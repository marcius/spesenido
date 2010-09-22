<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->name,
);
?>
<h1>View Account #<?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Account',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Account',array('create')); ?></li>
	<li><?php echo CHtml::link('Update Account',array('update','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::linkButton('Delete Account',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')); ?></li>
	<li><?php echo CHtml::link('Manage Account',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'months',
		'shared',
		'sign',
		'created_at',
		'updated_at',
	),
)); ?>
