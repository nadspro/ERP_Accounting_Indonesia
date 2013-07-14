<table class="appendo-gii" id="<?php echo $id ?>" width="50%">
    <thead>
        <tr>
            <th>Field</th>
            <th>Group By</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($model->field == null): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('field[]', '', gBiPerson::getListField()); ?>
                </td>
                <td><?php
                    echo CHtml::dropDownList('group[]', '', array(
                        '' => null,
                            //'GROUP BY'=>'GROUP BY',
                            //'SUM'=>'SUM',
                            //'COUNT'=>'COUNT',
                            //'MAX'=>'MAX',
                            //'MIN'=>'MIN',
                            //'AVERAGE'=>'AVERAGE',
                    ));
                    ?>
                </td>
            </tr>
        <?php else: ?>
            <?php for ($i = 0; $i < sizeof($model->field); ++$i): ?>
                <tr>
                    <td><?php echo CHtml::dropDownList('field[]', $model->field[$i], gBiPerson::getListField()); ?>
                    </td>
                    <td><?php
                        echo CHtml::dropDownList('group[]', $model->group[$i], array(
                            '' => null,
                                //'GROUP BY'=>'GROUP BY',
                                //'SUM'=>'SUM',
                                //'COUNT'=>'COUNT',
                                //'MAX'=>'MAX',
                                //'MIN'=>'MIN',
                                //'AVERAGE'=>'AVERAGE',
                        ));
                        ?>
                    </td>
                    </td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>
