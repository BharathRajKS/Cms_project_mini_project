<?php  require ".../view/Home_view.php";

// <?php

// require('../config.php');
// require('../model/DB.php');

// try {
//     $databaseConnection = new DatabaseConnection($config);
//     $conn = $databaseConnection->getConnection();
// } catch (Exception $e) {
//     die("Connection failed: " . $e->getMessage());
// }

// $stmt = $conn->prepare("SELECT * FROM Cms_testimonial");
// $stmt->execute();
// $result = $stmt->get_result();
// $testimonials = $result->fetch_all(MYSQLI_ASSOC); // Fetch all testimonials at once
// $totalTestimonials = count($testimonials);
?>

// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>All Testimonials</title>
//     <style>
//         /* General styling */
//         body {
//             font-family: Arial, sans-serif;
//             margin: 0;
//             padding: 0;
//             background-color: #f9f9f9;
//         }

//         /* Container styles */
//         .carousel-container {
//             position: relative;
//             max-width: 90%;
//             margin: 0 auto;
//             overflow: hidden;
//             text-align: center;
//         }

//         .carousel {
//             display: flex;
//             justify-content: center;
//             align-items: center; /* Vertically center the testimonials */
//             gap: 20px;
//             transition: transform 0.5s ease-in-out;
//             padding: 61px;
//             min-height: 300px; /* Set minimum height for carousel */
//             flex-wrap: wrap; /* Allows wrapping of slides */
//         }

//         .testimonial-slide {
//             background-color: #f4f4f4;
//             border-radius: 10px;
//             box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
//             padding: 5px 31px;
//             max-width: 300px;
//             min-width: 300px;
//             text-align: center;
//             transition: transform 0.5s ease-in-out;
//             display: none; /* Initially hide all testimonials */
//         }

//         .testimonial-image img {
//             width: 80px;
//             height: 80px;
//             border-radius: 50%;
//             border: 3px solid #00173d;
//             margin-bottom: 15px;
//         }

//         .testimonial-text {
//             font-size: 15px;
//             color: #333;
//             margin-bottom: 20px;
//         }

//         .testimonial-name {
//             font-size: 18px;
//             font-weight: bold;
//             color: #ff9900;
//         }

//         .testimonial-date {
//             font-size: 12px;
//             color: #888;
//         }

//         /* Navigation button styles */
//         .carousel-btn {
//             position: absolute;
//             top: 50%;
//             transform: translateY(-50%);
//             background-color: #00173d;
//             color: white;
//             border: none;
//             padding: 10px;
//             cursor: pointer;
//             z-index: 2;
//             border-radius: 50%;
//             font-size: 18px;
//         }

//         .carousel-btn.prev {
//             left: 10px; 
//         }

//         .carousel-btn.next {
//             right: 10px; 
//         }

//         h2 {
//             text-align: center;
//             font-size: 24px;
//             font-weight: bold;
//             color: #00173d;
//             margin-bottom: 5px;
//         }

//         p {
//             text-align: center;
//             font-size: 14px;
//             color: #555;
//             margin-bottom: 40px;
//         }

//         .empty-state p {
//             font-size: 18px;
//             color: #555;
//             margin-top: 20px;
//         }

//         .show-more-btn {
//             margin-top: 20px;
//             padding: 10px 20px;
//             background-color: #00173d;
//             color: white;
//             border: none;
//             border-radius: 5px;
//             cursor: pointer;
//         }
//     </style>
// </head>
// <body>

// <div class="testimonial-list" id="testimonial-list">
//     <h2>TESTIMONIALS</h2>

//     <div class="carousel-container">
//         <div class="carousel" id="carousel">
//             <?php if ($totalTestimonials > 0) : ?>
//                 <?php foreach ($testimonials as $index => $testimonial) : ?>
//                     <div class="testimonial-slide" id="testimonial-<?php echo $index; ?>">
//                         <div class="testimonial-image">
//                             <img src="<?php echo htmlspecialchars($testimonial['profile_picture']); ?>" alt="Profile Picture">
//                         </div>
//                         <div class="testimonial-content">
//                             <div class="testimonial-text">"<?php echo htmlspecialchars($testimonial['content']); ?>"</div>
//                             <div class="testimonial-name"><?php echo htmlspecialchars($testimonial['name']); ?></div>
//                             <div class="testimonial-date"><?php echo date('Y-m-d', strtotime($testimonial['created_at'])); ?></div>
//                         </div>
//                     </div>
//                 <?php endforeach; ?>
//             <?php else : ?>
//                 <div class="empty-state">
//                     <p>No testimonials available.</p>
//                 </div>
//             <?php endif; ?>
//         </div>
//     </div>
//     <?php if ($totalTestimonials > 4) : ?>
//         <button class="show-more-btn" id="show-more">Show More</button>
//     <?php endif; ?>
// </div>

// <script>
//     let currentIndex = 0;
//     const carousel = document.getElementById('carousel');
//     const slides = document.querySelectorAll('.testimonial-slide');
//     const totalSlides = slides.length;
//     const initialShow = 3; // Number of testimonials to show initially
//     let shownSlides = initialShow; 


//     for (let i = 0; i < Math.min(initialShow, totalSlides); i++) {
//         slides[i].style.display = 'block';
//     }


//     document.getElementById('show-more').addEventListener('click', function () {
//         const nextSlides = Math.min(shownSlides + 4, totalSlides);
//         for (let i = shownSlides; i < nextSlides; i++) {
//             slides[i].style.display = 'block'; 
//         }
//         shownSlides = nextSlides; 

//         // Hide the Show More button if all slides are shown
//         if (shownSlides >= totalSlides) {
//             this.style.display = 'none';
//         }
//     });
// </script>

// </body>
// </html>
