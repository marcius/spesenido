<?php
$this->breadcrumbs=array(
	'Payment Types'=>array('index'),
	'Manage',
);
?>
<h1>Manage Payment Types</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List PaymentType',array('index')); ?></li>
	<li><?php echo CHtml::link('Create PaymentType',array('create')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'shortname',
		'name',
		'created_at',
		'updated_at',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
