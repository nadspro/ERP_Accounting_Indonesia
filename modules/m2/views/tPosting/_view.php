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
            echo CHtml::link($data->system_reff, array('view', 'id' => $data->id));
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
        $this->widget('bootstrap.widgets.TbDetailView', array(
            //$this->widget('ext.XDetailView', array(
            //		'ItemColumns' => 3,
            'data' => array(
                'id' => 1,
                'entity_id' => $data->entity->name,
                'input_date' => $data->input_date,
                'yearmonth_periode' => $data->yearmonth_periode,
                'user_ref' => $data->user_ref,
                'total' => Yii::app()->indoFormat->number($data->journalSum),
            ),
            'attributes' => array(
                array('name' => 'entity_id', 'label' => 'Entity'),
                array('name' => 'input_date', 'label' => 'Input Date'),
                array('name' => 'yearmonth_periode', 'label' => 'Periode'),
                array('name' => 'user_ref', 'label' => 'Rec\'er/Rec\'ed From', 'visible' => (isset($data->user_ref))),
                array('name' => 'total', 'label' => 'Total'),
            ),
        ));
        ?>
    </div>
</div>


<?php echo $this->renderPartial('/uJournal/_viewDetail', array('data' => $data)); ?>

<?php
$this->endWidget();
?>

</div>
