<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * KitsController Controller
 *
 * @property Kit $Kit
 * @property PaginatorComponent $Paginator

	    		
 */
class KitsController extends AppController {

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
		
		$this->Kit->recursive = 0;
		$this->Paginator->paginate();
		$this->Paginator->settings['conditions'] = array('Item.deleted' => 0);
        $conditions = array();

        if (isset($this->request->query['keyword'])) {
        	$this->request->data['Kit'] = $this->request->query;
            $conditions['name like'] = '%'.$this->request->query['keyword'].'%';            
        }

		$kits = $this->Paginator->paginate($conditions);

        $this->set(compact('kits'));
    

		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Kit->exists($id)) {
			throw new NotFoundException(__('Nepostojeci kit'));
		}
		$options = array('conditions' => array('Kit.' . $this->Kit->primaryKey => $id));
		$this->set('kit', $this->Kit->find('first', $options));
	}

/**
 * save method
 *
 * @return void
 */
	public function save($id = null) {
		if(!empty($id)){
			if (!$this->Kit->exists($id)) {
				throw new NotFoundException(__('Nepostojeci kit'));
			}			
		}
		if($this->request->is('post') && empty($id)){
			$this->Kit->create();
			$result = $this->Kit->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Kit je uspesno dodat.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		}

	
		

		if($this->request->is(array('post', 'put')) && !empty($id)) {
			$result = $this->Kit->saveProduct($this->request->data, $id);
			if($result['success']) {
				$this->Flash->success(__('Kit je uspesno izmenjen.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error($result['message']);
				return $this->redirect(array('action' => 'index'));
			}
		} else {
			if(!empty($id)){
				$options = array('conditions' => array('Kit.' . $this->Kit->primaryKey => $id));
				$kit = $this->Kit->find('first', $options);
				$item = $this->Kit->Item->find('first', array('conditions' => array('Item.id' => $kit['Item']['id']), 'recursive' => -1));

				$this->request->data['Kit']['id'] = $kit['Kit']['id'];
				$this->request->data['Kit']['code'] = $item['Item']['code'];
				$this->request->data['Kit']['name'] = $item['Item']['name'];
				$this->request->data['Kit']['description'] = $item['Item']['description'];
				$this->request->data['Kit']['weight'] = $item['Item']['weight'];
				$this->request->data['Kit']['pid'] = $kit['Kit']['pid'];
				$this->request->data['Kit']['for_distributors'] = $kit['Kit']['for_distributors'];
				$this->request->data['Kit']['eccn'] = $kit['Kit']['eccn'];
				$this->request->data['Kit']['release_date'] = $kit['Kit']['release_date'];
				$this->request->data['Kit']['kit_status'] = $kit['Kit']['kit_status'];
				$this->request->data['Kit']['hts_number_id'] = $kit['Kit']['hts_number_id'];
				$this->request->data['Kit']['tax_group_id'] = $kit['Kit']['tax_group_id'];
				$this->request->data['Kit']['measurement_unit_id'] = $item['Item']['measurement_unit_id'];
				$this->request->data['Kit']['item_type_id'] = $item['Item']['item_type_id'];
			}
		}

		$taxes = $this->Kit->Tax->find('list', array('fields' => array('Tax.tax')));
		$this->set('taxes', $taxes);
		$htsNumbers = $this->Kit->HtsNumber->find('list', array('fields' => array('HtsNumber.hts_number')));
		$this->set('htsNumbers', $htsNumbers);
		$eccn = $this->Kit->eccn;
		$this->set(compact('eccn'));
		$statuses = $this->Kit->statuses;
		$this->set(compact('statuses'));
		$measurementUnits = $this->Kit->Item->MeasuementUnit->find('list');
		$this->set(compact('measurementUnits'));
		$itemTypes = $this->Kit->Item->ItemType->find('list', array('conditions' => array('ItemType.class' => 'kit')));
		$this->set('itemTypes', $itemTypes);
		
		if(empty($this->request->data) && !empty($kit)) {
			$this->request->data = $kit;
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
		$result = $this->Kit->deleteProduct($id);
		if ($result['success']) {
			$this->Flash->success(__('Kit je uspesno obrisan.'));
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
		$kits = $this->Kit->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('kits', $kits);
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

		$kits = $this->Kit->find('all', array('conditions' => array('Item.deleted' => 0)));
		$this->set('kits', $kits);
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
			if(empty($this->request->data['Kit']['import']['name'])){
			throw new Exception('Fajl nije ispravno prenet! Pokušajte ponovo.');
			}

			//Check if uploaded file is in excel format
			$upload_name = $this->request->data['Kit']['import']['name'];
			if(substr($upload_name, -4) != '.xls' && substr($upload_name, -5) != '.xlsx'){
			throw new Exception('Fajl nije u Excel formatu!');
			}
			//Move uploaded file
			$file = $this->request->data['Kit']['import'];
			$file['name'] = date('Ymdhis-') . $file['name'];
			$dir = new Folder(TMP, true, 0755);
			$dest = TMP . $file['name'];
			if(!move_uploaded_file($this->request->data['Kit']['import']['tmp_name'], $dest)){
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
					$item_type = $this->Kit->Item->ItemType->find('first', array(
						'conditions' => array('ItemType.code' => $item_type_code),
						'fields' => array('ItemType.id'),
						'recursive' => -1
					));
					if(empty($item_type)){
						throw new Exception("Tip artikla nije validan! Red: ".$row);
					}
					$tax_number = $rowData[0][7];
					$tax = $this->Kit->Tax->find('first', array(
						'conditions' => array('Tax.tax' => $tax_number),
						'fields' => array('Tax.id'),
						'recursive' => -1
					));
					if(empty($tax)){
						throw new Exception("Taksa nije validna! Red: ".$row);
					}
					$hts_number = $rowData[0][6];
					$hts = $this->Kit->HtsNumber->find('first', array(
						'conditions' => array('HtsNumber.hts_number' => $hts_number),
						'fields' => array('HtsNumber.id'),
						'recursive' => -1
					));
					if(empty($hts)){
						throw new Exception("HTS nije validan! Red: ".$row);
					}
					$form = array();
					$form['Kit']['code'] = $rowData[0][1];
					$form['Kit']['name'] = $rowData[0][2];
					$form['Kit']['description'] = $rowData[0][3];
					$form['Kit']['weight'] = $rowData[0][4];
					$form['Kit']['pid'] = $rowData[0][5];
					$form['Kit']['hts_number_id'] = $hts['HtsNumber']['id'];
					$form['Kit']['tax_group_id'] = $tax['Tax']['id'];
					$form['Kit']['eccn'] = $rowData[0][8];
					$form['Kit']['release_date'] = $rowData[0][9];
					$form['Kit']['for_distributors'] = $rowData[0][10];
					$form['Kit']['kit_status'] = $rowData[0][11];
					$form['Kit']['measurement_unit_id'] = 1;
					$form['Kit']['item_type_id'] = $item_type['ItemType']['id'];

					$result = $this->Kit->saveProduct($form);
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
