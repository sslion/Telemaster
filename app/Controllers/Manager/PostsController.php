<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\ChannelEntity;
use App\Entities\PostEntity;
use App\Libraries\Telegram;

class PostsController extends BaseController
{
    public function index()
    {
        $data['title'] = "Список постов";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        /** @var \Telegram\Bot\Api $telegram */
//        $telegram = getTelegram();

        $data['posts'] = (new PostEntity())->getAllPosts();

        $data['content'] = view("posts", $data);
        $this->render($data);
    }

    public function editChannel()
    {
        $data['title'] = "Канал: ";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        if (empty($_GET['channel'])) {
            $l = "Location: " . site_url(route_to('admin_channels'));
            header($l);
            exit();
        }

        $channelEntity = new ChannelEntity();
        $recordID = $_GET['channel'];
        $channelID = $channelEntity->getChannelUsername($recordID);
        if (!$channelID) {
            $this->statusError("Такой канал не существует");
        }

        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();
        $channel = $telegram->getChat(['chat_id' => $channelID]);
//        $channel["description"] = str_replace("\n", "<br>", $channel["description"]);

        $fileUrl = "images/channelNoPhoto.png";
        $data['noPhoto'] = true;
        if($res = $channelEntity->getChannelsPhotoURL($channel)) {
            $fileUrl = $res;
            $data['noPhoto'] = false;
        }

        $data['title'] .= $channel['title'];
        $data['fileUrl'] = $fileUrl;
        $data['channelID'] = $recordID;
        $data['channel'] = $channel;
        $data['content'] = view("channel_edit", $data);

        $this->render($data);
    }

    public function newPost()
    {
        $data['title'] = "Добавление поста";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        $data['channel'] = '';
        if (!empty($_GET['channel'])) {
            $channel = (new ChannelEntity())->getChannel($_GET['channel']);
            if (!$channel) {
                $this->statusError("Такой канал не существует");
            }

            $data['channel'] = $channel;
        }

        $data['content'] = view("new_post", $data);
        $this->render($data);
    }

    public function savePost()
    {
        $res = (new ChannelEntity())->saveChannel($this->request->getPost());
        if($res) {
            $this->statusSuccess("Успещно сохранено");
        }

        $this->statusError("Неудалось сохранить");
    }
}
