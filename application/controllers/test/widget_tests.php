<?php
require_once(APPPATH . 'controllers/test/Toast.php');
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Widget_tests extends Basic_tests
{
	function Widget_tests()
	{
		parent::Toast(__FILE__);
		// Load any models, libraries etc. you need here
        $this->minimal_db_version = 4;
	}

	function _pre() {
    	$this->load->model('widget_m');
	}

	function _post() {}

	function test_load_widget()
	{
		$widgets = $this->widget_m->get_all();

		$total_widgets = count($widgets);
		$available_widgets = 0;

		if (!empty($widgets)) {
			foreach ($widgets as $widget) {
				if (file_exists('application/widgets/'.$widget->widgetname)) {
					$available_widgets++;
				}
			}
		}

		$this->_assert_equals($total_widgets, $available_widgets);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */