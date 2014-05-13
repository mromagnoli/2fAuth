<?php
if (empty($user)) {
	return;
}
?>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<b><?=$this->Html->link(
				$user['username'],
				array('controller' => 'panels', 'action' => 'view', $user['panel_id']),
				array('class' => 'navbar-brand')
			)?></b>
		</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	<ul class="nav navbar-nav">
		<li><?=$this->Html->link(
			'Get Secret',
			array('controller' => 'users', 'action' => 'get_secret')
		)?></li>
		<li><?=$this->Html->link(
			'Logout',
			array('controller' => 'users', 'action' => 'logout')
		)?></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><?=$this->Html->link(
			'Implementación de Código',
			array('controller' => 'panels', 'action' => 'how_to')
		)?></li>
	</ul>
	</div><!-- /.container-fluid -->
</nav>
