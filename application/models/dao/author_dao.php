<?php
/**
 * DAO for pages
 *
 */
class Author_dao extends CI_Model {



	public function __construct() {

		parent::__construct();

		$this->load->library('rb');
		
		$this->table = 'author';

	}

	public function create($name, $position, $image, $text, $published, $gender) {
		$author = R::dispense($this->table);

		$author->name = $name;
		$author->position = $position;
		$author->image = $image;
		$author->text = $text;
		$author->published = $published;
		$author->gender = $gender;

		$id = R::store($author);

		return $id;
	}

	public function get_by_name($name) {
		return R::findOne($this->table, 'name = :name',
			array(':name' => $name));
	}


}