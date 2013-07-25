<?php
Yii::app()->clientScript->registerScript('myCap'.$data->id, "

		$('#myCap$data->id').click(function(){
		$(this).slideUp();
		$.ajax({
		type : 'get',
		url  : $(this).attr('href'),
		data: '',
		success : function(r){
		$('#list-$data->id').slideUp('slow');
}
})
		return false;
});


		");

?>


<div id="list-<?php echo $data->id; ?>">

<?php
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => false,
    'headerIcon' => 'icon-globe',
    'htmlHeaderOptions' => array('style' => 'background:white'),
        //'htmlContentOptions'=>array('style'=>'background:#FFA573'),
));
?>



<div class="row-fluid">
    <div class="span5">
        <h3>
            <?php
            echo $data->system_reff;
            ?>
        </h3>
        <p>
            <?php
				if ($data->state_id ==1 || $data->state_id ==2) {
					$this->widget('zii.widgets.jui.CJuiButton', array(
							'buttonType'=>'link',
							'id'=>'myCap'.$data->id,
							'name'=>'btnGo'.$data->id,
							'url'=>Yii::app()->createUrl("/m2/tPosting/posting",array("id"=>$data->id)),
							'caption'=>($data->state_id == 1) ? 'Post' : 'Re-Post',
							'options'=>array(
									//'icons'=>'js:{secondary:"ui-icon-extlink"}',
							),
							'htmlOptions'=>array(
									'class'=>'ui-button-primary',
							),

					));
				} elseif ($data->state_id == 4) {
					$this->widget('zii.widgets.jui.CJuiButton', array(
							'buttonType'=>'link',
							'id'=>'myCap'.$data->id,
							'name'=>'btnGo'.$data->id,
							'url'=>Yii::app()->createUrl("/m2/tPosting/unposting",array("id"=>$data->id)),
							'caption'=>'Un-Post',
							'options'=>array(
									//'icons'=>'js:{secondary:"ui-icon-extlink"}',
							),
							'htmlOptions'=>array(
									'class'=>'ui-button-primary',
							),

					));
				} else {
					$this->widget('zii.widgets.jui.CJuiButton', array(
							'buttonType'=>'link',
							'id'=>'myCap'.$data->id,
							'name'=>'btnGo'.$data->id,
							'url'=>Yii::app()->createUrl("/m2/tPosting/unlock",array("id"=>$data->id)),
							'caption'=>'Un-Lock',
							'options'=>array(
									//'icons'=>'js:{secondary:"ui-icon-extlink"}',
							),

					));
				}
				
            echo ($data->journalSum != $data->journalSumCek) ? " WARNING!!!... FAULT BY SYSTEM. JOURNAL IS NOT BALANCE, PLEASE DELETE.." : "";
            ?>
        </p>


        <?php if ($data->remark != null) { ?>
            <p>
                <?php echo CHtml::encode($data->remark); ?>
            </p>
        <?php }; ?>
    </div>

    <div class="span7">
        <?php
	        $this->renderPartial('/tJournal/_viewJournalInfo',array('data'=>$data));
        ?>
    </div>
</div>


<?php echo $this->renderPartial('/tJournal/_viewDetail', array('data' => $data)); ?>

<?php
$this->endWidget();
?>

</div>
