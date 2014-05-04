<?php
App::uses('AppController', 'Controller');

class PanelsController extends AppController {

/**
 * view method
 *
 * @throws NotFoundException
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
		$options = array('conditions' => array('Panel.' . $this->Panel->primaryKey => $id));

		$this->set('panel', $this->Panel->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Panel->exists($id)) {
			throw new NotFoundException(__('Invalid panel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Panel->save($this->request->data)) {
				$this->Session->setFlash(__('The panel has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The panel could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Panel.' . $this->Panel->primaryKey => $id));
			$this->request->data = $this->Panel->find('first', $options);
		}
	}
}
