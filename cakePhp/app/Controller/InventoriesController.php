<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator

	    		
 */
class InventoriesController extends AppController {

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
		$this->Inventory->recursive = 0;
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
		$this->set('inventories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Inventory->exists($id)) {
			throw new NotFoundException(__('Nepostojeci inventar'));
		}
		$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
		$this->set('inventory', $this->Inventory->find('first', $options));
	}

/**
 * save method
 *
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->Inventory->exists($id)) {
				throw new NotFoundException(__('Nepostojeci inventar'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->Inventory->create();
			$result = $this->Inventory->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Akcija je uspesno obavljena.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		}

		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->Inventory->saveProduct($this->request->data, $id);
			if($result['success']) {
					$this->Flash->success(__('Akcija je uspesno obavljena.'));
					return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('Inventory.' . $this->Inventory->primaryKey => $id));
				$inventory = $this->Inventory->find('first', $options);
				$item = $this->Inventory->Item->find('first', array('conditions' => array('Item.id' => $inventory['Item']['id']), 'recursive' => -1));

				$this->request->data['Inventory']['id'] = $inventory['Inventory']['id'];
				$this->request->data['Inventory']['code'] = $item['Item']['code'];
				$this->request->data['Inventory']['name'] = $item['Item']['name'];
				$this->request->data['Inventory']['description'] = $item['Item']['description'];
				$this->request->data['Inventory']['weight'] = $item['Item']['weight'];
				$this->request->data['Inventory']['status'] = $inventory['Inventory']['status'];
				$this->request->data['Inventory']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['Inventory']['status'] = $inventory['Inventory']['status'];
				$this->request->data['Inventory']['recommended_rating'] = $inventory['Inventory']['recommended_rating'];
				$this->request->data['Inventory']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$statuses = $this->Inventory->statuses;
		$this->set(compact('statuses'));
		$rating = $this->Inventory->rating;
		$this->set(compact('rating'));
		$measurementUnits = $this->Inventory->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->Inventory->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'inventory')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($inventory)) {
			$this->request->data = $inventory;
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
		$result = $this->Inventory->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Akcija je uspesno obrisana.'));

		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
