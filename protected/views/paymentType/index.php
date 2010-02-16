<?php
$this->breadcrumbs=array(
	'Payment Types',
);
?>

<h1>List PaymentType</h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create PaymentType',array('create')); ?></li>
	<li><?php echo CHtml::link('Manage PaymentType',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
