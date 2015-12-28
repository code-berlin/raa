<script>
    var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
    (function() {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') + 
        '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
    })();
    <?php
        if (isset($page)) {
            $ad_keywords = explode(',', $page->ad_keywords);
            $i = 0;
            if(isset($ad_keywords[0]) && !empty($ad_keywords[0])) {
    ?>
            googletag.cmd.push(function() {
                googletag.pubads().setTargeting("keyword",[<?php
                    foreach($ad_keywords as $val) {
                        if ($i > 0) echo ',';
                        echo '"'.$val.'"';
                        $i++;
                    }
                ?>]);
            });
    <?php
            }
        }
    ?>
</script>