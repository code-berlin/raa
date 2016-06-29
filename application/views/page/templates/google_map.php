<div class="content-container">

    <div class="flex-container _desktop">

        <div class="flex content-wrapper">
            <div class="content-header">
                <h1><?php echo $page->headline; ?></h1>
            </div>
            <div class="content-content _static _no-offsetbottom"><?php echo $page->text; ?></div>

            <div class="gm-searchlabel">Geben Sie hier Ihre Postleitzahl oder Ihren Ort an:</div>
            <div class="form-search mb30">
                <input class="js-map-embed-search-input" type="text" value="<?php echo isset($template_data['gm_searchterm']) ? $template_data['gm_searchterm'] : ''; ?>">
                <a class="js-map-embed-search-btn" href="#"><i class="fa fa-search"></i></a>
            </div>

            <div class="js-map-embed-key" data-key="<?php echo $template_data['api_key']; ?>"></div>
            <div class="js-map-embed-phrase" data-phrase="Apotheken near"></div>

            <iframe frameborder="0" style="border:0" class="js-map-container gmap-iframe" src="<?php echo isset($template_data['iframe_src']) ? $template_data['iframe_src'] : ''; ?>" allowfullscreen></iframe>

        </div>

        <div class="sidebar">
            <div class="sidebar-item _about-us"><?php $this->load->view('page/sidebar/about_us'); ?></div>
            <div class="sidebar-item"><?php $this->load->view('page/sidebar/teaser'); ?></div>
        </div>

    </div>

</div>



