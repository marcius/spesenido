<?php
$this->breadcrumbs=array(
    'Statistics'=>array('index'),
);
?>
<h1>View account totals by custom filter</h1>

<ul class="actions">
    <li><?php echo CHtml::link('Account totals by month',array('viewAccountMonth')); ?></li>
    <li><?php echo CHtml::link('Account totals by custom filter',array('viewAccountCustFilter')); ?></li>
</ul><!-- actions -->

<div class="form">

<?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($searchModel); ?>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'date_from'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$searchModel,
                    'attribute'=>'date_from',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                    ),                    
                ));
             ?>
            <?php echo CHtml::error($searchModel,'date_from'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'date_to'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$searchModel,
                    'attribute'=>'date_to',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                    ),
                ));
             ?>
            <?php echo CHtml::error($searchModel,'date_to'); ?>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'account_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'account_id', 
                CHtml::listData(Account::model()->findAll(),'id','name'),
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'account_id'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'sign'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'sign', 
                array('1'=>'+1', '-1'=>'-1'),
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'sign'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'include_accounts'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'include_accounts', 
//                array(''=>'all', 'notnull'=>'only > 0')
                array(''=>'all', 'notnull'=>'only not null', 'notzero'=>'only > 0')
//                array('prompt'=>'only > 1')
                ); ?>
            <?php echo CHtml::error($searchModel,'include_accounts'); ?>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'amount_min'); ?>
            <?php echo CHtml::activeTextField($searchModel,'amount_min', array('size'=>10)); ?>
            <?php echo CHtml::error($searchModel,'amount_min'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'amount_max'); ?>
            <?php echo CHtml::activeTextField($searchModel,'amount_max', array('size'=>10)); ?> 
            <?php echo CHtml::error($searchModel,'amount_max'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'payment_type_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'payment_type_id', 
                CHtml::listData(PaymentType::model()->findAll(),'id','name'),
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'payment_type_id'); ?>
        </div>        
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'counterparty'); ?>
            <?php echo CHtml::activeTextField($searchModel,'counterparty', array('size'=>10)); ?>
            <?php echo CHtml::error($searchModel,'counterparty'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'description'); ?>
            <?php echo CHtml::activeTextField($searchModel,'description', array('size'=>10)); ?>
            <?php echo CHtml::error($searchModel,'description'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'statement'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'statement', 
                array('Contanti'=>'Contanti', 'C/C bancario'=>'C/C bancario', 'Carta di credito'=>'Carta di credito', 'Poste Pay'=>'Poste Pay'),
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'statement'); ?>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'recipient_subject_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'recipient_subject_id', 
                CHtml::listData(Subject::model()->findAll(),'id','name'),                 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'recipient_subject_id'); ?>
        </div>

        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'expected_payer_subject_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'expected_payer_subject_id',
                CHtml::listData(Subject::model()->findAll(),'id','name'),                 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'expected_payer_subject_id'); ?>
        </div>

        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'actual_payer_subject_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'actual_payer_subject_id',
                CHtml::listData(Subject::model()->findAll(),'id','name'),                 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'actual_payer_subject_id'); ?>
        </div>

        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'diff_payers'); ?>
            <?php echo CHtml::activeCheckBox($searchModel, 'diff_payers'); ?>
            <?php echo CHtml::error($searchModel,'diff_payers'); ?>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'ref_period_date_from'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$searchModel,
                    'attribute'=>'ref_period_date_from',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                    ),
                ));
             ?>
            <?php echo CHtml::error($searchModel,'ref_period_date_from'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'ref_period_date_to'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$searchModel,
                    'attribute'=>'ref_period_date_to',
                    'options'=>array(
                        'dateFormat'=>'yy-mm-dd',
                    ),
                ));
             ?>
            <?php echo CHtml::error($searchModel,'ref_period_date_to'); ?>
        </div>
    </div>
<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<div class="form">    
    <div class="row">
        <div class="column">
            <button onclick="showAccountTotals();">Show account totals</button>
        </div>
        <div class="column">
            <button onclick="searchTransactions();">Search transactions</button>
        </div>
        <div class="column">
            <button onclick="showSubjBalance();">Show subject balance</button>
        </div>
    </div>
    <div class="row">

