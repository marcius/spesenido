<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class StatisticsSearch extends CFormModel
{
	public $classification_id;
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
    
    private $_conditions;

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
        if ($this->_conditions != "") 
            return $this->_conditions;
        if (U::filled($this->classification_id)) 
            $_conditions .= ' and classification_id = '.$this->classification_id;
        if (U::filled($this->account_id)) 
            $_conditions .= ' and account_id = '.$this->account_id;
        if (U::filled($this->amount_min)) 
            $_conditions .= ' and amount >= '.$this->amount_min;
        if (U::filled($this->amount_max)) 
            $_conditions .= ' and amount <= '.$this->amount_max;
        if (U::filled($this->date_from)) 
            $_conditions .= ' and date >= "'.$this->date_from.'"';
        if (U::filled($this->date_to)) 
            $_conditions .= ' and date <= "'.$this->date_to.'"';
        if (U::filled($this->ref_period_date_from)) 
            $_conditions .= ' and ref_period_end_date >= "'.$this->ref_period_date_from.'"';
        if (U::filled($this->ref_period_date_to)) 
            $_conditions .= ' and ref_period_begin_date <= "'.$this->ref_period_date_to.'"';
        if (U::filled($this->counterparty)) 
            $_conditions .= ' and counterparty like "%'.$this->counterparty.'%"';
        if (U::filled($this->recipient_subject_id)) 
            $_conditions .= ' and recipient_subject_id = '.$this->recipient_subject_id;
        if (U::filled($this->payer_subject_id)) 
            $_conditions .= ' and payer_subject_id = '.$this->payer_subject_id;
        if (U::filled($this->sign)) 
            $_conditions .= ' and accounts.sign = '.$this->sign;
        $this->_conditions = $_conditions;
        return $_conditions;
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
            'condition'=>$this->getWhereCondition(),
//            'join'=>'JOIN accounts ON accounts.id = account_id',
//                'order'=>'date DESC',
        );
    }
    
    public function getProviderOptions()
    {
        $_conditions = "";
        return array(         
            'criteria'=>$this->getCriteria(),
            'pagination'=>$this->getPagination(),
        );    
    }     
        
}