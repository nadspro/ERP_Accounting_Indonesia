	
<h3>	
    <div class="row">
        <div class="span8">
            <?php if ($data->applicant->vacancyLocked == 0) { ?>
                <div class="btn-toolbar pull-left">
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
                <?php
            }
            else
                echo "LOCKED";
            ?>
            <?php echo CHtml::link($data->applicant->applicant_name, Yii::app()->createUrl('/m1/hApplicant/view', array('id' => $data->applicant_id)), array('style' => 'margin-left:10px')); ?>
        </div>
</h3>

<div class="row">
    <div class="span8">
        <?php
        $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'placement' => 'left',
            'tabs' => array(
                array('id' => 'tab1' . $data->id, 'label' => 'Detail', 'content' => $this->renderPartial("_tabCandidateDetail", array("data" => $data), true), 'active' => true),
                array('id' => 'tab2' . $data->id, 'label' => 'Experience', 'content' => $this->renderPartial("_tabCandidateExperience", array("data" => $data), true)),
                array('id' => 'tab3' . $data->id, 'label' => 'Education', 'content' => $this->renderPartial("_tabCandidateEducation", array("data" => $data), true)),
            ),
        ));
        ?>

    </div>
</div>

