<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	$model->name,
);
?>
<h1>View PaymentType #<?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List PaymentType',array('index')); ?></li>
	<li><?php echo CHtml::link('Create PaymentType',array('create')); ?></li>
	<li><?php echo CHtml::link('Update PaymentType',array('update','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::linkButton('Delete PaymentType',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')); ?></li>
	<li><?php echo CHtml::link('Manage PaymentType',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shortname',
		'name',
		'created_at',
		'updated_at',
	),
)); ?>
