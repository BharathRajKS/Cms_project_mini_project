<?php
session_start();
require('../config.php');
require('../model/DB.php');

try {
    $databaseConnection = new DatabaseConnection($config);
    $conn = $databaseConnection->getConnection();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

$stmt = $conn->prepare("SELECT * FROM Cms_testimonial");
$stmt->execute();
$result = $stmt->get_result();
$testimonials = $result->fetch_all(MYSQLI_ASSOC); 



// -------------------- fetch only the last three posts-----------------
$query = "SELECT id, title, short_description, content, image FROM Cms_Post_table ORDER BY id DESC LIMIT 3";
$result = $conn->query($query);

$isAdmin = true; 
$successMessage = isset($_GET['success']) ? $_GET['success'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Testimonials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
       

        }

        .container {
            max-width: 1200px;
            margin: 0 auto; 
            padding: 20px; 
        }

        .carousel-container {
            position: relative;
            max-width: 90%;
            margin: 0 auto;
            overflow: hidden;
            text-align: center;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
            padding: 61px;
            min-height: 300px; 
        }

        .testimonial-slide {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 5px 31px;
            max-width: 300px;
            min-width: 300px;
            text-align: center;
            margin-right: 20px; 
        }

        .testimonial-image img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #00173d;
            margin-bottom: 15px;
        }

        .testimonial-text {
            font-size: 15px;
            color: #333;
            margin-bottom: 20px;
        }

        .testimonial-name {
            font-size: 18px;
            font-weight: bold;
            color: #ff9900;
        }

        .testimonial-date {
            font-size: 12px;
            color: #888;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: #00173d;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 2;
            border-radius: 50%;
            font-size: 18px;
        }

        .carousel-btn.prev {
            left: 10px; 
        }

        .carousel-btn.next {
            right: 10px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #00173d;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 40px;
        }

        .posts-container {
            width: 100%;
            margin: 32px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 12px;
        }

        .posts-container h1 {
            text-align: center;
            color: #00173d;
            margin-bottom: 20px;
            font-size: 32px;
            letter-spacing: 1px;
        }

        .posts-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .post {
            flex: 1 1 calc(33% - 20px);
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2);
        }

        .post img {
            width: 50%;
            height: 170px;
            object-fit: cover;
            transition: transform 0.3s;
            margin-left: 25%;
            margin-top: 10%;
        }

        .post h2 {
            margin: 10px;
            font-size: 1.5em;
            
            display: flex;
            justify-content: center;
        }

        .post p {
            margin: 0 10px 10px;
          
            flex-grow: 1; 
            display: flex;
            justify-content: center;
            margin-bottom: 9%;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            margin: 15% auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            max-width: 600px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .modal-header, .modal-footer {
            padding: 10px;
            text-align: right;
        }

        .close {
            cursor: pointer;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>
<body>


<div class="posts-container">
        <h1>Blog Posts</h1>
        <div class="posts-row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="post" onclick="openModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['title']); ?>', '<?php echo htmlspecialchars($row['short_description']); ?>', '<?php echo htmlspecialchars($row['content']); ?>', '<?php echo htmlspecialchars($row['image']); ?>')">
                    <?php if (!empty($row['image'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <?php endif; ?>
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><?php echo htmlspecialchars($row['short_description']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="" />
                <h2 id="modalTitle"></h2>
                <p id="modalDescription"></p>
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer">
                <button class="close" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>









<div class="container">
    <div class="testimonial-list" id="testimonial-list">
        <h2>TESTIMONIALS</h2>

        <div class="carousel-container">
            <button class="carousel-btn prev">‹</button>
            <button class="carousel-btn next">›</button>
            <div class="carousel">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-slide">
                        <div class="testimonial-image">
                            <img src="<?php echo htmlspecialchars($testimonial['profile_picture']); ?>" alt="Profile Picture">
                        </div>
                        <div class="testimonial-content">
                            <div class="testimonial-text">"<?php echo htmlspecialchars($testimonial['content']); ?>"</div>
                            <div class="testimonial-name"><?php echo htmlspecialchars($testimonial['name']); ?></div>
                            <div class="testimonial-date"><?php echo date('Y-m-d', strtotime($testimonial['created_at'])); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        const carousel = document.querySelector('.carousel');
        const slides = document.querySelectorAll('.testimonial-slide');
        let currentIndex = 0;

        document.querySelector('.carousel-btn.next').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        });

        document.querySelector('.carousel-btn.prev').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateCarousel();
        });

        function updateCarousel() {
            const offset = -currentIndex * (slides[0].clientWidth + 20); 
            carousel.style.transform = `translateX(${offset}px)`;
        }

        function openModal(id, title, shortDescription, content, image) {
            document.getElementById("modalTitle").textContent = title;
            document.getElementById("modalDescription").textContent = shortDescription;
            document.getElementById("modalContent").innerHTML = content;
            document.getElementById("modalImage").src = image;

            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById("myModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
