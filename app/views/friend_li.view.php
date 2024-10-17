<li class="friend" onclick="open_chat_window('<?=$conversation->members[0]->user->username?>', '<?=$conversation->conversation_id?>', '<?=$conversation->user_id?>'); load_chat_messages('<?=$conversation->conversation_id?>');">
    <img src="<?=get_image($conversation->members[0]->user->image)?>" alt="Profile Picture">
    <div class="friend-info">
        <p class="name"><?=$conversation->members[0]->user->username?></p>
        <span class="status online"></span>
    </div>
</li>