<?php

class AuthController extends Zend_Controller_Action
{
	const AUTH_TABLE_NAME = 'tbl_user';
	const AUTH_ID_NAME    = 'username';
	const AUTH_PASS_NAME  = 'password';
	
    public function init()
    {
        /* Initialize action controller here */
		$this->view->error = 'ログイン情報を入力してください。';
		
//		$authAdapter =$db;
    }

    public function indexAction()
    {
        // action body
        return $this->_forward('login-page');
    }

	public function loginPageAction()
	{
		$this->render('login');
	}
	
	public function loginAction()
	{
		// リクエストパラメータ
		$username  = $this->getRequest()->getParam('username', '');
		$password = $this->getRequest()->getParam('password', '');
		if ($username === '' || $password === '') {
			// そもそもIDまたはパスワードがない →認証NG →ログインページへ
			$this->view->error = 'あほかお前。';
				
			return $this->_forward('login-page');
		}
		//DB接続
		$dbAdapter = Zend_Registry::get('db');
		
		$authAdapter = new Zend_Auth_Adapter_DbTable(
				$dbAdapter,
				self::AUTH_TABLE_NAME,	
				self::AUTH_ID_NAME,
				self::AUTH_PASS_NAME);
		$authAdapter->setIdentity($username);
		$authAdapter->setCredential($password);
		$result = $authAdapter->authenticate();
		var_dump($result);
		// 認証する
		if ($result->isValid() === FALSE) {
			$this->view->error = 'ログイン情報が不正です。';
			// 認証NG →ログインページへ
			return $this->_forward('login-page');
		}
		// 認証OK →認証済み情報をストレージ（セッション）に格納
		$storage = Zend_Auth::getInstance()->getStorage();
		$resultRow = $authAdapter->getResultRowObject(array('username', 'email'));
		$storage->write($resultRow);
		// セッションID再生成
		$ret = session_regenerate_id(true);
		// ログイン後のデフォルトアクションへ
		return $this->_forward('index', 'index');
	}
	
	public function logoutAction()
	{
		// 認証済み情報をストレージから削除
		$authStorage = Zend_Auth::getInstance()->getStorage();
		$authStorage->clear();
		// ログインページへ
		return $this->_forward('login-page');
	}
	
}

