<form method="post" onsubmit="upload_post(event)">
    <div class="create-post">
        <textarea id="postText" placeholder="What's on your mind?" rows="3"></textarea>
        <img style="display: block; width: 100%; max-height: 150px; display: none" src="" class="post-image">
        <button type="submit">Create Post</button>
        <label style="cursor: pointer;">
            <i style="margin-left: 10px; font-size: 20px; " class="fa fa-file"></i>              
            <input onchange="display_post_image(this.files[0])" type="file" name="" style="display:none;">
        </label>
    </div>
</form>