<br/>  
<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
         'htmlOptions'=>array(
             'id'=>'accounttotals',
         ),
         'navbar'=>false,
         'options'=>array(
             'hiddengrid'=>true,
             'height'=>'110',
//             'autowidth'=>true,
             'datatype'=>'json',
//             'url'=> CController::createUrl('test/accounttotals'),
             'colNames'=>array('id','name', 'pm. amount', 'tr. amount'), // model attributes
             'colModel'=>array( // optional, this is generated automatically from colNames if 'modelClass' is defined
                array('index'=>'id', 'name'=>'id', 'hidden'=>true   ),
                array('index'=>'name', 'name'=>'name'),
                array('index'=>'sum_p_amount', 'name'=>'sum_p_amount', 'align'=>'right', 'width'=>'80', 'formatter'=>'number'),
                array('index'=>'sum_t_amount', 'name'=>'sum_t_amount', 'align'=>'right', 'width'=>'80', 'formatter'=>'number'),
             ),
             'rowNum'=>-1,
             'sortname'=>'name',
             'sortorder'=>"asc",
             'caption'=>"Account totals",
             'viewrecords'=>false,
             'footerrow' => true,
             'userDataOnFooter' => true,
         )
     )
 );
 ?>     
 
<br/>

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
//         'modelClass'=>'Payment',
         'htmlOptions'=>array(
             'id'=>'transactionlist',
         ),
         'navbar'=>true,
         'options'=>array(
             'hiddengrid'=>true,
             'height'=>'auto',
//             'autowidth'=>true,
             'datatype'=>'json',
             'colNames'=>array('id','date', 'account', 'amount', 'counterparty', 'description', 'recipient', 'expected payer', 'ref period begin', 'ref period end'), 
             'colModel'=>array( 
                array('index'=>'t_id', 'name'=>'t_id', 'width'=>'40'),
                array('index'=>'t_date', 'name'=>'t_date', 'width'=>'80'),
                array('index'=>'a_name', 'name'=>'a_name', 'width'=>'80'),
                array('index'=>'t_amount', 'name'=>'t_amount', 'align'=>'right', 'width'=>'60', 'formatter'=>'number'),
                array('index'=>'t_counterparty', 'name'=>'t_counterparty', 'width'=>'100'),
                array('index'=>'t_description', 'name'=>'t_description', 'width'=>'100'),
                array('index'=>'rs_name', 'name'=>'rs_name', 'width'=>'80'),
                array('index'=>'eps_name', 'name'=>'eps_name', 'width'=>'80'),
                array('index'=>'t_ref_period_begin_date', 'name'=>'t_ref_period_begin_date', 'width'=>'80'),
                array('index'=>'t_ref_period_end_date', 'name'=>'t_ref_period_end_date', 'width'=>'80'),
             ),
             'rowNum'=>10,
             'rowList'=>array(10,25,50,200),
             'sortname'=>'t_date',
             'sortorder'=>'desc',
             'caption'=>"Transaction list",
             'viewrecords'=>true,
            // 'footerrow' => true,
            // 'userDataOnFooter' => true,
            //'jsonreader'=>array('repeatitems'=>false)
            //'jsonreader'=>array('repeatitems'=>false, 'id' => "0"),
         )
     )
 );
 ?>     

 <br/>

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
         'htmlOptions'=>array(
             'id'=>'paymentlist',
         ),
         'navbar'=>false,
         'options'=>array(
             'hiddengrid'=>true,
             'height'=>'auto',
             'datatype'=>'json',
             'colNames'=>array('id','date', 'amount', 'actual payer', 'payment type'),
             'colModel'=>array(
                array('index'=>'p_id', 'name'=>'p_id', 'width'=>'40'),
                array('index'=>'p_date', 'name'=>'p_date', 'width'=>'80'),
                array('index'=>'p_amount', 'name'=>'p_amount', 'align'=>'right', 'width'=>'60', 'formatter'=>'number'),
                array('index'=>'aps_name', 'name'=>'aps_name', 'width'=>'80'),
                array('index'=>'pt_name', 'name'=>'pt_name', 'width'=>'100'),
             ),
             'rowNum'=>-1,
             'sortname'=>'p_date',
             'sortorder'=>'desc',
             'caption'=>"Payment list",
            // 'viewrecords'=>false,
            // 'footerrow' => true,
            // 'userDataOnFooter' => true,
             'jsonReader'=>array('repeatitems'=>false, 'id' => "0"),
         )
     )
 );
 ?>

 <br/>

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
         'htmlOptions'=>array(
             'id'=>'subjectbalance',
         ),
         'navbar'=>false,
         'options'=>array(
             'hiddengrid'=>true,
             'height'=>'auto',
             'datatype'=>'json',
             'colNames'=>array('creditore','azione', 'debitore', 'importo'),
             'colModel'=>array( 
                array('index'=>'creditore', 'name'=>'creditore', 'width'=>'80'),
                array('index'=>'azione', 'name'=>'azione', 'width'=>'120'),
                array('index'=>'debitore', 'name'=>'debitore', 'width'=>'80'),
                array('index'=>'importo', 'name'=>'importo', 'align'=>'right', 'width'=>'60', 'formatter'=>'number'),
             ),
             'rowNum'=>-1,
            // 'sortname'=>'p_date',
            // 'sortorder'=>'desc',
             'caption'=>"Subject balance",
            // 'viewrecords'=>false,
            // 'footerrow' => true,
            // 'userDataOnFooter' => true,
             'jsonReader'=>array('repeatitems'=>false, 'id' => "0"),
         )
     )
 );
 ?>     

    </div>
 </div>


 
