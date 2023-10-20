<?php

class User{

    public function get_data($id)   //fetch data of users from db
    {

        $query = "SELECT * FROM users WHERE stud_ID = '$id' LIMIT 1 ";
        $DB = new CONNECTION_DB();
		$result = $DB->read($query);

        if($result){

            $row = $result[0];
            return $row;
    
        }else{
             return false;
        }
    }

    public function get_user($id) //fetch data from users_db to posts_db by foreign key stud_ID
    {

        $query = "SELECT * FROM users WHERE stud_ID = '$id' limit 1 ";

        $DB = new CONNECTION_DB();
        $result = $DB->read($query);

        if($result)
        {
            return $result[0]; 
        }else{
            return false;
        }

    }

    public function get_friends($id)
    {

        $query = "SELECT * FROM users WHERE stud_ID != '$id' ";

        $DB = new CONNECTION_DB();
        $result = $DB->read($query);

        if($result)
        {
            return $result; 
        }else{
            return false;
        }

    }


}


?>