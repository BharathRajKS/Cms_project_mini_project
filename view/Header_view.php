<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonial Submission</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
            right: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(145, 145, 145, 0.91);
            min-width: 153px;
            padding: 20px;
            display: none;
            z-index: 1000;
            border-radius: 8px;
        }

        .profile-dropdown p {
            margin: 0;
            font-weight: bold;
        }

        .profile-dropdown a {
            display: block;
            color: #00173d;
            text-decoration: none;
            padding: 5px 0;
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

    </style>
</head>

<body>
<div class="header">
    <div class="logo">
        <a href="../view/Home_view.php">
            <img src="../view/src/Contentmanageent_-removebg-preview.png" alt="CMC_Management Logo" class="logo-image" />
        </a>
    </div>

    <div class="navbar">
        <a href="../view/Home_view.php"class="link-21">Home</a>
        <a href="../view/blog_view.php"class="link-21">Blog</a>
        <a href="../view/testimonial_view.php"class="link-21">Testimonials</a>
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

    <script>
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
    </script>
</body>

</html>
