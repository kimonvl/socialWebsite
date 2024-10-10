<?php

namespace Controller;

defined('ROOTPATH') OR exit("Access denied!");

class Home
{
	use Controller;

	public function index()
	{
		$user = new \Model\User;
		$post = new \Model\Post;
		$friendreq = new \Model\FriendRequest;
		$friendship = new \Model\Friendship;
		$ses = new \Core\Session;

		$limit = 10;
		$data['pager'] = new \Core\Pager($limit);
		$offset = $data['pager']->offset;

		if(!$ses->is_logged_in())
			redirect("Create_Account");

		$data['user_row'] = $user->first(['id' => $ses->get_user('id')]);

		$post->order_column = 'date';
		$post->limit = $limit;
		$post->offset = $offset;
		$data['posts'] = $post->where();
		$data['posts'] = $post->add_users_to_posts($data['posts']);

		$frequests = $friendreq->where(['recieverid' => $ses->get_user('id'), 'accepted' => 0]);
		$data['friend_requests'] = $user->addSenderUserToFriendReq($frequests);

		$friendships = $friendship->friends_of($ses->get_user('id'));
		$data['friendships'] = $user ->add_users_to_friendships($friendships, $ses->get_user('id'));

		$this->view('home', $data);
	}
}

