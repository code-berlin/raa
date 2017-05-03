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
            $teaserToPush = $value;

            // add alternative teaser to array instead of teaser, if teaser points to actual page
            if ($pageSlug === $slug && isset($alternativeTeaser)) {
                $teaserToPush = $alternativeTeaser;
            }

            // set target field
            if ($teaserToPush['external'] === '1') {
                $teaserToPush['target'] = '_blank';
            } else {
                $teaserToPush['target'] = '_self';
            }

            array_push($teaser, $teaserToPush);

        }

    }

    return $teaser;

}

function get_breadcrumbs($page) {

    $breadcrumbs = array();

    array_push($breadcrumbs, array('title' => 'Home', 'url'=> base_url('/')));

    if (!empty($page['parent_id'])) {
        array_push($breadcrumbs, array('title' => $page['parent_menu_title'], 'url'=> base_url($page['parent_slug'])));
    }

    array_push($breadcrumbs, array('title' => $page['menu_title'], 'url'=> NULL));

    return $breadcrumbs;

}

/*
* remove duplicated article items
* @param (Array) $data -> the article array
*/
function remove_duplicates($data) {

    $ids = array();
    $filtered = array();

    for ($i = 0; $i < count($data); $i++) {
        $id = $data[$i]['id'];
        if (!in_array($id, $ids)) {
            array_push($ids, $id);
            array_push($filtered, $data[$i]);
        }
    }

    return $filtered;
}

function get_image_placeholder($theme) {

    $themeUrl = 'assets/images/themes/'.$theme.'/ph.png';

    if (file_exists($themeUrl)) {
        return '/'.$themeUrl;
    }

    return '/assets/images/ph.png';

}

function get_image_placeholder_for_slideshow($theme) {

    $themeUrl = 'assets/images/themes/'.$theme.'/ph-slideshow.png';

    if (file_exists($themeUrl)) {
        return '/'.$themeUrl;
    }

    return '/assets/images/ph-slideshow.png';

}


?>
