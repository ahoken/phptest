<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $username =  Zend_Auth::getInstance()->getStorage()->read();
    	$this->view->login_user = ($username!=NULL) ? $username->username : NULL;
    }


}