<?php 

    
Yii::app()->getClientScript()->registerScript("1",
    "jQuery('#accounttotals_grid').jqGrid('setGridParam',{
        onSelectRow : function(id) {
            doSearchT(id);
        }
    });");
    
Yii::app()->getClientScript()->registerScript("2",
    "jQuery('#transactionlist_grid').jqGrid('setGridParam',{
        jsonReader : {repeatitems: false, id: \"0\" }
    });");    

Yii::app()->getClientScript()->registerScript("3",
    "jQuery('#transactionlist_grid').jqGrid('setGridParam',{
        onSelectRow : function(id) {
            doSearchP(id);
        }
    });");
?>      
    
<script type="text/javascript"> 

function searchTransactions() {
    toggleGridState('#accounttotals_grid', 'visible');
    doSearchT(jQuery('#PaymentSearch_account_id').val());
}

function showAccountTotals() {
    doSearchA();
}

function doSearchA(){
    var search_url = "/index.php?r=statistics/jsonAccountTotals"
        + "&date_from=" + jQuery('#PaymentSearch_date_from').val()
        + "&date_to=" + jQuery('#PaymentSearch_date_to').val()
        + "&account_id=" + jQuery('#PaymentSearch_account_id').val()
        + "&sign=" + jQuery('#PaymentSearch_sign').val()
        + "&recipient_subject_id=" + jQuery('#PaymentSearch_recipient_subject_id').val()
        + "&ref_period_date_to=" + jQuery('#PaymentSearch_ref_period_date_to').val()
        + "&ref_period_date_from=" + jQuery('#PaymentSearch_ref_period_date_from').val()
        + "&actual_payer_subject_id=" + jQuery('#PaymentSearch_actual_payer_subject_id').val()
        + "&expected_payer_subject_id=" + jQuery('#PaymentSearch_expected_payer_subject_id').val()
        + "&amount_min=" + jQuery('#PaymentSearch_amount_min').val()
        + "&amount_max=" + jQuery('#PaymentSearch_amount_max').val()
        + "&counterparty=" + jQuery('#PaymentSearch_counterparty').val()
        + "&description=" + jQuery('#PaymentSearch_description').val()
        + "&include_accounts=" + jQuery('#PaymentSearch_include_accounts').val()
        + "&payment_type_id=" + jQuery('#PaymentSearch_payment_type_id').val()
        + "&diff_payers=" + jQuery('#PaymentSearch_diff_payers').is(':checked')
        + "&statement=" + jQuery('#PaymentSearch_statement').val()
        ;
//    alert(search_url);
    jQuery('#accounttotals_grid').jqGrid('setGridParam', {url:search_url, page:1}).trigger('reloadGrid');
    toggleGridState('#accounttotals_grid', 'hidden');
    toggleGridState('#paymentlist_grid', 'visible');
} 

