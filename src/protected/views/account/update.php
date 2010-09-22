<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Account <?php echo $model->id; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Account',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Account',array('create')); ?></li>
	<li><?php echo CHtml::link('View Account',array('view','id'=>$model->id)); ?></li>
	<li><?php echo CHtml::link('Manage Account',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>