<?php
/**
 * CSpDataProvider implements a data provider based on ActiveRecord.
 *
 * CSpDataProvider provides data in terms of ActiveRecord objects which are
 * of class {@link modelClass}. It uses the AR {@link CActiveRecord::findAll} method
 * to retrieve the data from database. The {@link criteria} property can be used to
 * specify various query options, such as conditions, sorting, pagination, etc.
 *
 * CSpDataProvider may be used in the following way:
 * <pre>
 * $dataProvider=new CActiveDataProvider('Post', array(
 *     'criteria'=>array(
 *         'condition'=>'status=1 AND tags LIKE :tags',
 *         'params'=>array(':tags'=>$_GET['tags']),
 *         'with'=>array('author'),
 *     ),
 *     'pagination'=>array(
 *         'pageSize'=>20,
 *     ),
 * ));
 * // $dataProvider->getData() will return a list of Post objects
 * </pre>
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CSpDataProvider.php 1656 2010-01-03 14:20:04Z qiang.xue $
 * @package system.web
 * @since 1.1
 */
class CSQLDataProvider extends CDataProvider
{
	/**
	 * @var string the primary ActiveRecord class name. The {@link getData()} method
	 * will return a list of objects of this class.
	 */
	public $modelClass;
	/**
	 * @var string the name of key attribute for {@link modelClass}. If not set,
	 * it means the primary key of the corresponding database table will be used.
	 */
	public $keyAttribute;

	private $_criteria;

	/**
	 * Constructor.
	 * @param string the model class. This will be assigned to the {@link modelClass} property.
	 * @param array configuration (name=>value) to be applied to this data provider.
	 * Any public properties of the data provider can be configured via this parameter
	 */
	public function __construct($modelClass,$config=array())
	{
		$this->modelClass=$modelClass;
		$this->setId($modelClass);
		foreach($config as $key=>$value)
			$this->$key=$value;
	}

	/**
	 * @return CDbCriteria the query criteria
	 */
	public function getCriteria()
	{
		if($this->_criteria===null)
			$this->_criteria=new CDbCriteria;
		return $this->_criteria;
	}

	/**
	 * @param mixed the query criteria. This can be either a CDbCriteria object or an array
	 * representing the query criteria.
	 */
	public function setCriteria($value)
	{
		$this->_criteria=$value instanceof CDbCriteria ? $value : new CDbCriteria($value);
	}

	/**
	 * @return CSort the sorting object. If this is false, it means the sorting is disabled.
	 */
	public function getSort()
	{
		return false;
	}

	/**
	 * Fetches the data from the persistent data storage.
	 * @return array list of data items
	 */
	protected function fetchData()
	{
        $sql = CSQLTools::createPivotQuery(null, 
            'transactions join accounts on transactions.account_id = accounts.id',
            "accounts.name", 
            array(                                        
            '2009_10' => "date >= '2009-10-01' and date < '2009-11-01'",
            '2009_11' => "date >= '2009-11-01' and date < '2009-12-01'",
            '2009_12' => "date >= '2009-12-01' and date < '2010-01-01'",
            '2010_01' => "date >= '2010-01-01' and date < '2010-02-01'",
            '2010_02' => "date >= '2010-02-01' and date < '2010-03-01'",
            '2010_03' => "date >= '2010-03-01' and date < '2010-04-01'",
            ),
            $this->_criteria->condition,
            'transactions.amount',
            ''
            );
        //"CALL sp_pivot('accounts.name', 'date_format(transactions.date, \"%Y_%m\")', 'transactions.amount', 'transactions join accounts on transactions.account_id = accounts.id', '1=1')";
        $command=Yii::app()->db->createCommand($sql);
        return $command->queryAll();
	}

	/**
	 * Fetches the data item keys from the persistent data storage.
	 * @return array list of data item keys.
	 */
	protected function fetchKeys()
	{
		$keys=array('name', '01', '02', '03', '04');
        /*
		if($this->keyAttribute===null)
		{
			foreach($this->getData() as $i=>$data)
				$keys[$i]=$data->getPrimaryKey();
		}
		else
		{
			foreach($this->getData() as $i=>$data)
				$keys[$i]=$data->{$this->keyAttribute};
		}
        */
		return $keys;
	}

	/**
	 * Calculates the total number of data items.
	 * @return integer the total number of data items.
	 */
	protected function calculateTotalItemCount()
	{
		return 0; //CActiveRecord::model($this->modelClass)->count($this->getCriteria());
	}
}
