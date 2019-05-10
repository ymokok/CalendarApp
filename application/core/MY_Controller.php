<?php
class MY_Controller extends CI_Controller {

	// modelの呼び出し
	public function model($name) {
		$name = $name . '_model';
		if (!isset($this->{$name})) {
			$this->load->model($name);
		}
		return $this->{$name};
	}
}
