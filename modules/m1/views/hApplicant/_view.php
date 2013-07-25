<?php
/* @var $this HApplicantController */
/* @var $data hApplicant */
?>

<div style="<? echo ($data->company_id != 0) ? "background-color:#D5D5D5;padding:10px;margin-bottom:10px;" : "background-color:white"; ?>" >
    <h4>
        <?php
        echo CHtml::link(CHtml::encode($data->applicant_name), Yii::app()->createUrl(
                        '/m1/hApplicant/view', array('id' => $data->id)));
        if ($data->vacancyLocked != 0)
            echo " [LOCKED]";
        echo ($data->company_id != 0) ? " [Not Shared]" : "";
        ?>	
    </h4>
</div>


<div class="row">
    <div class="span2">
        <?php echo $data->photoPath; ?>
        <?php echo CHtml::tag('div', array('class' => 'pull-right', 'style' => 'color:#cbcbcb;text-size:10px'), waktu::nicetime($data->created_date)); ?>

    </div>
    <div class="span7">
        <p>
            <?php
            $expC = ($data->many_experienceC != 0) ? " (" . $data->many_experienceC . ")" : "";
            $appliedC = ($data->vacancyC != 0) ? " (" . $data->vacancyC . ")" : "";
            $commentC = ($data->commentC != 0) ? " (" . $data->commentC . ")" : "";
            $selC = ($data->selectionC != 0) ? " (" . $data->selectionC . ")" : "";
            $this->widget('bootstrap.widgets.TbTabs', array(
                'type' => 'tabs', // 'tabs' or 'pills'
                'id' => 'tabs' . $data->id,
                'tabs' => array(
                    array('id' => 'tab1' . $data->id, 'label' => 'Experience' . $expC, 'content' => $this->renderPartial("_viewTabExperience", array("data" => $data), true), 'active' => true),
                    array('id' => 'tab2' . $data->id, 'label' => 'Applied On' . $appliedC, 'content' => $this->renderPartial("_viewTabApplied", array("data" => $data), true)),
                    array('id' => 'tab3' . $data->id, 'label' => 'Comment' . $commentC, 'content' => $this->renderPartial("_viewTabComment", array("data" => $data), true)),
                    array('id' => 'tab4' . $data->id, 'label' => 'Selection Schedule' . $selC, 'content' => $this->renderPartial("_viewTabSelectionSchedule", array("data" => $data), true)),
                    array('id' => 'tab5' . $data->id, 'label' => 'Selection Result' . $selC, 'content' => $this->renderPartial("_viewTabSelectionResult", array("data" => $data), true)),
                ),
            ));
            ?>

            <?php echo CHtml::encode($data->address1); ?><br/>

            <b><?php echo CHtml::encode($data->getAttributeLabel('birth_place')); ?>:</b>
            <?php echo CHtml::encode($data->birth_place); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('birth_date')); ?>:</b>
            <?php echo CHtml::encode($data->birth_date); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('sex_id')); ?>:</b>
            <?php echo CHtml::encode($data->sex->name); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('religion_id')); ?>:</b>
            <?php echo (isset($data->religion)) ? $data->religion->name : ''; ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('handphone')); ?>:</b>
            <?php echo CHtml::encode($data->handphone); ?> |

            <b><?php echo CHtml::encode($data->getAttributeLabel('freshgrad_id')); ?>:</b>
            <?php echo CHtml::encode($data->freshgrad); ?>
        </p>
    </div>
</div>

<hr/>
