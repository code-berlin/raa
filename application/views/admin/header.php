<div class="row-fluid">
    <div class="admin-header row-fluid">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <ul class="nav">
                    <li class="active"><a href="<?php echo site_url('admin/')?>">RAA CMS</a></li>
                    <!-- <li><a href="#">About</a></li> -->
                </ul>
                <div class="dropdown" style="float: right;">
                    <button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        <?php echo $this->session->userdata('user_name'); ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('auth/logout')?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
   </div>
</div>
