<?php

/**
 * This is the model class for table "v_sorder".
 *
 * The followings are the available columns in table 'v_sorder':
 * @property integer $id
 * @property integer $organization_id
 * @property string $input_date
 * @property string $system_ref
 * @property integer $periode_date
 * @property integer $po_type_id
 * @property integer $approved_date
 * @property string $remark
 * @property integer $payment_state_id
 * @property integer $created_date
 * @property string $created_by
 * @property integer $updated_date
 * @property string $updated_by
 */
class vSorder extends BaseModel {

    public $item_id;
    public $item_name;
    public $budget_id;
    public $description;
    public $qty;
    public $amount;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'v_sorder';
    }

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('input_date', 'required'),
            array('item_id, budget_id, qty, amount, organization_id, periode_date, so_type_id, budgetcomp_id, supplier_id, approved_date, payment_state_id, journal_state_id, created_date, updated_date, total_amount', 'numerical', 'integerOnly' => true),
            array('system_ref, item_name, description', 'length', 'max' => 100),
            array('created_by, updated_by', 'length', 'max' => 15),
            array('remark, payment_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, organization_id, input_date, system_ref, periode_date, so_type_id, approved_date, remark, payment_state_id, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'sum_so' => array(self::STAT, 'vSorderDetail', 'parent_id', 'select' => 'sum(qty*amount)'),
            'so_detail' => array(self::HAS_MANY, 'vSorderDetail', 'parent_id'),
            'so_detail_group' => array(self::HAS_MANY, 'vSorderDetail', 'parent_id', 'group' => 'item_id,department_id', 'select' => '*,sum(so_detail_group.amount) as sub_total'),
            //'s_type' => array(self::BELONGS_TO, 'ABudget', 's0_type_id'),
            'organization' => array(self::BELONGS_TO, 'aOrganization', 'organization_id'),
            'budgetcomp' => array(self::BELONGS_TO, 'tAccount', 'budgetcomp_id'),
            'customer' => array(self::BELONGS_TO, 'uCustomer', 'customer_id'),
            'payment_state' => array(self::BELONGS_TO, 'sParameter', array('payment_state_id' => 'code'), 'condition' => 'type = \'cPayment\''),
            'journal_state' => array(self::BELONGS_TO, 'sParameter', array('journal_state_id' => 'code'), 'condition' => 'type = \'cJournalState\''),
            'so_type' => array(self::BELONGS_TO, 'sParameter', array('so_type_id' => 'code'), 'condition' => 'type = \'cPOtype\''),
            'payment' => array(self::STAT, 'vSorderPayment', 'parent_id', 'select' => 'sum(amount)'),
            'so_ext' => array(self::HAS_ONE, 'vSorderExt', 'id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'organization_id' => 'Organization',
            'customer_id' => 'Customer',
            'budgetcomp_id' => 'Budget Comp',
            'input_date' => 'Input Date',
            'system_ref' => 'System Ref',
            'periode_date' => 'Periode Date',
            'so_type_id' => 'SO Type',
            'approved_date' => 'Approved Date',
            'remark' => 'Remark',
            'payment_state_id' => 'Payment State',
            'journal_state_id' => 'Journal State',
            'total_amount' => 'Total Amount',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        );
    }

    public function searchAP($id = 0) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        if ($id == 1) {
            $criteria->condition = 'approved_date is null';
        } elseif ($id == 2) {
            $criteria->condition = 'approved_date is not null AND payment_state_id = 1';
        } elseif ($id == 3)
            $criteria->condition = 'approved_date is not null AND payment_state_id = 2';

        $criteria->order = 'id DESC';

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('organization_id', SUser::model()->getGroupArray());
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30
            )
        ));
    }

    public function search($id = 0) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        if ($id == 1) {
            $criteria->condition = 'approved_date is null';
        } elseif ($id == 2) {
            $criteria->condition = 'approved_date is not null AND payment_state_id = 1';
        } elseif ($id == 3)
            $criteria->condition = 'approved_date is not null AND payment_state_id = 2';

        $criteria->compare('so_type_id', 1);

        $criteria->order = 'id DESC';

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('organization_id', SUser::model()->getGroupArray());
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30
            )
        ));
    }

    public function searchCustomer($id) {
        $criteria = new CDbCriteria;
        $criteria->compare('customer_id', $id);

        $criteria->order = 'input_date DESC';

        if (Yii::app()->user->name != "admin") {
            $criteria->addInCondition('organization_id', SUser::model()->getGroupArray());
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 30
            )
        ));
    }

    public function approvalForm($id = 0, $cid = null) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        if ($id == 1) {
            $criteria->condition = 'approved_date is null';
        } elseif ($id == 2)
            $criteria->condition = 'approved_date is not null AND payment_state_id = 1';

        $criteria->compare('payment_state_id', 1);
        $criteria->compare('so_type_id', $cid);
        $criteria->compare('system_ref', $this->system_ref, true);
        $criteria->order = 'periode_date DESC, system_ref DESC';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
    }

    public function piutangPerCustomer($id) {
        $models = self::findAll(array(
                    'condition' => 'customer_id = :id',
                    'params' => array(':id' => $id),
        ));

        $_total = 0;
        foreach ($models as $model) {
            $_total = $_total + $model->sum_so();
        }

        return Yii::app()->numberFormatter->format("#,##0.00", $_total);
    }

    public function paymentPerCustomer($id) {
        $models = self::findAll(array(
                    'condition' => 'supplier_id = :id',
                    'params' => array(':id' => $id),
        ));

        $_total = 0;
        foreach ($models as $model) {
            $_total = $_total + $model->payment();
        }

        return Yii::app()->numberFormatter->format("#,##0.00", $_total);
    }

    public function balancePerCustomer($id) {
        $models = self::findAll(array(
                    'condition' => 'supplier_id = :id',
                    'params' => array(':id' => $id),
        ));

        $_totalh = 0;
        $_totalp = 0;
        foreach ($models as $model) {
            $_totalh = $_totalh + $model->sum_so();
        }

        foreach ($models as $model) {
            $_totalp = $_totalp + $model->payment();
        }

        $_total = $_totalh - $_totalp;

        return Yii::app()->numberFormatter->format("#,##0.00", $_total);
    }

    public function paymentCheck() {
        if (!isset($this->approved_date)) {
            $_state = "UnApproved";
        } elseif ($this->payment == 0) {
            $_state = "Unpaid";
        } elseif ($this->payment >= $this->sum_so) {
            $_state = "Paid";
        }
        else
            $_state = "Partial Paid";

        return $_state;
    }

    public static function getTopCreated($id = null) {  //1=PO Inventory, 2=PO General
        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'created_date DESC';
        $criteria->compare('so_type_id', $id);

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $_system_ref = (strlen($model->system_ref) > 15) ? substr($model->system_ref, 0, 15) . "..." : $model->system_ref;

            $returnarray[] = array('id' => $model->system_ref, 'label' => $_system_ref, 'icon' => 'list-alt', 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public static function getTopUpdated($id = null) {  //1=PO Inventory, 2=PO General
        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';
        $criteria->compare('so_type_id', $id);

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $_system_ref = (strlen($model->system_ref) > 15) ? substr($model->system_ref, 0, 15) . "..." : $model->system_ref;

            $returnarray[] = array('id' => $model->system_ref, 'label' => $_system_ref, 'icon' => 'list-alt', 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public static function getTopUnApprovedPO() {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'created_date DESC';
        $criteria->condition = 'approved_date is null';

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $_system_ref = (strlen($model->system_ref) > 15) ? substr($model->system_ref, 0, 15) . "..." : $model->system_ref;

            $returnarray[] = array('id' => $model->system_ref, 'label' => $_system_ref, 'icon' => 'list-alt', 'url' => array('/m2/mAccpayable/view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public static function getTopUnPaidPO() {

        $criteria = new CDbCriteria;
        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';
        $criteria->condition = 'approved_date is not null AND payment_state_id = 1';

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $_system_ref = (strlen($model->system_ref) > 15) ? substr($model->system_ref, 0, 15) . "..." : $model->system_ref;

            $returnarray[] = array('id' => $model->system_ref, 'label' => $_system_ref, 'icon' => 'list-alt', 'url' => array('/m2/mAccpayable/view', 'id' => $model->id));
        }

        return $returnarray;
    }

    public static function getTopRelated($name) {

        //$_related = self::model()->find((int)$id)->account_name;
        $_exp = explode(" ", $name);


        $criteria = new CDbCriteria;
        //$criteria->compare('account_name',$_related,true,'OR');

        if (isset($_exp[0]))
            $criteria->compare('user_ref', $_exp[0], true, 'OR');

        if (isset($_exp[1]))
            $criteria->compare('user_ref', $_exp[1], true, 'OR');

        $criteria->limit = 10;
        $criteria->order = 'updated_date DESC';

        $models = self::model()->findAll($criteria);

        $returnarray = array();

        foreach ($models as $model) {
            $returnarray[] = array('id' => $model->account_name, 'label' => $model->account_no . " " . $model->account_name, 'url' => array('view', 'id' => $model->id));
        }

        return $returnarray;
    }

    protected function afterDelete() {
        parent::afterDelete();
        vSorderDetail::model()->deleteAll(array(
            'condition' => 'parent_id= :id',
            'params' => array(':id' => $this->id),
        ));
    }

}