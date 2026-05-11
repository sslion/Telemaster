<?php
namespace App\Entities;

use App\Libraries\Telegram;
use App\Models\ChannelsModel;
use App\Models\PostsModel;
use Telegram\Bot\Objects\Chat;

class PostEntity
{
    public function getAllPosts(): array
    {
        return (new PostsModel())->findAll();
    }

    public function getChannelsInfo($channelID): Chat
    {
        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();
        return $telegram->getChat(['chat_id' => $channelID]);
    }


    public function getChannelsPhotoURL($channelData): mixed
    {
        $telegram = getTelegram();

        if(empty($channelData['photo']['big_file_id'])) return false;

        $fileId = $channelData['photo']['big_file_id'];
        $fileResponse = $telegram->getFile(['file_id' => $fileId]);
        $filePath = $fileResponse->getFilePath();
        $token = Telegram::$token;

        return "https://api.telegram.org/file/bot{$token}/{$filePath}";
    }

    public function saveChannel($data): mixed
    {
        /** @var \Telegram\Bot\Api $telegram */

        $bewData = [
            "id" => $data["id"],
            "title" => $data["title"],
            "description" => $data["description"],
            "image" => $data["photoURL"],
        ];

        $telegram = getTelegram();

        $res = $telegram->setChatTitle([
            "chat_id" => "@" . $data["username"],
            "title" => $data["title"]
        ]);
        if(!$res) return false;

        $res = $telegram->setChatDescription([
            "chat_id" => "@" . $data["username"],
            "description" => $data["description"]
        ]);
        if(!$res) return false;

        $res = (new ChannelsModel())->save($bewData);
        return $res;

        $s = "Как мы строим IT-бизнес в России: делимся опытом, успехами и ошибками
CRM Сайты Приложения Виджеты Сервисы

Наш сайт: https://nectar.ltd/

Связь @nectar_tech";
    }
}