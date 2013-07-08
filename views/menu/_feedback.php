<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => false,
    'headerIcon' => 'icon-globe',
    'htmlHeaderOptions' => array('style' => 'background:white'),
        //'htmlContentOptions'=>array('style'=>'background:#FFA573'),
));
?>

<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-comment"></i><?php echo Yii::t('basic', ' FeedBack') ?></li>
    </ul>
</div>


<table width="100%">
    <?php foreach (sFeedback::model()->searchFilter()->getData() as $data): ?>
        <tr>
            <td>
                <div>
                    <i class="iconic-check"></i>
                    <?php echo CHtml::link(substr($data->long_desc, 0, 50) . ' ...', Yii::app()->createUrl('/sFeedback/view', array("id" => $data->id))); ?></div>

                <div class="pull-right" style="color:grey;font-size:11px; margin-bottom:10px;">
                    <?php echo Yii::app()->dateFormatter->format("dd-MM-yyyy", $data->sender_date) ?> 
                    <?php echo ' | ' . $data->status->name . ' | (' . $data->countComment . ')' ?></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$this->endWidget();
?>

