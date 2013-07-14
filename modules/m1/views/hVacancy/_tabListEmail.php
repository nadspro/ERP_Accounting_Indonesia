<div class="row">
    <div class="span8">
        <div class="btn-toolbar">
            <?php
            $this->widget('bootstrap.widgets.TbButtonGroup', array(
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'mini',
                'buttons' => array(
                    array('label' => 'Action', 'items' => array(
                            array('label' => 'Pre Screened', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 2))),
                            array('label' => 'Candidate Pool', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 3))),
                            '---',
                            array('label' => 'Interview', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 4))),
                            '---',
                            array('label' => 'Rejected', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 5))),
                            array('label' => 'Blacklisted', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 6))),
                            '---',
                            array('label' => 'Hired', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 7))),
                            '---',
                            array('label' => 'Other', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 8))),
                            array('label' => 'Withdraw', 'url' => Yii::app()->createUrl('/m1/hVacancy/process', array('id' => $data->id, 'act' => 9))),
                        )),
                ),
            ));
            ?>
        </div>
        <?php //echo CHtml::tag('div', array('style'=>'color: #999; font-size: 11px'), waktu::nicetime($data->created_date));
        ?>
    </div>
</div>

<div class="row">
    <div class="span1">
        <?php echo $data->applicant->photoPath; ?>
    </div>
    <div class="span2">
        <?php
        echo CHtml::AjaxLink($data->applicant->applicant_name, Yii::app()->createUrl('/m1/hVacancy/detailApplicant', array('id' => $data->applicant_id)), array('update' => '#detail'));
        echo CHtml::tag('div', array('style' => 'color: #999; font-size: 11px'), $data->applicant->birth_date . "<br/>" .
                $data->applicant->sex->name . ' ( ' . $data->applicant->maritalStatus() . ' )' . "<br/>" .
                $data->applicant->religion->name);
        ?>
    </div>
    <div class="span3">
        <?php
        echo CHtml::tag('div', array('style' => 'font-weight: bold'), (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->company_name : '');
        echo CHtml::openTag('div', array('style' => 'color: #999; font-size: 11px'));
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->industries : '';
        echo "<br/>";
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->start_date . ' to ' . $data->applicant->many_experience[0]->end_date : '';
        echo "<br/>";
        echo (isset($data->applicant->many_experience[0])) ? $data->applicant->many_experience[0]->job_title : '';
        echo CHtml::closeTag('div');
        ?>
    </div>
    <div class="span2">
        <?php
        echo CHtml::tag('div', array('style' => 'font-weight: bold'), (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->school_name : '');
        echo CHtml::openTag('div', array('style' => 'color: #999; font-size: 11px'));
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->interest : '';
        echo "<br/>";
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->graduate : '';
        echo "<br/>";
        echo (isset($data->applicant->many_education[0])) ? $data->applicant->many_education[0]->ipk : '';
        echo CHtml::closeTag('div');
        ?>
    </div>
</div>

<div class="row">	
    <div class="span8">
        <?php
        if ($data->email_status_id == 1) {
            echo CHtml::link('Email Invitation', Yii::app()->createUrl('/m1/hVacancy/email', array('id' => $data->id)), array('target' => '_blank', 'class' => 'btn btn-mini', 'style' => 'margin:10px'));
        }
        else
            echo "Emailed";
        ?>

        <?php echo CHtml::link('Interview Comment', Yii::app()->createUrl('/m1/hVacancy/interviewDetail', array('id' => $data->id)), array('target' => '_blank', 'class' => 'btn btn-mini', 'style' => 'margin:10px')); ?>

    </div>
</div>
<hr/>

