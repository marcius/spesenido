<?php
$this->breadcrumbs=array(
    'Statistics'=>array('index'),
);
?>
<h1>View account totals by month</h1>

   <ul class="actions">
    <li><?php echo CHtml::link('Account totals by month',array('viewAccountMonth')); ?></li>
    <li><?php echo CHtml::link('Account totals by custom filter',array('viewAccountCustFilter')); ?></li>
</ul><!-- actions -->


<div class="form">

<?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($searchModel); ?>

    <div class="row">
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'classification_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'classification_id', 
                CHtml::listData(Classification::model()->findAll(),'id','name'), 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'classification_id'); ?>
        </div>
        <div class="column">
            <?php echo CHtml::activeLabelEx($searchModel,'sign'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'sign', 
                array('1'=>'Entrate', '0'=>'Giroconti', '-1'=>'Uscite'),
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'sign'); ?>
        </div>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>


<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'name:text:Account',
        '2009_10:number:Ott 09',
        '2009_11:number:Nov 09',
        '2009_12:number:Dic 09',
        '2010_01:number:Gen 10',
        '2010_02:number:Feb 10',
        '2010_03:number:Mar 10',
    ),
)); 
?>




