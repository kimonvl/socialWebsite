var post_image_file_edit = null;
var post_id_holder = document.getElementById("post_id_holder").getAttribute("data-value");
const root = "http://localhost/socialWebsite/public";

/*
TODO: message disapear from input after sent, append sent messages to chatbody when press send botton
*/

var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e) {
    var data = {};
    data.user_id = document.getElementById("user_id_holder").getAttribute('data-value');
    data.type = "new_conn";
    conn.send(JSON.stringify(data));
};

conn.onmessage = function(e) {
    let msg = JSON.parse(e.data);
    console.log(msg);
    if(msg.type == "message_income")
    {
        print_income_message(msg);
    }else if(msg.type == "message_saved")
    {
        print_saved_message(msg);
    }
    
};

function print_income_message(msg)
{
    let chat = document.getElementById("chatBody");   
    htmlData = '<div class="chat-message received"><div class="profile-img"><img src="' + root + "/" + msg.sender_image + '"></div><div class="message-bubble">' + msg.message + '</div></div>';
    chat.insertAdjacentHTML("beforeend", htmlData);
}

function print_saved_message(msg)
{
    if(msg.success)
    {
        let chat = document.getElementById("chatBody");
        htmlData = '<div class="chat-message sent"><div class="message-bubble">' + msg.message_text + '</div></div>';
        chat.insertAdjacentHTML("beforeend", htmlData);
    }else
    {
        let chat = document.getElementById("chatBody");
        htmlData = '<div class="chat-message sent"><div class="message-bubble"> failed to send message </div></div>';
        chat.insertAdjacentHTML("beforeend", htmlData);
    }
    
}

function send_message()
{
    var data = {};

    data.conversation_id = document.getElementById('conversation_id_chat').innerHTML;
    data.sender_id = document.getElementById('sender_id_chat').innerHTML;
    data.message = document.getElementById('chat_message_input').value;
    document.getElementById('chat_message_input').value = '';
    data.type = "new_message";

    conn.send(JSON.stringify(data));
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

function accept_request(sid)
{
    var obj = {};
    obj.senderid = sid;
    send_data(obj, "accept_request");
}



function open_chat_window(chatName, conversation_id, sender_id)
{
    document.querySelector('.chat-window').style.display= 'flex';
    document.getElementById('chthdr').innerHTML = chatName;
    document.getElementById('conversation_id_chat').innerHTML = conversation_id;
    document.getElementById('sender_id_chat').innerHTML = sender_id;
    document.getElementById("chatBody").innerHTML = '';
}

function close_chat()
{
    document.querySelector('.chat-window').style.display= 'none';
    document.getElementById("chatBody").innerHTML = '';
}

function load_chat_messages(convID)
{
    var obj = {};
    send_data(obj, "load_chat_messages/" + convID);
}

function search_profile()
{
    var obj = {};
    obj.search_text = document.getElementById("profile_search_input").value;
    send_data(obj, "search_profile");
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
    if(Object.hasOwn(obj, 'action'))
    {
        if(obj.action == "print_messages")
        {
            print_messages(obj.messages);
            return;
        }else if(obj.action == "print_profile_search_results")
        {
            print_profile_search_results(obj.matches);
            return;
        }
    }
    location.reload();
}

function print_profile_search_results(matches)
{

    let dropdown = document.getElementById("dropdown-search");
    if (matches == null)
    {
        htmlData = '<div class="profile-item"><span>No matches found</span></div>';
        dropdown.insertAdjacentHTML("afterbegin", htmlData);
        dropdown.style.display = "block";
        return;
    }

    for (const match of matches)
    {

        htmlData = '<div class="profile-item"><img src="' + root + "/" + match.image + '"><span>' + match.username + '</span></div>';
        dropdown.insertAdjacentHTML("afterbegin", htmlData);
        dropdown.style.display = "block";
    }
}

function print_messages(messages)
{
    let chat = document.getElementById("chatBody");

    if(messages == null)
        return;
      
    for (const message of messages) {
        if(message.sender_id == current_user_id)
        {
            htmlData = '<div class="chat-message sent"><div class="message-bubble">' + message.message_text + '</div></div>';
            chat.insertAdjacentHTML("afterbegin", htmlData);
        }else
        {
            htmlData = '<div class="chat-message received"><img class="profile-img" src="' + message.user.image + '"><div class="message-bubble">' + message.message_text + '</div></div>';
            chat.insertAdjacentHTML("afterbegin", htmlData);
        }
    }
    
}