<?php
if (empty($panel)) {
	echo 'Something went wrong, return later.';
	return;
}
?>
<?=$this->element('nav-bar', array('user' => $panel['User']))?>
<div class="well">
	<p class="alert alert-info">
		In order to implement/remove <b>Two Factor Authentication</b> to your login
		go to the link in the navigation bar above.
	</p>
</div>
