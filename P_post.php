<?php
    
    $databaseDate = $ROW['date']; // As $ROW['date'] contains the date from the database
    $formattedDate = date('M d, Y', strtotime($databaseDate)); //Convert databse date format to desired Month,Day and Year

?>

<div class="timeline">
    <!-- User Default Photo-->
    <?php

        $image = "images/bman1.jpg";
        if($ROW_user['gender'] == "Female")
        {
            $image = "images/gman.jpg";
        }

        if(file_exists($ROW_user['profile_image']))
        {
            $image = $image_class->get_thumb_profile($ROW_user['profile_image']);
        }
    ?>
     <!-- User Photo-->
    <div class="timeline-img">
        <img src="<?php  echo $image ?>" alt="profile photo">
    </div>

     <!-- Name and Date-->
    <div class="timeline-txt">
        <div class="label">
            <?php 
                echo $ROW_user['firstName'] . " " . $ROW_user['lastName']; // get the array or the user_DB

                if($ROW['is_profile_image'])
                {  
                    $pronoun = "his";
                    if($ROW_user['gender'] =="Female" )
                    {
                        $pronoun = "her";
                    }
                    echo"<span style='color: white ; font-weight:normal'> updated $pronoun profile image </span>";
                }

                if($ROW['is_cover_image'])
                {  
                    $pronoun = "his";
                    if($ROW_user['gender'] =="Female" )
                    {
                        $pronoun = "her";
                    }
                    echo"<span style='color: white ; font-weight:normal'> updated $pronoun cover photo </span>";
                }
            ?>
        </div>
        <div class="date">
            <?php 
                echo $formattedDate;
            ?>
        </div>
        <div class="edit">
            <a href="edit.php">
                Edit
            </a>.
            <a href="delete.php">
                Delete
            </a>
                
        </div>
        
        <br><br>
            <!-- Media posts -->
            <div class="posted-image">
                <?php //location C_image 
                    if (file_exists($ROW['image'])) {
                        $post_img = $image_class->get_thumb_posts($ROW['image']);
                        echo "<img src='$post_img' class='custom-image-class' />";
                    }
                ?>
            </div>

            <br>
            <!-- Caption -->
            <div class="posted-text">
                <?php
                    echo $ROW['post']
                ?>
            </div>


        <div class="tag">
            <div class="left-icons">
                <a href=""><i class='bx bx-heart bx-lg'></i></a>
                <a href=""><i class='bx bx-message-dots bx-lg'></i></a>
                <a href=""><i class='bx bx-share-alt bx-lg'></i></a>
            </div>
            <div class="right-icons">
                <i class='bx bx-bookmark-plus bx-lg'></i>
            </div>
        </div>

        <br>
        <hr>
    </div>        
</div>