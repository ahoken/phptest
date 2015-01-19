<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * レイアウトの初期化
	 */
	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}
	
	/**
	 * DBの初期化
	 */
	protected function _initDb()
	{
		$db = "";
		$dbauth = "";
		try{
			$options = new Zend_Config($this->getOptions());
			$dbConfig = $options->resources->db;
			$dbConect = Zend_Db::factory($dbConfig->adapter, $dbConfig->params);
			$db = Zend_Registry::set('db', $dbConect);
			Zend_Db_Table::setDefaultAdapter($dbConect);
		}catch(Exception $e){
			// Bootstrap.php内ではExceptionを表示させる機能は読み込まれていないため、ここに書きます。
			echo '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8" />';
			echo '<title>エラー</title></head><body>';
			if ('production' == APPLICATION_ENV){
				echo '<h1>エラーです。</h1>';
			}else{
				echo '<h1>データベースに接続できません。</h1>';
				echo '<h3>Message</h3>';
				echo $e->getMessage();
				echo '<h3>File</h3>';
				echo $e->getFile();
				echo '<h3>Line</h3>';
				echo $e->getLine();
				echo '<h3>Trace</h3>';
				echo '<pre>';
				echo $e->getTraceAsString();
				echo '</pre>';
			}
			echo '</body></html>';
			exit;
		}
	}
}

