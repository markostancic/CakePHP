<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
* Products Controller
*
* @property Product $Product
* @property PaginatorComponent $Paginator
			
*/
class ProductsController extends AppController {
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
		
		$this->Product->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
		$conditions = array();
		if (isset($this->request->query['keyword'])) {
			$this->request->data['Product'] = $this->request->query;
		$conditions['name like'] = '%'.$this->request->query['keyword'].'%';
		}
		$products = $this->Paginator->paginate($conditions);
		$this->set(compact('products'));
	}
/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Nepostojeci proizvod'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
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
			if (!$this->Product->exists($id)) {
				throw new NotFoundException(__('Nepostojeci proizvod'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->Product->create();
			$result = $this->Product->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Proizvod je uspesno dodat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
			}
		}
	
		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->Product->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Proizvod je uspesno izmenjen.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
				$product = $this->Product->find('first', $options);
				$item = $this->Product->Item->find('first', array('conditions' => array('Item.id' => $product['Item']['id']), 'recursive' => -1));
				$this->request->data['Product']['id'] = $product['Product']['id'];
				$this->request->data['Product']['code'] = $item['Item']['code'];
				$this->request->data['Product']['name'] = $item['Item']['name'];
				$this->request->data['Product']['description'] = $item['Item']['description'];
				$this->request->data['Product']['weight'] = $item['Item']['weight'];
				$this->request->data['Product']['pid'] = $product['Product']['pid'];
				$this->request->data['Product']['service_production'] = $product['Product']['service_production'];
				$this->request->data['Product']['for_distributors'] = $product['Product']['for_distributors'];
				$this->request->data['Product']['product_eccn'] = $product['Product']['product_eccn'];
				$this->request->data['Product']['product_status'] = $product['Product']['product_status'];
				$this->request->data['Product']['product_release_date'] = $product['Product']['product_release_date'];
				$this->request->data['Product']['hts_number_id'] = $product['Product']['hts_number_id'];
				$this->request->data['Product']['tax_group_id'] = $product['Product']['tax_group_id'];
				$this->request->data['Product']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['Product']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}
		$taxes = $this->Product->Tax->find('list', array('fields' => array('Tax.tax')));
		$this->set('taxes', $taxes);
		$htsNumbers = $this->Product->HtsNumber->find('list', array('fields' => array('HtsNumber.hts_number')));
		$this->set('htsNumbers', $htsNumbers);
		$product_eccn = $this->Product->product_eccn;
		$this->set(compact('product_eccn'));
		$statuses = $this->Product->statuses;
		$this->set(compact('statuses'));
		$measurementUnits = $this->Product->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->Product->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'product')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($product)) {
			$this->request->data = $product;
				}
		$this->set('id', $id);
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
		$result = $this->Product->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Proizvod je uspesno obrisan.'));
		} else {
			$this->Flash->error($result['message']);
		}
		return $this->redirect(array('action' => 'index'));
	}
	public function index_excel() {
		App::import('Vendor', 'Excel', array('file' => 'phpexcel/excel.php'));

		//Generate file for Office 2003 XLS
		$this->layout = 'xls'; //this will use the no layout
		$this->autoRender = false;
		$this->response->type('application/vnd.ms-excel');
		//Create objects
		$objExcel = new Excel();
		$objExcelWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
		//Set objects
		$this->set('objExcel', $objExcel);
		$this->set('objExcelWriter', $objExcelWriter);
		$products = $this->Product->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('products', $products);
		//Set filename
		$filename = 'ime_fajla.xls';
		$this->set('filename', $filename);
		//Render excel
		$this->render('index_excel');
	}
	public function index_pdf() {
	//Init PDF
		$pdf = null;
		while (!class_exists('PDF')) {
		//Init PDF
		App::import('Vendor', 'PDF', array('file' => 'tcpdf' . DS . 'pdf.php'));
		}
		$pdf = new PDF('L', 'mm','A4', true, 'UTF-8', false);

		$filename = 'ime_fajla.pdf';
		$this->set('filename', $filename);

		$products = $this->Product->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('products', $products);
		$this->set('pdf', $pdf);

		$this->layout = 'pdf';
		$this->autoRender = false;
		$this->response->type('application/pdf');

		$this->render('index_pdf');
	}
	/**
* Method for importing records from excel file
*
* @return void
*/
	public function import_excel() {
		//Set page title
		$this->set('title_for_layout', 'Uvoz podataka iz excela');
		set_time_limit(0);
		if ($this->request->is('post') || $this->request->is('put')) {
			//Init data
			$starting_row = 2;
			$active_sheet = 0;

			//Check for uploaded file
			if(empty($this->request->data['Product']['import']['name'])){
			throw new Exception('Fajl nije ispravno prenet! Pokušajte ponovo.');
			}

			//Check if uploaded file is in excel format
			$upload_name = $this->request->data['Product']['import']['name'];
			if(substr($upload_name, -4) != '.xls' && substr($upload_name, -5) != '.xlsx'){
			throw new Exception('Fajl nije u Excel formatu!');
			}
			//Move uploaded file
			$file = $this->request->data['Product']['import'];
			$file['name'] = date('Ymdhis-') . $file['name'];
			$dir = new Folder(TMP, true, 0755);
			$dest = TMP . $file['name'];
			if(!move_uploaded_file($this->request->data['Product']['import']['tmp_name'], $dest)){
			throw new Exception('Fajl me nože biti prenet!');
			}

			//Init Excel
			App::import('Vendor', 'Excel', array('file' => 'phpexcel/excel.php'));
			$inputFileName = TMP.$file['name'];
			//Read your Excel workbook
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			//Set active sheet
			$objWorksheet = $objPHPExcel->setActiveSheetIndex($active_sheet);
			// Get worksheet dimensions
			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();

			$highestColumn = $sheet->getHighestColumn();
			$order_record_count = 0;
			
			try {
				for ($row = $starting_row; $row <= $highestRow; $row++){
					//Get row
					$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
					$item_type_code = $rowData[0][0];
					$item_type = $this->Product->Item->ItemType->find('first', array(
						'conditions' => array('ItemType.code' => $item_type_code),
						'fields' => array('ItemType.id'),
						'recursive' => -1
					));
					if(empty($item_type)){
						throw new Exception("Tip artikla nije validan! Red: ".$row);
					}
					$tax_number = $rowData[0][7];
					$tax = $this->Product->Tax->find('first', array(
						'conditions' => array('Tax.tax' => $tax_number),
						'fields' => array('Tax.id'),
						'recursive' => -1
					));
					if(empty($tax)){
						throw new Exception("Taksa nije validna! Red: ".$row);
					}
					$hts_number = $rowData[0][6];
					$hts = $this->Product->HtsNumber->find('first', array(
						'conditions' => array('HtsNumber.hts_number' => $hts_number),
						'fields' => array('HtsNumber.id'),
						'recursive' => -1
					));
					if(empty($hts)){
						throw new Exception("HTS nije validan! Red: ".$row);
					}
					$form = array();
					$form['Product']['code'] = $rowData[0][1];
					$form['Product']['name'] = $rowData[0][2];
					$form['Product']['description'] = $rowData[0][3];
					$form['Product']['weight'] = $rowData[0][4];
					$form['Product']['pid'] = $rowData[0][5];
					$form['Product']['hts_number_id'] = $hts['HtsNumber']['id'];
					$form['Product']['tax_group_id'] = $tax['Tax']['id'];
					$form['Product']['product_eccn'] = $rowData[0][8];
					$form['Product']['product_release_date'] = $rowData[0][9];
					$form['Product']['for_distributors'] = $rowData[0][10];
					$form['Product']['product_status'] = $rowData[0][11];
					$form['Product']['service_production'] = $rowData[0][12];
					$form['Product']['measurement_unit_id'] = 1;
					$form['Product']['item_type_id'] = $item_type['ItemType']['id'];

					$result = $this->Product->saveProduct($form);
					if(!$result['success']) {
						throw new Exception($result['message']);
					}
				}//for

				$result['success'] = true;
			} catch (Exception $e) {
				$result['success'] = false;
				$result['message'] = $e->getMessage();
			}

			if($result['success']){
				$this->Flash->success("Artikli su uspesno uvezeni iz excela");			
			}else{
				$this->Flash->error($result['message']);			
			}
			return $this->redirect(array('action' => 'index'));			
		}
	}//~!
}