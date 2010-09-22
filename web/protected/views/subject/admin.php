<?php
$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	'Manage',
);
?>
<h1>Manage Subjects</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Subject',array('index')); ?></li>
	<li><?php echo CHtml::link('Create Subject',array('create')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'id',
		'shortname',
		'name',
		'roles',
		'created_at',
		'updated_at',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
