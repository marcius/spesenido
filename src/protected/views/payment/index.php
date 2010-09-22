<?php
$this->breadcrumbs=array(
	'Payments',
);
?>

<h1>List Payment</h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create Payment',array('create')); ?></li>
	<li><?php echo CHtml::link('Manage Payment',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
