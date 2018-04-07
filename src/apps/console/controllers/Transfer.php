<?php
use Libyaf\Database\Database;
use Libyaf\Helper\Daemon;
use Svc\Source;
use Svc\Article;

class TransferController extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        $config = Yaf\Registry::get('config')->daemon->transfer->toArray();

        $daemon = new Daemon($config);

        $source     = new Source();
        $article    = new Article();

        $job = function ($worker) use ($source, $article) {
            Database::ping('source');
            Database::ping();

            $result = $source->save(5, [$article, 'saveAll']);

            if (! $result) {
                sleep(30);
                return false;
            }

            return true;
        };

        $daemon->setJob($job);

        $daemon->loop(100);

        $daemon->run();
    }

}

