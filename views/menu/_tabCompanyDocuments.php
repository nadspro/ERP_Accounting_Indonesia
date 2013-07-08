<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-flag"></i><?php echo Yii::t('basic', ' Company Documents') ?></span>
        </li>
    </ul>
</div>

<?php
// ElFinder widget
$this->widget('ext.elFinder.ElFinderWidget', array(
    'connectorRoute' => 'sCompanyDocuments/connectorCompanyDocuments',
));
?>

<br/>
