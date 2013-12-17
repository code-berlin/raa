<ul>
 <?php
 if ($items) {
 foreach($items as $row){
 ?>
    <li>
        <a href="<?php echo (!empty($row->url->slug)) ? $row->url->slug : $row->absolute_url ?>"><?php echo $row->title?></a>
    </li>
 <?php } }?>
</ul>
