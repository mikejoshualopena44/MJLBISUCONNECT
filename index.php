<?php
  //print_r($_SESSION);
  include ("classes/autoloader.php");

  //Check if user is logged in and if numeric to secure
  //isset($_SESSION['Bisuconnect_stud_ID']); 
  $login = new Login();
  $user_data = $login->check_login($_SESSION['Bisuconnect_stud_ID']);

  // For posting start here

  if($_SERVER['REQUEST_METHOD'] == "POST" ) //inserting post to db
  {
    $post = new Post();
    $id = $_SESSION['Bisuconnect_stud_ID'];
    $result = $post->create_post($id, $_POST,$files);

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

  //change image in sidebar
  $corner_image = "images/bman1.jpg";

  if(isset($user_data))
  {
    $corner_image = $user_data['profile_image'];
  }

?>

<!--=== HTML ===-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>BISUconnect | Home_page </title>
    <link rel="stylesheet" href="style/style_index.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
   <!-- LOADING PAGE-->
 <!-- MOBILE NAVBAR -->
 <!-- White separator bar -->
<div class="mobile-separator"></div>
 <div class="mobile-navbar">
  <ul>
    <li class="list active">
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
    <li class="list">
      <a href="Profile_page.php">
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
        <li class="profilebg">
          <a href="index.php">
            <i class='bx bx-news' ></i>
            <span class="links_name">Activity Stream</span>
          </a>
          <span class="tooltip">Files</span>
        </li>
        <li>
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
  <!-- END OF SIDEBAR-->

  <!-- === Announcement -->

  <section class="ancmnt-container">
	<div class="ancmnt-bar">
    <div class="home-header">
        <h3>BisuConnect</h3>
    </div>
		<div class="slider">
      <img id="slide-1" src="images/BISU_bg.jpg" alt=" Announcement Image" />
      <img id="slide-2" src="images/BISU_bg6.png" alt=" Announcement Image" />
      <img id="slide-3" src="images/BISU_bg2.jpg" alt=" Announcement Image" />
      <img id="slide-4" src="images/BISU_bg3.jpg" alt=" Announcement Image" />
      <img id="slide-5" src="images/BISU_bg4.jpg" alt=" Announcement Image" />
      <img id="slide-6" src="images/BISU_bg5.jpg" alt=" Announcement Image" />
      <img id="slide-7" src="images/BISU_bg6.jpg" alt=" Announcement Image" />
		</div>
		<div class="slider-nav">
			<a href="#slide-1"></a>
			<a href="#slide-2"></a>
			<a href="#slide-3"></a>
      <a href="#slide-4"></a>
			<a href="#slide-5"></a>
      <a href="#slide-6"></a>
		</div>
	</div>
</section>
<!-- -=== End of Annucement -->

    <div class="profile-section">
        <!-- below cover-->
        <div class="profile-content">
          <!-- friends area-->

          <div class="org-container">
            <div class="org-bar">
              <div class="label">Announcements</div> <br>
                <a href="#">
                  <img class="org-logo" src="images/ICPEP.jpg" alt="friends"><br>  
                </a>
                <a href="#">
                  <img class="org-logo" src="images/cea.jpg " alt="friends"><br>  
                </a> 
                <a href="#">
                  <img class="org-logo" src="images/BISU.jpg " alt="friends"><br>  
                </a>     
              </a>
              </div>
          </div>
          <!-- Start Post area-->
            <div class="profile-posts">
              <!--post something-->
                <div class="posts-area">
                  <form action="" class="create-post">
                      <div class="profile-photo">
                          <img src="images/bman1.jpg" alt="">
                      </div>
                      <input name="post" id="create-post"  placeholder="What's on your mind, <?php echo $user_data['firstName']; ?>?">
                      <input type="submit" value="Post" id="posts_btn">
                  </form>
                </div>
              <!--profile- timeline-->
                <div class="timeline-bar">
                  <!--Your posts here!-->
                  <div class="timeline"> <!--refer to P_post.php for the content-->

                  <div class="friends-container">
                     <!--Problem: I may say add atleast 3 friends so it would fit in the desired size: SOLVED-->
                    <?php
                      $image_class = new Image();
                      if($friends)
                      {
                        foreach ($friends as $FRIEND_ROW) //It will display nth number of posts
                        {
                          include("P_user.php");
                        }
                      }
                    ?>
                </div>
<!--                 

                    -->
                  </div>
              </div>
            </div>
            <!--== End of post area== -->
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