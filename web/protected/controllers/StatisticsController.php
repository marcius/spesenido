<?php

class StatisticsController extends Controller {
    const PAGE_SIZE=10;

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'viewSubjectBalance', 'viewAccountMonth', 'viewAccountCustFilter', 'testJqGrid',
                    'jsonAccountTotals', 'jsonTransactionList', 'jsonPaymentList', 'jsonSubjectBalance'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionViewTest() {
        $searchModel = new StatisticsSearch;
        $providerOptions = array();
        if (isset($_POST['StatisticsSearch'])) {
            $searchModel->setAttributes($_POST['StatisticsSearch'], false);
            if ($searchModel->validate()) {
                $providerOptions = $searchModel->getProviderOptions();
            }
        }
        $count = Yii::app()->db->createCommand(StatisticsSQLHelper::createSubjectBalanceStmt(true))->queryScalar();
        $sql = StatisticsSQLHelper::createSubjectBalanceStmt();
        $dataProvider = new CSqlDataProvider($sql, array(
                    'id' => 'subjectbalance',
                    'totalItemCount' => $count,
                    'sort' => array(
                        'attributes' => array(
                            'id', 'username', 'email',
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));

        $this->render('viewSubjectBalance', array(
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
                )
        );
    }

    public function actionViewAccountMonth() {
        $searchModel = new StatisticsSearch;
        $providerOptions = array();
        if (isset($_POST['StatisticsSearch'])) {
            $searchModel->setAttributes($_POST['StatisticsSearch'], false);
            if ($searchModel->validate()) {
                $providerOptions = $searchModel->getProviderOptions();
            }
        }
        $dataProvider = new CStatMonthDataProvider('MonthStat', $providerOptions);

        $this->render('viewAccountMonth', array(
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
                )
        );
    }

    public function actionViewAccountCustFilter() {
        $searchModel = new PaymentSearch;
        $searchModel->include_accounts = 'notzero';
        //$balance = Yii::app()->db->createCommand(StatisticsSQLHelper::createSubjectBalanceStmt(true))->queryScalar();

        $this->render('viewAccountCustFilter', array(
            'searchModel' => $searchModel,
            'balance' => $balance
                )
        );
    }

    public function actionJsonAccountTotals() {
        $connection = Yii::app()->db;
        $stmt = StatisticsSQLHelper::createStmt_1();
        $stmt .= U::getOrderBy(U::q('sidx'), U::q('sord'));
        $reader = $connection->createCommand($stmt)->query();
        $i = 0;
        $response->userdata['name'] = 'Total';
        $response->userdata['sum_p_amount'] = 0;
        $response->userdata['sum_t_amount'] = 0;
        foreach ($reader as $row) {
            $response->rows[$i]['id'] = $row[id];
            $response->rows[$i]['cell'] = array($row[id], $row[name], $row[sum_p_amount], $row[sum_t_amount]);
            $i++;
            $response->userdata['sum_p_amount'] += $row[sum_p_amount];
            $response->userdata['sum_t_amount'] += $row[sum_t_amount];
        }
        $response->records = $i;
        $response->total = 1;
        $response->page = 1;
        echo json_encode($response);
    }

    public function actionJsonTransactionList() {
        $stmt = StatisticsSQLHelper::createStmt_2();
        $response = U::getJsonHeader($stmt, $_GET['page'], $_GET['rows']);
        $stmt .= U::getOrderBy(U::q('sidx'), U::q('sord')) . U::getLimitClause($_GET['page'], $_GET['rows']);
        $reader = Yii::app()->db->createCommand($stmt)->query();
        $i = 0;
        foreach ($reader as $row) {
            $response->rows[$i] = $row;
            $i++;
        }
        echo json_encode($response);
    }

    public function actionJsonPaymentList() {
        $connection = Yii::app()->db;
        $stmt = StatisticsSQLHelper::createStmt_3();
        $reader = $connection->createCommand($stmt)->query();
        $i = 0;
        foreach ($reader as $row) {
            $response->rows[$i] = $row;
            $i++;
        }
        $response->records = $i;
        $response->total = 1;
        $response->page = 1;
        echo json_encode($response);
    }

    public function actionJsonSubjectBalance() {
        $connection = Yii::app()->db;
        $stmt = StatisticsSQLHelper::createStmt_SubjectBalance();
        $reader = $connection->createCommand($stmt)->query();
        $i = 0;
        foreach ($reader as $row) {
            $response->rows[$i] = $row;
            $i++;
        }
        $response->records = $i;
        $response->total = 1;
        $response->page = 1;
        echo json_encode($response);
    }}
