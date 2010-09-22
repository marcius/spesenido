<?php
$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Subject <?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Subject',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Subject',array('create')); ?></li>
	<li><?php echo CHtml::link('View Subject',array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link('Manage Subject',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>