<noscript>
	<link href="/assets/css/min/main.min.css?<?php echo filemtime(FCPATH . 'assets/css/min/main.min.css'); ?>" rel="stylesheet">
</noscript>
<script>
!function(e){"use strict";e.loadCSS=function(t,n,l){var s,i=e.document.createElement("link");if(n)s=n;else if(e.document.querySelectorAll){var o=e.document.querySelectorAll("style,link[rel=stylesheet],script");s=o[o.length-1]}else s=e.document.getElementsByTagName("script")[0];var r=e.document.styleSheets;return i.rel="stylesheet",i.href=t,i.media="only x",s.parentNode.insertBefore(i,n?s:s.nextSibling),i.onloadcssdefined=function(e){for(var t,n=0;n<r.length;n++)r[n].href&&r[n].href===i.href&&(t=!0);t?e():setTimeout(function(){i.onloadcssdefined(e)})},i.onloadcssdefined(function(){i.media=l||"all",e.document.getElementsByTagName("html")[0].style.display="inline"}),i}}(this),loadCSS("/assets/css/min/main.min.css");
</script>