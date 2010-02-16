<?php

class StatisticsController extends Controller
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
				'actions'=>array('index','viewAccountMonth', 'viewAccountClassification'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionViewAccountMonth()
	{
        $searchModel=new StatisticsSearch;
        $providerOptions = array();
        if(isset($_POST['StatisticsSearch']))
        {
            $searchModel->setAttributes($_POST['StatisticsSearch'], false);
            if ($searchModel->validate())
            {
                $providerOptions = $searchModel->getProviderOptions();
            }
        }
        $dataProvider=new CSQLDataProvider('MonthStat', $providerOptions);
        
		$this->render('viewAccountMonth', array(
                'dataProvider'=>$dataProvider,
                'searchModel'=>$searchModel,
                )
        );
	}

    public function actionViewAccountClassification()
    {
        $searchModel=new StatisticsSearch;
        $dataProvider=new CActiveDataProvider('Account');
        // Construct the json data
        $connection = Yii::app()->db;
        $response->page = 1;
        $response->total = 1;
        $response->records = $connection->createCommand("SELECT count(*) from accounts")->queryScalar();
        $command=$connection->createCommand("SELECT id, name from accounts");
        $reader=$command->query();
        $i=0;
        foreach($reader as $row) {
            $response->rows[$i]['id']=$row[id];
            $response->rows[$i]['cell']=array($row[id],$row[name]);
            $i++;
        } 
        $jsondata = json_encode($response);
        
        $this->render('viewAccountClassification',array(
            'dataProvider'=>$dataProvider,
            'searchModel'=>$searchModel,
            'statData'=>$jsondata,
        ));
    }    
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionJqGridTest()
    {
        $this->render('jqGridTest');
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
    
}
