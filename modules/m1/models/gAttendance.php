<?php

/**
 * This is the model class for table "c_personalia_absence".
 *
 * The followings are the available columns in table 'c_personalia_absence':
 * @property string $id
 * @property string $parent_id
 * @property string $cdate
 * @property integer $realpattern_id
 * @property integer $daystatus1_id
 * @property string $in
 * @property string $out
 */
class gAttendance extends BaseModel {

    /**
     * Returns the static model of the specified AR class.
     * @return cPersonaliaAbsence the static model class
     */
    public $lateIn;
    public $earlyOut;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'g_attendance';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cdate', 'required'),
            array('cdate', 'date', 'format' => 'dd-MM-yyyy'),
            //array('cdate, parent_id', 'ext.EUniqueIndexValidator'),
            array('realpattern_id, daystatus1_id,daystatus2_id,daystatus3_id, overtime_in, overtime_out', 'numerical', 'integerOnly' => true),
            array('parent_id', 'length', 'max' => 11),
            array('remark', 'length', 'max' => 150),
            array('cdate, in, out', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, parent_id, cdate, realpattern_id, daystatus1_id, in, out', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'realpattern' => array(self::BELONGS_TO, 'gParamTimeblock', 'realpattern_id'),
            'person' => array(self::BELONGS_TO, 'gPerson', 'parent_id'),
            'permission1' => array(self::BELONGS_TO, 'gParamPermission', 'daystatus1_id'),
            'permission2' => array(self::BELONGS_TO, 'gParamPermission', 'daystatus2_id'),
            'permission3' => array(self::BELONGS_TO, 'gParamPermission', 'daystatus3_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Parent',
            'cdate' => 'Date',
            'realpattern_id' => 'Real Pattern',
            'daystatus1_id' => 'Day Status 1',
            'daystatus2_id' => 'Day Status 2',
            'daystatus3_id' => 'Day Status 3',
            'in' => 'In',
            'out' => 'Out',
            'remark' => 'Remark',
            'overtime_in' => 'Overtime In',
            'overtime_out' => 'Overtime Out',
        );
    }

    public function search($id, $month) {
        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            //'pagination'=>array(
            //		'pageSize'=>31,
            //),
            'pagination' => false,
        ));
    }

    public function searchOvertime($id, $month) {

        $criteria = new CDbCriteria;

        $criteria->compare('parent_id', $id);
        $criteria->addBetweenCondition('cdate', date("Y-m-d", strtotime(date("Y-m", strtotime($month . " month")) . "-01")), date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m", strtotime($month + 1 . " month")) . "-01"))));
        //$criteria->compare('realpattern_id',$this->realpattern_id);

        $criteria->order = 'cdate';
        $criteria->with = 'realpattern';

        $criteria1 = new CDbCriteria;
        $criteria1->compare('daystatus3_id', 400, false, 'OR');
        $criteria1->compare('daystatus3_id', 500, false, 'OR');
        $criteria1->compare('daystatus3_id', 600, false, 'OR');
        $criteria->mergeWith($criteria1);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 31,
            ),
        ));
    }

    public function getLateInStatus() {
        if (isset($this->in) && peterFunc::isTimeMore($this->in, $this->realpattern->in)) {
            $_val = "Late In";
        }
        else
            $_val = "";

        return $_val;
    }

    public function getEarlyOutStatus() {
        if (isset($this->out) && peterFunc::isTimeMore($this->realpattern->out, $this->out)) {
            $_val = "Early Out";
        }
        else
            $_val = "";

        return $_val;
    }

    public function getActualIn() {
        if (isset($this->in)) {
            $_val = peterFunc::toTime($this->in);
        } elseif ($this->realpattern_id != 90) {
            $_val = "??:??";
        }
        else
            $_val = "";

        return $_val;
    }

    public function getActualOut() {
        if (isset($this->out)) {
            $_val = peterFunc::toTime($this->out);
        } elseif ($this->realpattern_id != 90) {
            $_val = "??:??";
        }
        else
            $_val = "";

        return $_val;
    }

    public function getDiffIn() {
        if (peterFunc::isTimeMore($this->in, $this->realpattern->in)) {
            $_val = peterFunc::countTimeDiff($this->in, $this->realpattern->in);
        }
        else
            $_val = "";

        return $_val;
    }

    public function getDiffOut() {
        if (peterFunc::isTimeMore($this->realpattern->out, $this->out)) {
            $_val = peterFunc::countTimeDiff($this->realpattern->out, $this->out);
        }
        else
            $_val = "";

        return $_val;
    }

    public function getOvertimeIn() {
        if ($this->daystatus3_id == 500 || $this->daystatus3_id == 600) {
            $_val = peterFunc::countTimeDiff($this->realpattern->in, $this->in);
        }
        else
            $_val = "";

        return $_val;
    }

    public function getOvertimeOut() {
        if ($this->daystatus3_id == 400) {
            $_val = peterFunc::countTimeDiff($this->out, $this->realpattern->out);
        }
        else
            $_val = "";

        return $_val;
    }

    public function getOkName() {
        if ($this->daystatus3_id == 100) {
            $_val = "CONFIRM";
        } elseif ($this->daystatus3_id == 200) {
            $_val = "CUTI";
        } elseif ($this->daystatus3_id == 300) {
            $_val = "ALPHA";
        } elseif ($this->daystatus3_id == 400) {
            $_val = "LEMBUR";
        } elseif ($this->daystatus3_id == 500) {
            $_val = "LEMBUR DATANG";
        } elseif ($this->daystatus3_id == 600) {
            $_val = "LEMBUR DATANG DAN PULANG";
        }
        else
            $_val = "";

        return $_val;
    }

    public function getSyncPermission() {
        $criteria = new CDbCriteria;
        $criteria->compare('parent_id', $this->parent_id);

        $criteria1 = new CDbCriteria;
        $criteria1->compare('DATE_FORMAT(start_date,"%Y-%m-%d")', date("Y-m-d", strtotime($this->cdate)), false, 'OR');
        $criteria1->compare('DATE_FORMAT(end_date,"%Y-%m-%d")', date("Y-m-d", strtotime($this->cdate)), false, 'OR');

        $criteria->mergeWith($criteria1);

        $model = gPermission::model()->find($criteria);

        if (isset($model)) {
            return $model;
        }
        else
            return null;
    }

    /* public function afterSave() {
      if($this->isNewRecord) {
      Notification::create(
      1,
      'm1/gAttendance/view/id/'.$this->parent_id,
      'Attendance. New Attendance created: '.$this->person->employee_name
      );
      }
      return true;
      } */
}