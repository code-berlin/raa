<div class="blue-wrapper2 contact-widget">
    <div class="contact-widget-wrapper">
        <div class="form-container">
            <form method="post" action="" data-name="contact" id="contact-form" class="contact-widget-form">
                <div class="contact-form">
                    <span class="contact-widget-left-title contact-form-title"><?php echo $contact_us; ?></span>
                    <div class="row-fluid span11">
                        <div class="span6 contact-name">
                            <span class="contact-widget-form-control-wrap your-name"><input data-mandatory="1" type="text" name="name" value="" size="40" class="contact-widget-form-control contact-widget-text contact-widget-validates-as-required" aria-required="true" placeholder="<?php echo $name_placeholder."*"; ?>"></span>
                        </div>
                        <div class="span6 contact-email">
                            <span class="contact-widget-form-control-wrap your-email"><input type="email" name="email" data-mandatory="1" value="" size="40" class="contact-widget-form-control contact-widget-text contact-widget-email contact-widget-validates-as-required contact-widget-validates-as-email" aria-required="true" placeholder="<?php echo $email_placeholder."*"; ?>"></span>
                        </div>
                    </div>
                    <div class="row-fluid span11">
                        <div class="span12 contact-text">
                            <span class="contact-widget-form-control-wrap your-message">
                                <textarea name="message" cols="40" rows="10" class="contact-widget-form-control contact-widget-textarea contact-widget-validates-as-required" aria-required="true" placeholder="<?php echo $message_placeholder."*"; ?>" data-mandatory="1"></textarea>
                            </span>
                        </div>
                        <div class="span3 contactbtn send-button-container">
                            <input type="hidden" value="submit_contacts_form_widget" name="action">
                            <input type="submit" value="<?php echo $contact_submit; ?>" class="contact-widget-form-control contact-widget-submit">
                            <div id="disclaimer"><?php echo $contact_form_disclaimer; ?></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="contact-info-container">
            <span class="contact-widget-left-title"><?php echo $contact_info; ?></span>
            <div class="contact-address">
                Friedelstraße 40, 12047 Berlin <br>
                +49 30 577 07 8311 <br>
                <a href="mailto:office@code-b.com">office@code-b.com</a> <br>
            </div>
            <div class="contact-social">
                <a href="http://www.twitter.com" target="_blank" class="contact_social_icon" id="twitter"></a>
                <a href="http://www.facebook.com" target="_blank" class="contact_social_icon" id="facebook"></a>
                <a href="http://www.google.com" target="_blank" class="contact_social_icon" id="google"></a>
            </div>
        </div>
    </div>
</div>