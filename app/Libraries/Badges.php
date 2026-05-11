<?php

namespace App\Libraries;

use App\Models\FeedbackModel;
use App\Models\OrderModel;


class Badges
{
    function getBadges()
    {
        $data = [];

        // TODO заглушка
        return $data;

        $feedback = new FeedbackModel();
        $unreaded = $feedback->getUnreadedCount();
        if(count($unreaded)) {
            $count = 0;
            foreach ($unreaded as $val) {
                $count += $val->cnt;
            }
            $data['unreaded'] = $count;
        }

        $feedback = new OrderModel();
        $unreaded = $feedback->getUnreadedCountTotal();
        $data['orders'] = $unreaded->count;
//        if(count($unreaded)) {
//            $count = 0;
//            foreach ($unreaded as $val) {
//                $count += $val->cnt;
//            }
//        }

        return $data;
    }
}

?>