<?php

/**
 * BPhoneNumberValidator validates that a Brazilian phone number is valid.
 * 
 * Credits to Fausto Gonçalves Cintra regular expressions used in the validation.
 * http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 * @since 1.0
 */
class BPhoneNumberValidator extends CValidator {

    /**
     * Indicates whether only mobile numbers will be validated.
     * Defaults to true.
     * @var boolean
     */
    public $onlyMobileNumbers = false;

    /**
     * Indicates whether the attribute value can be null or empty.
     * Defaults to true.
     * @var boolean
     */
    public $allowEmpty = true;

    /**
     * Indicates whether the mask of the phone number will be considered in the validation.
     * Mask in the format will be accepted: (99) 9999-9999
     * Defaults to false.
     * @var boolean
     */
    public $validateWithMask = false;

    /**
     * Contains custom validation message.
     * @var string
     */
    public $customMessage;

    /**
     * Contains the required regular expression to validate phone number without mask.
     * @var string
     * @see http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
     * @copyright Fausto Gonçalves Cintra
     */
    //private $phoneWithoutMaskPattern = '/(10)|([1-9][1-9])[2-9][0-9]{3}[0-9]{4}/';
    private $phoneWithoutMaskPattern = '/^08[0-9]+$/';

    /**
     * Contains the regular expression needed for validation of mobile phone number without mask.
     * @var string
     * @see http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
     * @copyright Fausto Gonçalves Cintra
     */
    //private $mobilePhoneWithoutMaskPattern = '/(10)|([1-9][1-9])[6-9][0-9]{3}[0-9]{4}/';
    private $mobilePhoneWithoutMaskPattern = '/^08[0-9]+$/';

    /**
     * Contains the required regular expression to validate phone number with mask.
     * @var string
     * @see http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
     * @copyright Fausto Gonçalves Cintra
     */
    //private $phoneWithMaskPattern = '/\((10)|([1-9][1-9])\) [2-9][0-9]{3}-[0-9]{4}/';
    private $phoneWithMaskPattern = '/^08[0-9]+$/';

    /**
     * Contains the regular expression needed for validation of mobile phone number with mask.
     * @var string
     * @see http://goncin.wordpress.com/2010/08/30/validando-numeros-de-telefone-com-expressoes-regulares/
     * @copyright Fausto Gonçalves Cintra
     */
    //private $mobilePhoneWithMaskPattern = '/\((10)|([1-9][1-9])\) [6-9][0-9]{3}-[0-9]{4}/';
    private $mobilePhoneWithMaskPattern = '/^(62)[0-9]+$/';

    /**
     * Validates a single attribute.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     */
    protected function validateAttribute($object, $attribute) {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }
        if (!$this->validatePhoneNumber($value)) {
            $message = $this->customMessage !== null ? $this->customMessage : Yii::t('yii', '{attribute} is not a valid phone number.');
            if ($this->onlyMobileNumbers) {
                $message = $this->customMessage !== null ? $this->customMessage : Yii::t('yii', '{attribute} is not a valid mobile phone number.');
            }
            $this->addError($object, $attribute, $message);
        }
    }

    /**
     * Validates a phone number according to the rules.
     * @param string $value Phone number to be validated.
     * @return boolean
     */
    private function validatePhoneNumber($value) {
        if ($this->onlyMobileNumbers) {
            if ($this->validateWithMask) {
                return (preg_match($this->mobilePhoneWithMaskPattern, "$value"));
            } else {
                return (preg_match($this->mobilePhoneWithoutMaskPattern, "$value"));
            }
        } else {
            if ($this->validateWithMask) {
                return (preg_match($this->phoneWithMaskPattern, "$value"));
            } else {
                return (preg_match($this->phoneWithoutMaskPattern, "$value"));
            }
        }
    }

}

?>
