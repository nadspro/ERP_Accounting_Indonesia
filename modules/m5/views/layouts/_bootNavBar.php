<?php
if (!Yii::app()->user->isGuest) {
    if (Yii::app()->user->name == 'admin') {
        $dependency = new CDbCacheDependency('SELECT max(updated_date) AS t  FROM s_module;');
    }
    else
        $dependency = new CDbCacheDependency('SELECT max(um.updated_date) AS t  FROM s_user_module um WHERE um.s_user_id =' . Yii::app()->user->id);


    if (!Yii::app()->cache->get('hierarchy1m5' . Yii::app()->user->id)) {
        if (Yii::app()->user->name == 'admin') {
            $Hierarchy = menu::model()->findAll(array('condition' => 'parent_id = \'0\' AND (name = \'m5\' OR name = \'m0\') ', 'order' => 'sort'));
        } else {

            $criteria = new CDbCriteria;
            $criteria->with = array('user');
            $criteria->compare('parent_id', 0);
            $criteria->compare('user.s_user_id', Yii::app()->user->id);
            $criteria->order = 't.sort';
            $criteria1 = new CDbCriteria;
            $criteria1->compare('name', 'm5', true, 'OR');
            $criteria1->compare('name', 'm0', true, 'OR');
            $criteria->mergeWith($criteria1);

            //$Hierarchy=menu::model()->findAllBySql('SELECT a.id FROM s_module a
            //		LEFT JOIN s_user_module b ON a.id = b.s_module_id
            //		WHERE a.parent_id = "0"
            //		AND b.s_user_id = '.Yii::app()->user->id .' order by sort');
            $Hierarchy = menu::model()->cache(3600, $dependency)->findAll($criteria);
        }
        Yii::app()->cache->set('hierarchy1m5' . Yii::app()->user->id, $Hierarchy, 86400, $dependency);
    }
    else
        $Hierarchy = Yii::app()->cache->get('hierarchy1m5' . Yii::app()->user->id);

    if (!Yii::app()->cache->get('hierarchy2m5' . Yii::app()->user->id)) {
        foreach ($Hierarchy as $Hierarchy) {
            $models = menu::model()->findByPk($Hierarchy->id);
            $items[] = $models->getListed();
        }
        Yii::app()->cache->set('hierarchy2m5' . Yii::app()->user->id, $items, 86400, $dependency);
    }
    else
        $items = Yii::app()->cache->get('hierarchy2m5' . Yii::app()->user->id);

    $this->widget('bootstrap.widgets.TbNavbar', array(
        //'fixed'=>true,
        'brand' => Yii::app()->name,
        //'brand'=>CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/FA-logo-APL-3-mini.jpg", Yii::app()->name, array("height"=>"100%",'id'=>'photo','padding'=>0)),
        'brandUrl' => Yii::app()->createUrl("menu"),
        'collapse' => true, // requires bootstrap-responsive.css
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => $items,
            ),
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    //array('label'=>Yii::app()->user->name, 'icon'=>'icon-th', 'url'=>'#', 'items'=>array(
                    array('label' => sUser::model()->getFullName(), 'icon' => 'icon-th', 'url' => '#', 'items' => array(
                            array('label' => 'Notification', 'icon' => 'bookmark', 'url' => Yii::app()->createUrl("sNotification")),
                            array('label' => 'Feedback', 'icon' => 'comment', 'url' => Yii::app()->createUrl("sFeedback")),
                            //array('label'=>'Help', 'icon'=>'question-sign','url'=>Yii::app()->createUrl("sAdmin/help")),
                            '---',
                            array('label' => sUser::model()->getGroupName(), 'icon' => 'list', 'url' => Yii::app()->createUrl('/aOrganization/viewSelf', array('id' => sUser::model()->getGroup()))),
                            array('label' => 'My Profile', 'icon' => 'user', 'url' => Yii::app()->createUrl('/sUser/viewSelf', array('id' => Yii::app()->user->id))),
                            array('label' => 'Change Password', 'icon' => 'barcode', 'url' => Yii::app()->createUrl('/sUser/updatePasswordAuthenticated', array('id' => Yii::app()->user->id))),
                            '---',
                            array('label' => 'Photo Gallery', 'icon' => 'picture', 'url' => Yii::app()->createUrl('/site/photo')),
                            array('label' => 'Company News', 'icon' => 'share', 'url' => Yii::app()->createUrl('/sCompanyNews')),
                            array('label' => 'MailBox', 'icon' => 'envelope', 'url' => Yii::app()->createUrl('/mailbox')),
                            '---',
                            array('label' => 'Log Out', 'icon' => 'off', 'url' => Yii::app()->createUrl("site/logout")),
                        )),
                ),
            ),
        ),
    ));
} else {
    ?>

    <div class="row">
        <div class="span4">
            <?php echo CHtml::image(Yii::app()->request->baseUrl . "/shareimages/company/logo.jpg", Yii::app()->name, array("height" => "100%", 'id' => 'photo', 'style' => 'padding:0')); ?>
        </div>

        <div class="span8">
            <div class="pull-right">
                <?php
                $this->widget('bootstrap.widgets.TbMenu', array(
                    'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
                    'stacked' => false, // whether this is a stacked menu
                    'items' => array(
                        array('label' => 'Home', 'url' => Yii::app()->createUrl('/site/login')),
                        array('label' => 'Photo', 'url' => Yii::app()->createUrl('/site/photo')),
                        array('label' => 'Learning', 'url' => Yii::app()->createUrl('/site/learning')),
                        array('label' => 'Career', 'url' => (Yii::app()->params['webcareer']), 'linkOptions' => array('target' => '_blank', 'style' => 'background-color:#ddeeee')),
                    ),
                ));
                ?>
            </div>
        </div>
    </div>

    <div style="margin-top:-20px">
        <hr/>
    </div>

    <?php
}
?>
