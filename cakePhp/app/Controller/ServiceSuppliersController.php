<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator

	    		
 */
class ServiceSuppliersController extends AppController {

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
		$this->ServiceSupplier->recursive = 0;
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
		$this->set('serviceSuppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceSupplier->exists($id)) {
			throw new NotFoundException(__('Nepostojeca usluga dobavljaca'));
		}
		$options = array('conditions' => array('ServiceSupplier.' . $this->ServiceSupplier->primaryKey => $id));
		$this->set('serviceSupplier', $this->ServiceSupplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->ServiceSupplier->exists($id)) {
				throw new NotFoundException(__('Nepostojeca usluga dobavljaca'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->ServiceSupplier->create();
			$result = $this->ServiceSupplier->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Usluga dobavljaca je uspesno dodata.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		}

		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->ServiceSupplier->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Usluga dobavljaca je uspesno izmenjena.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('ServiceSupplier.' . $this->ServiceSupplier->primaryKey => $id));
				$serviceSupplier = $this->ServiceSupplier->find('first', $options);
				$item = $this->ServiceSupplier->Item->find('first', array('conditions' => array('Item.id' => $serviceSupplier['Item']['id']), 'recursive' => -1));

				$this->request->data['ServiceSupplier']['id'] = $serviceSupplier['ServiceSupplier']['id'];
				$this->request->data['ServiceSupplier']['code'] = $item['Item']['code'];
				$this->request->data['ServiceSupplier']['name'] = $item['Item']['name'];
				$this->request->data['ServiceSupplier']['description'] = $item['Item']['description'];
				$this->request->data['ServiceSupplier']['weight'] = $item['Item']['weight'];
				$this->request->data['ServiceSupplier']['service_status'] = $serviceSupplier['ServiceSupplier']['service_status'];
				$this->request->data['ServiceSupplier']['service_rating'] = $serviceSupplier['ServiceSupplier']['service_rating'];
				$this->request->data['ServiceSupplier']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['ServiceSupplier']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$statuses = $this->ServiceSupplier->statuses;
		$this->set(compact('statuses'));
		$rating = $this->ServiceSupplier->rating;
		$this->set(compact('rating'));
		$measurementUnits = $this->ServiceSupplier->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->ServiceSupplier->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'service_supplier')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($serviceSupplier)) {
			$this->request->data = $serviceSupplier;
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
		$result = $this->ServiceSupplier->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Usluga dobavljaca je uspesno izbrisana.'));

		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
