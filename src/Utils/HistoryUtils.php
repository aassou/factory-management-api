<?php

namespace App\Utils;

class HistoryUtils
{
    /**
     * @param string $action
     * @param string $target
     * @param array $params
     * @return array
     */
    public static function buildHistoryData(
        string $action,
        string $target,
        array $params
    ) {
        return [
            "action" => $action,
            "target" => $target,
            "description" => sprintf("%s %s %s %s",
                $action,
                $target,
                $params['status'],
                $params['label']
            )
        ];
    }
}