<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 */
class Item extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	function beforeValidate($options = array()) { 		

 		//Check for code
    if(empty($this->data['Item']['code'])){
    //Create new code
      $type = $this->ItemType->find('first', array(
      'conditions' => array('ItemType.id' => $this->data['Item']['item_type_id']),
      'fields' => array('ItemType.code'),
      'recursive' => -1
      ));
      if(!empty($type)){
        $count = $this->find('count', array(
        	'conditions' => array('Item.item_type_id' => $this->data['Item']['item_type_id']),
        	'recursive' => -1
        ));
        $new_count = $count + 1;
        $this->data['Item']['code'] = $type['ItemType']['code'].'-'.str_pad($new_count, 4, '0', STR_PAD_LEFT);
      }
    }
    return true;
  }
	public $validate = array(
    'code' => array(
      'codeRule1' => array(
        'rule' => 'notBlank',
        'message' => 'Molimo unesite kod artikla.'
      ),
      'codeRule2' => array(
        'rule' => 'isUnique',
        'message' => 'Kod artikla mora biti jedinstveno'
      )
    ),
    'name' => array(
      'nameRule1' => array(
        'rule' => 'notBlank',
        'message' => 'Molimo unesite naziv artikla.',
        'required' => true
      ),
      'nameRule2' => array(
        'rule' => 'isUnique',
        'message' => 'Ime artikla mora biti jedinstveno'
      )
    ),
    'item_type_id' => array(
      'itemTypeRule1' => array(
        'rule' => 'notBlank',
        'message' => 'Molimo odaberite tip kojem pripada artikal.'
      ),
      'itemTypeRule2' => array(
        'rule' => array('itemTypeExistsValidation'),
        'message' => 'Tip artikla nije validan!',
        'required' => true
      )
    ),
    'weight' => array(
      'weightRule' => array(
        'rule' => array('weightNumberValidation'),
        'message' => 'Weight broj nije validan!',
        'allowEmpty' => true
      )
    ),
    'measurement_unit_id' => array(
      'measurementUnitIdRule' => array(
        'rule' => array('numeric'),
        'message' => 'Jedinica mere mora biti broj!',
        'required' => true
      ),
      'measurementUnitIdRule2' => array(
        'rule' => array('measurementUnitExistsValidation'),
        'message' => 'Jedinica mere mora biti broj!',
        'required' => true
      )
    )
	);
	public function measurementUnitExistsValidation($check){
		$exists = $this->MeasuementUnit->find('count', array(
			'conditions' => array('MeasuementUnit.id' => $this->data['Item']['measurement_unit_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}
	public function itemTypeExistsValidation($check){
		$exists = $this->ItemType->find('count', array(
			'conditions' => array('ItemType.id' => $this->data['Item']['item_type_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}
  public function weightNumberValidation($check){
    	$value = array_values($check);
        $value = $value[0];
        return preg_match('|^[0-9]+$|', $value);
    }

	public $belongsTo = array(
		'MeasuementUnit' => array(
			'className' => 'MeasuementUnit',
			'foreignKey' => 'measurement_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemType' => array(
			'className' => 'ItemType',
			'foreignKey' => 'item_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'item_id',
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
