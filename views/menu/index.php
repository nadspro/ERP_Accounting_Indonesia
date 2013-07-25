<?php /*
  <?php $this->widget('ext.tooltipster.tooltipster'); ?>

  <a href="http://www.yiiframework.com" class="tooltipster" title="This is my link's tooltip message!">
  Link
  </a>

  <div class="tooltipster" title="This is my div's tooltip message!">
  <p>This div has a tooltip when you hover over it!</p>
  </div>
 */ ?>

<?php
//	$this->widget('ext.PNotify.PNotify',array( 
//		'message'=>'I am really a very simple notification')
//	);
?>

<div class="row">
    <div class="span8">
        <?php
        $this->renderPartial("_tabAnnouncement");

        $isExist = is_file(Yii::app()->basePath . "/modules/m1/models/gPerson.php");
        if ($isExist) {
            if (sUser::model()->getGroup() != 1100 || Yii::app()->user->name == "admin")
                $this->renderPartial("_tabNewEmployee");
        }

        echo $this->renderPartial("_tabMailbox", array("dataProvider" => $dataProviderInbox), true);

        $this->renderPartial("_tabCompanyDocuments");
        ?>
    </div>
    <div class="span4">
        <?php
        if (Yii::app()->user->name == "admin" || sUser::model()->rightCountM > 2 || !Yii::app()->user->checkAccess('HR ESS Staff'))
            $this->renderPartial("_notificationSystem");

        if (Yii::app()->user->name == "admin" || sUser::model()->rightCountM > 2 || !Yii::app()->user->checkAccess('HR ESS Staff'))
            $this->renderPartial("_reminderSystem");

        $this->renderPartial("_photoNews");

        //$this->widget('feedback');
        //sFeedback::model()->searchFilter();
        $this->renderPartial("_feedback");

        $this->renderPartial("_corporateCalendar");

        $this->renderPartial("/site/_category", array('category_id' => 3));

        $this->renderPartial("/site/_quote");
        ?>
    </div>
</div>

<?php
//Yii::app()->cache->flush();
//Yii::app()->user->checkAccess('Admin'))
//echo print_r(Yii::app()->modules);
?>

