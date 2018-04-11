<?php
App::uses('AppController', 'Controller');
/**
 * HtsNumbers Controller
 *
 * @property HtsNumber $HtsNumber
 * @property PaginatorComponent $Paginator
 */
class HtsNumbersController extends AppController {

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
		$this->HtsNumber->recursive = 0;
		$this->set('htsNumbers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->HtsNumber->exists($id)) {
			throw new NotFoundException(__('Nepostojeci hts broj'));
		}
		$options = array('conditions' => array('HtsNumber.' . $this->HtsNumber->primaryKey => $id));
		$this->set('htsNumber', $this->HtsNumber->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HtsNumber->create();
			if ($this->HtsNumber->save($this->request->data)) {
				$this->Flash->success(__('Hts broj je dodat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Hts broj ne moze biti sacuvan. Pokusajte ponovo.'));
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
		if (!$this->HtsNumber->exists($id)) {
			throw new NotFoundException(__('Nepostojeci hts broj'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->HtsNumber->save($this->request->data)) {
				$this->Flash->success(__('Hts broj je sacuvan.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Hts broj ne moze biti sacuvan. Pokusajte ponovo.'));
			}
		} else {
			$options = array('conditions' => array('HtsNumber.' . $this->HtsNumber->primaryKey => $id));
			$this->request->data = $this->HtsNumber->find('first', $options);
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
		$this->HtsNumber->id = $id;
		if (!$this->HtsNumber->exists()) {
			throw new NotFoundException(__('Nepostojeci hts broj'));
		}
		$this->request->allowMethod('post', 'delete');

		$product_exist = $this->HtsNumber->Product->find('count', array(
			'conditions' => array('Product.hts_number_id' => $id),
			'recursive' => -1
		));
		if(!empty($product_exist)){
       		$this->Flash->error('Ne mozete obrisati Hts broj zato sto postoje proizvodi vezani za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$good_exist = $this->HtsNumber->Good->find('count', array(
			'conditions' => array('Good.hts_number_id' => $id),
			'recursive' => -1
		));
		if(!empty($good_exist)){
       		$this->Flash->error('Ne mozete obrisati hts broj zato sto postoji roba vezana za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$kit_exist = $this->HtsNumber->Kit->find('count', array(
			'conditions' => array('Kit.hts_number_id' => $id),
			'recursive' => -1
		));
		if(!empty($kit_exist)){
       		$this->Flash->error('Ne mozete obrisati hts broj zato sto postoje kitovi vezani za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$service_product_exist = $this->HtsNumber->ServiceProduct->find('count', array(
			'conditions' => array('ServiceProduct.hts_number_id' => $id),
			'recursive' => -1
		));
		if(!empty($service_product_exist)){
       		$this->Flash->error('Ne mozete obrisati hts broj zato sto postoje usluge vezane za nju');
			return $this->redirect(array('action' => 'index'));			
		}

		if ($this->HtsNumber->delete()) {
			$this->Flash->success(__('Hts broj je obrisan.'));
		} else {
			$this->Flash->error(__('Hts broj ne moze biti obrisan. Pokusajte ponovo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
