<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	'Create',
);
?>
<h1>Create PaymentType</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List PaymentType',array('index')); ?></li>
	<li><?php echo CHtml::link('Manage PaymentType',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>