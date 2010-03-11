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
				'actions'=>array('index', 'viewAccountMonth', 'viewAccountCustFilter', 'testJqGrid'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {
        $this->render('index');
    }

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
        $dataProvider=new CStatMonthDataProvider('MonthStat', $providerOptions);
        
		$this->render('viewAccountMonth', array(
                'dataProvider'=>$dataProvider,
                'searchModel'=>$searchModel,
                )
        );
	}

    public function actionViewAccountCustFilter()
    {
        $this->render('viewAccountCustFilter');
    }

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
    
}
