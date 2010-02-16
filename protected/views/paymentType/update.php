<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update PaymentType <?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List PaymentType',array('index')); ?></li>
	<li><?php echo CHtml::link('Create PaymentType',array('create')); ?></li>
	<li><?php echo CHtml::link('View PaymentType',array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link('Manage PaymentType',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>