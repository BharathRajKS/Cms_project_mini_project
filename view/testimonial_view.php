<?php
session_start();
require('../config.php');
require('../model/DB.php');

// if (!isset($_SESSION['email'])) {
//     header("Location: ./login_view.php");
//     exit();
// }

$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $profilePicturePath = '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $profilePicture = $_FILES['profile_picture'];
        $uploadDir = '../uploads/';
        $profilePicturePath = $uploadDir . basename($profilePicture['name']);
        move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);
    }

    $stmt = $conn->prepare("INSERT INTO Cms_testimonial (content, profile_picture, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $content, $profilePicturePath);

    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Submission</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
 

 * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    <?php if (!$_SESSION['is_admin']): ?>
    body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
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
            background-color: #f8f8f8;
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
            margin: 55px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 45%;
        }

        .form-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-container label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .form-container input[type="file"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-container input[type="file"]:focus,
        .form-container textarea:focus {
            border-color: #00173d;
            outline: none;
        }

        .form-container button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00173d;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #1e3d6e;
        }

        .carousel-container {
            margin-top: 20px;
            text-align: center;
        }

        .carousel {
            display: flex;
            overflow: hidden;
        }

        .testimonial-slide {
            min-width: 100%;
            box-sizing: border-box;
            padding: 20px;
            text-align: center;
        }

        .testimonial-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #00173d;
            margin-bottom: 15px;
        }

        .testimonial-text {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .testimonial-date {
            font-size: 12px;
            color: #888;
        }

        .carousel-btn {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        .carousel-btn.prev {
            margin-right: 10px;
        }

        .carousel-btn.next {
            margin-left: 10px;
        }
        /* Style the scrollbar */
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
    </style>
</head>

<body>
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
        
        <a href="../controller/fetch_testimonials.php"class="link-21">Testimonials</a>
        <a href="../view/testimonial_view.php"class="link-21">Pricing</a>
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
        <i class="fas fa-home"></i> Home
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
        <div class="form-container">
            <h2>Submit Your Testimonial</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="content">Testimonial:</label>
                <textarea id="content" name="content" rows="5" required></textarea>
                <label for="profile_picture">Upload Your Profile Picture:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
                <button type="submit">Submit</button>
            </form>
        </div>

        <!-- <div class="carousel-container">
            <h2>Testimonials</h2>
            <div class="carousel" id="testimonialCarousel">
                <?php
                $query = "SELECT content, profile_picture, created_at FROM Cms_testimonial ORDER BY created_at DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="testimonial-slide">';
                        if ($row['profile_picture'] != '') {
                            echo '<div class="testimonial-image"><img src="' . htmlspecialchars($row['profile_picture']) . '" alt="Profile Picture"></div>';
                        }
                        echo '<div class="testimonial-text">' . htmlspecialchars($row['content']) . '</div>';
                        echo '<div class="testimonial-date">' . date('F j, Y', strtotime($row['created_at'])) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No testimonials yet!</p>';
                }
                ?>
            </div>
            <button class="carousel-btn prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-btn next" onclick="nextSlide()">&#10095;</button>
        </div>
    </div> -->

    <script>
        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.testimonial-slide');
            if (index >= slides.length) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slides.length - 1;
            } else {
                currentSlide = index;
            }
            slides.forEach((slide, i) => {
                slide.style.display = (i === currentSlide) ? 'block' : 'none';
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function openNav() {
            document.getElementById("sidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("sidenav").style.width = "0";
        }

        document.getElementById('profileImage').onclick = function () {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function (event) {
            if (!event.target.matches('#profileImage')) {
                const dropdown = document.getElementById('profileDropdown');
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            }
        }

        showSlide(currentSlide);
    </script>
</body>

</html>
