<?php

    $image = "images/bman1.jpg";
    if($FRIEND_ROW['gender'] == "Female")
    {
        $image = "images/gman.jpg";
    }else{

    }
?>


<div class="friends">                
    <img class="profile-friends-img" src="<?php  echo $image?>" alt="friends"><br>
    <a href="">
        <?php echo $FRIEND_ROW['firstName'] . " " . $FRIEND_ROW['lastName'] ?>
    </a>
</div>