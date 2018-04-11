<?php
App::uses('AppModel', 'Model');
/**
 * MeasuementUnit Model
 *
 */
class MeasuementUnit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
    'name' => array(
      'nameRule1' => array(
        'rule' => 'notBlank',
        'message' => 'Molimo unesite naziv merne jedinice.'
      ),
      'nameRule2' => array(
        'rule' => 'isUnique',
        'message' => 'Ime mora biti jedinstveno.'
      )
    ),
    'symbol' => array(
      'symbolRule1' => array(
        'rule' => 'notBlank',
        'message' => 'Molimo unesite simbol merne jedinice .'
      ),
      'symbolRule2' => array(
        'rule' => array('symbolValidation'),
        'message' => 'Simbol merne jedinice nije validan!',
        'required' => true
      ),
      'symbolRule3' => array(
        'rule' => array('isUnique'),
        'message' => 'Simbol merne jedinice mora biti jedinstven!'
      )
    ),
	);

	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'measurement_unit_id',
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
    public function symbolValidation($check) {

    	$value = array_values($check);
        $value = $value[0];
        return preg_match('|^[a-z]+$|', $value);
    }
}
