<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 */
class ServiceProduct extends AppModel {

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

	public $eccn = array(
		'EAR99' => 'EAR99',
		'3D991' => '3D991'
	);

	public $statuses = array(
		'development' => 'U razvoju',
		'for_sale' => 'Za prodaju',
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
		'tax_group_id' => array(
			'taxGroupIdRule1' => array(
				'rule' => array('notBlank'),
				'message' => 'Ne moze biti prazno!',
				'allowEmpty' => true
			),
			'taxGroupIdRule2' => array(
				'rule' => array('taxGroupExistsValidation'),
				'message' => 'Poreska grupa nije validna!',
				'required' => true
			)
		),
		'hts_number_id' => array(
			'htsNumberIdRule1' => array(
				'rule' => array('notBlank'),
				'message' => 'HS Broj ne moze biti prazno!',
				'allowEmpty' => true
			),
			'htsNumberIdRule2' => array(
				'rule' => array('htsNumberValidation'),
				'message' => 'HS Broj nije validan!',
				'required' => true
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
		'service_status' => array(
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
		'eccn' => array(
			'eccnRule1' => array(
				'rule' => 'notBlank',
				'message' => 'Status artikla nije definisan.',
				'allowEmpty' => true
			),
			'eccnRule2' => array(
				'rule' => array('checkEccn'),
				'message' => 'Status nije validan.',
				'required' => true
			)
		),
		'service_production' => array(
			'serviceProductionRule1' => array(
				'rule' => 'boolean',
				'message' => 'service_production.',
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
			'conditions' => array('Item.id' => $this->data['ServiceProduct']['item_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}

	public function htsNumberValidation($check){
		$exists = $this->HtsNumber->find('count', array(
			'conditions' => array('HtsNumber.id' => $this->data['ServiceProduct']['hts_number_id']), 
			'recursive' => -1
		));
		return !empty($exists);
	}

	public function taxGroupExistsValidation($check){
		$exists = $this->Tax->find('count', array(
			'conditions' => array('Tax.id' => $this->data['ServiceProduct']['tax_group_id']), 
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
        return array_key_exists($this->data['ServiceProduct']['service_status'], $this->statuses);
    }//~!

    public function checkEccn($check) {
        return array_key_exists($this->data['ServiceProduct']['eccn'], $this->eccn);
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
					'conditions' => array('ServiceProduct.id' => $id),
					'fields' => array('ServiceProduct.item_id', 'Item.code'),
					'recursive' => 0
				));
				if(empty($product_data)){
					throw new Exception("Artikal nije validan!");	
				}
			}

			$item = array();
			$item['Item']['name'] = $form_data['ServiceProduct']['name'];
			$item['Item']['description'] = $form_data['ServiceProduct']['description'];
			$item['Item']['weight'] = $form_data['ServiceProduct']['weight'];
			$item['Item']['measurement_unit_id'] = $form_data['ServiceProduct']['measurement_unit_id'];
			$item['Item']['item_type_id'] = $form_data['ServiceProduct']['item_type_id'];

			if(!empty($product_data['ServiceProduct']['item_id'])){
				$item['Item']['id'] = $product_data['ServiceProduct']['item_id'];
				$item['Item']['code'] = $product_data['Item']['code'];
			}else{
				$this->Item->create();
			}
			if(!$this->Item->save($item)){
				$errors = $this->Item->validationErrors;
				throw new Exception("Artikal ne moze biti snimljen: ".array_shift($errors)[0]);			
			}
			if(!empty($product_data['ServiceProduct']['item_id'])){
				$item_id = $item['Item']['id'] = $product_data['ServiceProduct']['item_id'];

			}else{
				$item_id = $this->Item->id;	
			}
			
			$serviceProduct = array();
			$serviceProduct['ServiceProduct']['item_id'] = $item_id;
			$serviceProduct['ServiceProduct']['id'] = $id;
			$serviceProduct['ServiceProduct']['pid'] = $form_data['ServiceProduct']['pid'];
			$serviceProduct['ServiceProduct']['hts_number_id'] = $form_data['ServiceProduct']['hts_number_id'];
			$serviceProduct['ServiceProduct']['tax_group_id'] = $form_data['ServiceProduct']['tax_group_id'];
			$serviceProduct['ServiceProduct']['eccn'] = $form_data['ServiceProduct']['eccn'];
			if(isset($form_data['ServiceProduct']['release_date'])){
				$serviceProduct['ServiceProduct']['release_date'] = $form_data['ServiceProduct']['release_date'];
			} else {
				$serviceProduct['ServiceProduct']['release_date'] = null;
			}
			if(empty($serviceProduct['ServiceProduct']['release_date'])){
				if($form_data['ServiceProduct']['service_status'] == 'for_sale'){
					$serviceProduct['ServiceProduct']['release_date'] = date('Y-m-d H:i:s');
				}else{
					$serviceProduct['ServiceProduct']['release_date'] = null;
				}
			}				
			
			$serviceProduct['ServiceProduct']['for_distributors'] = $form_data['ServiceProduct']['for_distributors'];
			$serviceProduct['ServiceProduct']['service_status'] = $form_data['ServiceProduct']['service_status'];


			$this->create();
			if(!$this->save($serviceProduct)){
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
				'conditions' => array('ServiceProduct.id' => $id),
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
