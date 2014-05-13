<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {
/**
 * view method
 *
 * @param string $id
 * @return void
*/
	public function view($id = null) {
		if (empty($id)) {
			$id = AuthComponent::user('Panel.id');
		}
		if (!$this->Panel->exists($id)) {
			throw new NotFoundException(__('Invalid panel'));
		}
		$options = array('conditions' => array('Panel.' . $this->Panel->primaryKey));

		$this->set('panel', $this->Panel->find('first', $options));
	}

/**
 *
 */
	public function how_to() {}
}
