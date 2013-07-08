<?php if (in_array($data->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) { ?>
    <div style="background-color:#D5D5D5;padding:10px;margin:10px 0;">
    <?php } elseif ($data->many_career2C >= 1) { ?>
        <div style="border-style:solid;border-width:1px;border-color:#D5D5D5;padding:10px;margin:10px 0;">
        <?php } else { ?>
            <div style="background-color:white">
            <?php } ?>

            <h3>
                <?php echo CHtml::link($data->employee_name_r, Yii::app()->createUrl($this->route . '/../view', array('id' => $data->id,))); ?>
            </h3>

            <?php echo $this->renderPartial('/gPerson/_viewDetail', array('data' => $data)); ?>

        </div>
