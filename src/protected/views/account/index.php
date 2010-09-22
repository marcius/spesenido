<?php
$this->breadcrumbs=array(
	'Accounts',
);
?>

<h1>List Account</h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create Account',array('create')); ?></li>
	<li><?php echo CHtml::link('Manage Account',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
