<?php

class Payment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'payments':
	 * @var double $id
	 * @var double $transaction_id
	 * @var string $amount
	 * @var string $date
	 * @var double $payer_subject_id
	 * @var double $payment_type_id
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
		return 'payments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_id, payer_subject_id, payment_type_id', 'required'),
			array('transaction_id, payer_subject_id, payment_type_id', 'numerical'),
			array('amount', 'length', 'max'=>10),
			array('date, created_at, updated_at', 'safe'),
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
			'payer_subject' => array(self::BELONGS_TO, 'Subject', 'payer_subject_id'),
			'transaction' => array(self::BELONGS_TO, 'Transaction', 'transaction_id'),
            'payment_type' => array(self::BELONGS_TO, 'PaymentType', 'payment_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'transaction_id' => 'Transaction',
			'amount' => 'Amount',
			'date' => 'Date',
			'payer_subject_id' => 'Payer Subject',
			'payment_type_id' => 'Payment Type',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}
}