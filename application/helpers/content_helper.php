<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_article_pagination($contentSiblings, $pageId) {

    $articlePagination = array();
    $count = count($contentSiblings);

    for ($i=0; $i<$count; $i++) {

        if ($contentSiblings[$i]['id'] == $pageId) {
            if ($i==0) {
                array_push($articlePagination, null);
            } else {
                array_push($articlePagination, $contentSiblings[$i-1]);
            }
            if ($i==$count-1) {
                array_push($articlePagination, null);
            } else {
                array_push($articlePagination, $contentSiblings[$i+1]);
            }
        }
    }

    return $articlePagination;

}


?>