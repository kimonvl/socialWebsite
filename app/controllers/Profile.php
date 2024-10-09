<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Profile
{
	use Controller;

	public function index($id = '')
	{
		$ses = new \Core\Session;
		$user = new \Model\User;
		$post = new \Model\Post;
		$friendreq = new \Model\FriendRequest;

		$limit = 10;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;
		$post->limit = $limit;
		$post->offset = $offset;
		if(!$ses->is_logged_in())
			redirect("Create_account");

		$post->limit = $limit;
		$post->offset = $offset;

		if(empty($id))
		{
			$data['friend_req_button'] = 'disabled'; 
		}else
		{
			$set1 = $friendreq->first(['senderid' => $id, 'recieverid' => $ses->get_user('id')]);
			$set2 = $friendreq->first(['senderid' => $ses->get_user('id'), 'recieverid' => $id]);
			if($set1 && $set1->accepted == 0)
			{
				$data['friend_req_button'] = 'Pending';
			}
			elseif ($set2 && $set2->accepted == 0)
			{
				$data['friend_req_button'] = 'Pending';
			}
			elseif ($set1 && $set1->accepted == 1)
			{
				$data['friend_req_button'] = 'disabled';
			}
			elseif ($set2 && $set2->accepted == 1)
			{
				$data['friend_req_button'] = 'disabled';
			}
			elseif(!$set1 && !$set2)
			{
				$data['friend_req_button'] = 'Add friend';
			}
		}

		$id = empty($id) ? $ses->get_user('id') : $id;
		$data['userRow'] = $user->first(['id' => $id]);
		$data['posts'] = $post->where(['userid' => $id]);
		$data['posts'] = $post->add_users_to_posts($data['posts']);

		$this->view('profile', $data);
	}
}