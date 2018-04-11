<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class SemiProduct extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $components = array('Flash', 'Session');
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $statuses = array(
		'development' => 'U razvoju',
		'in_use' => 'U upotrebi',
		'phase_out' => 'Za prodaju dok ne zastari',
		'obsolete' => 'Zastarelo'
	);
	public $validate = array(
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
		'item_id' => array(
			'itemIdRule1' => array(
				'rule' => 'notBlank',
				'message' => 'Molimo odaberite tip kojem pripada artikal.'
			),
			'itemIdRule2' => array(
				'rule' => array('itemExistsValidation'),
				'message' => 'Tip artikla nije validan!',
				'required' => true
			),
			'itemIdRule3' => array(
				'rule' => array('numeric'),
				'message' => 'Tip artikla nije validan!',
				'required' => true
			)
		),
		'semi_product_status' => array(
			'semiProductStatusRule1' => array(
				'rule' => 'notBlank',
				'message' => 'Status artikla nije definisan.',
				'required' => true
			),
			'productStatusRule2' => array(
				'rule' => array('checkStatuses'),
				'message' => 'Status nije validan.',
				'required' => true
			)
		),
		'service_production' => array(
			'serviceProductionRule1' => array(
				'rule' => 'boolean',
				'message' => 'service production.',
				'allowEmpty' => true
			)
		),
		'measurement_unit_id' => array(
			'measurementUnitIdRule' => array(
				'rule' => array('notBlank'),
				'message' => 'Ne moze biti prazno!'
			)
		),
		'item_type_id' => array(
			'itemTypeRule1' => array(
				'rule' => 'notBlank',
				'message' => 'Molimo odaberite tip kojem pripada artikal.'
			)
		)
	);
	public function itemExistsValidation($check){
		$exists = $this->Item->find('count', array(
			'conditions' => array('Item.id' => $this->data['SemiProduct']['item_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}
    public function checkStatuses($check) {
        return array_key_exists($this->data['SemiProduct']['semi_product_status'], $this->statuses);
    }//~!
	public function checkStatus(){
		if($this->request->data['Product']['product_status'] == 'development'){
			var_dump($res);
			exit();
			if(empty($this->request->data['Product']['pid'])){
				return false;
			}
			return  true;
		} 
	}
	public function saveProduct($form_data, $id = null){

		$result = array();
		try {
			$dataSource = $this->getDataSource();
			$dataSource->begin();

			if(!empty($id)){
				$product_data = $this->find('first', array(
					'conditions' => array('SemiProduct.id' => $id),
					'fields' => array('SemiProduct.item_id', 'Item.code'),
					'recursive' => 0
				));
				if(empty($product_data)){
					throw new Exception("Artikal nije validan!");	
				}
			}

			$item = array();
			$item['Item']['name'] = $form_data['SemiProduct']['name'];
			$item['Item']['description'] = $form_data['SemiProduct']['description'];
			$item['Item']['weight'] = $form_data['SemiProduct']['weight'];
			$item['Item']['measurement_unit_id'] = $form_data['SemiProduct']['measurement_unit_id'];
			$item['Item']['item_type_id'] = $form_data['SemiProduct']['item_type_id'];

			if(!empty($product_data['SemiProduct']['item_id'])){
				$item['Item']['id'] = $product_data['SemiProduct']['item_id'];
				$item['Item']['code'] = $product_data['Item']['code'];
			}else{
				$this->Item->create();
			}
			if(!$this->Item->save($item)){
				$errors = $this->Item->validationErrors;
				throw new Exception("Artikal ne moze biti snimljen: ".array_shift($errors)[0]);			
			}
			if(!empty($product_data['SemiProduct']['item_id'])){
				$item_id = $item['Item']['id'] = $product_data['SemiProduct']['item_id'];

			}else{
				$item_id = $this->Item->id;	
			}

			$semiProduct = array();
			$semiProduct['SemiProduct']['item_id'] = $item_id;
			$semiProduct['SemiProduct']['id'] = $id;
			$semiProduct['SemiProduct']['semi_product_status'] = $form_data['SemiProduct']['semi_product_status'];
			$semiProduct['SemiProduct']['service_production'] = $form_data['SemiProduct']['service_production'];


			$this->create();
			if(!$this->save($semiProduct)){
				$errors = $this->validationErrors;
				throw new Exception("Proizvod ne moze biti snimljen: ".array_shift($errors)[0]);			
			}

			$result['success'] = true;
		} catch (Exception $e) {
			$result['success'] = false;
			$result['message'] = $e->getMessage();
		}

		if ($result['success']) {
		    $dataSource->commit();
		} else {
		    $dataSource->rollback();
		}

		return $result;
	}//~!
	public function deleteProduct($id){
		$result = array();
		try {
			$dataSource = $this->getDataSource();
			$dataSource->begin();

			$product_data = $this->find('first', array(
				'conditions' => array('SemiProduct.id' => $id),
				'fields' => array('Item.*'),
				'recursive' => 0
			));
			if(empty($product_data)){
				throw new Exception("Proizvod nije validan");			
			}

			$item['Item'] = $product_data['Item'];
			$item['Item']['deleted'] = 1;
			if(!$this->Item->save($item)){
				$errors = $this->Item->validationErrors;
				throw new Exception("Artikal ne moze biti obrisan: ".array_shift($errors)[0]);
			}

			$result['success'] = true;
		} catch (Exception $e) {
			$result['success'] = false;
			$result['message'] = $e->getMessage();
		}

		if ($result['success']) {
		    $dataSource->commit();
		} else {
		    $dataSource->rollback();
		}

		return $result;
	}

}
