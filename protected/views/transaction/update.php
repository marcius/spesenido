<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Transaction <?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Transaction',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Transaction',array('create')); ?></li>
	<li><?php echo CHtml::link('View Transaction',array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link('Manage Transaction',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>