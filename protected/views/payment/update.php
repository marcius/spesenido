<?php
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Payment <?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Payment',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Payment',array('create')); ?></li>
	<li><?php echo CHtml::link('View Payment',array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link('Manage Payment',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>