<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id,
);
?>
<h1>View Transaction #<?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create Transaction',array('quickcreate')); ?></li>
	<li><?php echo CHtml::link('Update Transaction',array('update','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::linkButton('Delete Transaction',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')); ?></li>
    <li><?php echo CHtml::link('Add Payment',array('payment/create','transaction_id'=>$model->id)); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'date',
		'account.name',
		'amount',
        'counterparty',
		'description',
		'recipient_subject.name',
		'payer_subject.name',
		'ref_period_begin_date',
		'ref_period_end_date',
        array(
                'name'=>'created_at', 
                'value'=>Yii::app()->dateFormatter->formatDateTime($model->created_at),
        ),
        array(
                'name'=>'updated_at', 
                'value'=>Yii::app()->dateFormatter->formatDateTime($model->updated_at),
        ), 
	),
)); ?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'amount',
        'date',
        'payer_subject.name',
        'payment_type.name',
        /*
        'created_at',
        'updated_at',
        */
        array(
            'class'=>'CButtonColumn',
            'viewButtonUrl'=>'Yii::app()->createUrl("payment/view",array("id"=>$data->primaryKey))',
            'updateButtonUrl'=>'Yii::app()->createUrl("payment/update",array("id"=>$data->primaryKey))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("payment/delete",array("id"=>$data->primaryKey))',
        ),
    ),
)); ?>

