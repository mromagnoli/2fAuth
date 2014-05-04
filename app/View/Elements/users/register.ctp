<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerModalLabel">Login</h4>
      </div>
      <div class="modal-body">
			<?=$this->Form->create('User', array(
				'id' => 'UserAddForm',
				'url' => array('controller' => 'users',	'action' => 'add'),
				'role' => 'form'
			))?>
				<?=$this->Form->input('name', array(
					'div' => 'form-group'
				))?>
				<?=$this->Form->input('username', array(
					'div' => 'form-group'
				))?>
				<?=$this->Form->input('mail', array(
					'div' => 'form-group'
				))?>
				<?=$this->Form->input('password', array(
					'div' => 'form-group'
				))?>
			<?=$this->Form->end('Register')?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>