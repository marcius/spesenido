<div class="form">

<?php echo CHtml::beginForm(); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo CHtml::errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'shortname'); ?>
		<?php echo CHtml::activeTextField($model,'shortname',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo CHtml::error($model,'shortname'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'name'); ?>
		<?php echo CHtml::activeTextField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo CHtml::error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'created_at'); ?>
		<?php echo CHtml::activeTextField($model,'created_at'); ?>
		<?php echo CHtml::error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'updated_at'); ?>
		<?php echo CHtml::activeTextField($model,'updated_at'); ?>
		<?php echo CHtml::error($model,'updated_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->