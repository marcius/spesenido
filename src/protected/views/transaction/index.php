<?php
$this->breadcrumbs=array(
	'Transactions',
);
?>

<h1>List Transaction</h1>

<ul class="actions">
	<li><?php echo CHtml::link('Create Transaction',array('create')); ?></li>
	<li><?php echo CHtml::link('Manage Transaction',array('admin')); ?></li>
</ul><!-- actions -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
