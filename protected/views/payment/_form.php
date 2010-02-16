<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<?php echo CHtml::activeHiddenField($model,'transaction_id'); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'amount'); ?>
		<?php echo CHtml::activeTextField($model,'amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo CHtml::error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'date',
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                ),
                'htmlOptions'=>array(
                    'style'=>'height:20px;'
                ),
            ));
         ?>        
		<?php echo CHtml::error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'payer_subject_id'); ?>
        <?php echo CHtml::activeDropDownList($model,'payer_subject_id', CHtml::listData(Subject::model()->findAll(),'id','name')); ?>
		<?php echo CHtml::error($model,'payer_subject_id'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'payment_type_id'); ?>
        <?php echo CHtml::activeDropDownList($model,'payment_type_id', CHtml::listData(PaymentType::model()->findAll(),'id','name')); ?>
		<?php echo CHtml::error($model,'payment_type_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->