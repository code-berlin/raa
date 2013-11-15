<?php
require_once(APPPATH . 'controllers/test/basic_tests.php');

class Widgets_containers_tests extends Basic_tests
{
	function Widgets_containers_tests()
	{
		parent::Toast(__FILE__);

		$this->minimal_db_version = 11;

		$this->widget = new stdClass();
		$this->object = new stdClass();

		$this->widgets_container_id = 1;
		$this->widget_id = 0;
	}

	function _pre() {
		$this->load->model('widgets_containers_m');
		$this->load->model('widgets_container_m');
		$this->load->model('widget_m');

		$this->create_widgets_container();
		$this->create_widget();

		$widgets_containers = $this->widgets_containers_m;

		$this->object = $widgets_containers->create();
		$this->object->widgets_container_id = $this->widgets_container_id;
		$this->object->widget_id = $this->widget_id;
		$widgets_containers->save($this->object);
	}

	function _post() {
		$this->widgets_containers_m->remove($this->object);
		R::trash($this->widgets_container);
		R::trash($this->widget);
	}

	function test_retrieve_container_widgets()
	{
		$object = $this->widgets_containers_m->get_all_by_widgets_container_id($this->widgets_container_id);

		$this->_assert_not_empty($object);
	}

	private function create_widget() {
		$this->widget = R::dispense('widget');
		$this->widget->widgetname = 'Test';

		$this->widget_id = R::store($this->widget);
	}

	private function create_widgets_container() {
		$this->widgets_container = R::dispense('widgetscontainer');
		$this->widgets_container->name = 'Test';

		$this->widgets_container_id = R::store($this->widgets_container);
	}

	private function delete($model_name, $object) {
		$model = $this->$model_name;

		$model->remove($object);
	}
}

// End of file example_test.php */
// Location: ./system/application/controllers/test/example_test.php */
