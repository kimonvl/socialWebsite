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
                    alert(current_user_id);
                    obj.user_id = current_user_id;
                    obj.image = post_image_file;
                    send_data(obj, "create_post");
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
                    alert(result);
                    location.reload();
                }