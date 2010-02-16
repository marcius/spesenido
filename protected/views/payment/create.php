<?php
$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);
?>
<h1>Create Payment</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Payment',array('index')); ?></li>
	<li><?php echo CHtml::link('Manage Payment',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>