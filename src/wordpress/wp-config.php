<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'wordpress');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'wp_user');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'wp_user');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'B)M9js{[@K~_d[5Z!W*SmLp:k)_Ao&|G.c+v4m/u}:2p}*g,*D<@3@<OiJU*=Gtu');
define('SECURE_AUTH_KEY',  '7fN3jlpYgdI2`kIa`[?8C;ul]LVV-i)sJ$_}4O/| [In&I)wXyi{j5:3u0o;xb{m');
define('LOGGED_IN_KEY',    'PX.*(gbqn[wr0.mtCj%x/a,fmO:JuIG>.&rs&:Nm;{^,l|_Ue!TzW-o,R+eYK]B_');
define('NONCE_KEY',        'ZOnl!{roDAoZ>|iV%bGu8Kh18exKM2@UGuU~%j/P^AXQ_6ezoa>4N8z>@dg%kSEr');
define('AUTH_SALT',        'WwQ2Pv.zb/C{{IluAD1SbJQ$?vH1nr/Znf^2mLb[DWNr5m>dciy8Ui9n3RWA@P~d');
define('SECURE_AUTH_SALT', 'zX`[__m&`XFgv#=hp[.!T4*Y}/T&p./(y P>V~0Ar,l{D>?$-<lOj{BE1]VaSzr:');
define('LOGGED_IN_SALT',   '%2,>~L2jSKdf&&;4VbT7SXH6[>xeF KN*7>NE{5jx~:F#{K]0U@`HNfu)fhx/R@&');
define('NONCE_SALT',       '!JX)zU?4v*@rk]wX%gPb=00#k2YP$~f>^JOY7Z&lnQ=cbA<?hJtR-Z+IlmQ1sUP7');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', true);

if (WP_DEBUG) {
	define("WP_DEBUG_LOG", true);
	define('WP_DEBUG_DISPLAY', false);
}
/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
