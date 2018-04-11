<?php
App::uses('Semi-product', 'Model');

/**
 * Semi-product Test Case
 */
class Semi-productTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Semi-product = ClassRegistry::init('Semi-product');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Semi-product);

		parent::tearDown();
	}

}
