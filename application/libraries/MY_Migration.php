<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Migration extends CI_Migration {

	protected $_migration_path_fork = NULL;
	protected $_migration_version_fork = 0;

	function __construct() {
    	
    	parent::__construct();
    	
    	$CI =& get_instance();
    	$CI->config->load('migration');
    	
    	$this->_migration_path = $CI->config->item('migration_path');
    	$this->_migration_version = $CI->config->item('migration_version');
    	$this->_migration_enabled = $CI->config->item('migration_enabled');
    	$this->_migration_path_fork = $CI->config->item('migration_path_fork') . $CI->config->item('theme') . '/';
    	$this->_migration_version_fork = $CI->config->item('migration_version_fork');

    	log_message('debug', 'MY_Migrations class initialized');

    	if ($this->_migration_enabled !== TRUE)
		{
			show_error('Migrations has been loaded but is disabled or set up incorrectly.');
		}

		// If not set, set it
		$this->_migration_path == '' AND $this->_migration_path = APPPATH . 'migrations/';

		// Add trailing slash if not set
		$this->_migration_path = rtrim($this->_migration_path, '/').'/';

		// Load migration language
		$CI->lang->load('migration');

		// They'll probably be using dbforge
		$CI->load->dbforge();

		// If the migrations table is missing, make it
		if ( ! $CI->db->table_exists('migrations'))
		{
			$CI->dbforge->add_field(array(
				'version' => array('type' => 'INT', 'constraint' => 3),
			));

			$CI->dbforge->create_table('migrations', TRUE);

			$CI->db->insert('migrations', array('version' => 0));
		}

		if ( ! $CI->db->table_exists('migrations_fork'))
    	{
			$CI->dbforge->add_field(array(
				'version' => array('type' => 'INT', 'constraint' => 3),
			));

			$CI->dbforge->create_table('migrations_fork', TRUE);

			$CI->db->insert('migrations_fork', array('version' => 0));
		}
		
    }

    /**
	 * Migrate to a schema version
	 *
	 * Calls each migration step required to get to the schema version of
	 * choice
	 *
	 * @param	int	Target schema version
	 * @param	bool fork, identifies if this the migration is fork
	 * @return	mixed	TRUE if already latest, FALSE if failed, int if upgraded
	 */
	public function version($target_version, $fork = false)
	{
		
		$start = $current_version = $this->_get_version($fork);
		$stop = $target_version;

		if ($target_version > $current_version)
		{
			// Moving Up
			++$start;
			++$stop;
			$step = 1;
		}
		else
		{
			// Moving Down
			$step = -1;
		}

		$method = ($step === 1) ? 'up' : 'down';
		$migrations = array();

		// We now prepare to actually DO the migrations
		// But first let's make sure that everything is the way it should be

		for ($i = $start; $i != $stop; $i += $step)
		{
			
			$f = glob(sprintf(($fork === false ? $this->_migration_path : $this->_migration_path_fork) . '%03d_*.php', $i));

			// Only one migration per step is permitted
			if (count($f) > 1)
			{
				$this->_error_string = sprintf($this->lang->line('migration_multiple_version'), $i);
				return FALSE;
			}

			// Migration step not found
			if (count($f) == 0)
			{
				// If trying to migrate up to a version greater than the last
				// existing one, migrate to the last one.
				if ($step == 1)
				{
					break;
				}

				// If trying to migrate down but we're missing a step,
				// something must definitely be wrong.
				$this->_error_string = sprintf($this->lang->line('migration_not_found'), $i);
				return FALSE;
			}

			$file = basename($f[0]);
			$name = basename($f[0], '.php');

			// Filename validations
			if (preg_match('/^\d{3}_(\w+)$/', $name, $match))
			{
				$match[1] = strtolower($match[1]);

				// Cannot repeat a migration at different steps
				if (in_array($match[1], $migrations))
				{
					$this->_error_string = sprintf($this->lang->line('migration_multiple_version'), $match[1]);
					return FALSE;
				}

				include $f[0];
				$class = 'Migration_' . ucfirst($match[1]);

				if ( ! class_exists($class))
				{
					$this->_error_string = sprintf($this->lang->line('migration_class_doesnt_exist'), $class);
					return FALSE;
				}

				if ( ! is_callable(array($class, $method)))
				{
					$this->_error_string = sprintf($this->lang->line('migration_missing_'.$method.'_method'), $class);
					return FALSE;
				}

				$migrations[] = $match[1];
			}
			else
			{
				$this->_error_string = sprintf($this->lang->line('migration_invalid_filename'), $file);
				return FALSE;
			}
		}

		log_message('debug', 'Current migration: ' . $current_version);

		$version = $i + ($step == 1 ? -1 : 0);

		// If there is nothing to do so quit
		if ($migrations === array())
		{
			return TRUE;
		}

		log_message('debug', 'Migrating from ' . $method . ' to version ' . $version);

		// Loop through the migrations
		foreach ($migrations AS $migration)
		{
			// Run the migration class
			$class = 'Migration_' . ucfirst(strtolower($migration));
			call_user_func(array(new $class, $method));
			$current_version += $step;
			$this->_update_version($current_version, $fork);
		}

		log_message('debug', 'Finished migrating to '.$current_version);

		return $current_version;
	}

	/**
	 * Stores the current schema version
	 *
	 * @param	int	Migration reached
	 * @param bool fork, identifies if this the migration is fork
	 * @return	bool
	 */
	protected function _update_version($migrations, $fork = false)
	{
		return $this->db->update(($fork === false ? 'migrations' : 'migrations_fork'), array(
			'version' => $migrations
		));
	}

    /**
	 * Set's the schema to the migration version set in config
	 *
	 * @param bool fork, identifies if this the migration is fork
	 * @return	mixed	true if already current, false if failed, int if upgraded
	 */
	public function current($fork = false)
	{
		return $this->version(($fork === false ? $this->_migration_version : $this->_migration_version_fork), $fork);
	}

	/**
	 * Retrieves current schema version
	 *
	 * @param bool fork, identifies if this the migration is fork
	 * @return	int	Current Migration
	 */
	protected function _get_version($fork = false)
	{
		$row = $this->db->get(($fork === false ? 'migrations' : 'migrations_fork'))->row();
		return $row ? $row->version : 0;
	}


}