<?php
class Validator {

	public $rule;
	public $errors;
        public function __construct() {
		$this->errors = array();
        }

	public function validate($param) {
		foreach ($param as $key => $value) {
			if ($this->rule[$key]) {
				switch($this->rule[$key]['type'])
				{
				case "url":
					if (preg_match('/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$|^$/', $value)) {
					} else {
						$this->errors[$key] ="Invalid URL";
					}
					break;
				case "email":
					if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$|^$/", $value)) {
					} else {
						$this->errors[$key] ="Invalid Email";
					}

					break;
				default:
				}
				if ($this->rule[$key]['required']) {
					if ($value == "") {
						$this->errors[$key] ="$key required";
					}
				}
			}
		}
		//return true;
		if (count($this->errors)){
			return false;
		} else {
			return true;
		}
	}
}
?>
