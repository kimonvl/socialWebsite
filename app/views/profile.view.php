<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-like Profile Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body id="body">
    <div style="display: none;" id="user_id_holder" data-value="<?=current_user('id')?>"></div>
    <!-- Header Section -->
    <div class="navbar">
        <div class="logo">
            <h1>Facebook</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search Facebook">
        </div>
        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Friends</a>
            <a href="#">Messages</a>
            <a href="#">Notifications</a>
            <a href="<?=ROOT?>/logout">Logout</a>
            <a href="<?=ROOT?>/home">
                Home
            </a>

        </div>
    </div>
    <div class="profile-container">
        <!-- Cover Photo -->
        <div class="cover-photo">
            <img src="<?=get_image($userRow->image, "user")?>" alt="Cover Photo">
        </div>

        <!-- Profile Info -->
        <div class="profile-info">
            <!-- Profile Picture -->
            <label style="cursor: pointer;">
                <div class="profile-pic">
                    <img class="profile-image" src="<?=get_image($userRow->image, "user")?>" alt="Profile Picture">
                </div>
                <?php if($userRow->id == current_user('id')): ?>
                    <input onchange="display_image(this.files[0])" type="file" name="" style="display:none;">
                <?php endif; ?>
            </label>

            <!-- Name and Bio -->
            <div class="profile-details">
                <h1><?=$userRow->username?></h1>
            </div>

            <!-- Friends and Info Section -->
            <div class="profile-nav">
                <ul>
                    
                    <li><a href="#about">About</a></li>
                    <li><a href="#photos">Photos</a></li>
                    <?php if($friend_req_button != "disabled"): ?>
                       <li><button onclick="send_friend_request(<?=current_user('id')?>, <?=$userRow->id?>)"><?=$friend_req_button?></button></li> 
                    <?php endif; ?>
                    
                </ul>
            </div>
        </div>

        <!-- News Feed -->
        <div class="feed-container">
            <!-- Create Post Section -->
            <?php if($userRow->id == current_user('id')): ?>
                <?=$this->view('create_post_form')?>
            <?php endif; ?>
            <!-- Post Section -->
            <div class="posts-section">
                <!-- Demo Posts -->
                
                <?php if(!empty($posts) && is_array($posts)):?>
                    <?php foreach($posts as $post):?>
                        <?=$this->view('post-small', ['post' => $post])?>
                    <?php endforeach;?>
                <?php endif;?>

                <div><?php $pager->display()?></div>

            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/profile.js"></script>
</body>

</html>
