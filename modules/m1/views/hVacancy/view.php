<?php
/* @var $this GVacancyController */
/* @var $model gVacancy */

$this->breadcrumbs = array(
    'G Vacancies' => array('index'),
    $model->id,
);


Yii::app()->clientScript->registerScript('campaign', "
$('.campaign-button').click(function(){
	$('.campaign-block').toggle('slow');
	return false;
});
$('.detail-link').click(function(){
	$('.detail-block').toggle('slow');
	return false;
});

");


$this->menu7 = hVacancy::model()->getTopRecentVacancy();

$this->menu = array(
    array('label' => 'Vacancy', 'icon' => 'home', 'url' => array('/m1/hVacancy')),
    array('label' => 'Applicant', 'icon' => 'user', 'url' => array('/m1/hApplicant')),
    array('label' => 'Selection Registration', 'icon' => 'tint', 'url' => array('/m1/jSelection')),
    array('label' => 'Interview', 'icon' => 'volume-up', 'url' => array('/m1/hVacancy/interview')),
    array('label' => 'Update', 'icon' => 'edit', 'url' => array('/m1/hVacancy/update', 'id' => $model->id)),
        //array('label'=>'Broadcast', 'icon'=>'envelope', 'url'=>array('/m1/hVacancy/broadcast','id'=>$model->id)),
);
$this->menu4 = hVacancyApplicant::model()->getTopRecentInterview();
$this->menu8 = hApplicant::model()->getTopRecentApplicant();
?>

<div class="page-header">
    <h1>
        <i class="icon-fa-paper-clip"></i>
<?php
echo $model->vacancy_title;
?>

    </h1>
</div>

<?php
$this->renderPartial('_tabCampaign', array('model' => $model));
?>


<?php echo CHtml::link('Show/Hide Detail', '#', array('class' => 'detail-link pull-right')); ?>
<p>
<?php echo CHtml::link('Show/Hide New Campaign', '#', array('class' => 'campaign-button btn btn-mini')); ?>

<div class="campaign-block" style="display:none">
<?php
$this->renderPartial('_formCampaign', array('model' => $modelCampaign));
?>	
</div>

</p>


<div class="detail-block" style="display:none">
    <p>
<?php echo $model->vacancy_desc; ?>

        <?php
        //$this->widget('ext.expander.Expander',array(
        //  'content'=>$model->vacancy_desc,
        //  'config'=>array('slicePoint'=>50, 'expandText'=>'read more', 'userCollapseText'=>'read less', 'preserveWords'=>false)
        //)); 
        ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('company_id')); ?>:</b>
        <?php echo CHtml::encode($model->company->name); ?>
        <br />


    <div style="font-size:11px">
        <b><?php echo CHtml::encode($model->getAttributeLabel('industry_tag')); ?>:</b>
        <?php echo CHtml::encode($model->industry_tag); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('for_level')); ?>:</b>
        <?php echo CHtml::encode($model->for_level); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('city')); ?>:</b>
        <?php echo CHtml::encode($model->city); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_working_exp')); ?>:</b>
        <?php echo CHtml::encode($model->min_working_exp); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_education_level')); ?>:</b>
        <?php echo CHtml::encode($model->edulevel->name); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('min_gpa')); ?>:</b>
        <?php echo CHtml::encode($model->min_gpa); ?>
        <br />

        <b><?php echo "Salary (Rp)"; ?>:</b>
        <?php echo number_format($model->min_salary, 0, ',', '.') . " - " . number_format($model->max_salary, 0, ',', '.'); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('salary_hide')); ?>:</b>
        <?php echo ($model->salary_hide) ? "Yes" : "No"; ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('work_address')); ?>:</b>
        <?php echo CHtml::encode($model->work_address); ?> |

        <b><?php echo CHtml::encode($model->getAttributeLabel('specification_tag')); ?>:</b>
        <?php echo CHtml::encode($model->specification_tag); ?> |

        <?php //echo nl2br($model->skill_required);  ?>
        <br />
    </div>

</p>
</div>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs', // 'tabs' or 'pills'
    'tabs' => array(
        array('id' => 'tab1', 'label' => 'Unprocessed  (' . $model->screened(1) . ')', 'content' => $this->renderPartial("_tabUnscreened", array("model" => $model), true), 'active' => true),
        array('id' => 'tab2', 'label' => 'Pre Screened (' . $model->screened(2) . ')', 'content' => $this->renderPartial("_tabPrescreened", array("model" => $model), true)),
        array('id' => 'tab3', 'label' => 'Candidate Pool (' . $model->screened(3) . ')', 'content' => $this->renderPartial("_tabKeep", array("model" => $model), true)),
        array('id' => 'tab4', 'label' => 'INTERVIEW (' . $model->screened(4) . ')', 'content' => $this->renderPartial("_tabInterview", array("model" => $model), true)),
        array('id' => 'tab5', 'label' => 'Rejected (' . $model->screened(5) . ')', 'content' => $this->renderPartial("_tabRejected", array("model" => $model), true)),
        array('id' => 'tab10', 'label' => 'Other', 'items' => array(
                array('id' => 'tab6', 'label' => 'BlackListed (' . $model->screened(6) . ')', 'content' => $this->renderPartial("_tabBlacklisted", array("model" => $model), true)),
                array('id' => 'tab7', 'label' => 'Hired (' . $model->screened(7) . ')', 'content' => $this->renderPartial("_tabHired", array("model" => $model), true)),
                array('id' => 'tab8', 'label' => 'Other (' . $model->screened(8) . ')', 'content' => $this->renderPartial("_tabOther", array("model" => $model), true)),
                array('id' => 'tab8', 'label' => 'Withdraw (' . $model->screened(9) . ')', 'content' => $this->renderPartial("_tabWithdraw", array("model" => $model), true)),
            )),
    //array('id'=>'tab9','label'=>'Job Info','content'=>$this->renderPartial("_tabDetail", array("model"=>$model), true)),
    ),
));
?>

<div id="detail">
    <?php
    if (isset($modelApplicant)) {
        $this->renderPartial('_detailApplicant', array(
            'modelApplicant' => $modelApplicant,
        ));
    }
    ?>
</div>