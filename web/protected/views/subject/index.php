<?php
$this->breadcrumbs=array(
	'Subjects',
);
?>

<h1>List Subject</h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create Subject',array('create')); ?></li>
	<li><?php echo CHtml::link('Manage Subject',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
