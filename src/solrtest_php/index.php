<?php

require_once("./bootstrap.php");

define("MAX_ROW", 10);

$error_query    = NULL;
$query_response = NULL;
$q     = isset($_GET["q"]) ? trim($_GET["q"]) : NULL;
$start = isset($_GET["start"]) ? $_GET["start"] : 0;
$hl    = isset($_GET["hl"]) ? $_GET["hl"] : FALSE;
if ($q && ($start >= 0)) {
    $QUERY_FIELDS = array('id', 'title', 'family_name', 'first_name',
                          'publisher', 'orgbook', 'card_url');
    $OPTIONS = array('hostname' => SOLR_SERVER_HOSTNAME,
                     'port'     => SOLR_SERVER_PORT,
                     'path'     => SOLR_SERVER_PATH
                     );
    $client = new SolrClient($OPTIONS);
    $query = new SolrQuery();
    $query->setQuery($q);
    $query->setStart($start);
    $query->setRows(MAX_ROW);
    foreach ($QUERY_FIELDS as $fl) {
        $query->addField($fl);
    }
    if ($hl) {
        $query->setHighlight(TRUE);
        $query->addHighlightField("content");
        $query->setHighlightFragsize(150);
    }
    try {
        $query_response = $client->query($query);
    } catch (SolrClientException $e) {
        error_log("SolrQuery raises exception: cause: " . $e->getMessage());
        $error_query = $q;
        $query_response = NULL;
        $q = NULL;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>青空文庫 全文検索</title>
    <link rel="stylesheet" type="text/css" href="aozora.css">
</head>
<body>
<h1><a href="index.php">青空文庫&nbsp;全文検索</a></h1>

<?php if ($error_query) { ?>
<div class="error">
無効なクエリ&nbsp;<span class="query"><?php echo h($error_query); ?></span>
</div>
<?php } ?>

<form method="GET" action="index.php">
    <input type="text" name="q" value="<?php if ($q) { echo hq($q); } ?>" >
    <input type="submit" value="検索" >
    <input type="checkbox" name="hl" value="true" <?php if ($hl) { echo 'checked'; }?> >ハイライト
</form>

<?php if ($query_response) { include 'documents.php'; } ?>

</body>
</html>
