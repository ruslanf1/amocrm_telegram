<?php

namespace App\Http\Controllers\Amo\Elements;

use App\Http\Controllers\Amo\Query\CountElements\CountController;
use App\Http\Controllers\MainController;
use Exception;

class LeadsColdController extends MainController
{
    /**
     * Принимает id пользователя. Содержит параметры фильтрации.
     * Возвращает колличество сделок перешедших из воронки "Холодные продажи" с этапа "База для обзвона"
     * в любые другие этапы. В случае ошибки выбрасывает исключение.
     *
     * @param $userId
     * @return int
     * @throws Exception
     */
    public function getLeadsCold($userId): int {
        try {
            $getSet = [
                'method' => 'events',
                'limit' => 100,
                'filter[created_by]' => $userId,
                'filter[value_before][leads_statuses][0][pipeline_id]' => 4575370,
                'filter[value_before][leads_statuses][0][status_id]' => 42130510,
            ];
            return (new CountController)->countElement($getSet);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
