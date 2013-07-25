        <?php
        $this->widget('bootstrap.widgets.TbDetailView', array(
            //$this->widget('ext.XDetailView', array(
            //		'ItemColumns' => 3,
            'data' => array(
                'id' => 1,
                'entity_id' => $data->entity->name,
                'input_date' => $data->input_date,
                'yearmonth_periode' => $data->yearmonth_periode,
                'module' => $data->module->name,
                'user_ref' => $data->user_ref,
                'total' => Yii::app()->indoFormat->number($data->journalSum),
                'cb_custom1' => $data->cb_custom1,
            ),
            'attributes' => array(
                array('name' => 'entity_id', 'label' => 'Entity'),
                array('name' => 'input_date', 'label' => 'Input Date'),
                array('name' => 'yearmonth_periode', 'label' => 'Periode'),
                array('name' => 'module', 'label' => 'Module'),
                array('name' => 'cb_custom1', 'label' => 'Receiver', 'visible' => ($data->journal_type_id ==1)),
                array('name' => 'cb_custom1', 'label' => 'Received From', 'visible' => ($data->journal_type_id ==2)),
                array('name' => 'total', 'label' => 'Total'),
            ),
        ));
        ?>
