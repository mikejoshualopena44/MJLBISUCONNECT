<?php



class Post{

    private $error = "";

    public function create_post($stud_ID, $data, $files) //Check if user input in post area
    {

        if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image'])|| isset($data['is_cover_image'])){

            $myimage ="";
            $has_image = 0;
            $is_profile_image = 0;
            $is_cover_image = 0;

            //to separate Images between Profile,cover and Posts
            if(isset($data['is_profile_image'])|| isset($data['is_cover_image']))
            {
                $myimage = $files;
                $has_image = 1;
                
                
                if(isset($data['is_profile_image']))
                {
                    $is_profile_image = 1;
                }
                if(isset($data['is_cover_image']))
                {
                    $is_cover_image = 1;
                }

            }else
            { // check actual file

                if(!empty($files['file']['name']))
                {

                    $folder = "uploads/" . $stud_ID . "/";

                    //create folder for every user
        
                    if(!file_exists($folder))
                    {
                    mkdir($folder,0777,true);
                    }
        
                    $image_class = new Image();
        
                    //create random folder name
                    $myimage = $folder . $image_class->generate_filename(15).".jpg" ;
                    move_uploaded_file($_FILES['file']['tmp_name'], $myimage);

                    $image_class->resize_img($myimage,$myimage,1500,1500);
                    
                    $has_image = 1;
                }
            }

            $post = "";
            if(isset($data['post'])){
                $post = addslashes($data['post']);
            }

            $post = addslashes($data['post']) ;
            $post_id = $this->create_post_id();

            $query = "INSERT INTO posts (post_id,stud_ID,post,image,has_image,is_profile_image,is_cover_image ) VALUES ('$post_id','$stud_ID','$post','$myimage','$has_image','$is_profile_image','$is_cover_image' )";

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