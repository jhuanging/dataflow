<?php
namespace Model;

use Svc\Error;
use Libyaf\Database\Database;
use Libyaf\Logkit\Logger;

class CoinMarketCap
{
    public function get($params)
    {
        $database = Database::ins()
            ->createQueryBuilder()
            ->select('*')
            ->from('coin_market_cap');

        if (isset($params['oid'])) {
            $database->andWhere('oid=:oid')->setParameter(':oid', $params['oid']);
        }

        if (isset($params['last_updated'])) {
            $database->andWhere('last_updated=:last_updated')->setParameter(':last_updated', $params['last_updated']);
        }

        return $database->execute()->fetch();
    }

    public function save($data)
    {
        Database::ins()->insert('coin_market_cap', $data);

        return Database::ins()->lastInsertId();
    }
}