function doSearchT(sel_account_id){
    //alert(sel_account_id);
    var search_url = "/index.php?r=statistics/jsonTransactionList"
        + "&date_from=" + jQuery('#PaymentSearch_date_from').val()
        + "&date_to=" + jQuery('#PaymentSearch_date_to').val()
        + "&account_id=" + sel_account_id
        + "&sign=" + jQuery('#PaymentSearch_sign').val()
        + "&recipient_subject_id=" + jQuery('#PaymentSearch_recipient_subject_id').val()
        + "&ref_period_date_to=" + jQuery('#PaymentSearch_ref_period_date_to').val()
        + "&ref_period_date_from=" + jQuery('#PaymentSearch_ref_period_date_from').val()
        + "&actual_payer_subject_id=" + jQuery('#PaymentSearch_actual_payer_subject_id').val()
        + "&expected_payer_subject_id=" + jQuery('#PaymentSearch_expected_payer_subject_id').val()
        + "&amount_min=" + jQuery('#PaymentSearch_amount_min').val()
        + "&amount_max=" + jQuery('#PaymentSearch_amount_max').val()
        + "&counterparty=" + jQuery('#PaymentSearch_counterparty').val()
        + "&description=" + jQuery('#PaymentSearch_description').val()
        + "&include_accounts=" + jQuery('#PaymentSearch_include_accounts').val()
        + "&payment_type_id=" + jQuery('#PaymentSearch_payment_type_id').val()
        + "&diff_payers=" + jQuery('#PaymentSearch_diff_payers').is(':checked')
        + "&statement=" + jQuery('#PaymentSearch_statement').val()
        ;
//    alert(search_url);
    jQuery('#transactionlist_grid').jqGrid('setGridParam', {url:search_url, page:1}).trigger('reloadGrid');
    toggleGridState('#transactionlist_grid', 'hidden');
    toggleGridState('#paymentlist_grid', 'visible');
} 

function doSearchP(sel_transaction_id){
    //alert(sel_account_id);
    var search_url = "/index.php?r=statistics/jsonPaymentList"
        + "&transaction_id=" + sel_transaction_id
        ;
//    alert(search_url);
    jQuery('#paymentlist_grid').jqGrid('setGridParam', {url:search_url, page:1}).trigger('reloadGrid');
    toggleGridState('#paymentlist_grid', 'hidden');
//    if ($("#paymentlist_grid").jqGrid('getGridParam', 'gridstate') == "hidden") {
//        $(".HeaderButton", $('#paymentlist_grid')[0].grid.cDiv).trigger("click");
//    }
} 

function showSubjBalance(){
    var search_url = "/index.php?r=statistics/jsonSubjectBalance"
        + "&date_from=" + jQuery('#PaymentSearch_date_from').val()
        + "&date_to=" + jQuery('#PaymentSearch_date_to').val()
        + "&account_id=" + jQuery('#PaymentSearch_account_id').val()
        + "&sign=" + jQuery('#PaymentSearch_sign').val()
        + "&recipient_subject_id=" + jQuery('#PaymentSearch_recipient_subject_id').val()
        + "&ref_period_date_to=" + jQuery('#PaymentSearch_ref_period_date_to').val()
        + "&ref_period_date_from=" + jQuery('#PaymentSearch_ref_period_date_from').val()
        + "&actual_payer_subject_id=" + jQuery('#PaymentSearch_actual_payer_subject_id').val()
        + "&expected_payer_subject_id=" + jQuery('#PaymentSearch_expected_payer_subject_id').val()
        + "&amount_min=" + jQuery('#PaymentSearch_amount_min').val()
        + "&amount_max=" + jQuery('#PaymentSearch_amount_max').val()
        + "&counterparty=" + jQuery('#PaymentSearch_counterparty').val()
        + "&description=" + jQuery('#PaymentSearch_description').val()
        + "&include_accounts=" + jQuery('#PaymentSearch_include_accounts').val()
        + "&payment_type_id=" + jQuery('#PaymentSearch_payment_type_id').val()
        + "&diff_payers=" + jQuery('#PaymentSearch_diff_payers').is(':checked')
        + "&statement=" + jQuery('#PaymentSearch_statement').val()
        ;
//    alert(search_url);
    jQuery('#subjectbalance_grid').jqGrid('setGridParam', {url:search_url, page:1}).trigger('reloadGrid');
    toggleGridState('#subjectbalance_grid', 'hidden');
}

function toggleGridState(grid, state){
    if ($(grid).jqGrid('getGridParam', 'gridstate') == state) {
        $(".HeaderButton", $(grid)[0].grid.cDiv).trigger("click");
    }
}

</script> 

