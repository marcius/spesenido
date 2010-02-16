<?php

class Transaction extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'transactions':
	 * @var double $id
	 * @var double $account_id
	 * @var string $amount
	 * @var string $description
	 * @var double $recipient_subject_id
	 * @var double $payer_subject_id
	 * @var string $date
	 * @var string $counterparty
	 * @var string $ref_period_begin_date
	 * @var string $ref_period_end_date
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
		return 'transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, amount, payer_subject_id, date, ref_period_begin_date, ref_period_end_date', 'required'),
			array('account_id, recipient_subject_id, payer_subject_id', 'numerical'),
			array('amount', 'length', 'max'=>10),
			array('description', 'length', 'max'=>100),
			array('counterparty', 'length', 'max'=>50),
			array('created_at, updated_at', 'safe'),
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
			'payments' => array(self::HAS_MANY, 'Payment', 'transaction_id'),
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'recipient_subject' => array(self::BELONGS_TO, 'Subject', 'recipient_subject_id'),
			'payer_subject' => array(self::BELONGS_TO, 'Subject', 'payer_subject_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'account_id' => 'Account',
			'amount' => 'Amount',
			'description' => 'Description',
			'recipient_subject_id' => 'Recipient Subject',
			'payer_subject_id' => 'Payer Subject',
			'date' => 'Date',
			'counterparty' => 'Counterparty',
			'ref_period_begin_date' => 'Ref Period Begin Date',
			'ref_period_end_date' => 'Ref Period End Date',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}
}