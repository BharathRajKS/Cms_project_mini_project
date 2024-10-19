<?php
session_start();
require('../config.php');
require('../model/DB.php');




$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();


// post_table
$query = "SELECT id, title, short_description, content, image FROM Cms_Post_table ORDER BY id DESC";
$result = $conn->query($query);
// author_table
$authorsQuery = "SELECT id, name FROM author_table ORDER BY name ASC";
$authorsResult = $conn->query($authorsQuery);






$successMessage = isset($_GET['success']) ? $_GET['success'] : '';






$limit = 6;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


$offset = ($page - 1) * $limit;


$totalPostsQuery = "SELECT COUNT(*) AS total FROM Cms_Post_table";
$resultTotal = $conn->query($totalPostsQuery);
$totalPosts = $resultTotal->fetch_assoc()['total'];


$totalPages = ceil($totalPosts / $limit);


$query = "SELECT * FROM Cms_Post_table LIMIT $limit OFFSET $offset";
$result = $conn->query($query);










?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Post Blog & View Entries</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>


* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    <?php if (!$_SESSION['is_admin']): ?>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #ccdcec;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }

        .header {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    background-color: white;
    padding: 10px 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 80px;
}

.logo {
    margin-left: auto; 
}

.navbar {
    display: flex;
    justify-content: center; 
    flex-grow: 1; 
}

.navbar a {
    margin: 0 15px;
    text-decoration: none;
    color: #00173d;
    font-size: 18px;
    transition: color 0.3s ease;
}

.login-link {
    margin-left: 20px; 
}

        .logo-image {
            max-height: 62px;
            width: auto;
            margin-right: 10px;
        }

        .navbar {
            display: flex;
            align-items: center;
        }

        .navbar a {
            margin: 0 15px;
            text-decoration: none;
            color: #00173d;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: black;
        }

        .login-signup img {
            width: 40px;
            height: 40px;
            cursor: pointer;
            margin-left: 20px;
        }

        .profile-dropdown {
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 8px rgba(145, 145, 145, 0.91);
            min-width: 153px;
            padding: 20px;
            z-index: 1000;
            border-radius: 34px;
        }

        .profile-dropdown p {
            margin-top: 6%;
            font-weight: bold;
            font-size: x-large;
            margin-bottom: 10%;
        }

        .profile-dropdown a {
            display: block;
            color: #00173d;
            text-decoration: none;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }


        .profile-dropdown a:hover {
            background-color: #f1f1f1;
        }

        #logoutBtn {
            background-color: #00173d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #logoutBtn:hover {
            background-color: #606060;
        }

 
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #060693;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #0056b3;
        }

#loginBtn {
    background-color: #007bff; 
    color: white; 
    padding: 10px 20px; 
    border-radius: 21px;
    ; 
    border: none; 
    font-size: 16px; 
    font-weight: bold; 
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease; 
}

#profileImage{
  width: 100px;
}

#loginBtn:hover {
    background-color: #0056b3; 
    transform: scale(1.05); 
}
.link-21 {
  color: #ffffff;
  font-size: 20px;
  text-decoration: none;
  padding: 10px 20px;
  margin: 0 5px;
  display: inline-block;
  transition: all 0.4s;
}
.link-21:hover {
  letter-spacing: 2px;
}
<?php endif; ?>

    <?php if ($_SESSION['is_admin']): ?>
    body {
            font-family: 'Arial', sans-serif;
            background-color: #ccdcec;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }


    .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 9px 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 80px;

        }    


        .logo {
            display: flex;
            justify-content: space-between;
            align-items: ce nter;
            padding: 10px;
        }

        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            margin-top: 16%;
        }

        .logo-image {
            max-height: 62px;
            width: auto;
            margin-left: 10px;
        }

        .sidenav {
    height: 100%;
    width: 0; 
    position: fixed;
    z-index: 10; 
    top: 0;
    left: 0;
    background-color: #00173d; 
    overflow-x: hidden; 
    transition: 0.5s; 
    padding-top: 8%; 
}

        .sidenav .logo {
            display: block;
            margin: 0 auto;
            width: 80%;
            margin-bottom: 20px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .login-signup img {
            width: 80px;
            height: 68px;
            display: flex;
            cursor: pointer;
        }

        .profile-dropdown {
            position: absolute;
            right: 4px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(145, 145, 145, 0.91);
            min-width: 153px;
            padding: 41px;
            z-index: 1000;
            border-radius: 34px;
        }

        .profile-dropdown p {
            margin-top: 6%;
            font-weight: bold;
            font-size: x-large;
            margin-bottom: 10%;
        }

        .profile-dropdown a {
            display: block;
            color: #00173d;
            text-decoration: none;
            padding: 10px 0;
            transition: background-color 0.3s ease;
        }

        #logoutBtn {
            background-color: #00173d;
            color: white;
            padding: 12px 49px;
            border: none;
            border-radius: 48px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            font-weight: bold;
            margin-top: 12%;
        }

        #logoutBtn:hover {
            background-color: #606060;
            color: white;
        }

        .login-signup img{
          width: 80px;
          height: 68px;
          display: flex;
          cursor: pointer;
        }

