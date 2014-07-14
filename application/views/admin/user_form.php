<?php
    echo form_open_multipart('/admin/save_user_profile', array(
        'class' => 'form-message',
        'id' => 'user-profile-form'
    ));
?>
    <ul>
        <li>
            <?php echo form_label('image:', 'userfile'); ?>

            <div class="image-container <?php if (empty($user->image)) { echo ' hidden'; } ?>">
                <img src="/assets/uploads/<?php echo $user->image ?>" id="userfile-image-preview">
                <span class="delete-image"> Delete </span>
                <?php echo form_hidden('delete_image', 0); ?>
            </div>

            <?php echo form_upload(array('name'=> 'userfile', 'id' => 'userfile')); ?>
        </li>
        <li>
            <?php
                echo form_label('Name: *', 'name');
                echo form_input('name', set_value('name', $user->name));

                if (!empty($errors['name'])) {
            ?>
                <div class="errors">
                    <?php echo $errors['name']; ?>
                </div>
            <?php
                }
            ?>
        </li>
        <li>
            <?php
                echo form_label('Surname: *', 'surname');
                echo form_input('surname', set_value('surname', $user->surname));

                if (!empty($errors['surname'])) {
            ?>
                <div class="errors">
                    <?php echo $errors['surname']; ?>
                </div>
            <?php
                }
            ?>
        </li>
        <li>
            <?php
                echo form_label('Nickname:', 'nickname');
                echo form_input('nickname', set_value('nickname', $user->nickname));
            ?>
        </li>
        <li>
            <?php
                echo form_label('Email: *', 'email');
                echo form_input('email', set_value('email', $user->email));

                if (!empty($errors['email'])) {
            ?>
                <div class="errors">
                    <?php echo $errors['email']; ?>
                </div>
            <?php
                }
            ?>
        </li>
        <li>
            <?php
                echo form_label('Password:', 'password');
                echo form_password('password');

                echo form_label('Confirm password:', 'password');
                echo form_password('confirm_password');
            ?>

            <div class="errors">
                <?php echo $this->session->flashdata('passwords_match'); ?>
            </div>
        </li>
        <li>
            <?php
                echo form_hidden('id', $user->id);
                echo form_submit(array('class' => 'btn btn-info', 'value' => 'Save'), 'submit');
            ?>
        </li>
    </ul>
<?php echo form_close(); ?>