<div class="row">
    <div class="span2">
        <?php
        echo $data->photoPath;
        ?>
        <p>
        <ul class="unstyled">
            <li style="font-size:11px">Data Completeness <span class="pull-right strong"><?php echo number_format($data->completion, 0) ?>%</span>
                <?php
                $this->widget('bootstrap.widgets.TbProgress', array(
                    'type' => 'success', // 'info', 'success' or 'danger'
                    'percent' => $data->completion,
                    'htmlOptions' => array(
                        'style' => 'height:7px',
                    )
                ));
                ?>
            </li>
        </ul>		
        </p>
    </div>
    <?php if (in_array($data->mStatusId(), Yii::app()->getModule('m1')->PARAM_RESIGN_ARRAY)) { ?>
        <div class="span4">
        <?php } elseif ($data->many_career2C >= 1) { ?>
            <div class="span4">
            <?php } else { ?>
                <div class="span5">
                <?php } ?>

                <?php
                $this->widget('bootstrap.widgets.TbDetailView', array(
                    'data' => array(
                        'id' => 1,
                        'employee_id' => $data->employeeShortId,
                        'company' => $data->mCompany(),
                        'department' => $data->mDepartment(),
                        'job_title' => $data->mJobTitle(),
                        'level' => $data->mLevel(),
                        'status' => ($data->countContract() != "") ? $data->mStatus() . " ( " . $data->countContract() . " )" : $data->mStatus(),
                        'join_date' => (isset($data->companyfirst)) ? $data->companyfirst->start_date . " ( " . $data->countJoinDate() . " )" : "",
                        'superior_link' => (isset($data->company->superior)) ?
                                CHtml::link($data->company->superior->employee_name, Yii::app()->createUrl('m1/gPerson/view', array('id' => $data->company->superior_id))) : "",
                    ),
                    'attributes' => array(
                        array('name' => 'employee_id', 'label' => 'Employee ID'),
                        array('name' => 'company', 'label' => 'Company'),
                        array('name' => 'department', 'label' => 'Department'),
                        array('name' => 'job_title', 'label' => 'Job Title'),
                        array('name' => 'level', 'label' => 'Level'),
                        array('name' => 'status', 'label' => 'Status'),
                        array('name' => 'join_date', 'label' => 'Join Date'),
                        array('name' => 'superior_link', 'type' => 'raw', 'label' => 'Superior'),
                    ),
                ));
                ?>

            </div>


        </div>
<?php /*
EQuickDlgs::ajaxIcon(
		Yii::app()->baseUrl .'images/view.png',
		array(
				'controllerRoute' => '/m1/gPerson/view', //'member/view'
				'actionParams' => array('id'=>$data->id), //array('id'=>$data->member->id),
				'dialogTitle' => 'Detailview',
				'dialogWidth' => 800,
				'dialogHeight' => 600,
				'openButtonText' => 'View record',
				'closeButtonText' => 'Close',
		)
);
		*/
	