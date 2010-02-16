<?php
$this->breadcrumbs=array(
	'Statistics'=>array('index'),
);
?>
<h1>View Statistics Account by Classification</h1>

<ul class="actions">
    <li><?php echo CHtml::link('Account by Month',array('viewAccountMonth')); ?></li>
    <li><?php echo CHtml::link('Account by Classification',array('viewAccountClassification')); ?></li>
</ul><!-- actions -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>jquery.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>jquery.jqGrid.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>js/jqModal.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>js/jqDnR.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function(){ 
  jQuery("#list").jqGrid({
    url:'CalcStat.php',
    datatype: 'json',
    mtype: 'GET',
    colNames:['Inv No','Date'],
    colModel :[ 
      {name:'id', index:'id', width:20, align:'right'}, 
      {name:'name', index:'name', width:80, align:'right'}, 
      ],
    pager: jQuery('#pager'),
    rowNum:10,
    rowList:[10,20,30],
    sortname: 'id',
    sortorder: "desc",
    viewrecords: true,
    imgpath: 'themes/basic/images',
    caption: 'My first grid'
  }); 
}); 
</script>
<table id="list" class="scroll"></table> 
<div id="pager" class="scroll" style="text-align:center;"></div> 


<div class="form">

<?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($searchModel); ?>

    <div class="row">
            <?php echo CHtml::activeLabelEx($searchModel,'account_id'); ?>
            <?php echo CHtml::activeDropDownList($searchModel,'account_id', 
                CHtml::listData(Account::model()->findAll(),'id','name'), 
                array('prompt'=>' ')
                ); ?>
            <?php echo CHtml::error($searchModel,'account_id'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>


<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'name',
    ),
)); ?>



