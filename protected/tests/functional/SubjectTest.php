<?php

class SubjectTest extends WebTestCase
{
	public $fixtures=array(
		'subjects'=>'Subject',
	);

	public function testShow()
	{
		$this->open('?r=subject/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=subject/create');
	}

	public function testUpdate()
	{
		$this->open('?r=subject/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=subject/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=subject/index');
	}

	public function testAdmin()
	{
		$this->open('?r=subject/admin');
	}
}
