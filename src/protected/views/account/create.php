<?php
$this->breadcrumbs=array(
	'Accounts'=>array('index'),
	'Create',
);
?>
<h1>Create Account</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Account',array('index')); ?></li>
	<li><?php echo CHtml::link('Manage Account',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>