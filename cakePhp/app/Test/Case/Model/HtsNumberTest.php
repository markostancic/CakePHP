<?php
App::uses('HtsNumber', 'Model');

/**
 * HtsNumber Test Case
 */
class HtsNumberTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hts_number'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HtsNumber = ClassRegistry::init('HtsNumber');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HtsNumber);

		parent::tearDown();
	}

}
