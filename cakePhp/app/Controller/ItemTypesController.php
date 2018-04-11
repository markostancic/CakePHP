<?php
App::uses('AppController', 'Controller');
/**
 * ItemTypes Controller
 *
 * @property ItemType $ItemType
 * @property PaginatorComponent $Paginator
 */
class ItemTypesController extends AppController {

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
		$this->ItemType->recursive = 0;
		$this->set('itemTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ItemType->exists($id)) {
			throw new NotFoundException(__('Nepostojeci tip'));
		}
		$options = array('conditions' => array('ItemType.' . $this->ItemType->primaryKey => $id));
		$this->set('itemType', $this->ItemType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemType->create();
			if ($this->ItemType->save($this->request->data)) {
				$this->Flash->success(__('Tip je sacuvan.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Tip ne moze biti sacuvan. Pokusajte ponovo.'));
			}
		}
		$classes = $this->ItemType->classes;
		$this->set(compact('classes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ItemType->exists($id)) {
			throw new NotFoundException(__('Nepostojeci tip'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ItemType->save($this->request->data)) {
				$this->Flash->success(__('Tip je sacuvan.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Tip ne moze biti sacuvan. Pokusajte ponovo.'));
			}
		} else {
			$options = array('conditions' => array('ItemType.' . $this->ItemType->primaryKey => $id));
			$this->request->data = $this->ItemType->find('first', $options);
		}
		$classes = $this->ItemType->classes;
		$this->set(compact('classes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id) {
		$this->ItemType->id = $id;
		if (!$this->ItemType->exists()) {
			throw new NotFoundException(__('Nepostojeci tip'));
		}
		$this->request->allowMethod('post', 'delete');

		$item_type_exist = $this->ItemType->Item->find('count', array(
			'conditions' => array('Item.item_type_id' => $id),
			'recursive' => -1
		));
		if(!empty($item_type_exist)){
			$this->Flash->error('Ne mozete obrisati tip zato sto postoje artikli vezani za nju');
			return $this->redirect(array('action' => 'index'));
		}

		if ($this->ItemType->delete()) {
			$this->Flash->success(__('Tip je uspesno obrisan.'));
		} else {
			$this->Flash->error(__('Tip ne moze biti obrisan. Pokusajte ponovo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
