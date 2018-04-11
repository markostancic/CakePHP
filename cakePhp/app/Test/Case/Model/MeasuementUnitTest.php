<?php
App::uses('MeasuementUnit', 'Model');

/**
 * MeasuementUnit Test Case
 */
class MeasuementUnitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.measuement_unit'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MeasuementUnit = ClassRegistry::init('MeasuementUnit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MeasuementUnit);

		parent::tearDown();
	}

}
