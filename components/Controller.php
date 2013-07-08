<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to 'column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array(); //Operation
    public $menu1 = array(); //Recent Updated
    public $menu2 = array(); //Recent Added
    public $menu3 = array(); //Other Menu
    public $menu4 = array();
    public $menu5 = array();
    public $menu6 = array();
    public $menu7 = array();  //Filter Left SideBar Menu
    public $menu8 = array();  //Filter Right SideBar Menu
    public $menu9 = array();  //Search Box
    public $menu10 = array();  //Operation 2
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filterRights($filterChain) {
        $filter = new RightsFilter;
        $filter->allowedActions = $this->allowedActions();
        $filter->filter($filterChain);
    }

    /**
     * @return string the actions that are always allowed separated by commas.
     */
    public function allowedActions() {
        return '';
    }

    /**
     * Denies the access of the user.
     * @param string $message the message to display to the user.
     * This method may be invoked when access check fails.
     * @throws CHttpException when called unless login is required.
     */
    public function accessDenied($message = null) {
        if ($message === null)
        //$message = Rights::t('core', 'You are not authorized to perform this action.');
            $message = 'You are not authorized to perform this action.';

        $user = Yii::app()->getUser();
        if ($user->isGuest === true)
            $user->loginRequired();
        else
            throw new CHttpException(403, $message);
    }

}

?>