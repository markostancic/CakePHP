<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator

	    		
 */
class MaterialsController extends AppController {

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
		
		$this->Material->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
        $conditions = array();

        if (isset($this->request->query['keyword'])) {
        	$this->request->data['Material'] = $this->request->query;
            $conditions['name like'] = '%'.$this->request->query['keyword'].'%';            
        }

		$materials = $this->Paginator->paginate($conditions);

        $this->set(compact('materials'));
    

		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Material->exists($id)) {
			throw new NotFoundException(__('Nepostojeci materijal'));
		}
		$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
		$this->set('material', $this->Material->find('first', $options));
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
			if (!$this->Material->exists($id)) {
				throw new NotFoundException(__('Nepostojeci materijal'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->Material->create();
			$result = $this->Material->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Materijal je uspesno dodat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		}


		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->Material->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Materijal je uspesno izmenjen.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
			$options = array('conditions' => array('Material.' . $this->Material->primaryKey => $id));
			$material = $this->Material->find('first', $options);
			$item = $this->Material->Item->find('first', array('conditions' => array('Item.id' => $material['Item']['id']), 'recursive' => -1));

			$this->request->data['Material']['id'] = $material['Material']['id'];
			$this->request->data['Material']['code'] = $item['Item']['code'];
			$this->request->data['Material']['name'] = $item['Item']['name'];
			$this->request->data['Material']['description'] = $item['Item']['description'];
			$this->request->data['Material']['weight'] = $item['Item']['weight'];
			$this->request->data['Material']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
			$this->request->data['Material']['service_production'] = $material['Material']['service_production'];
			$this->request->data['Material']['material_status'] = $material['Material']['material_status'];
			$this->request->data['Material']['recommended_rating'] = $material['Material']['recommended_rating'];
			$this->request->data['Material']['item_type_id'] = $item['Item']['item_type_id'];

			}
		}

		$statuses = $this->Material->statuses;
		$this->set(compact('statuses'));
		$rating = $this->Material->rating;
		$this->set(compact('rating'));
		$measurementUnits = $this->Material->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->Material->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'material')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($material)) {
			$this->request->data = $material;
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
		$result = $this->Material->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Materijal je uspesno izbrisan.'));

		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
}
