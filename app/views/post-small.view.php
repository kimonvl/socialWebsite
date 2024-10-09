<div style="display: none;" id="post_id_holder" data-value="<?=$post->id?>"></div>
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
        <?php if($post->owner->id == current_user('id')): ?>
            <a id="editPostRef" href="#myForm<?=$post->id?>"><button onclick="openForm('<?=$post->id?>'); displayInitialPostImageEdit('<?=$post->image?>', '<?=$post->id?>');">Edit</button></a>
        <?php endif; ?>      
    </div>
</div>

<div class="form-popup" id="myForm<?=$post->id?>">
    <form method="post" onsubmit="edit_post(event, '<?=$post->id?>')">
        <div class="create-post">
            <textarea id="postTextEdit<?=$post->id?>" placeholder="What's on your mind?" rows="7"><?=$post->content?></textarea>
            <img style=" width: 100%; max-height: 150px; display: none" src="" id="post-image-popup<?=$post->id?>">
            <button type="submit">Edit Post</button>
            <button type="button" onclick="closeForm('<?=$post->id?>');">Cancel</button>
            <label style="cursor: pointer;">
                <i style="margin-left: 10px; font-size: 20px; " class="fa fa-file"></i>              
                <input onchange="displayAteredPostImageEdit(this.files[0], '<?=$post->id?>')" type="file" name="" style="display:none;">
            </label>
        </div>
    </form>
</div>

<style type="text/css">
    
/* The popup form - hidden by default */
.form-popup {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 50%;
    transform: translate(-50%, -50%);
    right: 15px;
    border: 3px solid #f1f1f1;
    z-index: 9;
}

</style>

<script type="text/javascript">
    var post_image_file_edit = null;
    var post_id_holder = document.getElementById("post_id_holder").getAttribute("data-value");

    function openForm(id)
    {
        document.getElementById("myForm" + id).style.display = "block";
    }

    function closeForm(id)
    {
        document.getElementById("myForm" + id).style.display = "none";
        document.getElementById("post-image-popup" + id).style.display = "none";
    }

    function displayInitialPostImageEdit(postImagePath, id)
    {
        if(postImagePath !== null && postImagePath.length > 0)
        {
            document.getElementById("post-image-popup" + id).src = "<?=ROOT?>" + "/" + postImagePath;
            document.getElementById("post-image-popup" + id).style.display = "block";
        }
    }

    function displayAteredPostImageEdit(file, id)
    {
        let allowed = ['jpg', 'jpeg', 'png', 'webp'];
        let ext = file.name.split(".").pop();
        if(!allowed.includes(ext.toLowerCase()))
        {
            alert("Only files of these type allowed: " + allowed.toString(", "));
            return;
        }
        document.getElementById("post-image-popup" + id).src = URL.createObjectURL(file);
        document.getElementById("post-image-popup" + id).style.display = "block";
        post_image_file_edit = file;
    }

    function edit_post(event, id)
    {
        event.preventDefault();
        var obj = {};
        obj.post_id = id;
        obj.content = document.getElementById("postTextEdit" + id).value;
        obj.user_id = current_user_id;//from the div that holds the value of current logged in user
        obj.image = post_image_file_edit;
        send_data(obj, "edit_post");
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