<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook-like Profile Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/profile.css">
</head>
<body>
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
                    send_data(obj);
                }

                function send_data(obj)
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

                    ajax.open('post', '<?=ROOT?>/ajax/profile_image_change', true);
                    ajax.send(myform);
                }

                function handle_result(result)
                {
                    let obj = JSON.parse(result);
                    console.log(obj.message);
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
                    <li><strong>500</strong> Friends</li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#photos">Photos</a></li>
                    <li><a href="#friends">Friends</a></li>
                </ul>
            </div>
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
</body>
</html>
