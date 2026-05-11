<?php
namespace App\Entities;

use App\Libraries\Telegram;
use App\Models\ChannelsModel;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Chat;
use function Symfony\Component\Translation\t;

class ChannelEntity
{
    static $channels = null;

    public function getAllChannels(): array
    {
        if(static::$channels) {
            return static::$channels;
        }

        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();

        $channels = (new ChannelsModel())->findAll();

        if(!count($channels)) return static::$channels = [];

        foreach ($channels as &$channel) {
            try {
                $subscribers = $telegram->getChatMemberCount(['chat_id' => $channel['username']]);
                $channel['subscribers'] = $subscribers;

                $chat = $telegram->getChat(['chat_id' => $channel['username']]);
                $fileUrl = "images/channelNoPhoto.png";
                if($res = $this->getChannelsPhotoURL($chat)) {
                    $fileUrl = $res;
                }
                $channel['image'] = $fileUrl;
            } catch (TelegramSDKException $e) {
                $channel['subscribers'] = 0;
                $channel['image'] = null;
                $channel['error'] = ["code" => $e->getCode(), "message" => $e->getMessage()];
            }

            static::$channels[] = $channel;
        }

        return static::$channels;
    }

    public function getChannel($channelID): array
    {
        return (new ChannelsModel())->find($channelID);
    }

    public function getChannelsInfo($channelID): Chat
    {
        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();
        return $telegram->getChat(['chat_id' => $channelID]);
    }

    public function getChannelUsername($channelID): mixed
    {
        $res = (new ChannelsModel())->find($channelID);
        if($res) {
            return $res['username'];
        }

        return $res;
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
        $telegram = getTelegram();

        try {
            $res = $telegram->setChatTitle([
                "chat_id" => "@" . $data["username"],
                "title" => $data["title"]
            ]);

            $res = $telegram->setChatDescription([
                "chat_id" => "@" . $data["username"],
                "description" => $data["description"]
            ]);
        } catch (TelegramSDKException $e) {
            if(403 == $e->getCode()){
                return [false, "Бот не участник или администратор канала."];
            }
            if("Bad Request: chat description is not modified" != $e->getMessage()) {
                throw new \Exception($e->getMessage());
            }
        }

        $res = (new ChannelsModel())->save([
            "id" => $data["id"],
            "title" => $data["title"],
            "description" => $data["description"],
            "image" => $data["photoURL"],
        ]);
        return [$res, 0];

        $s = "Как мы строим IT-бизнес в России: делимся опытом, успехами и ошибками
CRM Сайты Приложения Виджеты Сервисы

Наш сайт: https://nectar.ltd/

Связь @nectar_tech";
    }
}