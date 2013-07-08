<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i> Employee In</span>
        </li>
    </ul>
</div>
<?php
//$this->widget('bootstrap.widgets.TbGridView', array(
$this->widget('ext.groupgridview.TbGroupGridView', array(
    'extraRowColumns' => array('tMonth'),
    'id' => 'employee-grid',
    'dataProvider' => gPersonCareer::model()->employeeIn(),
    'enableSorting' => false,
    'template' => '{items}',
    'htmlOptions' => array('style' => 'padding-top:0'),
    'columns' => array(
        array(
            'name' => 'tMonth',
            'value' => 'date("M-Y", strtotime($data->start_date))',
            'headerHtmlOptions' => array('style' => 'display: none'),
            'htmlOptions' => array('style' => 'display: none'),
        ),
        array(
            'type' => 'raw',
            'value' => '$data->parent->gPersonPhoto',
            'htmlOptions' => array("width" => "55px"),
        ),
        array(
            'type' => 'raw',
            'value' => function($data) {
                return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->parent->gPersonLink)
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->department->name)
                        . $data->level->name
                        . CHtml::tag('div', array('style' => 'font-weight: bold'), $data->parent->mStatus())
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '')
                        . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->parent->countJoinDate());
            }
        ),
    ),
));
?>


