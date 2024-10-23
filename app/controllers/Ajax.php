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

	public function accept_request()
	{
		$req = new \Core\Request;
		$ses = new \Core\Session;
		$friend_request = new \Model\FriendRequest;
		$friendship = new \Model\Friendship;
		$conv = new \Model\Conversation;
		$grp_member = new \Model\GroupMember;

		$data = [];
		$result = [];

		$data['senderid'] = $req->post_get('senderid');
		$data['recieverid'] = $ses->get_user('id');

		$request_row = $friend_request->first($data);

		if($friend_request->update($request_row->id, ['accepted' => 1], 'id'))
		{
			if($friendship->insert(['userid' => $data['senderid'], 'friendid' => $data['recieverid'], 'date' => date("Y-m-d H:i:s")]))
			{
				//create conversation between the 2 friends
				$conv->insert(['name' => $data['senderid'] . "-" . $data['recieverid']]);
				$conversation_id = $conv->first(['name' => $data['senderid'] . "-" . $data['recieverid']])->id;
				//adding the first member of conversation
				$grp_member->insert(['user_id' => $data['senderid'], 'conversation_id' => $conversation_id, 'joined_date' => date("Y-m-d H:i:s")]);
				//adding the second member of conversation
				$grp_member->insert(['user_id' => $data['recieverid'], 'conversation_id' => $conversation_id, 'joined_date' => date("Y-m-d H:i:s")]);

				$result['success'] = true;
				$result['message'] = "Request accepted successfully";
			}else
			{
				$result['success'] = false;
				$result['message'] = "Failed to accept request";
			}
		}else
		{
			$result['success'] = false;
			$result['message'] = "Failed to accept request";
		}

		echo json_encode($result);
	}

	public function load_chat_messages($convID)
	{
		$message = new \Model\Message;
		$user = new \Model\User;
		$messages = $message->where(['conversation_id' => $convID]);
		$messages = $user->addUserToMessages($messages);
		$result = [];
		$result['messages'] = $messages;
		$result['action'] = "print_messages";

		echo json_encode($result);
	}

	public function search_profile()
	{
		$req = new \Core\Request;
		$user = new \Model\User;

		$query = "select * from users where username like :needle ";
		$matches = $user->query($query, ['needle' => '%' . $req->post_get('search_text') . '%']);

		$result = [];
		$result['matches'] = $matches;
		$result['action'] = "print_profile_search_results";

		echo json_encode($result);
	}
}