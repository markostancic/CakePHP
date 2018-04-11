<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class Product extends AppModel {

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
		),
		'HtsNumber' => array(
			'className' => 'HtsNumber',
			'foreignKey' => 'hts_number_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tax' => array(
			'className' => 'Tax',
			'foreignKey' => 'tax_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $product_eccn = array(
		'EAR99' => 'EAR99'
	);

	public $statuses = array(
		'development' => 'U razvoju',
		'for_sale' => 'Za prodaju',
		'phase_out' => 'Za prodaju dok ne zastari',
		'obsolete' => 'Zastarelo',
		'nrnd' => 'Neupotrebljivo'
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
				'message' => 'Tip artikla nije broj!',
				'allowEmpty' => true
			)
		),
		'tax_group_id' => array(
			'taxGroupIdRule' => array(
				'rule' => array('taxGroupExistsValidation'),
				'message' => 'Poreska grupa nije validna!',
				'allowEmpty' => true
			)
		),
		'hts_number_id' => array(
			'htsNumberIdRule' => array(
				'rule' => array('htsNumberValidation'),
				'message' => 'HS Broj nije validan!',
				'allowEmpty' => true
			)
		),
		'pid' => array(
			'pidRule1' => array(
				'rule' => array('pidNumeric'),
				'message' => 'PID mora biti pozitivan.',
				'allowEmpty' => true
			),
			'pidRule2' => array(
				'rule' => array('isUnique'),
				'message' => 'PID proizvoda mora biti jedinstven.',
				'allowEmpty' => true
			)
		),
		'product_status' => array(
			'productStatusRule1' => array(
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
		'product_eccn' => array(
			'productEccnRule1' => array(
				'rule' => 'notBlank',
				'message' => 'Status artikla nije definisan.',
				'allowEmpty' => true
			),
			'productEccnRule2' => array(
				'rule' => array('checkEccn'),
				'message' => 'Status nije validan.',
				'required' => true
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
			'conditions' => array('Item.id' => $this->data['Product']['item_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}
	public function htsNumberValidation($check){
		$exists = $this->HtsNumber->find('count', array(
			'conditions' => array('HtsNumber.id' => $this->data['Product']['hts_number_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}
	public function taxGroupExistsValidation($check){
		$exists = $this->Tax->find('count', array(
			'conditions' => array('Tax.id' => $this->data['Product']['tax_group_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}

    public function pidNumeric($check) {

    	$value = array_values($check);
        $value = $value[0];
        return preg_match('|^[0-9]+$|', $value);
    }
    public function checkStatuses($check) {
        return array_key_exists($this->data['Product']['product_status'], $this->statuses);
    }//~!
    public function checkEccn($check) {
        return array_key_exists($this->data['Product']['product_eccn'], $this->product_eccn);
    }//~!

	public function saveProduct($form_data, $id = null){
		$result = array();
		try {
			$dataSource = $this->getDataSource();
			$dataSource->begin();

			if(!empty($id)){
				$product_data = $this->find('first', array(
					'conditions' => array('Product.id' => $id),
					'fields' => array('Product.item_id', 'Product.product_release_date', 'Item.code'),
					'recursive' => 0
				));
				if(empty($product_data)){
					throw new Exception("Artikal nije validan!");	
				}
			}

			$item = array();
			$item['Item']['code'] = $form_data['Product']['code'];
			$item['Item']['name'] = $form_data['Product']['name'];
			$item['Item']['description'] = $form_data['Product']['description'];
			$item['Item']['weight'] = $form_data['Product']['weight'];
			$item['Item']['measurement_unit_id'] = $form_data['Product']['measurement_unit_id'];
			$item['Item']['item_type_id'] = $form_data['Product']['item_type_id'];

			if(!empty($product_data['Product']['item_id'])){
				$item['Item']['id'] = $product_data['Product']['item_id'];
				$item['Item']['code'] = $product_data['Item']['code'];
			}else{
				$this->Item->create();
			}
			if(!$this->Item->save($item)){
				$errors = $this->Item->validationErrors;
				$this->validationErrors = $errors;
				throw new Exception("Artikal ne moze biti snimljen: ".array_shift($errors)[0]);			
			}
			if(!empty($product_data['Product']['item_id'])){
				$item_id = $item['Item']['id'] = $product_data['Product']['item_id'];

			}else{
				$item_id = $this->Item->id;	
			}
			
			$product = array();
			$product['Product']['item_id'] = $item_id;
			$product['Product']['id'] = $id;
			$product['Product']['pid'] = $form_data['Product']['pid'];
			$product['Product']['hts_number_id'] = $form_data['Product']['hts_number_id'];
			$product['Product']['tax_group_id'] = $form_data['Product']['tax_group_id'];
			$product['Product']['product_eccn'] = $form_data['Product']['product_eccn'];
			if(isset($form_data['Product']['product_release_date'])){
				$product['Product']['product_release_date'] = $form_data['Product']['product_release_date'];
			} else {
				$product['Product']['product_release_date'] = null;
			}
			if(empty($product['Product']['product_release_date'])){
				if($form_data['Product']['product_status'] == 'for_sale'){
					#$product['Product']['product_release_date'] = date('Y-m-d H:i:s');
					$product['Product']['product_release_date'] =  date('Y-m-d');
				}else{
					$product['Product']['product_release_date'] = null;
				}
				
			}
			$product['Product']['for_distributors'] = $form_data['Product']['for_distributors'];
			$product['Product']['product_status'] = $form_data['Product']['product_status'];
			$product['Product']['service_production'] = $form_data['Product']['service_production'];


			$this->create();
			if(!$this->save($product)){
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
				'conditions' => array('Product.id' => $id),
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
