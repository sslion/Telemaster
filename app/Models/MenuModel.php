<?php namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = "menu_items";

    public function getMenus() {
        // Заглушка для админ меню
        return [
            [
                "title" => "item 1",
            ],
        ];


        $this->setTable("menus");
        return $this->findAll();
    }

    public function getMenu()
    {
        $menu['uslugi'] = [
            'title' => 'Наши услуги',
            'link' => '',
            'childs' => [
                'destruction' => [
                    'title' => 'Утилизация архивов',
                    'link' => 'pages/destruction',
                ],
                'storge' => [
                    'title' => 'Хранение архивов',
                    'link' => 'pages/storage',
                ],
                'ecobox' => [
                    'title' => 'Установка экобоксов',
                    'link' => 'pages/ecobox',
                ],
                'containers-sale' => [
                    'title' => 'Установка контейнеров',
                    'link' => 'pages/containers-sale',
                ],
                'buy' => [
                    'title' => 'Прием вторсырья',
                    'link' => 'pages/buy',
                ],
            ]
        ];
        $menu['buy'] = [
            'title' => 'Мы покупаем',
            'link' => 'pages/buy',
        ];
        $menu['price'] = [
            'title' => 'Цены',
            'link' => 'pages/price',
        ];
        $menu['pallets'] = [
            'title' => 'Мы продаём',
            'link' => 'pages/pallets',
        ];
        $menu['projects'] = [
            'title' => 'Наши проекты',
            'link' => 'pages/projects',
        ];
        $menu['about'] = [
            'title' => 'О компании',
            'link' => '',
            'childs' => [
                'vacancy' => [
                    'title' => 'Вакансии',
                    'link' => 'pages/vacancy',
                ],
                'reviews' => [
                    'title' => 'Отзывы',
                    'link' => 'pages/reviews',
                ],
                'questions' => [
                    'title' => 'Вопрос - ответ',
                    'link' => 'pages/questions',
                ]
            ]
        ];
        $menu['blog'] = [
            'title' => 'Блог',
            'link' => 'news',
        ];
        $menu['contacts'] = [
            'title' => 'Контакты',
            'link' => 'pages/contacts',
        ];
//        $menu['personal-account'] = [
//            'title' => 'Личный кабинет',
//            'link' => 'admin/dashboard'
//            //'link' => 'pages/personal-account'
//        ];

        return $menu;
    }

    public function getAdminMenu()
    {
//        $this->orderBy('position', 'ASC');
        $result = $this->findAll();
        $menu = [];
        try {
            foreach ($result as $item) {
                if (!$item["parent_id"] == 0) continue;

                $menu_item = [
                    "title" => $item["title"],
                    "icon" => $item["fa_icon"],
                    "code" => $item["code"],
                ];
                if (!empty($item["route_name"])) {
                    $menu_item["link"] = route_to($item["route_name"]);
                }
                if (!empty($item["badge_id"])) {
                    $menu_item["item_id"] = $item["badge_id"];
                }
                $menu[$item["id"]] = $menu_item;
            }

            foreach ($result as $item) {
                if ($item["parent_id"] == 0) continue;

                $menu_item = [
                    "title" => $item["title"],
                    "icon" => $item["fa_icon"],
                    "code" => $item["code"],
                ];
                if (!empty($item["route_name"])) {
                    $menu_item["link"] = route_to($item["route_name"]);
                }
                if (!empty($item["badge_id"])) {
                    $menu_item["item_id"] = $item["badge_id"];
                }
                $menu[$item["parent_id"]]["childs"][] = $menu_item;
            }
        } catch (\Exception $e) {
            dd($item);
        }
//        dd($menu);
        return $menu;
    }
}
