<?php

class TransactionController extends Controller
{
	const PAGE_SIZE=10;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('quickcreate','withdrawalcreate','create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $this->loadModel();
        $condition='transaction_id = ' . $this->_model->id;
        $dataProvider=new CActiveDataProvider('Payment', array(
            'criteria'=>array(
                'condition'=>$condition,
                'order'=>'date ASC',
            ),
        ));

        $dataStat=new CSpDataProvider('Stat', array(
        ));
        
		$this->render('view',array(
			'model'=>$this->_model,
            'dataProvider'=>$dataProvider,
            'dataStat'=>$dataStat,
		));
	}

	public function actionQuickcreate()
	{
		$modelTransaction=new Transaction;
        $modelPayment=new Payment;
		if(isset($_POST['Transaction']))
		{
			$modelTransaction->attributes = $_POST['Transaction'];
            $modelTransaction->ref_period_begin_date = $modelTransaction->date;
            $modelTransaction->ref_period_end_date = $modelTransaction->date;
			$modelPayment->attributes = $_POST['Payment'];
            $modelPayment->payer_subject_id = $modelTransaction->payer_subject_id;
            $modelPayment->date = $modelTransaction->date;
            $modelPayment->amount = $modelTransaction->amount;
			if($modelTransaction->save())
              {
			  $modelPayment->transaction_id = $modelTransaction->id;
              if($modelPayment->save(false))
                $this->redirect(array('view','id'=>$modelTransaction->id));
              }
		}

		$this->render('quickcreate',array(
			'model'=>$modelTransaction,
			'modelP'=>$modelPayment,
		));
	}

    public function actionWithdrawalcreate()
    {
        $modelTransaction=new Transaction;
        $modelTransaction->account_id = 43;
        $modelPayment=new Payment;
        $modelPayment->payment_type_id = 2;
        if(isset($_POST['Transaction']))
        {
            $modelTransaction->attributes = $_POST['Transaction'];
            $amount = $modelTransaction->amount;
            $modelTransaction->ref_period_begin_date = $modelTransaction->date;
            $modelTransaction->ref_period_end_date = $modelTransaction->date;
            $modelTransaction->amount = 0;
            if($modelTransaction->save())
            {
                $modelPayment->attributes = $_POST['Payment'];
                $modelPayment->transaction_id = $modelTransaction->id;
                $modelPayment->payer_subject_id = $modelTransaction->payer_subject_id;
                $modelPayment->date = $modelTransaction->date;
                $modelPayment->amount = $amount * -1; 
                if($modelPayment->save(false)) {
                    $modelPayment=new Payment;
                    $modelPayment->attributes = $_POST['Payment'];
                    $modelPayment->transaction_id = $modelTransaction->id;
                    $modelPayment->payer_subject_id = $modelTransaction->payer_subject_id;
                    $modelPayment->date = $modelTransaction->date;
                    $modelPayment->amount = $amount; 
                    $modelPayment->payment_type_id = 4;
                    if($modelPayment->save(false))
                        $this->redirect(array('view', 'id'=>$modelTransaction->id));
                }
            }
        }

        $this->render('quickcreate',array(
            'model'=>$modelTransaction,
            'modelP'=>$modelPayment,
        ));
    }

	public function actionCreate()
	{
		$model=new Transaction;
		if(isset($_POST['Transaction']))
		{
			$model->attributes=$_POST['Transaction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		if(isset($_POST['Transaction']))
		{
			$model->attributes=$_POST['Transaction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Transaction', array(
			'pagination'=>array(
				'pageSize'=>self::PAGE_SIZE,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $searchModel=new TransactionSearch;
        if(isset($_POST['TransactionSearch']))
        {
            $searchModel->setAttributes($_POST['TransactionSearch'], false);
            if (!$searchModel->validate())
            {
                //?
            }
        }
        $dataProvider=new CActiveDataProvider('Transaction', $searchModel->getProviderOptions());
        $sql = Yii::app()->db->createCommand($searchModel->getTotalQuery());
        $total= $sql->queryScalar();

        $this->render('admin',array(
            'dataProvider'=>$dataProvider,
            'searchModel'=>$searchModel,
            'amountTotal'=>$total,
        ));
	}

    public function actionSearch()
    {
        $searchModel=new TransactionSearch;
        if(isset($_POST['TransactionSearch']))
        {
            $searchModel->attributes=$_POST['TransactionSearch'];
            if($searchModel->validate())
            {
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Transaction::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
