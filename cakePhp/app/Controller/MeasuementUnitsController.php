<?php
App::uses('AppController', 'Controller');
/**
 * MeasuementUnits Controller
 *
 * @property MeasuementUnit $MeasuementUnit
 * @property PaginatorComponent $Paginator
 */
class MeasuementUnitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MeasuementUnit->recursive = 0;
		$this->set('measuementUnits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MeasuementUnit->exists($id)) {
			throw new NotFoundException(__('Nepostojece merna jedinica'));
		}
		$options = array('conditions' => array('MeasuementUnit.' . $this->MeasuementUnit->primaryKey => $id));
		$this->set('measuementUnit', $this->MeasuementUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MeasuementUnit->create();
			if ($this->MeasuementUnit->save($this->request->data)) {
				$this->Flash->success(__('Merna jedinica je uspesno sacuvana.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Merna jedinica ne moze biti sacuvana. Pokusajte ponovo.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->MeasuementUnit->exists($id)) {
			throw new NotFoundException(__('Nepostojeca merna jedinica'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->MeasuementUnit->save($this->request->data)) {
				$this->Flash->success(__('Merna jedinica je uspesno izmenjena.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Merna jedinica ne moze biti sacuvana. Pokusajte ponovo.'));
			}
		} else {
			$options = array('conditions' => array('MeasuementUnit.' . $this->MeasuementUnit->primaryKey => $id));
			$this->request->data = $this->MeasuementUnit->find('first', $options);
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
		$this->MeasuementUnit->id = $id;
		if (!$this->MeasuementUnit->exists()) {
			throw new NotFoundException(__('Nepostojeca merna jedinica'));
		}
		$this->request->allowMethod('post', 'delete');

		$item_exist = $this->MeasuementUnit->Item->find('count', array(
			'conditions' => array('Item.measurement_unit_id' => $id),
			'recursive' => -1
		));
		if(!empty($item_exist)){
			$this->Flash->error('Ne mozete obrisati jedinicu mere zato sto postoje artikli vezani za nju');
			return $this->redirect(array('action' => 'index'));
		}

		if ($this->MeasuementUnit->delete()) {
			$this->Flash->success(__('Merna jedinica je uspesno obrisana.'));
		} else {
			$this->Flash->error(__('Merna jedinica ne moze biti obrisana. Pokusajte ponovo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
