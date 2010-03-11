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

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
//         'modelClass'=>'Account', // used for columns label
         'htmlOptions'=>array(
             'id'=>'mygrid1',
         ),
         'navbar'=>true,
         'options'=>array(
             'height'=>'auto',
             'autowidth'=>true,
             'datatype'=>'json',
              'url' => '/index.php?r=test/uno',
//             'url'=>Yii::app()->createUrl('index'), // ajax request for data
             'colNames'=>array('id','name'), // model attributes
             'colModel'=>array( // optional, this is generated automatically from colNames if 'modelClass' is defined
                array('index'=>'id', 'name'=>'id', 'hidden'=>true),
                array('index'=>'name', 'name'=>'name'),
             ),
             'rowNum'=>10,
             'rowList'=>array(20,50,100),
             'sortname'=>'name',
             'sortorder'=>"asc",
             'caption'=>"My first grid",
         )
     )
 );
?> 

<br/>

<?php $this->widget('ext.jqgrid.CJuiJqGrid', array(
//         'modelClass'=>'Account', // used for columns label
         'htmlOptions'=>array(
             'id'=>'mygrid2',
         ),
         'navbar'=>true,
         'options'=>array(
             'height'=>'auto',
             'autowidth'=>true,
             'datatype'=>'json',
              'url' => '/index.php?r=test/due',
//             'url'=>Yii::app()->createUrl('index'), // ajax request for data
             'colNames'=>array('id','name', 'amount'), // model attributes
             'colModel'=>array( // optional, this is generated automatically from colNames if 'modelClass' is defined
                array('index'=>'id', 'name'=>'id', 'hidden'=>true   ),
                array('index'=>'name', 'name'=>'name'),
                array('index'=>'sum_amount', 'name'=>'sum_amount'),
             ),
             'rowNum'=>-1,
//             'rowList'=>array(20,50,100),
             'sortname'=>'name',
             'sortorder'=>"asc",
             'caption'=>"My second grid",
             'footerrow' => true,
             'userDataOnFooter' => true,
             
         )
     )
 );
?> 
