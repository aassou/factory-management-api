<?php

namespace App\Trait;

use App\Manager\HistoryManager;

trait HistoryTrait
{
    /**
     * @var HistoryManager
     */
    protected HistoryManager $historyManager;

    /**
     * @param string $action
     * @param string $target
     * @param array $params
     * @return array
     */
    public function buildHistoryData(
        string $action,
        string $target,
        array $params
    ): array {
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
