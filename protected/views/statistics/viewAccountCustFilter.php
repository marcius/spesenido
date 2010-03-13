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

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
         'htmlOptions'=>array(
             'id'=>'mygrid2',
         ),
         'navbar'=>false,
         'options'=>array(
             'height'=>'auto',
//             'autowidth'=>true,
             'datatype'=>'json',
             'url'=> CController::createUrl('test/due'),
             'colNames'=>array('id','name', 'amount'), // model attributes
             'colModel'=>array( // optional, this is generated automatically from colNames if 'modelClass' is defined
                array('index'=>'id', 'name'=>'id', 'hidden'=>true   ),
                array('index'=>'name', 'name'=>'name'),
                array('index'=>'sum_amount', 'name'=>'sum_amount', 'align'=>'right'),
             ),
             'rowNum'=>-1,
             'sortname'=>'name',
             'sortorder'=>"asc",
             'caption'=>"My second grid",
             'viewrecords'=>false,
             'footerrow' => true,
             'userDataOnFooter' => true,
         )
     )
 );
 ?>     
 
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
            <?php echo CHtml::activeLabelEx($searchModel,'include accounts'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'includeaccounts', 
                array(''=>'all', 'notnull'=>'only > 0')
//                array('prompt'=>'only > 1')
                ); ?>
            <?php echo CHtml::error($searchModel,'includeaccounts'); ?>
        </div>
    </div>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'amount_min'); ?>
            <?php echo CHtml::activeTextField($searchModel,'amount_min'); ?>
            <?php echo CHtml::error($searchModel,'amount_min'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'amount_max'); ?>
            <?php echo CHtml::activeTextField($searchModel,'amount_max'); ?>
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
            <?php echo CHtml::activeTextField($searchModel,'counterparty'); ?>
            <?php echo CHtml::error($searchModel,'counterparty'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'description'); ?>
            <?php echo CHtml::activeTextField($searchModel,'description'); ?>
            <?php echo CHtml::error($searchModel,'description'); ?>
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


    <div class="row submit">
        <button onclick="doSearch();">Search</button>
    </div>

</div><!-- form -->

<script type="text/javascript"> 
function doSearch(){
    var account_id = jQuery('#PaymentSearch_account_id').val();
    var recipient_subject_id = jQuery('#PaymentSearch_recipient_subject_id').val();

    var search_url = "/index.php?r=test/due"
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
        + "&includeaccounts=" + jQuery('#PaymentSearch_includeaccounts').val()
        + "&payment_type_id=" + jQuery('#PaymentSearch_payment_type_id').val()
        ;
//    alert(search_url);
    jQuery('#mygrid2_grid').jqGrid('setGridParam', {url:search_url, page:1}).trigger('reloadGrid');
} 
</script> 

