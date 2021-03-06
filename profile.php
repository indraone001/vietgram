<?php
    session_start();
    include 'config.php';
    include 'date.php';
    if (!isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }
    
    $uid = $_SESSION["uid"];
    $sql = "SELECT * FROM photo where id = '$uid'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        // echo "get data success";
        $data = array();
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
    }else{
        echo "no data";
    }
    $sql = "SELECT * FROM Users where id = '$uid'";
    $detailUser = mysqli_query($conn, $sql);
    if(mysqli_num_rows($detailUser)>0){
        // echo "get data success";
        $dataInfo = mysqli_fetch_assoc($detailUser);
    }else{
        echo "no data";
    }
    $sql = "SELECT * FROM profiles where id = '$uid'";
    $detailUser2 = mysqli_query($conn, $sql);
    if(mysqli_num_rows($detailUser2)>0){
        // echo "get data success";
        $dataInfo2 = mysqli_fetch_assoc($detailUser2);
    }else{
        echo "no data";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile | <?= $_SESSION["user"];?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navigation">
        <div class="navigation__column">
            <a href="feed.php">
                <img src="images/logo.png" />
            </a>
        </div>
        <div class="navigation__column">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Search">
        </div>
        <div class="navigation__column">
            <ul class="navigations__links">
                <li class="navigation__list-item">
                    <a href="explore.php" class="navigation__link">
                        <i class="fa fa-compass fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="#" class="navigation__link">
                        <i class="fa fa-heart-o fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="profile.php" class="navigation__link">
                        <i class="fa fa-user-o fa-lg"></i>
                    </a>
                </li>
                <li class="navigation__list-item">
                    <a href="upload.php" class="navigation__link">
                        <i class="fa fa-upload fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="profile">
        <header class="profile__header">
            <div class="profile__column">
                <img src="<?php echo $dataInfo['fotoProfile']; ?>" />
            </div>
            <div class="profile__column">
                <div class="profile__title">
                    <h3 class="profile__username"><?= $_SESSION['user']; ?></h3>
                    <a href="edit-profile.php">Edit profile</a>
                    <i class="fa fa-cog fa-lg"></i>
                </div>
                <ul class="profile__stats">
                    <li class="profile__stat">
                        <span class="stat__number"><?php echo count($data); ?></span> posts
                    </li>
                    <li class="profile__stat">
                        <span class="stat__number">1234</span> followers
                    </li>
                    <li class="profile__stat">
                        <span class="stat__number">36</span> following
                    </li>
                </ul>
                <p class="profile__bio">
                    <span class="profile__full-name">
                        <?= $dataInfo2['name']; ?>
                    </span> <?= $dataInfo2['bio']; ?> <br>
                    <?= $dataInfo2['gender']; ?> - <?= $dataInfo2['phone_number']; ?>
                    <a href=" <?= $dataInfo2['website']; ?>"> <?= $dataInfo2['website']; ?></a>
                </p>
            </div>
        </header>

        <section class="profile__photos">
            <?php foreach($data as $row){ ?>
            <div class="profile__photo">
                <img src="<?php echo $row['url']; ?>" />
                <div class="profile__photo-overlay">
                    <span class="overlay__item">
                        <i class="fa fa-heart"></i>
                        <?php echo $row['like']; ?>
                    </span>
                    <span class="overlay__item">
                        <i class="fa fa-comment"></i>
                        344
                    </span>
                </div>
            </div>
            <?php } ?>
        </section>
    </main>
    <footer class="footer">
        <div class="footer__column">
            <nav class="footer__nav">
                <ul class="footer__list">
                    <li class="footer__list-item"><a href="#" class="footer__link">About Us</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Support</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Blog</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Press</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Api</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Jobs</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Privacy</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Terms</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Directory</a></li>
                    <li class="footer__list-item"><a href="#" class="footer__link">Language</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer__column">
            <span class="footer__copyright">© 2017 Vietgram</span>
        </div>
    </footer>
</body>

</html>