<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator

	    		
 */
class SemiProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->SemiProduct->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
        $conditions = array();

        if (isset($this->request->query['keyword'])) {
        	$this->request->data['SemiProduct'] = $this->request->query;
            $conditions['name like'] = '%'.$this->request->query['keyword'].'%';            
        }

		$semiProducts = $this->Paginator->paginate($conditions);

        $this->set(compact('semiProducts'));
    

		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SemiProduct->exists($id)) {
			throw new NotFoundException(__('Nepostojeci poluproizvod'));
		}
		$options = array('conditions' => array('SemiProduct.' . $this->SemiProduct->primaryKey => $id));
		$this->set('semiProduct', $this->SemiProduct->find('first', $options));
	}

/**
 * add/edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->SemiProduct->exists($id)) {
				throw new NotFoundException(__('Nepostojeci poluproizvod'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->SemiProduct->create();
			$result = $this->SemiProduct->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Poluproizvod je uspesno dodat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
						$this->Flash->error($result['message']);
						return $this->redirect(array('action' => 'index'));
			}
		}


		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->SemiProduct->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Poluproizvod je uspesno izmenjen.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('SemiProduct.' . $this->SemiProduct->primaryKey => $id));
				$semiProduct = $this->SemiProduct->find('first', $options);
				$item = $this->SemiProduct->Item->find('first', array('conditions' => array('Item.id' => $semiProduct['Item']['id']), 'recursive' => -1));

				$this->request->data['SemiProduct']['id'] = $semiProduct['SemiProduct']['id'];
				$this->request->data['SemiProduct']['code'] = $item['Item']['code'];
				$this->request->data['SemiProduct']['name'] = $item['Item']['name'];
				$this->request->data['SemiProduct']['description'] = $item['Item']['description'];
				$this->request->data['SemiProduct']['weight'] = $item['Item']['weight'];
				$this->request->data['SemiProduct']['service_production'] = $semiProduct['SemiProduct']['service_production'];
				$this->request->data['SemiProduct']['semi_product_status'] = $semiProduct['SemiProduct']['semi_product_status'];
				$this->request->data['SemiProduct']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['SemiProduct']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$statuses = $this->SemiProduct->statuses;
		$this->set(compact('statuses'));
		$measurementUnits = $this->SemiProduct->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->SemiProduct->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'semi_product')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($semiProduct)) {
			$this->request->data = $semiProduct;
		}		
  	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id) {
		$this->request->allowMethod('post', 'delete');
		$result = $this->SemiProduct->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Poluproizvod je uspesno obrisan.'));

		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
