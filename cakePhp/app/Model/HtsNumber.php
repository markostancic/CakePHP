<?php
App::uses('AppModel', 'Model');
/**
 * HtsNumber Model
 *
 */
class HtsNumber extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'hts_number' => array(
            'htsNumberRule' => array(
	            'rule' => array('isUnique'),
	            'message' => 'HS Broj je zauzet!',
	            'required' => true
           	)
        )
	);
	public $hasMany = array(
		'Good' => array(
			'className' => 'Good',
			'foreignKey' => 'tax_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Kit' => array(
			'className' => 'Kit',
			'foreignKey' => 'tax_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'tax_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ServiceProduct' => array(
			'className' => 'ServiceProduct',
			'foreignKey' => 'tax_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
