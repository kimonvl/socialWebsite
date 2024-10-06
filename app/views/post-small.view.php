<div class="post">
    <div class="post-header">
        <img src="<?=get_image($post->owner->image, "user")?>" alt="Profile Picture">
        <div>
            <p class="name"><?=$post->owner->username?></p>
            <p class="time"><?=$post->date?></p>
        </div>
    </div>
    <div class="post-content">
        <p><?=$post->content?></p>
    </div>
    <div class="post-footer">
        <button class="like-button"><i class="fas fa-heart"></i> Like</button>
        <button>Comment</button>
        <button>Edit</button>
    </div>
</div>