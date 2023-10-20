<?php
  session_start();

  //print_r($_SESSION);
  include ("classes/connection.php");
  include ("classes/C_login.php");
  include ("classes/C_user.php");
  include ("classes/C_post.php");
  include ("classes/C_image.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['Bisuconnect_stud_ID']);
  //userdata we will know whos the person who log in
	//posting starts here


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
    
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
    {
   //type to check extension
      if($_FILES['file']['type'] == "image/jpeg")
      {
        //size to check file size
        $allowed_size = (1024  * 1024) *7;
        if($_FILES['file']['size'] < $allowed_size)
        {
            //All goods
            $filename = "uploads/" . $_FILES['file']['name'] ;
            move_uploaded_file($_FILES['file']['tmp_name'], $filename);

            $image = new Image();
            $image->crop_img($filename,$filename,800,800);

            if(file_exists($filename))
            {
              $stud_ID = $user_data['stud_ID'];
              $query = "UPDATE users SET profile_image = '$filename' WHERE stud_ID =' $stud_ID' LIMIT 1 ";
      
              $DB = new CONNECTION_DB();
              $DB->save($query);
      
              header("Location: Profile_page.php");
              die;
      
            }
        }else{
          echo "<div class='error'>";
          echo "The following errors occurred:<br><hr style='border: 1.5px solid black'>";
          echo "Only images of 7MB or lower are allowed";
          echo "</div>"; 
        }

      }else
      {
        echo "<div class='error'>";
        echo "The following errors occurred:<br><hr style='border: 1.5px solid black'>";
        echo "Only images of jpeg format are allowed";
        echo "</div>";       
      }
      
    }else{
      echo "<div class='error'>";
      echo "The following errors occurred:<br><hr style='border: 1.5px solid black'>";
		  echo "please add a valid image!";
	  	echo "</div>";
    }
  }

   //   echo "<div class='error'>";
   //   echo "The following errors occurred:<br><hr style='border: 1.5px solid black'>";
		//	echo "please add a valid image!";
	//		echo "</div>";

?>


<!--=== HTML ===-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>BISUconnect | Change profile </title>
    <link rel="stylesheet" href="style/change_style.css">
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
    <div class="home-header">
       <h3>BisuConnect</h3>
    </div>
      
    <div class="profile-section">
        <!-- below cover-->
        <div class="profile-content">
          <!-- Main Area-->
          <div class="profile-friends">
            <div class="friends-bar">
              <div class="label">Change Profile Photo</div> <br>
                  <div class="posts-area">
                    <form method="post" action="" class="create-post" enctype="multipart/form-data">
                        <input type="file" name="file" id="upload-btn">
                        <input type="submit" value="Change" id="posts_btn">
                    </form>
                  </div>
              </div>
          </div>

          <div class="profile-friends">
            <div class="friends-bar">
              <div class="label">Change Cover Photo</div> <br>
                  <div class="posts-area">
                    <form method="post" action="" class="create-post" enctype="multipart/form-data">
                        <input type="file" name="file2" id="upload-btn">
                        <input type="submit" value="Change" id="posts_btn">
                    </form>
                  </div>
              </div>
          </div>
            <!-- Start Post area-->
            <!--== End of post area== -->
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