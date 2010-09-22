<?php

class TestController extends Controller
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
                'actions'=>array('index','view', 'accounttotals', 'transactionlist'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
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
        $this->render('view',array(
            'model'=>$this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Subject;
        if(isset($_POST['Subject']))
        {
            $model->attributes=$_POST['Subject'];
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
        if(isset($_POST['Subject']))
        {
            $model->attributes=$_POST['Subject'];
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
        $dataProvider=new CActiveDataProvider('Subject', array(
            'pagination'=>array(
                'pageSize'=>self::PAGE_SIZE,
            ),
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionUno()
    {
        if (U::filled($_GET['page'])) $usr_pagestart = $_GET['page'];
        if (U::filled($_GET['rows'])) $usr_rowsperpage = $_GET['rows'];
        $rowstart = $usr_pagestart * $usr_rowsperpage - $usr_rowsperpage;
        $sqlfrom = " FROM accounts";
        $sqllimit = " LIMIT ".$rowstart.", ".$usr_rowsperpage;
        $connection = Yii::app()->db;
        $response->records = $connection->createCommand("SELECT count(*)".$sqlfrom)->queryScalar();
        if( $response->records > 0 ) {
            $response->total = ceil($response->records / $usr_rowsperpage);
        } else {
            $response->total = 0;
        }
        $response->page = $usr_pagestart;
        $command=$connection->createCommand("SELECT id, name".$sqlfrom.$sqllimit);
        $reader=$command->query();
        $i=0;
        foreach($reader as $row) {
            $response->rows[$i]['id']=$row[id];
            $response->rows[$i]['cell']=array($row[id],$row[name]);
            $i++;
        } 
        $response->userdata['col_a'] = $connection->createCommand("SELECT sum(id)".$sqlfrom)->queryScalar();
        echo json_encode($response);
    }
        //$response->rows[$i]['id']=$row[p_id];
        //$response->rows[$i]['cell']=$row;
        //Yii::log('['.$i.']'.print_r($row, TRUE));
        //$response->rows[$i]['cell']=array($row[p_id], $row[p_date], $row[p_amount]);
    

    public function actionTestJqGrid()
    {
        $this->render('testJqGrid');
    }

    
    public function actionJqGridTestData()
    {
    if (Yii::app()->request->isAjaxRequest) {
            $criteria=new CDbCriteria;
            // $criteria->compare(); // here I can filter data

            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
            $sord = $_GET['sord']; // get the direction

            $dataProvider = new CActiveDataProvider('Account', array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'currentPage'=>$page-1, // jqGrid index isn't zero-based
                    'pageSize'=>$limit,
                ),
                'sort'=>array(
                    'defaultOrder'=>"$sidx $sord",
                )
            ));

            $count = $dataProvider->totalItemCount;
            $total_pages=($count) ? $total_pages = ceil($count/$limit) : $total_pages = 0;

        // prepare json data for jqGrid
        $response->page = $page;
        $response->total = $total_pages;
        $response->records = $count;
        $data=$dataProvider->getData();
        foreach($data as $row) {
            $response->rows[]=array(
                    'id'=>$row->id,
                    'cell'=>array(
                        $row->id,
                        $row->name,
                    //...
                    )
                );
            }
            echo CJavaScript::jsonEncode($response);
    }    
    }
    
    
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $dataProvider=new CActiveDataProvider('Subject', array(
            'pagination'=>array(
                'pageSize'=>self::PAGE_SIZE,
            ),
        ));

        $this->render('admin',array(
            'dataProvider'=>$dataProvider,
        ));
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
                $this->_model=Subject::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
