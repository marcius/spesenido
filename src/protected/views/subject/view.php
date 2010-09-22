<?php
$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->name,
);
?>
<h1>View Subject #<?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Subject',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Subject',array('create')); ?></li>
	<li><?php echo CHtml::link('Update Subject',array('update','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::linkButton('Delete Subject',array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure to delete this item?')); ?></li>
	<li><?php echo CHtml::link('Manage Subject',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shortname',
		'name',
		'roles',
		'created_at',
		'updated_at',
	),
)); ?>