.sidebar-image{
      height: 60px;
      width: 70px;

}


        #logoutBtn {
          background-color: #00173d;
    color: white;
    padding: 12px 49px;
    border: none;
    border-radius: 48px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    font-weight: bold;
    margin-top: 12%;
}

#logoutBtn:hover {
    background-color: #606060; 
    color: white; 
}

.icon {
    margin-right: 5px; 
    
}

.logout-btn {
    display: flex;
    align-items: center;
}  

<?php endif; ?>



       .container {
           flex: 1;
           width: 100%;
           background: #f8f8f8;
           color: black;
       }


       .form-container {
           background: #ffffff;
           border: 1px solid #ddd;
           border-radius: 8px;
           padding: 20px;
           margin-bottom: 20px;
           display: none;
           width: 50%;
           margin: 1% 5% 5% 5%;
       }


       .form-container.show {
           display: block;
       }


       .form-container h1 {
           margin-bottom: 20px;
           font-size: 24px;
           color: #00173d;
       }


       .form-container form {
           display: flex;
           flex-direction: column;
       }


       .form-container label {
           margin: 10px 0 5px;
           font-size: 14px;
           color: #333;
       }


       .form-container input[type="text"],
       .form-container textarea,
       .form-container input[type="file"] {
           padding: 12px;
           border: 1px solid #ddd;
           border-radius: 4px;
           margin-bottom: 10px;
       }


       .form-container textarea {
           resize: vertical;
           min-height: 120px;
       }


       .form-container button {
           padding: 12px;
           border: none;
           border-radius: 4px;
           background-color: #007bff;
           color: #fff;
           font-size: 16px;
           cursor: pointer;
           transition: background-color 0.3s;
       }


       .form-container button:hover {
           background-color: #0056b3;
       }


       .posts-container {
           margin: 5% 5%;
       }


       .posts-container h1 {
           font-size: 28px;
           margin-bottom: 20px;
           color: #00173d;           ;
           border-bottom: 2px solid #000;
           padding-bottom: 10px;
       }


       .posts-row {
           display: flex;
           flex-wrap: wrap;
           gap: 20px;
       }


       .post {
           padding: 20px;
           border-radius: 8px;
           width: calc(33.333% - 20px);
           box-sizing: border-box;
           margin-bottom: 20px;
           display: flex;
           flex-direction: column;
           background-color: white;
       }


       .post img {
           width: 100%;
           height: 169px;

           object-fit: cover;
           border-radius: 4px;
           margin-bottom: 15px;
       }


       .post h2 {
           margin: 0 0 10px;
           font-size: 20px;
           color: #00173d;
           ;
       }


       .post p {
           margin: 0 0 10px;
           font-size: 16px;
           color: #00173d;           ;
           overflow: hidden;
           display: -webkit-box;
           -webkit-line-clamp: 3;
           -webkit-box-orient: vertical;
           text-overflow: ellipsis;
       }


       .post a {
           color: #00173d;           ;
           text-decoration: none;
           font-weight: bold;
       }




       .toggle-button {
           margin: 2% 2%;
           padding: 12px 20px;
           border: none;
           border-radius: 4px;
           background-color: #6695c5;
           color: black;
           font-size: 16px;
           cursor: pointer;
           font-size: medium;
       }




       .error {
           color: red;
           font-size: 0.875rem;
           margin-top: 5px;
       }




   #postContent img {
   width: 350px;
   height: 193px;

   margin: 5% 4% 6% 24%;}


   #postDrawer {
           position: fixed;
           right: -1000px;
           top: 0;
           width: 66%;
           height: 100%;
           background-color: white;
           box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
           transition: right 0.5s ease;
           padding: 20px;
           overflow-y: scroll;
           /* display: none; */
       }
       #postDrawer.active {
           right: 0;
           /* display: block; */
       }
       .close-btn {
           cursor: pointer;
           float: right;
           padding: 5px 10px;
           background-color: #333;
           color: white;


       }
       #postDrawer span{
           cursor: pointer;
       }
       #postDrawer p{
        margin-top: 7%;
       }
       #postDrawer p{
        margin-top: 7%;
       }
       #editBtn{
       margin-right: 10px;
           padding: 12px 28px;
           background-color: #060693;
           color: white;
           text-decoration: none;
           border-radius: 5px;
           height: 45px;
           width: 119px;
           z-index: 1000;
   }
   .modal {
       display: none;
       position: fixed;
       z-index: 1;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
     
       background-color: rgba(0, 0, 0, 0.6);
       overflow-x: hidden;
      
   }
   .modal-content {
       background-color: #fff;
       margin: 15% auto;
       padding: 20px;
       border-radius: 32px;
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
       width: 90%;
       max-width: 600px;
       margin: 3% 27%;
       margin-top: 1%;
   }


   h2 {
       text-align: center;
       color: #333;
   }
   label {
       display: block;
       margin: 10px 0 5px;
       color: #555;
   }


   input[type="text"],
   textarea {
       width: calc(100% - 20px);
       padding: 10px;
       margin-bottom: 15px;
       border: 1px solid #ccc;
       border-radius: 4px;
       font-size: 16px;
    
   }
  
   textarea {
   width: calc(100% - 20px);
   padding: 10px;
   margin-bottom: 15px;
   border: 1px solid #ccc;
   border-radius: 4px;
   font-size: 16px;
   height: 150px;
   
 
}
input[type="file"] {
       margin: 15px 0;
   }
   .action-buttons {
           margin-top: 20px;
       }
       .action-buttons a {
           margin-right: 10px;
           padding: 12px 28px;
           background-color: #060693;
           color: white;
           text-decoration: none;
           border-radius: 5px;
           transition: background-color 0.3s;
       }
       .action-buttons a:hover {
           background-color: #0056b3;
       }
       .action-buttons a.delete {
           background-color: #060693;
       }
       .action-buttons a.delete:hover {
           background-color: #c82333;
       }




       .footer {
      background-color:#bdbdbd;
      color: white;
      text-align: center;
      padding: 30px 0;
    }

    .footer-logo img {
      max-height: 62px;
      margin-bottom: 10px;
      
    }

    .footer-links a {
      color: #00173d;
      text-decoration: none;
      margin: 0 10px;
    }

    .footer-links a:hover {
      text-decoration: underline;
    }



