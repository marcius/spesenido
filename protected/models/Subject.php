<?php

class Subject extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'subjects':
	 * @var double $id
	 * @var string $shortname
	 * @var string $name
	 * @var string $roles
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
		return 'subjects';
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
			array('shortname, roles', 'length', 'max'=>3),
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
			'payments' => array(self::HAS_MANY, 'Payment', 'payer_subject_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'recipient_subject_id'),
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
			'roles' => 'Roles',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}
}