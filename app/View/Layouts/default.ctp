<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$siteDesc = "MyBin .::. Cloud based file storage.";
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $siteDesc ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
		echo $this->Html->css('jumbotron-narrow.css');
		echo $this->Html->css('general');

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo $this->Html->script('//code.jquery.com/jquery-1.11.0.min.js');
		echo $this->Html->script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container" class="container">
		<div id="header" class="header">
			<?=$this->Html->link(
				'<h2 class="text-muted">MyBin</h2>',
				'/',
				array(
					'escape' => false
				)
			)?>
		</div>
		<div id="content">
			<?=$this->Session->flash()?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" class="footer">
			<div class="media">
				<a class="pull-left" href="#">
					<!-- <img class="media-object" src="" alt="..."> -->
					<?=$this->Html->image('logotipo_um.jpg', array(
						'class' => 'media-object'
					))?>
				</a>
				<div class="media-body">
					<h5 class="media-heading">Universidad de Mendoza | Facultad de Ingeniería</h5>
					<b>Cátedra de Comunicaciones de Redes Seguras</b><br>
					<i>Implementación de Autenticación de Doble Factor</i><br>
					Marcelo Romagnoli. <i>leg. 5483</i>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
