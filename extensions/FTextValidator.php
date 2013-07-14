<?php

/**
 * FTextValidator class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @version 1.0
 * @link http://www.yiiframework.com/extension/
 * @license BSD
 */

/**
 * FTextValidator verifies if the attribute represents a valid text (contains no XML tags).
 */
class FTextValidator extends CValidator {

    /**
     * @var boolean whether the attribute value can be null or empty. Defaults to true,
     * meaning that if the attribute is empty, it is considered valid.
     */
    public $allowEmpty = true;

    /**
     * Validates the attribute of the object.
     * If there is any error, the error message is added to the object.
     * @param CModel the data object being validated
     * @param string the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value))
            return;

        if ($value !== filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)) {
            $message = $this->message !== null ? $this->message : Yii::t(__CLASS__, 'Valid text of {attribute} without any XML tags will expected.');
            $this->addError($object, $attribute, $message);
        }
    }

}