<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Toast
 *
 * JUnit-style unit testing in CodeIgniter. Requires PHP 5 (AFAIK). Subclass
 * this class to create your own tests. See the README file or go to
 * http://jensroland.com/projects/toast/ for usage and examples.
 *
 * RESERVED TEST FUNCTION NAMES: test_index, test_show_results, test__[*]
 *
 * @package			CodeIgniter
 * @subpackage	Controllers
 * @category		Unit Testing
 * @based on		Brilliant original code by user t'mo from the CI forums
 * @based on		Assert functions by user 'redguy' from the CI forums
 * @license			Creative Commons Attribution 3.0 (cc) 2009 Jens Roland
 * @author			Jens Roland (mail@jensroland.com)
 *
 */


abstract class Toast extends CI_Controller
{

	// The folder INSIDE /controllers/ where the test classes are located
	// TODO: autoset
	var $test_dir = '/test/';

	var $modelname;
	var $modelname_short;
	var $message;
	var $messages;
	var $asserts;

    var $execution_times_xml = array();

	function Toast($name,$db=NULL)
	{

        ini_set('display_errors',1);
        error_reporting(E_ALL);

		parent::__construct();

		$this->load->library('Unit_test');
		$this->modelname = $name;
		$this->modelname_short = basename($name, '.php');
		$this->messages = array();

		//$this->_load_db($db);
	}

	function _load_db($db){
		if(!isset($db)) $db = $this->config->config['stage'] . '_test';

		$this->db = $this->load->database($db,TRUE);

	}

	function index()
	{
		$this->_show_all();
	}

	function show_results()
	{
		$this->_run_all();
		$data['modelname'] = $this->modelname;
		$data['results'] = $this->unit->result();
		$data['messages'] = $this->messages;
		$this->load->view('test/results', $data);
	}

	function show_results_xml()
	{

		$output = '';

		$this->_run_all_xml();
		$results = $this->unit->result();

		$test_results = '';
		$failed = 0;

		$total_execution_time = 0;

		if($results && is_array($results)){

		    foreach($results as $result){
                        
		        // passed
		        if($result['Result']=='Passed'){
		           $test_results .= '<testcase classname="'.$result['Test Name'].'" name="'.$result['Test Name'].'" time="'.$this->execution_times_xml[$result['Test Name']].'">';
		        }
		        else {
		           $test_results .= '<testcase classname="'.$result['Test Name'].'" name="'.$result['Test Name'].'" time="'.$this->execution_times_xml[$result['Test Name']].'">';
		           $test_results .= '<failure type="PHPUnit_Framework_ExpectationFailedException">Test failed</failure>';
		           $failed++;
		        }

		        $test_results .= '</testcase>';

		        $total_execution_time += floatval($this->execution_times_xml[$result['Test Name']]);

		    }
		}

		$output .= '<testsuite name="'.$_POST['test_name'].'" tests="'.count($results).'" failures="'.$failed.'" errors="0" skip="0" time="'.$total_execution_time.'">';
		$output .= $test_results;
		$output .= '</testsuite>';
		echo $output;
	}

	function _show_all()
	{
		$this->_run_all();
		$data['modelname'] = $this->modelname;
		$data['results'] = $this->unit->result();
		$data['messages'] = $this->messages;


		$this->load->view('test/header');
		$this->load->view('test/results', $data);
		$this->load->view('test/footer');
	}

	function _show($method)
	{
		$this->_run($method);
		$data['modelname'] = $this->modelname;
		$data['results'] = $this->unit->result();
		$data['messages'] = $this->messages;

		$this->load->view('test/header');
		$this->load->view('test/results', $data);
		$this->load->view('test/footer');
	}

	function _run_all()
	{
		foreach ($this->_get_test_methods() as $method)
		{
			$this->_run($method);
		}
	}

	function _run_all_xml()
	{
		foreach ($this->_get_test_methods() as $method)
		{
			$this->_run_xml($method);
		}
	}


	function _run($method)
	{
		// Reset message from test
		$this->message = '';

		// Reset asserts
		$this->asserts = TRUE;

		// Run cleanup method _pre
		$this->_pre();

		// Run test case (result will be in $this->asserts)
		$this->$method();

		// Run cleanup method _post
		$this->_post();

		// Set test description to "model name -> method name" with links
		$this->load->helper('url');
		$test_class_segments = $this->test_dir . strtolower($this->modelname_short);
		$test_method_segments = $test_class_segments . '/' . substr($method, 5);
		$desc = anchor($test_class_segments, $this->modelname_short) . ' -> ' . anchor($test_method_segments, substr($method, 5));

		$this->messages[] = $this->message;

		// Pass the test case to CodeIgniter
		$this->unit->run($this->asserts, TRUE, $desc);
	}