::-webkit-scrollbar {
   width: 8px;
   height: 8px;
}




::-webkit-scrollbar-track {
   background-color: #f1f1f1;
}




::-webkit-scrollbar-thumb {
   background-color: #060693;
   border-radius: 10px;
}


::-webkit-scrollbar-thumb:hover {
   background-color: #0056b3;
}
.sidebar-container{
   color: red;
}
.notification {
   position: fixed;
   top: 5%;
   left: 50%;
   transform: translate(-50%, -50%);
   background-color: #4caf50;
   color: white;
   padding: 15px;
   border-radius: 10px;
   z-index: 1000;
   opacity: 0;
   transition: opacity 0.5s, transform 0.5s;
   width: 200px;
   height: auto;
}


.notification.show {
   opacity: 1; 
}


.notification.hidden {
   opacity: 0; 
}

.pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 34px 9px;
    margin-left: 77%;
}

.pagination-button {
    background-color: #007BFF; 
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 25px;
    ;
    cursor: pointer;
    margin: 0 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.pagination-button:disabled {
    background-color: #A9A9A9; 
    cursor: not-allowed;
}

.pagination-button:hover:not(:disabled) {
    background-color: #0056b3; 
}

#pageNumbers {
    display: flex;
    align-items: center;
    margin: 0 10px;
}

