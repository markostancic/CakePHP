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
class ServiceProductsController extends AppController {

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
		
		$this->ServiceProduct->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
        $conditions = array();

        if (isset($this->request->query['keyword'])) {
        	$this->request->data['ServiceProduct'] = $this->request->query;
            $conditions['name like'] = '%'.$this->request->query['keyword'].'%';            
        }

		$serviceProducts = $this->Paginator->paginate($conditions);

        $this->set(compact('serviceProducts'));
    

		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceProduct->exists($id)) {
			throw new NotFoundException(__('Nepostojeca usluga'));
		}
		$options = array('conditions' => array('ServiceProduct.' . $this->ServiceProduct->primaryKey => $id));
		$this->set('serviceProduct', $this->ServiceProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->ServiceProduct->exists($id)) {
				throw new NotFoundException(__('Nepostojeca usluga'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->ServiceProduct->create();
			$result = $this->ServiceProduct->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Usluga je uspesno dodata.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		}

		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->ServiceProduct->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Usluga je uspesno izmenjena.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('ServiceProduct.' . $this->ServiceProduct->primaryKey => $id));
				$product = $this->ServiceProduct->find('first', $options);
				$item = $this->ServiceProduct->Item->find('first', array('conditions' => array('Item.id' => $product['Item']['id']), 'recursive' => -1));

				$this->request->data['ServiceProduct']['id'] = $product['ServiceProduct']['id'];
				$this->request->data['ServiceProduct']['code'] = $item['Item']['code'];
				$this->request->data['ServiceProduct']['name'] = $item['Item']['name'];
				$this->request->data['ServiceProduct']['description'] = $item['Item']['description'];
				$this->request->data['ServiceProduct']['weight'] = $item['Item']['weight'];
				$this->request->data['ServiceProduct']['pid'] = $product['ServiceProduct']['pid'];
				$this->request->data['ServiceProduct']['for_distributors'] = $product['ServiceProduct']['for_distributors'];
				$this->request->data['ServiceProduct']['eccn'] = $product['ServiceProduct']['eccn'];
				$this->request->data['ServiceProduct']['release_date'] = $product['ServiceProduct']['release_date'];
				$this->request->data['ServiceProduct']['service_status'] = $product['ServiceProduct']['service_status'];
				$this->request->data['ServiceProduct']['hts_number_id'] = $product['ServiceProduct']['hts_number_id'];
				$this->request->data['ServiceProduct']['tax_group_id'] = $product['ServiceProduct']['tax_group_id'];
				$this->request->data['ServiceProduct']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['ServiceProduct']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$taxes = $this->ServiceProduct->Tax->find('list', array('fields' => array('Tax.tax')));
		$this->set('taxes', $taxes);
		$htsNumbers = $this->ServiceProduct->HtsNumber->find('list', array('fields' => array('HtsNumber.hts_number')));
		$this->set('htsNumbers', $htsNumbers);
		$eccn = $this->ServiceProduct->eccn;
		$this->set(compact('eccn'));
		$statuses = $this->ServiceProduct->statuses;
		$this->set(compact('statuses'));
		$measurementUnits = $this->ServiceProduct->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->ServiceProduct->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'service_product')));
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
		$result = $this->ServiceProduct->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Usluga je uspesno obrisana.'));

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
		$serviceProducts = $this->ServiceProduct->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('serviceProducts', $serviceProducts);
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

		$serviceProducts = $this->ServiceProduct->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('serviceProducts', $serviceProducts);
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
			if(empty($this->request->data['ServiceProduct']['import']['name'])){
			throw new Exception('Fajl nije ispravno prenet! Pokušajte ponovo.');
			}

			//Check if uploaded file is in excel format
			$upload_name = $this->request->data['ServiceProduct']['import']['name'];
			if(substr($upload_name, -4) != '.xls' && substr($upload_name, -5) != '.xlsx'){
			throw new Exception('Fajl nije u Excel formatu!');
			}
			//Move uploaded file
			$file = $this->request->data['ServiceProduct']['import'];
			$file['name'] = date('Ymdhis-') . $file['name'];
			$dir = new Folder(TMP, true, 0755);
			$dest = TMP . $file['name'];
			if(!move_uploaded_file($this->request->data['ServiceProduct']['import']['tmp_name'], $dest)){
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
					$item_type = $this->ServiceProduct->Item->ItemType->find('first', array(
						'conditions' => array('ItemType.code' => $item_type_code),
						'fields' => array('ItemType.id'),
						'recursive' => -1
					));
					if(empty($item_type)){
						throw new Exception("Tip artikla nije validan! Red: ".$row);
					}
					$tax_number = $rowData[0][7];
					$tax = $this->ServiceProduct->Tax->find('first', array(
						'conditions' => array('Tax.tax' => $tax_number),
						'fields' => array('Tax.id'),
						'recursive' => -1
					));
					if(empty($tax)){
						throw new Exception("Taksa nije validna! Red: ".$row);
					}
					$hts_number = $rowData[0][6];
					$hts = $this->ServiceProduct->HtsNumber->find('first', array(
						'conditions' => array('HtsNumber.hts_number' => $hts_number),
						'fields' => array('HtsNumber.id'),
						'recursive' => -1
					));
					if(empty($hts)){
						throw new Exception("HTS nije validan! Red: ".$row);
					}
					$form = array();
					$form['ServiceProduct']['code'] = $rowData[0][1];
					$form['ServiceProduct']['name'] = $rowData[0][2];
					$form['ServiceProduct']['description'] = $rowData[0][3];
					$form['ServiceProduct']['weight'] = $rowData[0][4];
					$form['ServiceProduct']['pid'] = $rowData[0][5];
					$form['ServiceProduct']['hts_number_id'] = $hts['HtsNumber']['id'];
					$form['ServiceProduct']['tax_group_id'] = $tax['Tax']['id'];
					$form['ServiceProduct']['eccn'] = $rowData[0][8];
					$form['ServiceProduct']['release_date'] = $rowData[0][9];
					$form['ServiceProduct']['for_distributors'] = $rowData[0][10];
					$form['ServiceProduct']['service_status'] = $rowData[0][11];
					$form['ServiceProduct']['measurement_unit_id'] = 1;
					$form['ServiceProduct']['item_type_id'] = $item_type['ItemType']['id'];

					$result = $this->ServiceProduct->saveProduct($form);
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
