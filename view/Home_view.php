

<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMC_Management</title>
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
            background-color: #00173d;
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



header {
    background-color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header img {
    width: 150px;
}

header ul {
    list-style: none;
    display: flex;
    gap: 25px;
}

header a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    transition: color 0.3s ease;
}

header a:hover {
    color: #ff6f61;
}

.hero {
    position: relative;
    text-align: center; 
    overflow: hidden;
     height :400px;
}

.hero-image {
    position: absolute; 
    top: 0; 
    left: 0;
    width: 100%; 
    height: 100%; 
    object-fit: cover; 
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 1; 
    color: white; 
    padding: 50px; 
}

.hero h1 {
  margin-top: 7%;

    font-size: 2.5rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px; 
    color: white;

}

.cta-button {
  background-color: #2942A4;
    color: white;
    padding: 15px 51px;
    text-decoration: none;
    border-radius: 50px;
}





.trusted-by {
    padding: 40px 20px;
    background-color: #fff;
    text-align: center;
}

.trusted-by h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #00173d;
    margin-top: 5%;

}

.trusted-companies {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20%;
    ; 
}

.trusted-companies img {
    width: 216px;  
    height: 120px; 
    object-fit: contain; 
    opacity: 0.8; 
    transition: opacity 0.3s;
}

.trusted-companies img:hover {
    opacity: 1; 
}




.features {
    padding: 60px 20px;
    background-color: #f8f8f8;
    text-align: center;
}

.features h2 {
  font-size: 2em;

    color: #00173d;
    margin-bottom: 40px;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.feature {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.feature:hover {
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
}

.feature h3 {
    font-size: 1.4em;
    color: #00173d;
    margin-bottom: 20px;
}

.feature p {
    color: #666;
}


.how-it-works {
    padding: 60px 20px;
    background-color: white;
    text-align: center;
}

.how-it-works h2 {
    font-size: 2.5em;
    color: #00173d;
    margin-bottom: 40px;
}

.how-it-works img {
    max-width: 100%;
    border-radius: 8px;
    margin-bottom: 20px;
}

.how-it-works p {
    font-size: 1.2em;
    color: #00173d;
}


.why-dckap {
    padding: 60px 20px;
    background-color: #f8f8f8;
    text-align: center;
}

.why-dckap h2 {
    font-size: 2.5em;
    margin-bottom: 40px;
}

.why-dckap .grid {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.benefit {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    max-width: 300px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.benefit h3 {
    color: #00173d;
    margin-bottom: 20px;
}

.benefit p {
    color: #666;
}


    .footer {
      background-color: #bdbdbd;
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





<section class="hero">
    <img src="../view/src/futurism-perspective-digital-nomads-lifestyle.jpg" alt="System Integration Diagram" class="hero-image">
    <div class="hero-content">
        <h1>Make your systems talk to each other.</h1>
        <p>DCKAP Integrator connects your ERP with E-commerce, CRM, inventory, accounting, logistics, and other applications. Scale and run your business faster, so you have increased profitability and low-effort customer experience.</p>
        <a href="../view/blog_view.php" class="cta-button">Blog</a>
    </div>
</section>



    <section class="trusted-by">
        <h2>Trusted by Fast-Growing Manufacturers & Distributors</h2>
        <div class="trusted-companies">
            <img src="../view/src/Dckap_interfgator.png" alt="Company 1">
            <img src="../view/src/Qa_touch.png" alt="Company 2">
            <img src="../view/src/Klizer.png" alt="Company 3">

        </div>
    </section>

    <section class="features">
        <h2>Create a connected B2B experience for your employees & your customers.</h2>
        <div class="features-grid">
            <div class="feature">
                <h3>Get access to real-time data.</h3>
                <p>With our ERP integrator, you’ll be able to pull data from multiple channels and update customer information in real-time.</p>
            </div>
            <div class="feature">
                <h3>Keep control of your business.</h3>
                <p>Manage multiple sales channels without losing control, inventory, or order tracking while avoiding overselling or underselling.</p>
            </div>
            <div class="feature">
                <h3>Speed up order fulfillment.</h3>
                <p>Order fulfillment will be faster by integrating systems like Shopify, BigCommerce, and Magento with your ERP for real-time inventory synchronization.</p>
            </div>
            <div class="feature">
                <h3>Update product info with ease.</h3>
                <p>Automate the updates of product catalogs to ensure consistent product information across your online storefronts.</p>
            </div>
        </div>
    </section>


    <section class="why-dckap">
        <h2>Why DCKAP?</h2>
        <div class="grid">
            <div class="benefit">
                <h3>Surprisingly Simple.</h3>
                <p>Our drag-and-drop system is so simple that even non-programmers can build and manage workflows without technical support.</p>
            </div>
            <div class="benefit">
                <h3>Surprisingly Powerful.</h3>
                <p>Set it, forget it. DCKAP runs invisibly in the background. No maintenance is needed. Enjoy fully automated workflows in no time.</p>
            </div>
            <div class="benefit">
                <h3>No learning curve for non-programmers.</h3>
                <p>You don’t need to be a tech expert to use DCKAP. The platform is easy to use with drag-and-drop functionality, so you can get started right away.</p>
            </div>
        </div>
    </section>
  
<div class="divtem">
  <?php

include '../controller/fetch_testimonials.php';



?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>


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

  <script>
// document.addEventListener('DOMContentLoaded', function () {
//     const profileImage = document.getElementById('profileImage');
//     const profileDropdown = document.getElementById('profileDropdown');
    
//     profileImage.addEventListener('click', function () {
//         profileDropdown.style.display = 
//             profileDropdown.style.display === 'block' ? 'none' : 'block';
//     });

//     // Close dropdown if clicking outside
//     document.addEventListener('click', function(event) {
//         if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
//             profileDropdown.style.display = 'none';
//         }
//     });
// });


function openNav() {
    document.getElementById("sidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("sidenav").style.width = "0";
}

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

</script>






</body>
</html>
