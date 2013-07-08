<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-reorder"></i> Probation</span>
        </li>
    </ul>
</div>


<?php
$criteria = new CDbCriteria;

//if (Yii::app()->user->name != "admin") {
$criteria1 = new CDbCriteria;
$criteria1->condition = '(select c.company_id from g_person_career c WHERE t.id=c.parent_id AND c.status_id IN (' . implode(",", Yii::app()->getModule("m1")->PARAM_COMPANY_ARRAY) . ')  ORDER BY c.start_date DESC LIMIT 1) IN (' . implode(",", sUser::model()->getGroupArray()) . ')';
$criteria->mergeWith($criteria1);
//}

$criteria->order = '(select start_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1)';

$criteria1 = new CDbCriteria;
$criteria1->condition = '(select status_id from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) IN(4,5)';

$criteria2 = new CDbCriteria;
$criteria2->condition = '(select end_date from g_person_status s where s.parent_id = t.id ORDER BY start_date DESC LIMIT 1) < DATE_ADD(CURDATE(),INTERVAL 60 DAY)';

$criteria->mergeWith($criteria1);
$criteria->mergeWith($criteria2);

$models = gPerson::model()->findAll($criteria);
?>

<?php foreach ($models as $data): ?>
    <div class="detail" style="margin-bottom:10px;">
        <div class="row">
            <div class="span1">
                <?php echo $data->gPersonPhoto; ?>
            </div>
            <div class="span2">
                <?php echo $data->gPersonLink; ?>
                <div style="font-size:10px;">
                    <?php echo (isset($data->company)) ? $data->company->department->name : ''; ?>
                    <br/>
                    <?php echo $data->mStatus(); ?>
                    <br/>
                    <?php echo $data->mStatusEndDate(); ?>
                    <?php echo ' (' . $data->countContract() . ')'; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

