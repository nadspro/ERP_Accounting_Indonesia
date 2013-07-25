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
        <h4><?php echo CHtml::link($data->username, Yii::app()->createUrl('/sUser/view', array('id' => $data->id))); ?>
            | <?php echo CHtml::link('rights', Yii::app()->createUrl('/rights/assignment/user', array('id' => $data->id))); ?>
            <small><?php echo waktu::nicetime($data->last_login); ?></small>
            </h4>

        <b><?php echo CHtml::tag("span", array('class' => 'badge badge-info'), $data->getAttributeLabel('full_name')); ?>:</b>
        <?php echo CHtml::encode($data->full_name); ?>
        <br />

        <b><?php echo CHtml::tag("span", array('class' => 'badge badge-info'), "SSO"); ?>:</b>
        <?php
        echo CHtml::encode($data->sso());
        ?>
        <br />

        <?php echo CHtml::tag("span", array('class' => 'badge badge-info'), "Module ".$data->moduleCount) ?>
        <?php echo implode(" | ", $data->moduleMember); ?>	
        <br />

        <?php echo CHtml::tag("span", array('class' => 'badge badge-info'), "Rights ".$data->rightCount); ?>
        <?php echo implode(" | ", $data->rightMember); ?>	
        <br />


        <?php echo CHtml::tag("span", array('class' => 'badge badge-info'), "Group ". ($data->groupCount + 1)); ?>
        <?php echo implode(" | ", $data->groupMember); ?>	
        <br />

        <b><?php echo CHtml::tag("span", array('class' => 'badge badge-info'), $data->getAttributeLabel('status_id')); ?></b>
        <?php echo $data->status->name; ?>

    </div>
</div>
<br />

