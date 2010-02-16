<?php
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id,
);
?>
<h1>View Payment #<?php echo $model->id; ?></h1>

<ul class="actions">
    <li><?php echo CHtml::link('View Transaction',array('transaction/view','id'=>$model->transaction_id)); ?></li>
	<li><?php echo CHtml::link('Update Payment',array('update','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::linkButton('Delete Payment',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transaction_id',
		'amount',
		'date',
		'payer_subject_id',
		'payment_type_id',
		'created_at',
		'updated_at',
	),
)); ?>
