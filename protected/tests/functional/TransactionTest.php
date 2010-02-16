<?php

class TransactionTest extends WebTestCase
{
	public $fixtures=array(
		'transactions'=>'Transaction',
	);

	public function testShow()
	{
		$this->open('?r=transaction/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=transaction/create');
	}

	public function testUpdate()
	{
		$this->open('?r=transaction/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=transaction/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=transaction/index');
	}

	public function testAdmin()
	{
		$this->open('?r=transaction/admin');
	}
}
