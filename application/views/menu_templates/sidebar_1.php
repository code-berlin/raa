<ul>
 <?php
 foreach($items as $row){
 ?>
    <li>
        <a href="<?php echo ($row->slug!='')?$row->slug:$row->absolute_url;?>"><?php echo $row->title?></a>
    </li>
 <?php } ?>
</ul>
