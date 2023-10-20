<?php

class Post{

    private $error = "";

    public function create_post($stud_ID, $data) //Check if user input in post area
    {

        if(!empty($data['post'])){

            $post = addslashes($data['post']);
            $post_id = $this->create_post_id();

            $query = "INSERT INTO posts (post_id,stud_ID,post) VALUES ('$post_id','$stud_ID','$post')";

            $DB = new CONNECTION_DB();
            $DB->save($query);

        }else{
            $this->error .= "Please input something to post!<br>";
        }

        return $this->error;
    }

    public function get_posts($id)  //get the posts of the user
    {
        $query = "SELECT * FROM posts WHERE stud_ID = '$id' ORDER BY id DESC LIMIT 10";

        $DB = new CONNECTION_DB();
        $result= $DB->read($query);

        if($result){
             
            return $result;
        }else{
            return false;
        }

    }


    private function create_post_id()   //Generate random number for every post of the user
    {

        $length = rand(4,19);
        $number = "";

        for ($i=0; $i<$length; $i++ ){
            $new_rand = rand(0,9);

            $number = $number . $new_rand;
        }
        return $number;

    }


}



?>