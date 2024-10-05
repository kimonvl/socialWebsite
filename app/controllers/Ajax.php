<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Ajax
{
	use Controller;

	public function profile_image_change()
	{
		$result = [];
		$req = new \Core\Request;
		$user = new \Model\User;
		$image_row = $req->files('image');
		$user_row = $user->first(['id' => $req->post_get('id')]);

		if($image_row['error'] == 0)
		{
			$folder = "uploads/";
			if(!file_exists($folder))
			{
				mkdir($folder, 0777,true);
			}
			$destination = $folder . time() . $image_row['name'];
			move_uploaded_file($image_row['tmp_name'], $destination);
			$image_class = new \Model\Image;
			$image_class->resize($destination, 1000);

			if(file_exists($user_row->image))
				unlink($user_row->image);

			$user->update($user_row->id, ['image' => $destination]);
			$info['success'] = true;
			$info['message'] = "Profile image changed successfully";
		}

		echo json_encode($result);
	}
}