.page-number {
    padding: 10px 15px;
    margin: 0 5px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.page-number:hover {
    background-color: #f0f0f0; 
}

.page-number.active {
    background-color: #007BFF; 
    color: white;
    border-radius: 25px;;
}






.post:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); 
}




   </style>
</head>
<body>




<div id="successMessage" class="notification hidden"></div>





<?php if (!$_SESSION['is_admin']): ?>


<div class="header">
    <div class="logo">
        <a href="../view/Home_view.php">
            <img src="../view/src/Contentmanageent_-removebg-preview.png" alt="CMC_Management Logo" class="logo-image" />
        </a>
    </div>

    <div class="navbar">
        <a href="../view/Home_view.php"class="link-21">Home</a>
        <a href="../view/blog_view.php"class="link-21">Blog</a>
        
        <a href="../controller/Testimonial.php"class="link-21">Testimonials</a>
        <a href="../view/price_page.php"class="link-21">Pricing</a>
        <?php if ($_SESSION['is_admin']): ?>
            <a href="../controller/counts.php"class="link-21">Admin Dashboard</a>
        <?php endif; ?>
    </div>

    <div class="login-link">
        <?php if (isset($_SESSION['email'])): ?>
            <img src="../view/src/download (1).png" alt="Profile" id="profileImage" />
            <div id="profileDropdown" class="profile-dropdown">
                <p><?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?></p>
                <div style="display: flex; align-items: center;">
                    <a href="../view/blog_view.php">
                        <i class="fa-solid fa-blog" style="margin-right: 10px;"></i> Blog
                    </a>
                </div>
                <form method="POST" action="../controller/logout.php" style="margin-top: 10%;">
                    <button type="submit" id="logoutBtn">Logout</button>
                </form>
            </div>
            <?php else: ?>
        <button id="loginBtn" onclick="window.location.href='./login_view.php'">Login</button>
    <?php endif; ?>
    </div>
</div>


<?php endif; ?>






<!-- ---------------------admin header content--------------- -->
<?php if ($_SESSION['is_admin']): ?>
<div class="header">
        <div class="logo">
            <span class="menu-icon" onclick="openNav()">&#9776;</span>
            <a href="../view/Home_view.php">
                <img src="../view/src/Contentmanageent_-removebg-preview.png" alt="CMC_Management Logo" class="logo-image" />
            </a>
        </div>

        
        <div class="login-signup" id="auth-links">
            <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
                <img src="../view/src/download__1_-removebg-preview.png" alt="Profile" id="profileImage" style="cursor: pointer;" />
                <div id="profileDropdown" style="display: none;" class="profile-dropdown">
                    <p>
                        <i class="fa-solid fa-user" style="margin-right: 10px; margin-left: 10%;"></i>
                        <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; ?>
                    </p>

                    
                    <div style="display: flex; align-items: center;">
                        <a href="../view/blog_view.php" style="display: flex; align-items: center; margin-left: 9%;">
                            <i class="fa-solid fa-blog" style="margin-right: 10px;"></i>Blog
                        </a>
                    </div>
                    <?php if ($_SESSION['is_admin']): ?>
                        <div style="display: flex; align-items: center;">
                            <a href="../view/testimonial_view.php" style="display: flex; align-items: center; margin-left: 9%;">
                                <i class="fa-solid fa-user-edit" style="margin-right: 10px;"></i> Testimonial
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['is_admin']): ?>
    <div style="display: flex; align-items: center;">
        <a href="../controller/counts.php" style="display: flex; align-items: center; margin-left: 9%;">
            <img src="../view/src/admin.png" alt="Admin Dashboard Icon" style="margin-right: 10px; width: 20px; height: 20px;"> Admin Dashboard 
        </a>
    </div>
<?php endif; ?>
                    <form method="POST" action="../controller/logout.php" style="margin-top: 10%;">
                        <button type="submit" id="logoutBtn">Logout</button>
                    </form>
                </div>
            <?php else: ?>
                <a href="./login_view.php" style="margin-left: 10px;">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="sidenav" id="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="../view/Home_view.php">
        <i class="fas fa-home"></i> Home overview
    </a>
    <a href="../view/blog_view.php">
        <i class="fab fa-blogger"></i> Blog
    </a>
    <a href="../view/testimonial_view.php">
        <i class="fab fa-wpforms"></i> Testimonials
    </a>
