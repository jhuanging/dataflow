<?php
use Libyaf\Database\Database;
use Libyaf\Queue\Queue;
use Libyaf\Helper\Daemon;
use Svc\CoinMarketCap;

class CoinmarketcapController extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        $result = CoinMarketCap::getData();
        $result = json_decode($result, true);
        foreach ($result as $r) {
            $data = [
                "oid" => $r['id'],
                "name" => $r['name'],
                "symbol" => $r['symbol'],
                "rank" => $r['rank'],
                "price_usd" => $r['price_usd'],
                "price_btc" => $r['price_btc'],
                "24h_volume_usd" => $r['24h_volume_usd'],
                "market_cap_usd" => $r['market_cap_usd'],
                "available_supply" => $r['available_supply'],
                "total_supply" => empty($r['total_supply'])?'':$r['total_supply'],
                "max_supply" => empty($r['max_supply'])?'':$r['max_supply'],
                "percent_change_1h" => $r['percent_change_1h'],
                "percent_change_24h" => $r['percent_change_24h'],
                "percent_change_7d" => $r['percent_change_7d'],
                "last_updated" => $r['last_updated']
            ];
            $cMC = new Model\CoinMarketCap();
            $c = $cMC->get(['key'=>$data['key'], 'last_updated'=>$data['last_updated']]);
            if (!$c) {
                $cMC->save($data);
            }
        }
    }
}

