<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

/**
 *
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('add', 'logout', 'login', 'view');
	}

/**
 *
 */
	public function login() {
	if ($this->request->is('post')) {
		if ($this->Auth->login()) {
			return $this->redirect($this->Auth->redirectUrl());
		}
		$this->Session->setFlash(__('Invalid username or password, try again'));
	}
}

/**
 *
 */
	public function logout() {
		$this->Session->setFlash('Thanks, come again.');

		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$user = $this->User->save($this->request->data);

			if ($user) {
				if ($this->User->Panel->save(array('Panel' => array('user_id' => $this->User->id)))) {
					$this->User->saveField('wall_id', $this->User->Panel->id);
				}
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				return $this->redirect('/');
			}

			$this->Auth->login();
			$this->Session->setFlash(__('The user has been saved.'));

			//return $this->redirect(array('controller' => 'walls', 'action' => 'view', $this->User->Panel->id));
			return $this->redirect(array('action' => 'secret'));
		}
	}

/**
 *
 */
	public function secret($renew = null) {
		$this->User->id = $this->Auth->user('id');
		/*if ($this->request->is('post')) {
			$this->User->saveField('secret', null);
			$this->redirect(array('action' => 'view', $this->User->id));
		}*/

		App::uses('GoogleAuthenticator', 'GoogleAuthenticate.Lib');
		$Google = new GoogleAuthenticator();

		$secret = $this->User->field('secret');
		if (!$secret || $renew == 'renew') {
			$secret = $Google->generateSecret();
			$this->User->saveField('secret', $secret);
		}

		$url = $Google->getUrl($secret, $this->Auth->user('username'));

		$this->set(compact('secret', 'url'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}