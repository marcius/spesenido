<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Manage',
);
?>
<h1>Manage Accounts</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Account',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Account',array('create')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'name',
		'months',
		'shared',
		'sign',
		'created_at',
		/*
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
