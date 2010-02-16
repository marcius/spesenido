<?php
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);
?>
<h1>Manage Payments</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Payment',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Payment',array('create')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
        'date',
        array(      
            'name'=>'amount',
            'value'=>'$data->amount',
            'htmlOptions'=>array(                                        
                'align'=>'center',
            ),
            'footer'=>Yii::app()->format->formatNumber($amountTotal), //'#,###.##', 
        ),        
        array(      
            'name'=>'Actual payer',
            'value'=>'$data->payer_subject->name',
        ),        
        array(      
            'name'=>'Payment type',
            'value'=>'$data->payment_type->name',
        ),        
        array(
            'class'=>'CLinkColumn',
            'header'=>'T Id',
            'labelExpression'=>'$data->transaction_id',
            'urlExpression'=>'Yii::app()->createUrl("transaction/view",array("id"=>$data->transaction_id))',
            'linkHtmlOptions'=>array('target'=>'_blank', 'title'=>'See transaction details'),
        ),        
        array(      
            'name'=>'Expected payer',
            'value'=>'$data->transaction->payer_subject->name',
        ),        
        array(      
            'name'=>'Account',
            'value'=>'$data->transaction->account->name',
        ),        
        array(      
            'name'=>'Counterparty',
            'value'=>'$data->transaction->counterparty',
        ),        
        array(      
            'name'=>'Recipient',
            'value'=>'$data->transaction->recipient_subject->name',
        ),        
        array(      
            'name'=>'Ref. period begin',
            'value'=>'$data->transaction->ref_period_begin_date',
        ),        
        array(      
            'name'=>'Ref. period end',
            'value'=>'$data->transaction->ref_period_end_date',
        ),        
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

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
            <?php echo CHtml::activeLabelEx($searchModel,'counterparty'); ?>
            <?php echo CHtml::activeTextField($searchModel,'counterparty'); ?>
            <?php echo CHtml::error($searchModel,'counterparty'); ?>
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
            <?php echo CHtml::activeLabelEx($searchModel,'payer_subject_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'payer_subject_id',
                CHtml::listData(Subject::model()->findAll(),'id','name'),                 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'payer_subject_id'); ?>
        </div>
        
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

    <div class="row submit">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->