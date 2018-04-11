<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator

	    		
 */
class ConsumablesController extends AppController {

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
		
		$this->Consumable->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
        $conditions = array();

        if (isset($this->request->query['keyword'])) {
        	$this->request->data['Consumable'] = $this->request->query;
            $conditions['name like'] = '%'.$this->request->query['keyword'].'%';            
        }

		$consumables = $this->Paginator->paginate($conditions);

        $this->set(compact('consumables'));	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Consumable->exists($id)) {
			throw new NotFoundException(__('Nepostojeci potrosni materijal'));
		}
		$options = array('conditions' => array('Consumable.' . $this->Consumable->primaryKey => $id));
		$this->set('consumable', $this->Consumable->find('first', $options));
	}

/**
 * save method
 *
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->Consumable->exists($id)) {
				throw new NotFoundException(__('Nepostojeci potrosni materijal'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->Consumable->create();
			$result = $this->Consumable->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Akcija je uspesno sacuvana.'));
				return $this->redirect(array('action' => 'index'));
			} else {
						$this->Flash->error($result['message']);
						return $this->redirect(array('action' => 'index'));
			}
		}

		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->Consumable->saveProduct($this->request->data, $id);
			if($result['success']) {
					$this->Flash->success(__('Akcija je uspesno sacuvana.'));
					return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('Consumable.' . $this->Consumable->primaryKey => $id));
				$consumable = $this->Consumable->find('first', $options);
				$item = $this->Consumable->Item->find('first', array('conditions' => array('Item.id' => $consumable['Item']['id']), 'recursive' => -1));
				$this->request->data['Consumable']['id'] = $consumable['Consumable']['id'];
				$this->request->data['Consumable']['code'] = $item['Item']['code'];
				$this->request->data['Consumable']['name'] = $item['Item']['name'];
				$this->request->data['Consumable']['description'] = $item['Item']['description'];
				$this->request->data['Consumable']['weight'] = $item['Item']['weight'];
				$this->request->data['Consumable']['consumable_status'] = $consumable['Consumable']['consumable_status'];
				$this->request->data['Consumable']['recommended_rating'] = $consumable['Consumable']['recommended_rating'];
				$this->request->data['Consumable']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['Consumable']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$statuses = $this->Consumable->statuses;
		$this->set(compact('statuses'));
		$measurementUnits = $this->Consumable->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$rating = $this->Consumable->rating;
		$this->set(compact('rating'));
		$itemTypes = $this->Consumable->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'consumable')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($consumable)) {
			$this->request->data = $consumable;
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
		$result = $this->Consumable->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Akcija je uspesno obrisana.'));

		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
