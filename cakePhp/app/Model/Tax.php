<?php
App::uses('AppModel', 'Model');
/**
 * Tax Model
 *
 */
class Tax extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'tax' => array(
           	'taxRule1' => array(
               	'rule' => 'notBlank',
               	'message' => 'Molimo unesite naziv artikla.'
           	),
           	'taxRule2' => array(
               	'rule' => 'isUnique',
               	'message' => 'Ime artikla mora biti jedinstveno'
           	),
          	'taxRule3' => array(
               	'rule' => array('taxNumeric'),
               	'message' => 'Ime artikla mora biti broj'
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
		),
	);
	
    public function taxNumeric($check) {
    	$value = array_values($check);
        $value = $value[0];
        return preg_match('|^[0-9]+$|', $value);
    }
}