</div>

<?php endif; ?>





<div class="container">
<?php if ($_SESSION['is_admin']): ?>
  
   <button
   class="toggle-button"
   onclick="toggleForm()"
   style="display: flex; align-items: center; border: none; font-weight: bold; padding: 10px; border-radius: 5px; cursor: pointer;">
  
   <i class="fab fa-wpforms" style="margin-right: 8px;"></i>
   <span>Create Blog</span>
</button>


<?php endif; ?>




<!-- <div id="successMessage" class="notification hidden"></div> -->


<div id="blogModal" class="modal" style="display: none;">
   <div class="modal-content">
      
       <span class="close-button" onclick="closeModal()">&times;
  
       </span>
       <h4 style="
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 23px;
">Create Blog</h4>
       <form id="blogForm" method="post" enctype="multipart/form-data">
          
           <!-- <span>Create Blog</span> -->


           <label for="title">Title: <span style="color: red;">*</span></label>
           <input type="text" id="title" name="title">
           <div id="titleError" class="error"></div>


           <label for="short_description">Short Description:</label>
           <textarea id="short_description" name="short_description"></textarea>


           <label for="content">Content: <span style="color: red;">*</span></label>
           <textarea id="content" name="content"></textarea>
           <div id="contentError" class="error"></div>


           <label for="author">Author: <span style="color: red;">*</span></label>
           <select id="author" name="author">
               <option value="">Select Author</option>
               <?php if ($authorsResult->num_rows > 0): ?>
                   <?php while ($author = $authorsResult->fetch_assoc()): ?>
                       <option value="<?php echo htmlspecialchars($author['id']); ?>">
                           <?php echo htmlspecialchars($author['name']); ?>
                       </option>
                   <?php endwhile; ?>
               <?php else: ?>
                   <option value="">No authors available</option>
               <?php endif; ?>
           </select>
           <div id="authorError" class="error"></div>


           <label for="image">Image (optional):</label>
           <input type="file" id="image" name="image">
          
           <button type="submit">Post Blog Entry</button>
       </form>
   </div>
</div>




<div class="posts-container">
   <h1>
       <i class="fa-solid fa-blog" style="margin-right: 10px;"></i>
       All Blog Posts
   </h1>
   <div class="pagination">
    <button id="prevPage" class="pagination-button" disabled>&lt;</button>
    <div id="pageNumbers"></div>
    <button id="nextPage" class="pagination-button" disabled>&gt;</button>
</div>


   <div class="posts-row">

  


       <?php while ($row = $result->fetch_assoc()): ?>
           <div class="post" id="<?php echo htmlspecialchars($row['id']); ?>" onclick="openDrawer(<?php echo htmlspecialchars($row['id']); ?>)">
               <?php if (!empty($row['image'])): ?>
                   <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
               <?php endif; ?>
               <h2><?php echo htmlspecialchars($row['title']); ?></h2>
               <p><?php echo htmlspecialchars($row['short_description']); ?></p>
           </div>
       <?php endwhile; ?>
   </div>










 
</div>




<div id="postDrawer">
   <span onClick="closeDrawer()">x</span>
   <div id="postContent"></div>
 




   </div>






   <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Post</h2>
        <form id="editPostForm" enctype="multipart/form-data">
            <input type="hidden" id="postId" name="id"> 
            
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" required></textarea>

            <label for="content">Content</label>
            <textarea id="content" name="content" required></textarea>

            <label for="image">Post Image (optional)</label>
            <input type="file" id="image" name="image">

            <button type="button" id="updateButton">Update Post</button>
        </form>
    </div>
</div>
  <!-- Footer -->
  <footer class="footer">
    <div class="footer-logo">
      <img src="../view/src/Contentmanageent_-removebg-preview.png" alt="CMC_Management Logo">
    </div>
    <div class="footer-links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Use</a>
      <a href="#">Contact Us</a>
    </div>
  </footer>

</div>


<script>




   function toggleForm() {
   const modal = document.getElementById("blogModal");
   modal.style.display = modal.style.display === "none" ? "block" : "none";
}


