<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-camera"></i><?php echo Yii::t('basic', ' Photo News') ?></span>
        </li>
    </ul>
</div>

<div>

    <?php
    $this->widget('ext.albumPhoto', array('dir' => Yii::app()->basePath . "/../shareimages/photo/",
        'columns' => 2,
        'span' => 2,
        'limit' => 6,
        'header' => 5,
        'showDescription' => false
    ));
    ?>

</div>

