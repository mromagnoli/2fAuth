<h1>Implementación Autenticación Doble Factor.</h1>
<h2>Introducción</h2>
<p>
	La arquitectura para el problema de 2F-Autentication que se eligió contempla la posibilidad de hacer uso, si el usuario lo expresa, de la doble autenticación.
	Lo que se propone, es utilizar como primer factor de autenticación, <b>algo que el usuario sabe</b>, esto se implementa con los campos de <b><i>Usuario y Contraseña</i></b>. Por otra parte, como segundo factor de autenticación lo que se implementa es <b>algo que el usuario posea</b>, y esto se logra mediante, por ejemplo, el teléfono celular del usuario, en el cuál se generan <b>One Time Passwords</b> (OTP), la cuales, por definición, expiran en un tiempo dado.
</p>
<h2>Arquitectura</h2>
<p>
	La autenticación que se realiza en este caso, hace uso de lo que se conoce como <b>One Time Password</b>, es decir contraseñas o valores de cadena que son generados en el momento preciso que se va a necesitar usar, y que no pueden volver a ser usadas nuevamente, o luego de un tiempo determinado. El valor resultante de la generación de una OTP, por lo general se hace que dependa en parte de quién solicite su generación y cuándo lo solicite para reforzar esa cualiad de unicidad. Esto hace que sean candidatas perfectas para la implementación de Autenticación de Doble Factor, en relación a un valor para el denomiado <b>Factor de Posesión</b>.
</p>
<p>
	En este caso, el algoritmo y metodología utilizados para la generación de la OTP es la que se define en la <a href="http://tools.ietf.org/html/rfc6238"><b>RFC 6238</b></a> <b>TOTP: Time-Based One-Time Password Algorithm</b>, es decir, una contraseña de un sólo uso basada en tiempo.<br>
	Este algoritmo, TOPT, es una extensión del algoritmo <b>HMAC-based One-Time Password (HOTP)</b> <a href="http://tools.ietf.org/html/rfc4226"><b>-RFC 4226-</b></a> que en vez de utilizar un contador como valor de cambio, utiliza un valor de tiempo, más especificamente un valor de <i>Unix Time.</i><br>
	En líneas generales, el algoritmo de TOPT funciona de la siguiente manera:<br>
	<ul>
		<li>Se calcula un token HMAC mediante el algoritmo HMAC-SHA-1 utilizando como key un valor de <i>secreto</i> que es asignado al usuario determinado y el valor de tiempo actual basado en el Unix Time.
		</li>
		<li>
			Luego se selecciona un valor dentro del token que se utiliza como un offset. Este offset es el valor que represente el digito menos significativo.
		</li>
		<li>
			El offset que se obtuvo, determina la posición dentro del token a partir de la cual se extraen los siguientes 8 digitos hexadecimales (4 bytes).
		</li>
		<li>
			El valor extraído es convertido en <i>Integer.</i>
		</li>
		<li>
			Se divide el valor entero entre 1000000, es decir <b>10^6</b>, donde <b>6</b> determina la cantidad de digitos que queremos que tenga nuesta OTP.
		</li>
		<li>
			El resto de esta división, es decir el resultado de la operación <i>módulo</i>, es el valor utilizado como OTP.
		</li>
	</ul>
	<?=$this->Html->image('TOPT.png')?>
</p>
<h2>Aplicación</h2>
<p>
	En la aplicación, se utiliza <b>Google Authenticator</b> como generador de claves OTP y es quien nos provee la imagen de código QR para su escaneo y almacenamiento de secreto mediante su aplicación <i>Android</i>. Además, nos permite sincronizar el reloj para que los códigos sean generados dentro del mismo timestamp que la web.<br>
	Google Authenticator, utiliza un <b>paso de 30 segundos</b>, es decir, genera una nueva OTP cada 30 segundos y realiza hashes mediante el algoritmo <b>HMAC-SHA-1</b> con un <b>secreto de 80 bits</b> proveido por una cadena de <b>16 caracteres encodeado en Base32</b>. Son basicamente estos datos lo que hay que tener en cuenta para la implementación del método que valida esas OTP.
</p>
<p>
	El proceso de autenticado del usuario comienza en el momento que el mismo se ha registrado al sitio. Una vez el usuario se registro (<i>Sign In</i>), el mismo es logueado en el sistema. Si el usuario quiere utilizar Autenticación de doble factor deberá dirigirse al link <b><i>Get Secret</i></b>.<br>
	En ese momento, se genera un secreto random para el usuario, como se muestra en las figuras siguientes:
	<?=$this->Html->image('codes/get_secret.png')?><br><br>
	En la imágen anterior, puede verse el método que se utiliza para limpiar el secreto, si se solicita, obtener un nuevo secreto, y al final se setean los valores para presentar luego al usuario.
	<?=$this->Html->image('codes/generate_secret.png')?><br>
	Aquí, se seleccionan valores random en 0 y 255, para armar una serie de chars que luego son encodeados en base32.<br>
	Este secreto es luego presentado al usuario en forma de código QR, el cual debe escanearse con el dispositivo móvil:
	<?=$this->Html->image('codes/get_secret_view.png')?><br>
</p>
<p>
	Una vez el usuario ha ingresado sus credenciales en la app móvil, ésta empezará a generar OTPs cada 30 segundos, las cuales deberá utilizar para completar el campo <i>Code</i> a la hora de loguearse:<br>
	<?=$this->Html->image('codes/cap_otp.png')?><br><br>
	<?=$this->Html->image('codes/login_code.png')?><br>
</p>
<p>
	Una vez se presiona <i>Log in</i>, el módulo de Autenticación chequea que el código que se ingreso sea correcto.<br>
	En la siguiente imágen se muestra el método encargado de generar el <b>TOPT</b>:<br><br>
	<?=$this->Html->image('codes/getCode.png')?><br><br>
	Una vez esta función devuelve el OTP calculado, el mismo se compara con el ingresado por el usuario, si son iguales se concede el acceso, sino se rechaza. Cabe destacar, que previamente debe haber ingresado correctamente los valores de <i>Usuario y Contraseña</i>.<br>
	Por último, si el usuario pudo acceder, se almacena esa OTP, para no permitir su uso nuevamente si el usuario la quiere volver a utilizar.
</p>