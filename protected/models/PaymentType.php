<?php

class PaymentType extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'payment_types':
	 * @var double $id
	 * @var string $shortname
	 * @var string $name
	 * @var string $created_at
	 * @var string $updated_at
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'payment_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shortname, name, created_at', 'required'),
			array('shortname', 'length', 'max'=>3),
			array('name', 'length', 'max'=>50),
			array('updated_at', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'shortname' => 'Shortname',
			'name' => 'Name',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}
}