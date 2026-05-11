<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\ChannelEntity;
use App\Models\PostsModel;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

class MainController extends BaseController
{
    public function index()
    {
        $data['title'] = "Главная страница";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        $token = '7747802532:AAElxqJYF2Go7Uixp_TGwdUpTjCh8YzLYSI';
////        $chatId = '5533094311'; // Ваш chat_id в Telegram (можно получить у бота @userinfobot)
        $chatId = '-1002386275705'; // Ваш chat_id в Telegram (можно получить у бота @userinfobot)

        /** @var \Telegram\Bot\Api $telegram */
        $telegram = getTelegram();

//        $telegram->sendMessage([
//            'chat_id' => $chatId,
//            'text' => "From ne interface"
//        ]);
        $chat = $telegram->getChatAdministrators(['chat_id' => $chatId]);

        foreach ($chat as $item) {
            $fileUrl = "";
            $response = $telegram->getUserProfilePhotos(["user_id" => $item["user"]["id"], "limit" => 1]);
            $photos = $response->getPhotos();
            if (!empty($photos) && count($photos)) {
                $photo = $photos[0][count($photos[0]) - 1];
                $fileId = $photo["file_id"];
                $fileResponse = $telegram->getFile(['file_id' => $fileId]);
                $filePath = $fileResponse->getFilePath();
                $fileUrl = "https://api.telegram.org/file/bot{$token}/{$filePath}";
            }

            $data['admins'][] = ["user" => $item["user"], "fileUrl" => $fileUrl];
        }

        $data['channels']  = (new ChannelEntity())->getAllChannels();
//        dd($data['channels']);
        $data['card'] = view('layouts/chanel_admins', $data);
        $data['channels_card'] = view('layouts/channels_card', $data);
        $data['content'] = view('welcome_message', $data);

        $this->render($data);
    }

    public function newPost()
    {
        $data['title'] = "Главная страница";
        $data['cur_menu'] = $this->cur_menu;
        $data['cur_sub_menu'] = $this->cur_sub_menu;
        $data['tag'] = '';

        $token = '7747802532:AAElxqJYF2Go7Uixp_TGwdUpTjCh8YzLYSI';
        $chatId = '5533094311'; // Ваш chat_id в Telegram (можно получить у бота @userinfobot)
//        $chatId = '-1002386275705'; // Ваш chat_id в Telegram (можно получить у бота @userinfobot)
//        $chatId = '@it_nectar'; // Ваш chat_id в Telegram (можно получить у бота @userinfobot)

        $d = '*Вы задумывались когда-нибудь,* \n что самые долгожданные вещи происходят в самый неожиданный момент. Вот и со мной такое случилось. Я так долго ждал этого письма и не думал, что это произойдет именно вот так. Но Мегамеркет творит настоящее волшебство: в честь Чёрной пятницы здесь действует повышенный кешбэк до 75% бонусами Спасибо! Наконец-то я смогу заказать все товары, которые так долго ждут своей очереди в корзине. А с удобной доставкой по клику, курьер подстроится под вас и привезет заказы домой в удобное время от 15 минут. ';

        $telegram = new Api($token);
//        $res = $telegram->sendMessage([
//            'chat_id' => $chatId,
//            'text' => "From ne interface"
//        ]);

        $res = $telegram->sendPhoto([
            'chat_id' => $chatId,
//        'photo' => 'https://nectar.ltd/assets/img/sales/bitrrix-desktop.png',
            'photo' => InputFile::create('https://nectar.ltd/assets/img/sales/bitrrix-desktop.png'),
            'caption' => $d,
            'parse_mode' => 'Markdown',
//        'reply_markup' => Keyboard::make()
//            ->inline()
//            ->row(
//                [
//                    Keyboard::inlineButton(['text' => 'Сат Nectar.ltd', 'url' => 'https://nectar.ltd']),
//                ]
//            )
        ]);

        $messageId = $res->getMessageId();
//        $this->statusSuccess(var_dump($messageId));
        $this->statusSuccess($messageId);
    }
}
