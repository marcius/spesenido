<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Manage',
);
?>
<h1>Manage Transactions</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Transaction',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Transaction',array('quickcreate')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(      
            'name'=>'id',
            'value'=>'$data->id',
        ),        
        'date',
        array(      
            'name'=>'account.name',
            'value'=>'$data->account->name',
        ),		
        array(      
            'name'=>'amount',
    //        'type'=>'currency',
            'value'=>'$data->amount',
            'htmlOptions'=>array(                                        
                'align'=>'center',
            ),
            'footer'=>Yii::app()->format->formatNumber($amountTotal), //'#,###.##', 
        ),		
        'counterparty',
		'description',
        'recipient_subject.name',
        'payer_subject.name',
		'ref_period_begin_date',
		'ref_period_end_date',
        /*
		'created_at',
		'updated_at',
		*/
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