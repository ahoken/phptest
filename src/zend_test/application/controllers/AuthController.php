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
		$authAdapter =  new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter->setTableName(self::AUTH_TABLE_NAME)
		->setIdentity($username)
		->setIdentityColumn(self::AUTH_ID_NAME)
		->setCredential($password)
		->setCredentialColumn(self::AUTH_PASS_NAME)
		->setCredentialTreatment('MD5(?)');
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
	
	private function createSalt()
	{
		$dynamicSalt = null;
		for ($i = 0; $i < 50; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		}
		return $dynamicSalt;
	}
}

