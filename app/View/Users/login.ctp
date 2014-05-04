<div class="jumbotron">
	<h1>MyBin</h1>
	<p>Cloud based files storage, for ALL.</p>
	<p><button class="btn btn-primary btn-large" data-toggle="modal" data-target="#registerModal">Sign up</button></p>
	<p><button class="btn btn-small" data-toggle="modal" data-target="#loginModal">Login</button></p>
	<p><?=$this->Html->image('bin-logo.png')?></p>
</div>
<?=$this->element('users/login')?>
<?=$this->element('users/register')?>