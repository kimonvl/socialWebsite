<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-like Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
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
            <a href="<?=ROOT?>/profile/index">
                <?=$user_row->username?>
                <img style="width: 30px; height: 30px; margin-left: 5px;" src="<?=get_image($user_row->image, 'user')?>">
            </a>

        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="main-content">
        <!-- Friends List Sidebar -->
        <div class="sidebar">
            <h3>Friends</h3>
            <ul>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">John Doe</p>
                        <span class="status online"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Jane Smith</p>
                        <span class="status offline"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Robert Brown</p>
                        <span class="status online"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Emily Clark</p>
                        <span class="status offline"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Alice Johnson</p>
                        <span class="status online"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Michael White</p>
                        <span class="status offline"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Jessica Brown</p>
                        <span class="status online"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">David Wilson</p>
                        <span class="status offline"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Sophia Lewis</p>
                        <span class="status online"></span>
                    </div>
                </li>
                <li class="friend">
                    <img src="https://via.placeholder.com/40" alt="Profile Picture">
                    <div class="friend-info">
                        <p class="name">Daniel Martinez</p>
                        <span class="status offline"></span>
                    </div>
                </li>
            </ul>
        </div>

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

        <!-- News Feed -->
        <div class="feed-container">
            <!-- Create Post Section -->
            <?=$this->view('create_post_form')?>

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

    <!-- Chat Window (Demo) -->
    <div class="chat-window">
        <div class="chat-header">
            <p>Chat with Friends</p>
            <span class="close-chat" onclick="document.querySelector('.chat-window').style.display='none'">X</span>
        </div>
        <div class="chat-body">
            <div class="message received">
                <p>Hi! How are you?</p>
            </div>
            <div class="message received">
                <p>Hi! How are you?</p>
            </div>
            <div class="message received">
                <p>Hi! How are you?</p>
            </div>
            <div class="message sent">
                <p>I'm good, thanks! You?</p>
            </div>
            <div class="message received">
                <p>Doing well! Just catching up on some work.</p>
            </div>
            <div class="message sent">
                <p>Nice! Let me know if you need any help.</p>
            </div>
            <div class="message received">
                <p>Will do! Thanks!</p>
            </div>
        </div>
        <div class="chat-footer">
            <input type="text" placeholder="Type a message...">
            <button>Send</button>
        </div>
    </div>

</body>
</html>
