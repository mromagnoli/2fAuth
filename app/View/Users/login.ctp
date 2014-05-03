<div>
	<?=$this->Session->flash('auth')?>
	<?=$this->Form->create('User')?>
	<?=$this->Form->input('username')?>
	<?=$this->Form->input('password')?>
	<?//=$this->Form->input('code')?>
	<?=$this->Form->submit('Log in')?>
	<?=$this->Form->end()?>
</div>
<div>
Register
<?=$this->Form->create('User', array(
	'id' => 'UserAddForm',
	'url' => array('controller' => 'users',	'action' => 'add')
))?>
	<?=$this->Form->input('name')?>
	<?=$this->Form->input('username')?>
	<?=$this->Form->input('mail')?>
	<?=$this->Form->input('password')?>
<?=$this->Form->end('Register')?>
</div>