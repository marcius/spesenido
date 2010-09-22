<?php

class AccountTest extends WebTestCase
{
	public $fixtures=array(
		'accounts'=>'Account',
	);

	public function testShow()
	{
		$this->open('?r=account/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=account/create');
	}

	public function testUpdate()
	{
		$this->open('?r=account/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=account/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=account/index');
	}

	public function testAdmin()
	{
		$this->open('?r=account/admin');
	}
}
