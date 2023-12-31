<?php
   $image_class = new Image();
   
  $corner_image = "images/bman1.jpg"; 
  if($user_data['gender'] == "Female")
  {
    $corner_image = "images/gman.jpg";
  }
  //if image loaded to db, uplaod it to profile
  if(file_exists($user_data['profile_image']))
  {
    $corner_image = $image_class->get_thumb_profile($user_data['profile_image']);
  }
?>

  




<div class="sidebar">
      <div class="logo-details">
        <img class='bx bxl-c-plus-plus icon'  id="logo-img" src="images/BISU.png"  alt="">
          <div class="logo_name">BisuConnect</div>
          <i class='bx bx-menu' id="btn" ></i>
      </div>
      <ul class="nav-list">
        <li>
            <i class='bx bx-search' ></i>
          <input type="text" placeholder="Search...">
          <span class="tooltip">Search</span>
        </li>
        <li>
          <a href="index.php">
            <i class='bx bx-news' ></i>
            <span class="links_name">Activity Stream</span>
          </a>
          <span class="tooltip">Feed</span>
        </li>
        <li class="profilebg">
          <a href="Profile_page.php">
            <i class='bx bx-user' ></i>
            <span class="links_name">Profile</span>
          </a>
          <span class="tooltip">Profile</span>
        </li>
      <li>
        <a href="#">
          <i class='bx bx-chat' ></i>
          <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li>
      <li>
          <a href="P_logout.php"> <!-- Logout user-->
            <i class='bx bx-log-out' ></i>
            <span class="links_name">Logout</span>
          </a>
          <span class="tooltip">Logout</span>
        </li>
      <li class="profile">
          <div class="profile-details">
            
              <div class="profile_img online">
                  <img src="<?php echo $corner_image ?>" alt="profileImg">
              </div>
            <div class="name_job">
              <div class="name"><?php echo $user_data['firstName']?></div>
              <div class="job"><?php echo $user_data['lastName']?></div>
            </div>
          </div>

          <i class='bx bx-log-out' id="log_out"></i>
      </li>
      </ul>
    </div>