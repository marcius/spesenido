<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Create',
);
?>
<h1>Create Transaction</h1>

<ul class="actions">
	<li><?php echo CHtml::link('List Transaction',array('index')); ?></li>
	<li><?php echo CHtml::link('Manage Transaction',array('admin')); ?></li>
</ul><!-- actions -->

<?php echo $this->renderPartial('_quickform', 
    array(
        'model'=>$model, 
        'modelP'=>$modelP,
        )
        ); ?>