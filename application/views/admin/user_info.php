<ul id="user-profile">
    <?php if (!empty($user->image)) { ?>
        <li>
            <img src="/assets/uploads/<?php echo $user->image ?>" id="userfile-image-preview">
        </li>
    <?php } ?>

    <li>
        Nickname: <?php echo $user->nickname ?>
    </li>
    <li>
        Email: <?php echo $user->email ?>
    </li>
    <li>
        Role: <?php echo $role->title ?>
    </li>

    <?php if ($user_can_edit_profile) { ?>
        <li>
            <a href="/admin/profile/edit" class="btn btn-info">Edit</a>
        </li>
    <?php } ?>
</ul>