        function _run_xml($method)
	{
		// Reset message from test
		$this->message = '';

		// Reset asserts
		$this->asserts = TRUE;

		// Run cleanup method _pre
		$this->_pre();

                $mtime = microtime();
                $mtime = explode(" ",$mtime);
                $mtime = $mtime[1] + $mtime[0];
                $starttime = $mtime;

		// Run test case (result will be in $this->asserts)
		$this->$method();

                $mtime = microtime();
                $mtime = explode(" ",$mtime);
                $mtime = $mtime[1] + $mtime[0];
                $endtime = $mtime;
                $totaltime = ($endtime - $starttime);

		// Run cleanup method _post
		$this->_post();

		// Set test description to "model name -> method name" with links
		$this->load->helper('url');
		$test_class_segments = $this->test_dir . strtolower($this->modelname_short);
		$test_method_segments = $test_class_segments . '/' . substr($method, 5);

		$desc = $method;
                $this->execution_times_xml[$method] = $totaltime;

		$this->messages[] = $this->message;

		// Pass the test case to CodeIgniter
		$this->unit->run($this->asserts, TRUE, $desc);
	}


	function _get_test_methods()
	{
		$methods = get_class_methods($this);
		$testMethods = array();
		foreach ($methods as $method) {
			if (substr(strtolower($method), 0, 5) == 'test_') {
				$testMethods[] = $method;
			}
		}
		return $testMethods;
	}

	/**
	 * Remap function (CI magic function)
	 *
	 * Reroutes any request that matches a test function in the subclass
	 * to the _show() function.
	 *
	 * This makes it possible to request /my_test_class/my_test_function
	 * to test just that single function, and /my_test_class to test all the
	 * functions in the class.
	 *
	 */
	function _remap($method)
	{
		$test_name = 'test_' . $method;
		if (method_exists($this, $test_name))
		{
			$this->_show($test_name);
		}
		else
		{
			$this->$method();
		}
	}


	/**
	 * Cleanup function that is run before each test case
	 * Override this method in test classes!
	 */
	function _pre() { }

	/**
	 * Cleanup function that is run after each test case
	 * Override this method in test classes!
	 */
	function _post() { }


	function _fail($message = null) {
		$this->asserts = FALSE;
		if ($message != null) {
			$this->message = $message;
		}
		return FALSE;
	}

	function _assert_true($assertion) {
		if($assertion) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_false($assertion) {
		if($assertion) {
			$this->asserts = FALSE;
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function _assert_true_strict($assertion) {
		if($assertion === TRUE) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_false_strict($assertion) {
		if($assertion === FALSE) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_equals($base, $check) {
		if($base == $check) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_not_equals($base, $check) {
		if($base != $check) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_equals_strict($base, $check) {
		if($base === $check) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_not_equals_strict($base, $check) {
		if($base !== $check) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_empty($assertion) {
		if(empty($assertion)) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}

	function _assert_not_empty($assertion) {
		if(!empty($assertion)) {
			return TRUE;
		} else {
			$this->asserts = FALSE;
			return FALSE;
		}
	}



        function result($results = array())
	{


		$CI =& get_instance();
		$CI->load->language('unit_test');

		if (count($results) == 0)
		{
			$results = $this->results;
		}

		$retval = array();
		foreach ($results as $result)
		{
			$temp = array();
			foreach ($result as $key => $val)
			{
				if ( ! in_array($key, $this->_test_items_visible))
				{
					continue;
				}

				if (is_array($val))
				{
					foreach ($val as $k => $v)
					{
						if (FALSE !== ($line = $CI->lang->line(strtolower('ut_'.$v))))
						{
							$v = $line;
						}
						$temp[$CI->lang->line('ut_'.$k)] = $v;
					}
				}
				else
				{
					if (FALSE !== ($line = $CI->lang->line(strtolower('ut_'.$val))))
					{
						$val = $line;
					}
					$temp[$CI->lang->line('ut_'.$key)] = $val;
				}
			}

			$retval[] = $temp;
		}

		return $retval;
	}


}

// End of file Toast.php */
// Location: ./system/application/controllers/test/Toast.php */
