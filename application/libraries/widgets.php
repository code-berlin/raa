<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Widgets loader library:
* Team 2 "Lost Latinos" code-b 02.2014
*
* Add the widget on the CMS, and then create a method here f
*
* The widget helper will try to load the widget from the widgets folder in case
* it's a standard widget (whichk doesn't require database interactions).
*
* If it's not a standard widget, the helper will try to call a method from this library,
* so the widget name should be the same as the method name.
*/
class Widgets {
	private $ci;

	public function __construct(){
		$this->ci =& get_instance();
	}

	public function example_widget($id) {
		$ci = $this->ci;
		// Load models:
		//$ci->load->model('about_us_widget_m');

		$data['title'] = 'Example widget title!';

		/*
		// Do some database magic:
		$data['widgets'] = $ci->about_us_widget_m->get_all();

		foreach ($data['widgets'] as $widget) {
			$widget->text = substr($widget->text, 0, 800);
		}
		//*/

		$ci->load->view('widgets/example_widget/index', $data);
	}
}