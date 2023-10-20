<?php
  session_start();

  //print_r($_SESSION);
  include ("classes/connection.php");
  include ("classes/C_signup.php");
  include ("classes/C_login.php");
  include ("classes/C_user.php");
  include ("classes/C_post.php");

  //Check if user is logged in and if numeric to secure
  //isset($_SESSION['Bisuconnect_stud_ID']); 
  $login = new Login();
  $user_data = $login->check_login($_SESSION['Bisuconnect_stud_ID']);

  // For posting start here

  if($_SERVER['REQUEST_METHOD'] == "POST" ) //inserting post to db
  {
    $post = new Post();
    $id = $_SESSION['Bisuconnect_stud_ID'];
    $result = $post->create_post($id, $_POST);

    //To avoid resubmission of post when refreshing

    if($result == ""){
      header("Location: Profile_page.php");
      die;
    }else{
      echo "<div class='error'>";
      echo "The following errors occurred:<br><hr style='border: 1.5px solid black'>";
      print_r($result);
      echo "</div>";
    }

  }

  // to collect posts
  $post = new Post();
  $id = $_SESSION['Bisuconnect_stud_ID'];

  $posts = $post->get_posts($id, $_POST);// no_post??
 
  //to collect friends
  $user = new User();
  $id = $_SESSION['Bisuconnect_stud_ID'];

  $friends = $user->get_friends($id);


?>

<!--=== HTML ===-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>BISUconnect | Profile_page </title>
    <link rel="stylesheet" href="style/profile_style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
   <!-- LOADING PAGE-->

 <!-- White separator bar -->
<div class="mobile-separator"></div>
 <!-- MOBILE NAVBAR -->
 <div class="mobile-navbar">
  <ul>
    <li class="list">
      <a  href="index.php">
        <span class="mobile-icon">
          <i class='bx bx-news' ></i>
        </span>
        <span class="mobile-txt">Home</span>
      </a>
      </span>
    </li>
    <li class="list">
      <a href="#">
        <span class="mobile-icon">
          <i class='bx bx-chat' ></i>
        </span>
        <span class="mobile-txt">Messages</span>
      </a>
      </span>
    </li>
    <li class="list active">
      <a  href="Profile_page.php">
        <span class="mobile-icon">
          <i class='bx bx-user' ></i>
        </span>
        <span class="mobile-txt">Profile</span>
      </a>
      </span>
    </li>
    <li class="list">
      <a href="#">
        <span class="mobile-icon">
          <i class='bx bx-cog' ></i>
        </span>
        <span class="mobile-txt">Settings</span>
      </a>
      </span>
    </li>
    <li class="list">
      <a href="P_logout.php">
        <span class="mobile-icon">
          <i class='bx bx-log-out' ></i>
        </span>
        <span class="mobile-txt">Logout</span>
      </a>
      </span>
    </li>
    <div class="indicator"></div>
  </ul>
</div>
<!--===END OF MOBILE NAVBAR ===-->

 
  <!--COVER AREA -->
  <div class="container">
       <!--LEFT SIDEBAR-->
    <div class="sidebar">
      <div class="logo-details">
        <img class='bx bxl-c-plus-plus icon' id="" src="images/BISU.png"  alt="">
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
          <span class="tooltip">Files</span>
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
                  <img src="images/bman1.jpg" alt="profileImg">
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
  <!-- END OF SIDEBAR-->

  <!-- Profile Page -->
      <!-- top header -->
      <div class="profile-header">
          <h3>BisuConnect</h3>
        </div>
      <div class="profile-section">
        <div class="profile-container">
          <!-- user profile-->
          <div class="profile-box">
            <!-- Cover photo-->
            <img class="profile-bg" src="images/bg2.jpg" alt="no images">

            <!-- Profile photo-->
            <?php
              $image = "images/bman1.jpg"; 
              //if image loaded to db, uplaod it to profile
              if(file_exists($user_data['profile_image']))
              {
                $image = $user_data['profile_image'];
              }


             ?>
            <img class="profile-dp" src="<?php echo $image ?>" alt="image_profile"> 
            <div class="profile-name"> <!--retrieve username-->
            <?php echo $user_data['firstName']. " ". $user_data['lastName']  ?>
            </div>
            <!-- profile Options-->
             <br>
             <a href="User_image.php"><div class="menu-buttons">Change</div></a>
            <a href="index.php"><div class="menu-buttons">Wall</div></a>
            <div class="menu-buttons">Photos</div>
            <div class="menu-buttons">Friends</div> 
          </div>
        </div>
        <!-- below cover-->
        <div class="profile-content">
          <!-- friends area-->
          <div class="profile-friends">
            <div class="friends-bar">
              <div class="label">Friends</div> <br>
                <div class="friends-container">
                     <!--Problem: I may say add atleast 3 friends so it would fit in the desired size: SOLVED-->
                    <?php
                      if($friends)
                      {
                        foreach ($friends as $FRIEND_ROW) //It will display nth number of posts
                        {
                          include("P_user.php");
                        }
                      }
                    ?>
                </div>
              </div>
          </div>
          <!--  Post area-->
            <div class="profile-posts">
              <!--post something-->
                <div class="posts-area">
                  <form method="post" action="#">
                    <textarea name="post" id=""  placeholder="What's on your mind, <?php echo $user_data['firstName']; ?>?"></textarea>
                    <input id="posts_btn" type="submit" value="Post"> 
                    <br><br>
                  </form>
                </div><br>
              <!--profile- timeline-->
                <div class="timeline-bar">
                  <!--Your posts here!-->
                  <div class="timeline"> <!--refer to P_post.php for the content-->
                    <?php
                      if($posts)
                      {
                        foreach ($posts as $ROW) //It will display nth number of posts
                        {
                          $user = new User();
                          $ROW_user = $user->get_user($ROW['stud_ID']);

                          include("P_post.php");
                        }
                      }
                    ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

















  <!--=== Mobileview Bar Script==-->
  <script>
    const list = document.querySelectorAll('.list');
    function activeLink(){
      list.forEach((item) =>
      item.classList.remove('active'));
      this.classList.add('active');
    }
    list.forEach((item) =>
    item.addEventListener('click' , activeLink));
  </script>

  <!--=== Sidebar Script==-->
  <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
  </script>


    <!--main-->
        <!---->
</body>
</html>