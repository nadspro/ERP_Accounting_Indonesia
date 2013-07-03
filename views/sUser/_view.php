<?php
/* @var $this SUserSController */
/* @var $data sUser */
?>

<div class="row">
<?php /*
<div class="span1 well">
	<?php 
		echo $data->photoPath;
	?>
</div>
*/ ?>
<div class="span5">
	<h4><?php echo CHtml::link($data->username,Yii::app()->createUrl('/sUser/view',array('id'=>$data->id))); ?>
	| <?php echo CHtml::link('rights',Yii::app()->createUrl('/rights/assignment/user',array('id'=>$data->id))); ?></h4>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('full_name')); ?>:</b>
	<?php echo CHtml::encode($data->full_name); ?>
	<br />

	<b><?php echo "SSO"; ?>:</b>
	<?php
		echo CHtml::encode($data->sso()); 
	?>
	<br />

	<b><?php echo "Module "; ?> (<?php echo $data->moduleCount; ?>):</b>
	<?php echo implode(" | ", $data->moduleMember); ?>	
	<br />

	<b><?php echo "Rights "; ?> (<?php echo $data->rightCount; ?>):</b>
	<?php echo implode(" | ", $data->rightMember); ?>	
	<br />


	<b><?php echo "Group"; ?> (<?php echo $data->groupCount + 1; ?>):</b>
	<?php echo implode(" | ", $data->groupMember); ?>	
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo $data->status->name; ?>
	<br />
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login')); ?>:</b>
	<?php echo waktu::nicetime($data->last_login); ?>
	<br />

</div>
</div>
<br />

