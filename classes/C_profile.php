<?php

Class Profile
{
	
	function get_profile($id){

		$id = addslashes($id);
		$DB = new CONNECTION_DB();
		$query = "SELECT * FROM users WHERE stud_ID = '$id' limit 1"; // stop searching after finding 1
		return $DB->read($query);

	}
}

