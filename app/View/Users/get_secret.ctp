<?php
if (empty($user) || empty($url) || empty($secret)) {
	echo "Something went wrong, please return later.";
	return;
}

?>
<?=$this->element('nav-bar', array('user' => $user))?>
<div class="users secret well">
	<p class="gauth-logo"><?=$this->Html->image('google-auth-logo.png')?></p>
	<h2>Google Authentication Secret</h2>
</div>
<div class="well">
	<p class="alert alert-warning">In order to use 2-Factor Authentication, you have to follow these directions</p>
	<ul>
		<li>Get and Install Google Authenticator in your phone from <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=es" target="_blank">Google Play</a></li>
		<li>Open the app</li>
		<li>Go to <i>Menu</i> then choose <i>Set up an account</i></li>
		<li>If you choose <i>Scan a barcode</i>, in scanning mode focus the next QR Code with your phone</li>
		<p><?=$this->Html->image($url)?></p>
		<li>If you choose <i>Enter secret manually</i>, you will have to provide the following values</li>
		<ul>
			<li>Username: <b><?=$user['username'] . '@mybin.com'?></b></li>
			<li>Secret: <b><?=$user['secret']?></b></li>
			<li>Type: <b>Time based</b></li>
		</ul>
	</ul>
	<p class="alert alert-success">Now, when you want to log in again, you will have to enter the 6 digits code shown in the Google Authenticator app.</p>
</div>
<div class="actions">
	<h3>Management</h3>
	<ul>
		<li><?php echo $this->Html->link('Change secret (Don\'t forget to scan again!)', array('action' => 'get_secret', 'renew'));?></li>
		<li><?php echo $this->Form->postLink('Remove secret (Return to One Factor Authentication)');?></li>
	</ul>
</div>