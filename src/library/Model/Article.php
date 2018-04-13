<?php
namespace Model;

use Svc\Error;
use Libyaf\Database\Database;
use Libyaf\Logkit\Logger;

class Article
{
    public function get($params,  $tableName='article')
    {
        $database = Database::ins()
            ->createQueryBuilder()
            ->select('*')
            ->from($tableName);

        if (isset($params['id'])) {
            $database->andWhere('id=:id')->setParameter(':id', $params['id']);
        }

        if (isset($params['source_id'])) {
            $database->andWhere('source_id=:source_id')->setParameter(':source_id', $params['source_id']);
        }

        return $database->execute()->fetch();
    }

    public function saveAll($data, $tableName='article')
    {
        $conn = Database::ins();

        $conn->beginTransaction();

        try {
            foreach ($data as $item) {
                $this->save($item, $tableName);
            }

            $conn->commit();
        } catch (\Exception $e) {
            Logger::ins('_exception')->error($e->getMessage());

            $conn->rollback();

            return false;
        }

        return true;
    }

    public function save($data, $tableName='article')
    {
        Database::ins()->insert($tableName, $data);

        return Database::ins()->lastInsertId();
    }
}

