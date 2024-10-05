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
                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">John Doe</p>
                            <p class="time">2 hours ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>This is my first post! Excited to be here.</p>
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Jane Smith</p>
                            <p class="time">5 hours ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Had an amazing day at the park. #sunshine</p>
                        <img src="https://via.placeholder.com/500x300" alt="Park" style="width: 100%; border-radius: 10px; margin-top: 10px;">
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Robert Brown</p>
                            <p class="time">1 day ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Feeling productive today. Completed my to-do list!</p>
                        <img src="https://via.placeholder.com/500x300" alt="To-do List" style="width: 100%; border-radius: 10px; margin-top: 10px;">
                    </div>
                    <div class="post-footer">
                        <button class="like-button"><i class="fas fa-heart"></i> Like</button>
                        <button>Comment</button>
                        <button>Edit</button>
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Emily Clark</p>
                            <p class="time">1 day ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Just got back from a trip! Here are some photos.</p>
                        <img src="https://via.placeholder.com/500x300" alt="Trip" style="width: 100%; border-radius: 10px; margin-top: 10px;">
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Alice Johnson</p>
                            <p class="time">3 days ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Can't wait for the weekend! #TGIF</p>
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Michael White</p>
                            <p class="time">4 days ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Just finished a great book! Any recommendations for what to read next?</p>
                        <img src="https://via.placeholder.com/500x300" alt="Book" style="width: 100%; border-radius: 10px; margin-top: 10px;">
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Jessica Brown</p>
                            <p class="time">5 days ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Happy to announce my new job! Excited for the journey ahead!</p>
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">David Wilson</p>
                            <p class="time">1 week ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Had an amazing dinner last night! Great food and even better company.</p>
                        <img src="https://via.placeholder.com/500x300" alt="Dinner" style="width: 100%; border-radius: 10px; margin-top: 10px;">
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Sophia Lewis</p>
                            <p class="time">1 week ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Looking forward to the concert this Friday! #excited</p>
                    </div>
                </div>

                <div class="post">
                    <div class="post-header">
                        <img src="https://via.placeholder.com/40" alt="Profile Picture">
                        <div>
                            <p class="name">Daniel Martinez</p>
                            <p class="time">1 week ago</p>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Just started learning a new language. Wish me luck!</p>
                    </div>
                </div>
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
