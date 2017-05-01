<?php

$order = explode(',', $page->productteaser_order);

foreach ($order as $key => $value) {
	if (!isset($page->productteaser[$value])) continue;
	//var_dump($page->productteaser[$value]);
}

?>