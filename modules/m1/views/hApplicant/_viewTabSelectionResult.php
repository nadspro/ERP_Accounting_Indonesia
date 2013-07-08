<?php if ($data->selectionC != 0) { ?>
    <?php
    foreach ($data->selection_many as $sel) {
        echo CHtml::tag('li', array(), $sel->assestment_date . ", " . $sel->workflow_result_id . ", " . $sel->assestment_summary . " - "
                . $sel->development_area);
    }
    ?>
    <br/>
<?php } ?>

