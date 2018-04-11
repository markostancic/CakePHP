<?php
/**
 * Product Fixture
 */
class ProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'item' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'pid' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'hts_number' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'tax_group' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'product_release_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'for_distributors' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'service_production' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'pid_UNIQUE' => array('column' => 'pid', 'unique' => 1),
			'tax_group_UNIQUE' => array('column' => 'tax_group', 'unique' => 1),
			'FK_item_products_idx' => array('column' => 'item', 'unique' => 0),
			'FK_hts_number_hts_idx' => array('column' => 'hts_number', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'item' => 1,
			'pid' => 1,
			'hts_number' => 1,
			'tax_group' => 1,
			'product_release_date' => '2018-03-20 15:41:50',
			'for_distributors' => 1,
			'service_production' => 1,
			'created' => '2018-03-20 15:41:50',
			'modified' => '2018-03-20 15:41:50'
		),
	);

}
