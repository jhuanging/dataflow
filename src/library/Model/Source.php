<?php
namespace Model;

use Svc\Error;
use Libyaf\Database\Database;

class Source
{
    public function listNearestId()
    {
        return Database::ins()
            ->createQueryBuilder()
            ->select('*')
            ->from('spider')
            ->execute()
            ->fetchAll();
    }

    public function saveNearestId($job, $taskId)
    {
        $data = [
            'task_id' => $taskId,
        ];

        return (bool) Database::ins()->update('spider', $data, array('job'=>$job));
    }

    public function listSource($job, $taskId, $count)
    {
        return Database::ins('source')
            ->createQueryBuilder()
            ->select('*')
            ->from($job)
            ->where('taskid > :taskid')
            ->setParameter(':taskid', $taskId)
            ->setMaxResults($count)
            ->execute()
            ->fetchAll();
    }

}

