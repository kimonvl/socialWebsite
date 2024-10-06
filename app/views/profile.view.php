<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-like Profile Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
</head>
<body>
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
                
                <input onchange="display_image(this.files[0])" type="file" name="" style="display:none;">
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

                function change_image(file)
                {
                    var obj = {};
                    obj.image = file;
                    obj.id = <?=$userRow->id?>;
                    send_data(obj, "profile_image_change");
                }

                function upload_post()
                {
                    var obj = {};
                    obj.content = document.getElementById("postText").value;
                    obj.user_id = <?=$userRow->id?>;
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
            <form method="post" onsubmit="upload_post()">
                <div class="create-post">
                    <textarea id="postText" placeholder="What's on your mind?" rows="3"></textarea>
                    <button>Create Post</button>
                </div>
            </form>

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
