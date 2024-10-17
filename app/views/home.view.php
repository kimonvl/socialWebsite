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
            <?=$this->view('drop_down_friend_request', ['friend_requests' => $friend_requests]);?>
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
                <?php if(!empty($conversations)): ?>
                    <?php foreach($conversations as $conversation): ?>
                        <?php $this->view("friend_li", ['conversation' => $conversation]); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>

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

        <!-- Chat Window (Demo) -->
        <div style="display:none;" id="conversation_id_chat"></div>
        <div style="display:none;" id="sender_id_chat"></div>
        <div style="display:none;" id="sender_profile_image_chat"></div>
        <div class="chat-window">
            <div class="chat-header" id="chthdr">
                Chat
            </div>

            <div class="chat-body" id="chatBody">
        
            </div>
            <div class="chat-input">
                <input id="chat_message_input" type="text" placeholder="Type a message...">
                <button onclick="send_message()">Send</button>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>/assets/js/home.js"></script>
</body>
</html>
