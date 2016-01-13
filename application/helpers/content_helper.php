<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_content_pagination($contentSiblings, $pageId) {

    echo 'Page ID: ' . $pageId;
    echo '<br>';

    $contentPagination = array();
    $count = count($contentSiblings);

    for ($i=0; $i<$count; $i++) {

        // echo $contentSiblings[$i]['id'];
        // echo '<br>##########<br>';

        if ($contentSiblings[$i]['id'] == $pageId) {
            if ($i==0) {
                array_push($contentPagination, null);
            } else {
                array_push($contentPagination, $contentSiblings[$i-1]);
            }
            if ($i==$count-1) {
                array_push($contentPagination, null);
            } else {
                array_push($contentPagination, $contentSiblings[$i+1]);
            }
        }
    }

    return $contentPagination;

}


?>