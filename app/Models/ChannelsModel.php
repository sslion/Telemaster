<?php

namespace App\Models;

use CodeIgniter\Model;

class ChannelsModel extends Model
{
    public $table = 'channels';

    protected $allowedFields = [
        "title",
        "description",
        "username",
        "image",
    ];
}