<?php
    
    $databaseDate = $ROW['date']; // As $ROW['date'] contains the date from the database
    $formattedDate = date('M d, Y', strtotime($databaseDate)); //Convert databse date format to desired Month,Day and Year

?>

<div class="timeline">
    <?php

        $image = "images/bman1.jpg";
        if($ROW_user['gender'] == "Female")
        {
            $image = "images/gman.jpg";
        }else{

        }
    ?>
    <div class="timeline-img">
        <img src="<?php  echo $image ?>" alt="profile photo">
    </div>
    <div class="timeline-txt">
        <div class="label">
            <?php 
                echo $ROW_user['firstName'] . " " . $ROW_user['lastName']; // get the array or the user_DB
            ?>
        </div>
        <p>
            <?php
                echo $ROW['post']
            ?>
        </p>
        <div class="tag">
            <a href="">Like</a> .
            <a href="">Comment</a> . 
            <?php 
                echo $formattedDate;
            ?> 
        </div>
        <br><hr>
    </div>        
</div>