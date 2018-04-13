<?php
namespace Svc;

use Libyaf\Queue\Queue;
use Model\Source as MS;

class Source
{
    public function save($count = 5, callable $callback)
    {
        $result = [];

        $count = intval($count);
        if ($count <= 0) {
            throw new \LogicException('set invalid source count');
        }

        $sourceId = $this->listNearestId();

        if (! $sourceId) {
            return $result;
        }

        foreach ($sourceId as $item) {
            $sourceResult = $this->listSource($item['job'], $item['task_id'], $count);

            if ($sourceResult) {
                $result = call_user_func($callback, $item['job'], $sourceResult);

                if ($result) {
                    //翻译队列
                    foreach ($sourceResult as $sR) {
                        $sR['job'] = $item['job'];
                        $sR['task_id'] = $item['task_id'];
                        $sR['lang'] = $item['lang'];
                        Queue::ins()->push('translate_queue', json_encode($sR));
                    }
                    $nearestResult = array_pop($sourceResult);
                    $this->saveNearestId($item['job'], $nearestResult['taskid']);
                }
            }
        }

        return true;
    }

    public function listNearestId()
    {
        return (new MS)->listNearestId();
    }

    public function saveNearestId($job, $taskId)
    {
        return (new MS)->saveNearestId($job, $taskId);
    }

    public function listSource($job, $taskId, $count)
    {
        return (new MS)->listSource($job, $taskId, $count);
    }

}

