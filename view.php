<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="chatbot.css">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  
  <link href="index_style2.css"  rel="stylesheet" />
    <style>
        /* Your existing styles */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 3px;
            background-color: #7335b7;
            color: white;
            width: 100%;
        }

        .nav-links {
            list-style-type: none;
            display: flex;
        }

        .nav-links li {
            margin-right: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-right: 100px;
        }

        .search-bar form {
            display: flex;
            align-items: center;
        }

        .search-bar input[type="text"] {
            width: 300px; /* Adjust width as needed */
            padding: 8px;
            font-size: 16px;
            margin: 5px;
        }

        .search-bar input[type="submit"] {
            padding: 8px;
            font-size: 16px;
            background-color: #f8842b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .alb {
    margin-top: 50px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.alb-item {
    margin: 50px;
    text-align: center;
    height: 400px;
    width: 500px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content:; /* Center video and description vertically */
}

.alb video {
    width: 100%;
    height: auto; /* Allow the video to adjust its height while maintaining aspect ratio */
    border-radius: 8px;
    border: 4px solid transparent;
    transition: border-color 0.3s;
}

.alb p {
    margin: 0;
    background-color:  #f8842b;
    color: white;
    padding: 10px;
  margin-left:5px;
}

.alb-item:hover video {
    border-color: #f8842b;
}

.alb-item:hover p {
    background-color:#f8842b;
}

    </style>
</head>
<body>
    <!-- Your Navbar Code -->
    <nav>
        <div class="logo">
            <img src="assets/Logo 14-02-02.png" alt="Website Logo">
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="games.php">Games</a></li>
            <li><a href="view.php">Videos</a></li>
        </ul>
        <div class="search-bar">
            <form method="get" action="view.php">
                <input type="text" name="search" placeholder="Search by caption">
                <input type="submit" value="Search">
            </form>
        </div>
    </nav>
    <div id="chatbot-button" class="chatbot-button">
  <a href="chatbot_main.html">
    <img src="assets/chatbot.png" alt="Chatbot">
  </a>
</div>
<script src="chatbot.js"></script>

    <div class="alb">
        <?php
        include "db_conn.php";

        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

        $sql = "SELECT * FROM videos";
        if (!empty($search)) {
            $sql .= " WHERE caption LIKE '%$search%'";
        }
        $sql .= " ORDER BY id DESC";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($video = mysqli_fetch_assoc($res)) {
                ?>
                <div class="alb-item">
                    <video src="uploads/<?= $video['video_url'] ?>" controls></video>
                    <p><?= $video['caption']; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<h1>No videos found</h1>";
        }
        ?>
    </div>
    <!-- <div class="footer_container">
     info section -->
    <!-- <section class="info_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="info_link_box">
                        <h4>Links</h4>
                        <div class="info_links">
                            <a href="index.html">Home</a>
                            <a href="about.html">About</a>
                            <a href="service.html">Services</a>
                            <a href="quiz.html">Quiz</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="info_contact">
                        <h4>Address</h4>
                        <div class="contact_link_box">
                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>Location</span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>Call +01 1234567890</span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>demo@gmail.com</span>
                            </a>
                        </div>
                    </div>
                    <div class="info_social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --> 
</div>

</body>
</html>
