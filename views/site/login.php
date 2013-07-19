<div class="row">
    <div class="span6">
        <?php
        $this->renderPartial("_carousel")
        ?>
        <?php
        $this->renderPartial("_fullArticle")
        ?>

    </div>
    <div class="row">
        <div class="span3">
            <?php $this->renderPartial("_latestNews") ?>
        </div>
        
		<div class="span3">
            <?php $this->renderPartial("_tabLogin", array("model" => $model)) ?>
        </div>
        
        <div class="row">
            <div class="span6">
                <?php
                $this->renderPartial("_quote")
                ?>

                <?php $this->renderPartial("_category", array('category_id' => 1)) ?>
                <?php //$this->renderPartial("_category",array('category_id'=>2)) ?>
                <?php $this->renderPartial("_category", array('category_id' => 3)) ?>

                <hr/>
                <div class="pull-right">
                    <p>
                        <strong><?php echo CHtml::link('News Index', Yii::app()->createUrl('/sCompanyNews')); ?></strong>				
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial("_tabSocNet", array()) ?>

