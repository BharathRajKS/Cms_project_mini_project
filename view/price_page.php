<?php
session_start();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ERP Integration Pricing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>


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
    justify-content: space-between; /* Space between logo and links */
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
    margin-left: 20px; /* Space for the login link */
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

button.cta {
    background-color: white;
    color:#00173d;
    border: none;
    padding: 0.5em 1em;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.main-section {
    text-align: center;
    margin: 2em 0;
}

.main-section h1 {
    font-size: 2.5em;
    margin-bottom: 0.5em;
}

.pricing-section {
    display: flex;
    justify-content: space-around;
    margin: 2em 0;
}

.pricing-card {
    background: white;
    border-radius: 10px;
    padding: 1.5em;
    text-align: center;
    width: 30%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.pricing-card h2 {
    font-size: 1.5em;
}

.pricing-card .price {
    font-size: 2.5em;
    margin: 0.5em 0;
    color: #00173d;
}

.pricing-card.highlight {
    border: 2px solid #00173d;
}

.comparison-table {
    margin: 3em auto;
    width: 80%;
    text-align: left;
}

.comparison-table table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.comparison-table th, .comparison-table td {
    padding: 1em;
    border: 1px solid #ddd;
    text-align: center;
}

.testimonials {
    background-color: #f9f9f9;
    padding: 3em;
    text-align: center;
}

.testimonial {
    background: white;
    padding: 1.5em;
    margin: 1em;
    display: inline-block;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.footer {
      background-color: #ffffff;
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




        </style>


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
  
    <section class="main-section">
        <h1>Platform Pricing</h1>
        <p>Fully ERP in 7 weeks.</p>
    </section>

    <section class="pricing-section">
        <div class="pricing-card">
            <h2>Standard</h2>
            <p class="price">$999/month</p>
            <p>Billed annually</p>
            <button class="cta">Book a Demo</button>
        </div>
        <div class="pricing-card highlight">
            <h2>Professional</h2>
            <p class="price">$1,499/month</p>
            <p>Billed annually</p>
            <button class="cta">Book a Demo</button>
        </div>
        <div class="pricing-card">
            <h2>Enterprise</h2>
            <p>Custom Pricing</p>
            <button class="cta">Get a Quote</button>
        </div>
    </section>

   
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
</body>
</html>
