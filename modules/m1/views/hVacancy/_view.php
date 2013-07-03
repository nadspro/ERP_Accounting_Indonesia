<?php
/* @var $this GVacancyController */
/* @var $data gVacancy */
?>

<div class="row">
<div class="span6">

	<?php echo CHtml::tag('div',array('class'=>'pull-right','style'=>'color:#cbcbcb;text-size:10px'),waktu::nicetime($data->created_date)); ?>
	
	<h3><?php
			echo CHtml::link(CHtml::encode($data->vacancy_title),
			Yii::app()->createUrl('/m1/hVacancy/view',array('id'=>$data->id))); 
	?>
	</h3>	
	
	<p><?php echo $data->vacancy_desc; ?></p>

	<div style="border-color:#cbcbcb;border-style:solid; border-width:1px; padding:2px 4px; margin:5px 0" id="c<?php echo $data->id ?>" >
		<strong>Applicant List:</strong>
		<?php 
			foreach ($data->applicantMany as $list) {
				echo CHtml::link($list->applicant_name,Yii::app()->createUrl('/m1/hApplicant/view',array('id'=>$list->id)),array('target'=>'_blank'));
				echo " | ";
			}
		?>
	</div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company->name); ?>


	<?php //$this->widget('ext.expander.Expander',array(
          //  'content'=>$data->vacancy_desc,
          //  'config'=>array('slicePoint'=>50, 'expandText'=>'read more', 'userCollapseText'=>'read less', 'preserveWords'=>false)
        //)); 
    ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry_tag')); ?>:</b>
	<?php echo CHtml::encode($data->industry_tag); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_level')); ?>:</b>
	<?php echo CHtml::encode($data->for_level); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('specification_tag')); ?>:</b>
	<?php echo CHtml::encode($data->specification_tag); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('work_address')); ?>:</b>
	<?php echo CHtml::encode($data->work_address); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
	<?php echo CHtml::encode($data->city); ?> |

	<b><?php echo "Salary (Rp)"; ?>:</b>
	<?php echo number_format($data->min_salary,0,',','.')." - ".number_format($data->max_salary,0,',','.'); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('salary_hide')); ?>:</b>
	<?php echo ($data->salary_hide) ?"Yes" : "No"; ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_working_exp')); ?>:</b>
	<?php echo CHtml::encode($data->min_working_exp); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_education_level')); ?>:</b>
	<?php echo CHtml::encode($data->edulevel->name); ?> |

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_gpa')); ?>:</b>
	<?php echo CHtml::encode($data->min_gpa); ?>
	<br />

	<p>
		<b><?php echo CHtml::encode($data->getAttributeLabel('skill_required')); ?>:</b>

		<?php echo $data->skill_required; ?>
	</p>

		
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('promotion_content')); ?>:</b>
	<?php echo CHtml::encode($data->promotion_content); ?>
	<br />
	*/ ?>

</div>
</div>

