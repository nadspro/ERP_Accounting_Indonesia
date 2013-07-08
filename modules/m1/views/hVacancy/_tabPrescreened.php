<p>
    <?php
    echo CHtml::link('Export to Excel', Yii::app()->createUrl('/m1/hVacancy/toExcel', array("id" => $model->id, 'tab' => 'prescreened')), array('class' => 'btn btn-info'));
    ?>
</p>


<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => hVacancyApplicant::model()->search($model->id, 2),
    'template' => '{items}{pager}',
    'itemView' => '_tabList',
));
