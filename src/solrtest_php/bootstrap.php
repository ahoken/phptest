<?php

/* Solrサーバのホスト名 */
define("SOLR_SERVER_HOSTNAME", 'localhost');

/* Solrサーバのポート番号 */
define("SOLR_SERVER_PORT", 8983);

/* Solrサーバのパス */
define("SOLR_SERVER_PATH", '/solr/#/collection1');

/* ページあたりの表示件数 */
define("MAX_PAGE_WIDTH", 10);

define("ENCODING", "UTF-8");

function h($string)
{
    return htmlspecialchars($string, ENT_NOQUOTES, ENCODING);
}

function hq($string)
{
    return htmlspecialchars($string, ENT_QUOTES, ENCODING);
}

