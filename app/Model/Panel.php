<?php
App::uses('AppModel', 'Model');

class Panel extends AppModel {

	public $recursive = 2;

	public $hasOne = array(
		'User'
	);
}
