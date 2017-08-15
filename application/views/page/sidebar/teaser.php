<?php
foreach ($lib_data['sidebar_teaser'] as $key => $value) {
    $this->load->view('page/sidebar/teaser/' . $value['type'], $value);
} ?>
