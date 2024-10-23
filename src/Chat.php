<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

define("SERVERPATH", __DIR__ . DIRECTORY_SEPARATOR);

require "app/core/config.php";
require "app/core/functions.php";
require "app/core/Database.php";
require "app/core/Model.php";
require "app/models/GroupMember.php";
require "app/models/Message.php";
require "app/models/User.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data_obj = json_decode($msg);

        switch ($data_obj->type) {
            case 'new_conn':
                $from->user_id = $data_obj->user_id;
                $this->clients->attach($from);
                break;
            case 'new_message':
                $this->process_new_message($data_obj, $from);
                break;
            
            default:
                // code...
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    private function process_new_message($msg, $from)
    {
        $grp_member = new \Model\GroupMember;
        $user = new \Model\User;
        //find group members of the conversation to which the message was sent
        $grp_member->order_column = "user_id";
        $members = $grp_member->where(['conversation_id' => $msg->conversation_id], ['user_id' => $msg->sender_id]);


        //send message if reciever is online
        foreach ($this->clients as $client) {
            foreach ($members as $member) {
                if($client->user_id == $member->user_id)
                {   
                    print_r("message sent to " . $member->user_id);
                    $msg->sender_image = $user->first(['id' => $msg->sender_id])->image;
                    $msg->type = "message_income";
                    $client->send(json_encode($msg, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                }
            }
        }

        //save to the database
        $message = new \Model\Message;
        $data = [];
        $data['message_text'] = $msg->message;
        $data['date'] = date("Y-m-d H:i:s");
        $data['conversation_id'] = $msg->conversation_id;
        $data['sender_id'] = $msg->sender_id;
        if($message->insert($data))
        {
            $myObj->type = "message_saved";
            $myObj->success = true;
            $myObj->message_text = $msg->message;
            $from->send(json_encode($myObj, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }else
        {
            $myObj->type = "message_saved";
            $myObj->success = false;
            $from->send(json_encode($myObj, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
    }
}