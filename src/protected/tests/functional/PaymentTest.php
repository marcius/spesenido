<?php

class PaymentTest extends WebTestCase
{
	public $fixtures=array(
		'payments'=>'Payment',
	);

	public function testShow()
	{
		$this->open('?r=payment/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=payment/create');
	}

	public function testUpdate()
	{
		$this->open('?r=payment/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=payment/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=payment/index');
	}

	public function testAdmin()
	{
		$this->open('?r=payment/admin');
	}
}
