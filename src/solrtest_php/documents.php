<?php

require_once('./bootstrap.php');

function write_not_found($query)
{
    echo '<p>';
    echo 'クエリ&quot;<span class="query">' . h($query) . '</span>&quot;';
    echo 'に該当するドキュメントはありません。';
    echo '</p>';
}

function write_header($response)
{
    $num_found = $response['response']['numFound'];
    echo '<div class="header">';
    echo '<div class="num_found">';
    echo '全' . h($num_found) . '件';
    echo '</div>';
    write_pagination($response);
    echo '</div>';
}

function write_docs($response)
{
    $docs = $response['response']['docs'];
    echo "<div class=\"query_result\">\n";
    echo "<div class=\"documents\">\n";
    foreach ($docs as $doc) {
        write_doc($doc, $response);
    }
    echo "</div>\n";
    echo "</div>\n";
}

function write_doc($doc, $response)
{
    $id       = $doc['id'];
    $h_params = $response['responseHeader']['params'];
    $hl       = (isset($h_params['hl']) && $h_params['hl']) ? TRUE : FALSE;

    echo "<div class=\"document\">\n";
    echo '<ul>';
    echo '<li>タイトル:&nbsp;<a href="'. hq($doc['card_url']) .'">'. h($doc['title']) . '</a></li>';
    echo '<li>著者:&nbsp;'. h($doc['family_name']).h($doc['first_name']) . '</li>';
    echo '<li>出版社:&nbsp;' . h($doc['publisher']) . '</li>';
    echo '<li>底本:&nbsp;' . h($doc['orgbook']) . '</li>';
    if ($hl) {
        $highlitings = $response['highlighting'];
        $content     = $highlitings[$doc['id']];
        $content     = isset($content['content']) ? $content['content'] : array();
        if ($content) {
            echo '<li class="hl">';
            foreach ($content as $cont) { echo $cont; }
            echo  '</li>';
        }
    }
    echo '</ul>';
    echo "</div>\n";
}

function next_page_link($q, $start, $row, $hl)
{
    $anc = new SolrQuery();
    $anc->setQuery($q);
    $anc->setStart($start);
    $anc->setRows($row);
    if ($hl) {
        $anc->setHighlight(TRUE);
    }
    return $anc->toString(true);
}

function write_pagination($response)
{
    $h_params   = $response['responseHeader']['params'];
    $num_found  = $response['response']['numFound'];
    $row        = $h_params['rows'];
    $start      = $h_params['start'];
    $q          = $h_params['q'];
    $hl         = isset($h_params['hl']) ? $h_params['hl'] : FALSE;

    $num_pages  = ceil($num_found / $row);
    $current    = (int)($start / $row) + 1;
    $next       = ($current >= $num_pages) ? NULL : $current+1;
    $prev       = ($current <= 1)          ? NULL : $current-1;
    $start_page = $current - (MAX_PAGE_WIDTH/2);
    $start_page = ($start_page < 1) ? 1 : $start_page;

    echo '<div class="pagination">';
    echo '<div>ページ</div>';
    if (!is_null($prev)) {
        $next_page = next_page_link($q, ($prev-1) * $row, $row, $hl);
        echo '<div><a class="next_page" href="index.php?' . $next_page . '">前へ</a></div>';
    }
    for ($i = $start_page, $j = 0; $i <= $num_pages && $j < MAX_PAGE_WIDTH; $i++, $j++) {
        if ($current === $i) {
            echo "<div class=\"current_page\">$i</div>";
        } else {
            $next_page = next_page_link($q, ($i-1) * $row, $row, $hl);
            echo '<div><a href="index.php?'. $next_page  ."\">$i</a></div>";
        }
    }
    if (!is_null($next)) {
        $next_page = next_page_link($q, ($next-1) * $row, $row, $hl);
        echo '<div><a class="next_page" href="index.php?' . $next_page . '">次へ</a></div>';
    }
    echo '</div>';
}

if (!isset($query_response)) {
    error_log("query_response variable is not set.");
    exit(1);
}

$response = $query_response->getResponse();
$num_found = $response['response']['numFound'];
if ($num_found > 0) {
    write_header($response);
    write_docs($response);
} else {
    write_not_found($q);
}

