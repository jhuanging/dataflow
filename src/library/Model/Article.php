<?php
namespace Model;

use Svc\Error;
use Libyaf\Database\Database;
use Libyaf\Logkit\Logger;

class Article
{
    public function get($params)
    {
        $database = Database::ins()
            ->createQueryBuilder()
            ->select('*')
            ->from('article');

        if (isset($params['id'])) {
            $database->andWhere('id=:id')->setParameter(':id', $params['id']);
        }

        if (isset($params['source_id'])) {
            $database->andWhere('source_id=:source_id')->setParameter(':source_id', $params['source_id']);
        }

        return $database->execute()->fetch();
    }

    public function saveAll($data)
    {
        $conn = Database::ins();

        $conn->beginTransaction();

        try {
            foreach ($data as $item) {
                $this->save($item);
            }

            $conn->commit();
        } catch (\Exception $e) {
            Logger::ins('_exception')->error($e->getMessage());

            $conn->rollback();

            return false;
        }

        return true;
    }

    public function save($data)
    {
        Database::ins()->insert('article', $data);

        return Database::ins()->lastInsertId();
    }
}

