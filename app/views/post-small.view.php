<div class="post">
    <div class="post-header">
        <img src="<?=get_image($post->owner->image, "user")?>" alt="Profile Picture">
        <div>
            <a href="<?=ROOT?>/profile/index/<?=$post->owner->id == current_user('id') ? '' : $post->owner->id?>"><p class="name"><?=$post->owner->username?></p></a>
            <p class="time"><?=$post->date?></p>
        </div>
    </div>
    <div class="post-content">
        <p><?=$post->content?></p>
        <?php if(!empty($post->image)): ?>
            <img src="<?=get_image($post->image, "post")?>">
        <?php endif ?>
    </div>
    <div class="post-footer">
        <button class="like-button"><i class="fas fa-heart"></i> Like</button>
        <button>Comment</button>
        <button>Edit</button>
    </div>
</div>