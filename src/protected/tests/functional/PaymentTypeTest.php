<?php

class PaymentTypeTest extends WebTestCase
{
	public $fixtures=array(
		'paymentTypes'=>'PaymentType',
	);

	public function testShow()
	{
		$this->open('?r=paymentType/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=paymentType/create');
	}

	public function testUpdate()
	{
		$this->open('?r=paymentType/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=paymentType/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=paymentType/index');
	}

	public function testAdmin()
	{
		$this->open('?r=paymentType/admin');
	}
}
