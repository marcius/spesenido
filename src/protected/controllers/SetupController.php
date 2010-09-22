<?php

class SetupController extends Controller
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
                'actions'=>array(),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array(),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('index', 'updatedb'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }


        
public function actionUpdatedb()
    {
        $connection = Yii::app()->db;
        $stmts = require(dirname(__FILE__).'/sql_sp.php');
        echo "Updating...<br/>";
        foreach($stmts[$_GET['ver']] as $stmt) {
            $command=$connection->createCommand($stmt);
            echo $stmt;
            $command->execute();
            echo "<br/>";
            echo "# ";
        }
        echo "<br/>Completed.";
    }
    
 
 public function actionIndex()
    {
   $this->actionUpdatedb();
    }
       
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