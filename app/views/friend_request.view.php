<li>
      <img src="<?=get_image($request->sender->image, "user")?>" alt="Profile" class="profile-img">
      <span class="profile-name"><?=$request->sender->username?></span>
      <button class="btn accept-btn" onclick="accept_request(<?=$request->sender->id?>);">Accept</button>
      <button class="btn decline-btn">Decline</button>
</li>