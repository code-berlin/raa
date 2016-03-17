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

function get_sidebar_teaser($sidebarTeaser, $alternativeTeaser, $pageSlug) {

    $teaser = array();

    if (isset($sidebarTeaser) && is_array($sidebarTeaser)) {

        foreach ($sidebarTeaser as $key => $value) {

            $slug = trim($value['url'], '/');

            // add alternative teaser to array instead of teaser, if teaser points to actual page
            if ($pageSlug !== $slug) {
                array_push($teaser, $value);
            } else if (isset($alternativeTeaser)) {
                array_push($teaser, $alternativeTeaser);
            }

        }

    }

    return $teaser;

}

?>