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

            // if teaser points to actual page
            if ($pageSlug === $slug) {
                // add alternative teaser to array instead of teaser
                if (isset($alternativeTeaser[0])) {
                    $teaserToPush = $alternativeTeaser[0];
                // or add nothing
                } else {
                    continue;
                }
            }

            // set target field
            if ($teaserToPush['external'] === '1') {
                $teaserToPush['target'] = '_blank';
            } else {
                $teaserToPush['target'] = '_self';
            }
            $teaserToPush['hasImage'] = isset($teaserToPush['image']) && !empty($teaserToPush['image']);
            $teaserToPush['hasTitle'] = isset($teaserToPush['title']) && !empty($teaserToPush['title']);
            $teaserToPush['hasText'] = isset($teaserToPush['text']) && !empty($teaserToPush['text']);
            $teaserToPush['hasUrl'] = isset($teaserToPush['url']) && !empty($teaserToPush['url']);

            array_push($teaser, $teaserToPush);

        }

    }

    return $teaser;

}

function get_breadcrumbs($page, $homeTitle) {

    $breadcrumbs = array();

    if (!$homeTitle) {
        $homeTitle = 'Startseite';
    }

    array_push($breadcrumbs, array('title' => $homeTitle, 'url'=> base_url('/')));

    if (!empty($page['parent_id'])) {
        array_push($breadcrumbs, array('title' => $page['parent_menu_title'], 'url'=> base_url($page['parent_slug'])));
    }

    array_push($breadcrumbs, array('title' => $page['menu_title'], 'url'=>  base_url($page['slug'])));

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

function formatPrice($price) {
    $price = explode('.', $price);
    // add '00' if necessary
    if (!isset($price[1])) {
        array_push($price, '00');
    // add '0' if necessary
    } else if (strlen($price[1]) === 1) {
        $price[1] =$price[1] . '0';
    }
    return implode(',', $price) . ' €';
}

function teaser_items_ordered_list($items) {

    $orderedItems = [];

    foreach ($items as $key => $value) {
    
        $title = isset($value['title']) ? $value['title'] : $value['page_title'];
        $first = strtoupper(mb_substr($title, 0, 1));
        
        if (!isset($orderedItems[$first])) {
            $orderedItems[$first] = [];
        }

        array_push($orderedItems[$first], [
            'title' => $title,
            'slug' => $value['slug']
        ]);
    }

    ksort($orderedItems);

    return $orderedItems;
}


?>
