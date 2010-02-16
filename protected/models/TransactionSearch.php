<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TransactionSearch extends CFormModel
{
	public $account_id;
    public $counterparty;
    public $description;
	public $date_from;
	public $date_to;
    public $amount_min;
    public $amount_max;
    public $recipient_subject_id;
    public $payer_subject_id;
    public $ref_period_date_from;
    public $ref_period_date_to;
    public $sign;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
        return array(
            array('account_id, recipient_subject_id, payer_subject_id, amount_min, amount_max', 'numerical'),
            array('amount_min, amount_max', 'length', 'max'=>10),
            array('description', 'length', 'max'=>100),
            array('counterparty', 'length', 'max'=>50),
	    );
    }

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'account_id'=>'Account',
		);
	}

    public function getWhereCondition()
    {
        return '1=1'.$this->getConditions();
    }
    
    private function getConditions()
    {           
//                    $criteria->condition='account_id = :account_id';
//                    $criteria->params=array_merge($criteria->params, array(':account_id'=>$this->account_id));
        if (!empty($this->account_id)) 
            $condition .= ' and account_id = '.$this->account_id;
        if (!empty($this->amount_min)) 
            $condition .= ' and amount >= '.$this->amount_min;
        if (!empty($this->amount_max)) 
            $condition .= ' and amount <= '.$this->amount_max;
        if (!empty($this->date_from)) 
            $condition .= ' and date >= "'.$this->date_from.'"';
        if (!empty($this->date_to)) 
            $condition .= ' and date <= "'.$this->date_to.'"';
        if (!empty($this->ref_period_date_from)) 
            $condition .= ' and ref_period_end_date >= "'.$this->ref_period_date_from.'"';
        if (!empty($this->ref_period_date_to)) 
            $condition .= ' and ref_period_begin_date <= "'.$this->ref_period_date_to.'"';
        if (!empty($this->counterparty)) 
            $condition .= ' and counterparty like "%'.$this->counterparty.'%"';
        if (!empty($this->recipient_subject_id)) 
            $condition .= ' and recipient_subject_id = '.$this->recipient_subject_id;
        if (!empty($this->payer_subject_id)) 
            $condition .= ' and payer_subject_id = '.$this->payer_subject_id;
        
        if (!empty($this->sign)) 
            $condition .= ' and accounts.sign = '.$this->sign;

        return $condition;
    }

    public function getTotalQuery()
    {           
        $sql = "select sum(amount) from transactions join accounts on accounts.id = account_id where ";
        $sql .= $this->getWhereCondition();
        $sql .= " and accounts.sign = -1";
        return $sql;
    }

    public function getPagination()
    {
        if ($this->getConditions() == "")
            return array(
                'pageSize'=>10,
            );
        else
            return false;
    }

    public function getCriteria()
    {
        return array(
            'select'=>'t.*',
            'condition'=>$this->getWhereCondition(),
            'join'=>'JOIN accounts ON accounts.id = account_id',
            'order'=>'date DESC',
        );
    }
    
    public function getProviderOptions()
    {
        return array(         
            'criteria'=>$this->getCriteria(),
            'pagination'=>$this->getPagination(),
        );    
    }    
}