<?php if ($data->many_experienceC != 0) { ?>
    <?php
    foreach ($data->many_experience as $exp) {
        echo CHtml::tag('li', array(), $exp->company_name . ", " . $exp->industries . ", " . $exp->start_date . " - " . $exp->end_date
                . ", " . $exp->job_title);
    }
    ?>
    <br/>
<?php } ?>

