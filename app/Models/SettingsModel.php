<?php namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    public $table = "settings";

    public $structure = [
        "sections" => [
            "cms" => [
                "title" => "Настройки CMS",
                "tabs" => [
                    "main" => [
                        "title" => "Основные настройки",
                        "items" => [
                            "DEFAULT_TEMPLATE" => [
                                "label" => "Основной шаблон сайта",
                                "type" => "text"
                            ],
                            "DEFAULT_USER_TEMPLATE" => [
                                "label" => "Основной шаблон ЛК пользователя",
                                "type" => "text"
                            ],
                            "DEFAULT_ADMIN_TEMPLATE" => [
                                "label" => "Основной шаблон админки",
                                "type" => "text"
                            ],
                            "AVATARS_DIRECTORY" => [
                                "label" => "Путь к аватаркам",
                                "type" => "text"
                            ],
                        ]
                    ],
                    "main1" => [
                        "title" => "Основные",
                        "items" => [
                            "TEST" => [
                                "label" => "Какое-то значение1",
                                "type" => "text"
                            ]
                        ]
                    ],
                ]
            ],
            "crm" => [
                "title" => "Настройки CRM",
                "tabs" => [
                    "crm_main" => [
                        "title" => "Основные настройки",
                        "items" => [
                            "NOTIFY_START" => [
                                "label" => "Время рассылки уведомлений с:",
                                "type" => "time"
                            ],
                            "NOTIFY_END" => [
                                "label" => "Время рассылки уведомлений до:",
                                "type" => "time"
                            ],
                        ]
                    ],
                ]
            ],
            "integrations" => [
                "title" => "Интеграции",
                "items" => [
                    "SMSRU_TOKEN" => [
                        "label" => "Код SMS.RU",
                        "type" => "text",
                    ],
                    "WIALON_TOKEN" => [
                        "label" => "Код WIALON",
                        "type" => "text",
                    ]
                ]
            ],
        ]
    ];

}
