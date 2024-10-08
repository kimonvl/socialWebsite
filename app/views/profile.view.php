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

            <script type="text/javascript">
                function display_image(file)
                {
                    let allowed = ['jpg', 'jpeg', 'png', 'webp'];
                    let ext = file.name.split(".").pop();
                    if(!allowed.includes(ext.toLowerCase()))
                    {
                        alert("Only files of these type allowed: " + allowed.toString(", "));
                        return;
                    }
                    document.querySelector(".profile-image").src = URL.createObjectURL(file);
                    change_image(file);
                }

                var post_image_file = null;
                const current_user_id = document.getElementById("user_id_holder").getAttribute("data-value");

                function display_post_image(file)
                {
                    let allowed = ['jpg', 'jpeg', 'png', 'webp'];
                    let ext = file.name.split(".").pop();
                    if(!allowed.includes(ext.toLowerCase()))
                    {
                        alert("Only files of these type allowed: " + allowed.toString(", "));
                        return;
                    }
                    document.querySelector(".post-image").src = URL.createObjectURL(file);
                    document.querySelector(".post-image").style.display = "";
                    post_image_file = file;
                }

                function change_image(file)
                {
                    var obj = {};
                    obj.image = file;
                    obj.id = current_user_id;
                    send_data(obj, "profile_image_change");
                }

                function upload_post(event)
                {
                    event.preventDefault();
                    var obj = {};
                    obj.content = document.getElementById("postText").value;
                    obj.user_id = current_user_id;
                    obj.image = post_image_file;
                    send_data(obj, "create_post");
                }

                function send_data(obj, func)
                {
                    var myform = new FormData();

                    for(key in obj)
                    {
                        myform.append(key, obj[key]);
                    }

                    var ajax = new XMLHttpRequest();
                    ajax.addEventListener('readystatechange', function(e){
                        if(ajax.readyState == 4 && ajax.status == 200)
                        {
                            handle_result(ajax.responseText);
                        }
                    });

                    ajax.open('post', '<?=ROOT?>/ajax/' + func, true);
                    ajax.send(myform);
                }

                function handle_result(result)
                {
                    let obj = JSON.parse(result);
                    alert(obj.message);
                    location.reload();
                }
            </script>

            <!-- Name and Bio -->
            <div class="profile-details">
                <h1><?=$userRow->username?></h1>
            </div>

            <!-- Friends and Info Section -->
            <div class="profile-nav">
                <ul>
                    
                    <li><a href="#about">About</a></li>
                    <li><a href="#photos">Photos</a></li>
                    <li><button>Add Friend</button></li>
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
</body>

</html>
