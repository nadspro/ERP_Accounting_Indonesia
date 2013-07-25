<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => false,
    'headerIcon' => 'icon-globe',
    'htmlHeaderOptions' => array('style' => 'background:white'),
        //'htmlContentOptions'=>array('style'=>'background:#FFA573'),
));
?>

<div class="row-fluid">
    <div class="span4">
        <h3>
            <?php
            echo CHtml::link($data->system_reff, array('view', 'id' => $data->id));
            ?>
        </h3>
        <p>
            <?php
            if ($data->state_id != 4) {
                echo CHtml::link('<i class="fam-delete"></i>', "#", array("class" => "btn btn-mini", "submit" => array('delete', 'id' => $data->id), 'confirm' => 'Are you sure to delete this journal?'));
                echo " ";
                echo CHtml::link('<i class="fam-comment-edit"></i>', Yii::app()->createUrl($this->module->id . '/' . $this->id . '/update', array("id" => $data->id)), array("class" => "btn btn-mini"));
                echo " ";
            }
            echo CHtml::link('<i class="fam-printer"></i>', Yii::app()->createUrl($this->module->id . '/' . $this->id . '/print', array("id" => $data->id)), array('target' => '_blank', "class" => "btn btn-mini"));

            echo ($data->journalSum != $data->journalSumCek) ? " WARNING!!!... FAULT BY SYSTEM. JOURNAL IS NOT BALANCE, PLEASE DELETE.." : "";
            ?>
        </p>


        <?php if ($data->remark != null) { ?>
            <p>
                <?php echo CHtml::encode($data->remark); ?>
            </p>
        <?php }; ?>
    </div>

    <div class="span8">
        <?php
	        $this->renderPartial('/tJournal/_viewJournalInfo',array('data'=>$data));
        ?>
    </div>
</div>

<?php echo $this->renderPartial('/tJournal/_viewDetail', array('data' => $data)); ?>

<?php
$this->endWidget();
?>

