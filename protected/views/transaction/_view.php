<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_id')); ?>:</b>
	<?php echo CHtml::encode($data->account_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recipient_subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->recipient_subject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payer_subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->payer_subject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('counterparty')); ?>:</b>
	<?php echo CHtml::encode($data->counterparty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_period_begin_date')); ?>:</b>
	<?php echo CHtml::encode($data->ref_period_begin_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_period_end_date')); ?>:</b>
	<?php echo CHtml::encode($data->ref_period_end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>