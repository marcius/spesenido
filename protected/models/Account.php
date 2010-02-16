<?php

class Account extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'accounts':
	 * @var double $id
	 * @var string $name
	 * @var integer $months
	 * @var string $shared
	 * @var integer $sign
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
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, shared, sign, created_at', 'required'),
			array('months, sign', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('shared', 'length', 'max'=>2),
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
			'account_classifications' => array(self::HAS_MANY, 'AccountClassification', 'account_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'name' => 'Name',
			'months' => 'Months',
			'shared' => 'Shared',
			'sign' => 'Sign',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}
}