function closeModal() {
   document.getElementById("blogModal").style.display = "none";
}




window.onclick = function(event) {
   const modal = document.getElementById("blogModal");
   if (event.target === modal) {
       modal.style.display = "none";
   }
}


// --------------------delete Ajax callbacks--------------------


function deletePost(postId) {
   Swal.fire({
       title: "Are you sure?",
       text: "You won't be able to Delete this!",
       icon: "warning",
       showCancelButton: true,
       confirmButtonColor: "#3085d6",
       cancelButtonColor: "#d33",
       confirmButtonText: "Yes, delete it!"
   }).then((result) => {
       if (result.isConfirmed) {
           const xhr = new XMLHttpRequest();
           xhr.open('POST', '../controller/post_delete.php', true);
           xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


           xhr.onreadystatechange = function() {
               if (xhr.readyState === 4 && xhr.status === 200) {
                   const response = JSON.parse(xhr.responseText);


                   if (response.success) {
                   
                       Swal.fire({
                           title: "Deleted!",
                           text: "Your post has been deleted successfully.",
                           icon: "success",
                           timer: 3000,
                           showConfirmButton: false
                       });


                       const postElement = document.getElementById(`${postId}`);
                       if (postElement) {
                           document.getElementById("postDrawer").classList.remove("active");
                           postElement.remove();
                       }


                   } else {
                   
                       Swal.fire({
                           title: "Error!",
                           text: `Error deleting post: ${response.message}`,
                           icon: "error"
                       });
                   }
               }
           };


           xhr.send(`id=${postId}`);
       }
   });
}



// ------- -----------------edit Ajax -------------------------

function openEditModal(postId) {
    const editModal = document.getElementById('editModal');
    editModal.style.display = "block";

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../controller/fetch_post.php?id=${postId}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                console.log(response); // Log the response for debugging

                if (response.success) {
                    document.getElementById('postId').value = response.post.id; 
                    document.getElementById('title').value = response.post.title;
                    document.getElementById('short_description').value = response.post.short_description;
                    document.getElementById('content').value = response.post.content;

                    const postImage = document.getElementById('postImage');
                    postImage.src = `../uploads/${response.post.image}`; 
                    postImage.style.display = "block"; 
                } else {
                    alert('Error fetching post details: ' + response.message);
                }
            } else {
                alert('Failed to fetch post details: ' + xhr.status);
            }
        }
    };
    xhr.send();
}

function closeModal() {
    document.getElementById('editModal').style.display = "none";
}

document.getElementById('updateButton').addEventListener('click', function() {
    const form = document.getElementById('editPostForm');
    const formData = new FormData(form); 

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/post_edit.php', true); 

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                alert('Post updated successfully!');
                updatePostInUI(response.post);
                closeModal(); 
            } else {
                alert('Error updating post: ' + (response.message || 'Unknown error'));
            }
        }
    };

    xhr.send(formData); 
});

function updatePostInUI(post) {
    const postElement = document.getElementById(`post-${post.id}`); 
    if (postElement) {
        postElement.querySelector('.post-title').innerText = post.title;
        postElement.querySelector('.post-short-description').innerText = post.short_description;
        postElement.querySelector('.post-content').innerHTML = post.content;
        
        const imgElement = postElement.querySelector('img'); 
        imgElement.src = `../uploads/${post.image}`; 
    }
}










// -----------------blog AJAx


document.getElementById('blogForm').addEventListener('submit', function(event) {
    event.preventDefault();

    document.getElementById('titleError').textContent = '';
    document.getElementById('contentError').textContent = '';
    document.getElementById('authorError').textContent = '';

    const formData = new FormData(this);

    let isValid = true;

    if (!formData.get('title')) {
        document.getElementById('titleError').textContent = 'Title is required.';
        isValid = false;
    }

    if (!formData.get('content')) {
        document.getElementById('contentError').textContent = 'Content is required.';
        isValid = false;
    }

    if (!formData.get('author')) {
        document.getElementById('authorError').textContent = 'Author is required.';
        isValid = false;
    }

    if (!isValid) {
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/post_blog.php', true);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
    const successMessage = document.getElementById('successMessage');
    
    successMessage.textContent = 'Posted successfully!';
    successMessage.classList.remove('hidden');
    successMessage.classList.add('show');

    document.getElementById('blogForm').reset();

    if (typeof closeModal === 'function') {
        closeModal();
    }

    addPostToDOM(response.postId, formData.get('title'), formData.get('short_description'), formData.get('content'), response.image);

    fetchPosts(1); 

    setTimeout(function() {
        successMessage.classList.add('hidden'); 
        successMessage.classList.remove('show'); 
    }, 3000); 
}else {
                document.getElementById('titleError').textContent = response.errors.title || '';
                document.getElementById('contentError').textContent = response.errors.content || '';
                document.getElementById('authorError').textContent = response.errors.author || '';
            }
        }
    };

    xhr.send(formData);
});

