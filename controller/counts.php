<?php
session_start();
require('../config.php');
require('../model/DB.php');


$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();


$postCount = 0;
$testimonialCount = 0;
$userCount = 0;

try {
    $stmt = $conn->query("SELECT COUNT(*) AS post_count FROM Cms_Post_table");
    $postCount = $stmt->fetch_assoc()['post_count'];

    $stmt = $conn->query("SELECT COUNT(*) AS testimonial_count FROM Cms_testimonial");
    $testimonialCount = $stmt->fetch_assoc()['testimonial_count'];

    $stmt = $conn->query("SELECT COUNT(*) AS user_count FROM Cms_Users WHERE role_id != 1");
    $userCount = $stmt->fetch_assoc()['user_count'];
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counts Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
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
            padding: -1px 20px;
            
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logo {
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    padding: 10px; 
}

.menu-icon {
    font-size: 30px; 
    cursor: pointer; 
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
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #00173d;
            overflow-x: hidden;
            padding-top: 7%;
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
            color: White;
            display: block;
            transition: 0.3s;
        }

     

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .login-signup img{
          width: 80px;
          height: 68px;
          display: flex;
          cursor: pointer;
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



.profile-dropdown close-btn {
    cursor: pointer;
    float: right;
    padding: 5px 10px;
    background-color: #333;
    color: white;
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

.icon {
    margin-right: 5px; 
    
}

.logout-btn {
    display: flex;
    align-items: center;
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
.sidebar-container{
    color: red;
}     .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #00173d;
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 800px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .card h2 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #00173d;
        }

        .card p {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3748;
        }

        canvas {
            max-width: 100%;
            height: 400px;
            margin-top: 20px;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #718096;
        }


    </style>
</head>
<body>
<div class="header">

<div class="logo">
    <span class="menu-icon" onclick="openNav()">&#9776;</span>
    <a href="../view/Home_view.php">
        <img src="../view/src/Contentmanageent_-removebg-preview.png" alt="CMC_Management Logo" class="logo-image" />
    </a>
</div>

    <!-- Profile logout -->
    <div class="login-signup" id="auth-links">
        <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])): ?>
            <img src="../view/src/download (1).png" alt="Profile" id="profileImage" style="cursor: pointer;" />
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
                            <i class="fab fa-wpforms" style="margin-right: 10px;"></i>Testimonial 
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION['is_admin']): ?>
                    <div style="display: flex; align-items: center;">
                        <a href="../view/testimonial_view.php" style="display: flex; align-items: center; margin-left: 9%;">
                            <i class="fab fa-wpforms" style="margin-right: 10px;"></i>Admin Dashboard 
                        </a>
                    </div>
                <?php endif; ?>
                <a href="../controller/logout.php" id="logoutBtn" style="display: flex; align-items: center;">
                    <i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i>Logout
                </a>
            </div>
        <?php else: ?>
            <a href="./login_view.php" id="loginBtn">Login</a>
        <?php endif; ?>
    </div>
</div>


<div id="mySidenav" class="sidenav">

    
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>


<div class="sidebar-container">
<div style="display: flex; align-items: center;">
    <a href="../view/Home_view.php" style="display: flex; align-items: center;margin-left: 6%;margin-bottom: 3%;">
    <i class="fa-solid fa-house" style="margin-right: 10px;"></i>Home
    </a>
</div>

    <div style="display: flex; align-items: center;">
    <a href="../view/blog_view.php" style="display: flex; align-items: center; margin-left: 6%;margin-bottom: 3%;">
        <i class="fa-solid fa-blog" style="margin-right: 10px;"></i>Blog
    </a>
</div>
<?php if ($_SESSION['is_admin']): ?>
<div style="display: flex; align-items: center;">
    <a href="../view/testimonial_view.php" style="display: flex; align-items: center;    margin-left: 6%;margin-bottom: 3%;">
    <i class="fab fa-wpforms" style="margin-Right: 10px;"></i>Testimonial 
    </a>
</div>
</div>
<?php endif; ?>
</div>
</div>
<?php if ($_SESSION['is_admin']): ?>
    <div class="container">
        <h1>Counts Dashboard</h1>
        <div class="grid">
            <div class="card">
                <h2>CMS Posts</h2>
                <p><?php echo htmlspecialchars($postCount); ?></p>
            </div>
            <div class="card">
                <h2>Testimonials</h2>
                <p><?php echo htmlspecialchars($testimonialCount); ?></p>
            </div>
            <div class="card">
                <h2>Users</h2>
                <p><?php echo htmlspecialchars($userCount); ?></p>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold mt-6">Count Graph</h2>
            <canvas id="countsChart"></canvas>
        </div>
    </div>
    <?php endif; ?>


    <script>
    const ctx = document.getElementById('countsChart').getContext('2d');
    const countsChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['CMS Posts', 'Testimonials', 'Users'],
            datasets: [{
                label: 'Counts',
                data: [<?php echo htmlspecialchars($postCount); ?>, <?php echo htmlspecialchars($testimonialCount); ?>, <?php echo htmlspecialchars($userCount); ?>],
                backgroundColor: [
                    'Red',
                    'Blue',
                    'Green'
                ],
              
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
    // ----------------------Profile logout-----------
document.addEventListener('DOMContentLoaded', function () {
    const profileImage = document.getElementById('profileImage');
    const profileDropdown = document.getElementById('profileDropdown');
    
    profileImage.addEventListener('click', function () {
        profileDropdown.style.display = 
            profileDropdown.style.display === 'block' ? 'none' : 'block';
    });


    document.addEventListener('click', function(event) {
        if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.style.display = 'none';
        }
    });
});
// --------------------side bar
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
    </script>

</body>
</html>
