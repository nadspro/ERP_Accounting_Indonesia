<div class="row">
    <div class="span4">
        <div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="icon-fa-user"></i><?php echo Yii::t('basic', ' Welcome New Employees') ?></span>
                </li>
            </ul>
        </div>

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'employee-grid',
            'dataProvider' => gPersonCareer::model()->employeeInAll(),
            'enableSorting' => false,
            'template' => '{items}',
            'itemsCssClass' => 'table table-striped table-bordered',
            'columns' => array(
                array(
                    'type' => 'raw',
                    'value' => '$data->parent->photoPath',
                    'htmlOptions' => array("width" => "120px"),
                ),
                array(
                    'header' => 'Detail',
                    'type' => 'raw',
                    'value' => function($data) {
                        return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->parent->employee_name)
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->parent->mCompany())
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->parent->mDepartment())
                                . $data->parent->mLevel()
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '');
                    }
                ),
            ),
        ));
        ?>

    </div>
    <div class="span4">
        <div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
            <ul class="nav nav-list">
                <li class="nav-header"><i class="icon-fa-user"></i><?php echo Yii::t('basic', 'Employee Career Updated') ?></span>
                </li>
            </ul>
        </div>

        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'employee-grid',
            'dataProvider' => gPersonCareer::model()->employeeRecentAll(),
            'enableSorting' => false,
            'template' => '{items}',
            'itemsCssClass' => 'table table-striped table-bordered',
            'columns' => array(
                array(
                    'type' => 'raw',
                    'value' => '$data->parent->photoPath',
                    'htmlOptions' => array("width" => "120px"),
                ),
                array(
                    'header' => 'Detail',
                    'type' => 'raw',
                    'value' => function($data) {
                        return CHtml::tag('div', array('style' => 'font-weight: bold'), $data->parent->employee_name)
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->parent->mCompany())
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->parent->mDepartment())
                                . $data->parent->mLevel()
                                . CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), (isset($data->parent->companyfirst->start_date)) ? $data->parent->companyfirst->start_date : '');
                    }
                ),
            ),
        ));
        ?>

    </div>
</div>

