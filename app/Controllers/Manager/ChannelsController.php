<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\ChannelEntity;
use App\Libraries\Telegram;
use Telegram\Bot\Exceptions\TelegramSDKException;

class ChannelsController extends BaseController
{
    public function index()
    {
        $data['title'] = "Список каналов";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();

        $data['channels'] = (new ChannelEntity())->getAllChannels();
        $data['content'] = view("channels", $data);
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

        try {
            $channel = $telegram->getChat(['chat_id' => $channelID]);

            $subscribers = $telegram->getChatMemberCount(['chat_id' => $channelID]);
            $data['subscribers'] = $subscribers;

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

        } catch (TelegramSDKException $e) {
            $data['channel'] = $channelEntity->getChannel($recordID);
            $data['content'] = viewError("channel_not_found", $data);
        }

        $this->render($data);
    }

    public function newChanel()
    {
        $data['title'] = "Главная страница";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';
    }

    public function saveChannel()
    {
        [, $err] = (new ChannelEntity())->saveChannel($this->request->getPost());
        if(!$err) {
            $this->statusSuccess("Успещно сохранено");
        }

        $this->statusError($err);
    }

    public function checkChannel()
    {
        if(empty($channelName = $_POST["channelName"])) $this->statusError("Не передан ID канала");

        $a = str_contains($channelName, "t.me");
        if($a) echo ">>> {$a} <<<";
        
        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();


        try {
            $channel = $telegram->getChat(['chat_id' => $channelName]);
            $description = $channel["description"] ?? "";
            $description = str_replace("\n", "<br>", $description);
            $data["data"] = [
                "title" => $channel["title"],
                "description" => $description,
                "image" => (new ChannelEntity())->getChannelsPhotoURL($channel),
            ];
            $this->statusSuccess("success", $data);
        } catch (TelegramSDKException $e) {
            if($e->getMessage() == "Bad Request: chat not found") {
                $this->statusError("Канал не найден");
            } else {
                $this->statusError($e->getMessage());
            }
        }
    }
}
