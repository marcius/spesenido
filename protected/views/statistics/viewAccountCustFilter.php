<?php
$this->breadcrumbs=array(
    'Statistics'=>array('index'),
);
?>
<h1>View account totals by custom filter</h1>

<ul class="actions">
    <li><?php echo CHtml::link('Account totals by month',array('viewAccountMonth')); ?></li>
    <li><?php echo CHtml::link('Account totals by custom filter',array('viewAccountCustFilter')); ?></li>
</ul><!-- actions -->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jq/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jqg/css/ui.jqgrid.css" />

<script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jqg/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jq/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jqg/js/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/jqg/js/jquery.jqGrid.min.js" type="text/javascript"></script>

<script type="text/javascript">
//    url: '<?php echo Yii::app()->request->getBaseUrl(true).Yii::app()->createUrl("test/uno"); ?>',
//    imgpath: '<?php echo Yii::app()->request->getBaseUrl(true); ?>/jq/css/images',

jQuery(document).ready(function(){ 
 
  jQuery("#mygrid").jqGrid({
    caption: 'My first grid',
    datatype: 'json',
    url: '/index.php?r=test/uno',
    mtype: 'GET',
    colNames:['id','name'],
    pager: '#mypager',
    width: 500,
    height: 'auto',
//    scroll: 1,
    rowNum:10,
//    rowList:[5,10,20],
//    sortname: 'id',
//    sortorder: "desc",
//    altRows : true,
    viewrecords: true,
    imgpath: '/jq/css/images',
    footerrow : true,
    userDataOnFooter : true,
    colModel :[ 
      {name:'col_a', width:100, align:'right'}, 
      {name:'col_b', width:300, align:'right'}, 
      ]
  }); 

  jQuery("#mygrid2").jqGrid({
    caption: 'My second grid',
    datatype: 'json',
    url: '/index.php?r=test/due',
    mtype: 'GET',
    colNames:['ID','Account', 'Amount'],
    pager: '#mypager2',
    width: 500,
    height: 'auto',
//    scroll: 1,
    rowNum:-1,
//    rowList:[5,10,20],
//    sortname: 'id',
//    sortorder: "desc",
//    altRows : true,
    viewrecords: true,
    imgpath: '/jq/css/images',
    footerrow : true,
    userDataOnFooter : true,
    colModel :[ 
      {name:'id', width:100, align:'right'}, 
      {name:'name', width:300, align:'right'}, 
      {name:'sum_amount', width:300, align:'right'}, 
      ]
  }); 

  jQuery("#mygrid").jqGrid('navGrid', '#mypager', {edit:false,add:false,del:false});
  jQuery("#mygrid2").jqGrid('navGrid', '#mypager2', {edit:false,add:false,del:false});
  
}); 

</script>

<table id="mygrid"></table>
<div id="mypager"></div>

<br/>

<table id="mygrid2"></table>
<div id="mypager2"></div>