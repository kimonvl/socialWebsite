var post_image_file = null;
const current_user_id = document.getElementById("user_id_holder").getAttribute("data-value");
const root = "http://localhost/socialWebsite/public";

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

function send_friend_request(senderid, recieverid)
{
    var obj = {};
    obj.senderid = senderid;
    obj.recieverid = recieverid;
    send_data(obj, "send_friend_request");
}

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
        document.getElementById("post-image-popup" + id).src = root + "/" + postImagePath;
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

    ajax.open('post', root + '/ajax/' + func, true);
    ajax.send(myform);
}

function handle_result(result)
{
    let obj = JSON.parse(result);
    alert(obj.message);
    location.reload();
}