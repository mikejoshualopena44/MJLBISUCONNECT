<?php
  //print_r($_GET);

  include ("classes/autoloader.php");



  //Check if user is logged in and if numeric to secure
  //isset($_SESSION['Bisuconnect_stud_ID']); 
  $login = new Login();
  $user_data = $login->check_login($_SESSION['Bisuconnect_stud_ID']);

  //check who login


  $profile = new Profile();
  $profile_data = $profile-> get_profile($_GET['id']?? '');

  if(is_array( $profile_data))
  {
    $user_data = $profile_data[0];
  }


  // For posting start here


  if($_SERVER['REQUEST_METHOD'] == "POST" ) //inserting post to db
  {

    $post = new Post();
    $id = $_SESSION['Bisuconnect_stud_ID'];
    $result = $post->create_post($id, $_POST,$_FILES);

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
  $id = $user_data['stud_ID']; //getting from userdata to only visit other friend not access it
//  $id = $_SESSION['Bisuconnect_stud_ID'];

  $posts = $post->get_posts($id, $_POST);// no_post??
 
  //to collect friends
  $user = new User();


  $friends = $user->get_friends($id);

  $image_class = new Image();


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
      <?php include("Sidebar.php"); ?>
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
            <?php
              $image_bg = "images/main_bg.jpg"; 

              //if image loaded to db, uplaod it to profile
              if(file_exists($user_data['cover_image']))
              {
                $image_bg = $image_class->get_thumb_cover($user_data['cover_image']);
              }
             ?>
            <img class="profile-bg" src="<?php echo $image_bg ?>" alt="no images">

            <!-- Profile photo-->
            <?php
              $image = "images/bman1.jpg"; 
              if($user_data['gender'] == "Female")
              {
                $image = "images/gman.jpg";
              }
              //if image loaded to db, uplaod it to profile
              if(file_exists($user_data['profile_image']))
              {
                $image = $image_class->get_thumb_profile($user_data['profile_image']);
              }
            ?>

            <img class="profile-dp" src="<?php echo $image ?>" alt="image_profile"> 
            <a href="Profile_page.php?id=<?php echo $user_data['stud_ID']?>">
              <div class="profile-name"> <!--retrieve username-->
                <?php echo $user_data['firstName']. " ". $user_data['lastName']  ?>
              </div>
            </a>

            <!-- profile Options-->
             <br>
         <!--   <a href="index.php"><div class="menu-buttons">Wall</div></a>  -->
            <a href="User_image.php?change=profile"><div class="menu-buttons">Change Profile</div></a>
            <a href="User_image.php?change=cover"><div class="menu-buttons">Change Cover</div></a>
            <a href="Profile_page.php?section=about&id=<?php echo $user_data['stud_ID']?>"  ><div class="menu-buttons">About me</div></a>
            <a href="Profile_page.php?section=photos&id=<?php echo $user_data['stud_ID']?>"  ><div class="menu-buttons">Photos</div></a>
            <a href="Profile_page.php?section=bisuans&id=<?php echo $user_data['stud_ID']?>"><div class="menu-buttons">Bisuans</div></a>
          </div>
        </div>

        <!-- below cover-->

        <?php
          $section = "default";
          if(isset($_GET['section']))
          {
            $section = $_GET['section'];
          }
          if($section == "default")
          {
            include("profile_content_default.php");
          }
          elseif($section == "photos")
          {
            include("profile_content_photos.php");
          }
          elseif($section == "about")
          {
            include("profile_content_about.php");
          }
          elseif($section == "bisuans")
          {
            include("profile_content_bisuans.php");
          }

        ?>

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