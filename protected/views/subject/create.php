<?php
$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	'Create',
);
?>
<h1>Create Subject</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Subject',array('index')); ?></li>
	<li><?php echo CHtml::link('Manage Subject',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>