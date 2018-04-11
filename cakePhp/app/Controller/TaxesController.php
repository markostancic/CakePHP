<?php
App::uses('AppController', 'Controller');
/**
 * Taxes Controller
 *
 * @property Tax $Tax
 * @property PaginatorComponent $Paginator
 */
class TaxesController extends AppController {

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
		$this->Tax->recursive = 0;
		$this->set('taxes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tax->exists($id)) {
			throw new NotFoundException(__('Ne postoji taksa'));
		}
		$options = array('conditions' => array('Tax.' . $this->Tax->primaryKey => $id));
		$this->set('tax', $this->Tax->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tax->create();
			if ($this->Tax->save($this->request->data)) {
				$this->Flash->success(__('Taksa je uspesno sacuvana.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Taksa ne moze biti sacuvana. Pokusajte ponovo.'));
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
		if (!$this->Tax->exists($id)) {
			throw new NotFoundException(__('Ne postoji taksa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tax->save($this->request->data)) {
				$this->Flash->success(__('Taksa je uspesno izmenjena.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('Taksa ne moze biti izmenjena. Pokusajte ponovo.'));
			}
		} else {
			$options = array('conditions' => array('Tax.' . $this->Tax->primaryKey => $id));
			$this->request->data = $this->Tax->find('first', $options);
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
		$this->Tax->id = $id;
		if (!$this->Tax->exists()) {
			throw new NotFoundException(__('Ne postoji taksa'));
		}
		$this->request->allowMethod('post', 'delete');

		$product_exist = $this->Tax->Product->find('count', array(
			'conditions' => array('Product.tax_group_id' => $id),
			'recursive' => -1
		));
		if(!empty($product_exist)){
       		$this->Flash->error('Ne mozete obrisati taxu zato sto postoje proizvodi vezani za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$good_exist = $this->Tax->Good->find('count', array(
			'conditions' => array('Good.tax_group_id' => $id),
			'recursive' => -1
		));
		if(!empty($good_exist)){
       		$this->Flash->error('Ne mozete obrisati taxu zato sto postoji roba vezana za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$kit_exist = $this->Tax->Kit->find('count', array(
			'conditions' => array('Kit.tax_group_id' => $id),
			'recursive' => -1
		));
		if(!empty($kit_exist)){
       		$this->Flash->error('Ne mozete obrisati taxu zato sto postoje kitovi vezani za nju');
			return $this->redirect(array('action' => 'index'));			
		}
		$service_product_exist = $this->Tax->ServiceProduct->find('count', array(
			'conditions' => array('ServiceProduct.tax_group_id' => $id),
			'recursive' => -1
		));
		if(!empty($service_product_exist)){
       		$this->Flash->error('Ne mozete obrisati taxu zato sto postoje usluge vezane za nju');
			return $this->redirect(array('action' => 'index'));			
		}

		if ($this->Tax->delete()) {
			$this->Flash->success(__('Taksa je uspesno obrisana.'));
		} else {
			$this->Flash->error(__('Taksa ne moze biti obrisana. Pokusajte ponovo.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}