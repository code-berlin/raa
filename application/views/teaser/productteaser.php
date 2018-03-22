<?php 
$product_id = (isset($productteaser_order) ? $productteaser_order : $id);
?>

<div class="product-teaser-iframe-wrapper"><iframe id="product-teaser-iframe" class="product-teaser-iframe" src="/productteaser/<? echo urlencode($product_id); ?>"></iframe></div>