function addPostToDOM(postId, title, short_description, image) {
    const postContainer = document.querySelector('.posts-row');
    const newPost = document.createElement('div');
    newPost.classList.add('post');
    newPost.setAttribute('id', postId);
    newPost.onclick = function() {
        openDrawer(postId);
    };

    const imageUrl = image ? `../uploads/${image}` : '../uploads/default-image.jpg';

    newPost.innerHTML = `
        <h2>${title}</h2>
        <p>${short_description}</p>
    
        <img src="${imageUrl}" alt="${title}" onerror="this.onerror=null; this.src='../uploads/default-image.jpg'">
    `;

    postContainer.prepend(newPost); 
}



// ----------------------------pagenation 
let currentPage = 1; 
const postsPerPage = 6; 
let totalPosts = 0; 
let totalPages = 0; 

function fetchPosts(page) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../controller/get_posts.php?page=${page}&limit=${postsPerPage}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                totalPosts = response.totalPosts;
                totalPages = Math.ceil(totalPosts / postsPerPage); 

                
                if (totalPosts > 0 && totalPages === 0) {
                    totalPages = 1;
                }

       
                const postContainer = document.querySelector('.posts-row');
                postContainer.innerHTML = '';

         
                response.posts.forEach(post => {
                    addPostToDOM(post.id, post.title, post.short_description,  post.image);
                });

                updatePagination();
            } else {
                console.error(response.message);
            }
        }
    };
    xhr.send();
}

function updatePagination() {
    const paginationContainer = document.getElementById('pageNumbers');
    paginationContainer.innerHTML = ''; 

    if (totalPages > 1) {
        for (let i = 1; i <= totalPages; i++) {
            const pageNumber = document.createElement('span');
            pageNumber.classList.add('page-number');
            pageNumber.textContent = i;

            if (i === currentPage) {
                pageNumber.classList.add('active'); 
            }

            pageNumber.addEventListener('click', function () {
                currentPage = i;
                fetchPosts(currentPage); 
            });

            paginationContainer.appendChild(pageNumber); 
        }
    } else if (totalPages === 1) {
     
        const pageNumber = document.createElement('span');
        pageNumber.classList.add('page-number', 'active');
        pageNumber.textContent = 1;
        paginationContainer.appendChild(pageNumber); 
    }

    document.getElementById('prevPage').disabled = currentPage === 1;
    document.getElementById('nextPage').disabled = currentPage === totalPages;
}

document.getElementById('prevPage').addEventListener('click', function () {
    if (currentPage > 1) {
        currentPage--;
        fetchPosts(currentPage); 
    }
});

document.getElementById('nextPage').addEventListener('click', function () {
    if (currentPage < totalPages) {
        currentPage++;
        fetchPosts(currentPage); 
    }
});

function addPostToDOM(postId, title, short_description,  image) {
    const postContainer = document.querySelector('.posts-row');
    const newPost = document.createElement('div');
    newPost.classList.add('post');
    newPost.setAttribute('id', postId);
    newPost.onclick = function() {
        openDrawer(postId); 
    };
    newPost.innerHTML = `
        <h2>${title}</h2>
        <p>${short_description}</p>
       
        <img src="../uploads/${image ? image : 'default-image.jpg'}" alt="${title}" onerror="this.onerror=null; this.src='../uploads/default-image.jpg'">
    `;
    postContainer.appendChild(newPost); 
}


fetchPosts(currentPage);

