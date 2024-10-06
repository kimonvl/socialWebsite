<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-like Page</title>
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
            <a href="<?=ROOT?>/profile">
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

        <!-- News Feed -->
        <div class="feed-container">
            <!-- Create Post Section -->
            <div class="create-post">
                <textarea placeholder="What's on your mind?" rows="3"></textarea>
                <button>Create Post</button>
            </div>

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
