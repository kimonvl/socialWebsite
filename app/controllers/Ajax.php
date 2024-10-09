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
			$result['success'] = true;
			$result['message'] = "Profile image changed successfully";
		}

		echo json_encode($result);
	}

	public function create_post()
	{
		$result = [];
		$post = new \Model\Post;
		$req = new \Core\Request;
		$image_row = $req->files('image');

		if($post->validate(['content' => $req->post_get('content'), 'image' => $image_row]))
		{

			$post_data = [];
			
			if(!empty($image_row))
			{
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
					$post_data['image'] = $destination;
				}
			}
			$post_data['userid'] = $req->post_get('user_id');
			$post_data['content'] = $req->post_get('content');
			$post_data['date'] = date("Y-m-d H:i:s");
			$post->insert($post_data);
			$result['success'] = true;
			$result['message'] = 'post created successfully';
		}else
		{
			$result['success'] = false;
			$result['message'] = $post->errors['post'];
		}
		echo json_encode($result);exit();
	}

	public function edit_post()
	{
		$result = [];
		$post = new \Model\Post;
		$req = new \Core\Request;
		$image_row = $req->files('image');
		$post_row = $post->where(['id' => $req->post_get('post_id')]);

		if($post->validate(['content' => $req->post_get('content'), 'image' => $image_row]))
		{

			$post_data = [];
			
			if(!empty($image_row))
			{
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
					$post_data['image'] = $destination;

					if(!empty($post_row->image))
					{
						if(file_exists($post_row->image))
							unlink($post_row->image);
					}
					
				}
			}
			$post_data['userid'] = $req->post_get('user_id');
			$post_data['content'] = $req->post_get('content');
			$post_data['date'] = date("Y-m-d H:i:s");
			$post->update($req->post_get('post_id'), $post_data, 'id');
			$result['success'] = true;
			$result['message'] = 'post updated successfully';
		}else
		{
			$result['success'] = false;
			$result['message'] = $post->errors['post'];
		}
		echo json_encode($result);	
	}

	public function send_friend_request()
	{
		$req = new \Core\Request;
		$friendreq = new \Model\FriendRequest;

		$data = [];
		$data['senderid'] = $req->post_get('senderid');
		$data['recieverid'] = $req->post_get('recieverid');
		$data['accepted'] = 0;
		$data['date'] = date("Y-m-d H:i:s");

		$result = [];
		if($friendreq->insert($data))
		{
			$result['success'] = true;
			$result['message'] = "Request sent successfully";
		}else
		{
			$result['success'] = false;
			$result['message'] = "Request failed";
		}
		echo json_encode($result);
	}
}