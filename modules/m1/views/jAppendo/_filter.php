<table class="appendo-gii" id="<?php echo $id ?>">
    <thead>
        <tr>
            <th>Field</th>
            <th>Operator</th>
            <th>Value</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($model->field == null): ?>
            <tr>
                <td><?php echo CHtml::dropDownList('fieldfilter[]', '', gBiPerson::getListField('Fill')); ?></td>
                <td><?php
                    echo CHtml::dropDownList('expression[]', '', array(
                        '' => null,
                        '=' => '=',
                        '<>' => '<>',
                        '>' => '>',
                        '>=' => '>=',
                        '<' => '<',
                        '<=' => '<=',
                        'LIKE' => 'LIKE',
                        'IN' => 'IN',
                    ));
                    ?>
                </td>
                <td><?php echo CHtml::textField('value[]', ''); ?></td>
            </tr>
        <?php else: ?>
            <?php for ($i = 0; $i < sizeof($model->fieldfilter); ++$i): ?>
                <tr>
                    <td><?php echo CHtml::dropDownList('fieldfilter[]', $model->fieldfilter[$i], gBiPerson::getListField('Fill')); ?></td>
                    <td><?php
                        echo CHtml::dropDownList('expression[]', $model->expression[$i], array(
                            '' => null,
                            '=' => '=',
                            '<>' => '<>',
                            '>' => '>',
                            '>=' => '>=',
                            '<' => '<',
                            '<=' => '<=',
                            'LIKE' => 'LIKE',
                            'IN' => 'IN',
                        ));
                        ?>
                    </td>
                    <td><?php echo CHtml::textField('value[]', $model->value[$i]); ?></td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>
