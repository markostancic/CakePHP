<?php
App::uses('AppModel', 'Model');
/**
 * ItemType Model
 *
 */
class ItemType extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */

	public $classes = array(
		'product' => 'Proizvod',
		'material' => 'Repromaterijal',
		'kit' => 'Kit',
		'semi_product' => 'Poluproizvod',
		'service_product' => 'Usluga',
		'service_supplier' => 'Usluga dobavljaca',
		'goods' => 'Roba',
		'consumable' => 'Potrosni materijal',
		'inventory' => 'Inventar',
		'other' => 'Drugo'
	);

	public $validate = array(
    'code' => array(
     	'codeRule1' => array(
       	'rule' => 'notBlank',
       	'message' => 'Molimo odaberite tip kojem pripada artikal.'
     	),
    	'codeRule2' => array(
       	'rule' => array('isUnique'),
       	'message' => 'Tip artikla mora biti jedinstven!',
       	'required' => true
     	)
    ),
    'name' => array(
       'nameRule1' => array(
         'rule' => 'notBlank',
         'message' => 'Molimo unesite naziv artikla.'
       ),
       'nameRule2' => array(
         'rule' => 'isUnique',
         'message' => 'Ime artikla mora biti jedinstveno'
       )
    ),
    'class' => array(
      'classRule1' => array(
        'rule' => array('notBlank'),
        'message' => 'Molimo unesite klasu!',
        'required' => true
	    ),
      'classRule2' => array(
        'rule' => array('checkClass'),
        'message' => 'Klasa nije validna!',
        'required' => true
	    )
    )
	);
  public $hasMany = array(
    'Item' => array(
      'className' => 'Item',
      'foreignKey' => 'id',
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

    public function checkClass($check) {
        return array_key_exists($this->data['ItemType']['class'], $this->classes);
    }//~!
}
