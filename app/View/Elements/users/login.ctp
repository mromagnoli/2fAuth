<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="loginModalLabel">Login</h4>
      </div>
      <div class="modal-body">
			<?=$this->Form->create('User', array(
				'role' => 'form'
			))?>
			<?=$this->Form->input('username', array(
				'div' => 'form-group',
				'class' => 'form-control'
			))?>
			<?=$this->Form->input('password', array(
				'div' => 'form-group',
				'class' => 'form-control'
			))?>
			<?=$this->Form->input('code', array(
				'div' => 'form-group',
				'class' => 'form-control'
			))?>
			<?=$this->Form->submit('Log in', array('class' => 'btn btn-success'))?>
			<?=$this->Form->end()?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>