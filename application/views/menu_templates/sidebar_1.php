<ul>
 <?php
 foreach($items as $row){
 ?>
    <li>
        <a href="<?php echo ($row->url->slug!='')?$row->url->slug:$row->absolute_url;?>"><?php echo $row->title?></a>
    </li>
 <?php } ?>
</ul>