// --------------------------------author name-------------
   document.getElementById('author').addEventListener('change', function () {
   const authorName = this.options[this.selectedIndex].text;
   const contentField = document.getElementById('content');


   if (contentField.value.trim() === '') {
       contentField.value = `Author: ${authorName}\n\n`;
   }


   else {
       const lines = contentField.value.split('\n');
       if (lines[0].startsWith('Author:')) {
           lines[0] = `Author: ${authorName}`;
           contentField.value = lines.join('\n');
       }
        else {


           contentField.value = `Author: ${authorName}\n\n` + contentField.value;
       }
   }
});




 // -------------------------------Post Details
 function openDrawer(postId) {
    document.getElementById("postDrawer").classList.add("active");

    const newUrl = `?id=${postId}`;
    window.history.pushState({ path: newUrl }, '', newUrl);

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../controller/fetch_post.php?id=" + postId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            const postContent = document.getElementById("postContent");

            const imagePath = response.image ? `../uploads/${response.image}` : 'default-image.jpg';

            postContent.innerHTML = `
                <h2>${response.title}</h2>
                <p>${response.short_description}</p>
                <p>${response.content}</p>
                <img src="${imagePath}" alt="Post Image">

                <?php if ($_SESSION['is_admin']): ?>
                <div class="action-buttons">
                    <button id="editBtn" onclick="openEditModal(${response.id})">Edit</button>
                    <a href="javascript:void(0);" class="delete" id="${response.id}" onclick="deletePost(${response.id})">Delete</a>
                </div>
                <?php endif; ?>
            `;
        }
    };
    xhr.send();
}







function closeDrawer() {
   document.getElementById("postDrawer").classList.remove("active");
   window.history.pushState({}, '', './blog_view.php'); 
}




window.onload = function() {
   const urlParams = new URLSearchParams(window.location.search);
   if (urlParams.has('id')) {
       document.getElementById("postDrawer").classList.add("active");
   }
};






// ----------------------Edit form
var modal = document.getElementById("editModal");
   var btn = document.getElementById("editBtn");
   var span = document.getElementsByClassName("close")[0];


   btn.onclick = function() {
       modal.style.display = "block";
   }
   span.onclick = function() {
       modal.style.display = "none";
   }
   window.onclick = function(event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }



   document.getElementById("editPostForm").addEventListener("submit", function(event) {
       var valid = true;
      
       var title = document.getElementById("title");
       var shortDescription = document.getElementById("short_description");
       var content = document.getElementById("content");


       var titleError = document.getElementById("titleError");
       var shortDescError = document.getElementById("shortDescError");
       var contentError = document.getElementById("contentError");


    
       titleError.textContent = "";
       shortDescError.textContent = "";
       contentError.textContent = "";


       title.classList.remove("invalid");
       shortDescription.classList.remove("invalid");
       content.classList.remove("invalid");


       if (title.value.trim() === "") {
           valid = false;
           titleError.textContent = "Title is required.";
           title.classList.add("invalid");
       }




       if (shortDescription.value.trim() === "") {
           valid = false;
           shortDescError.textContent = "Short description is required.";
           shortDescription.classList.add("invalid");
       }


  
       if (content.value.trim() === "") {
           valid = false;
           contentError.textContent = "Content is required.";
           content.classList.add("invalid");
       }


       if (!valid) {
           event.preventDefault();
       }
   });
  
   var modal = document.getElementById("editModal");
   var btn = document.getElementById("editBtn");
   var span = document.getElementsByClassName("close")[0];


btn.onclick = function() {
   modal.style.display = "block";
   document.body.classList.add("modal-open"); }


span.onclick = function() {
   modal.style.display = "none";
   document.body.classList.remove("modal-open");
}


window.onclick = function(event) {
   if (event.target == modal) {
       modal.style.display = "none";
       document.body.classList.remove("modal-open");
   }
}



// ----------------------profile page  -----------------



document.getElementById('profileImage').onclick = function (event) {
    event.stopPropagation(); 
    const dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}


window.onclick = function (event) {
    const dropdown = document.getElementById('profileDropdown');
    if (dropdown.style.display === 'block' && !event.target.matches('#profileImage') && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
    }
}


showSlide(currentSlide);

function openNav() {
    document.getElementById("sidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("sidenav").style.width = "0";
}













</script>
</body>
</html>



