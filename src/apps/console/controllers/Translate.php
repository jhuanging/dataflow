<?php
use Libyaf\Database\Database;
use Libyaf\Queue\Queue;
use Libyaf\Helper\Daemon;
use Svc\Source;
use Svc\Article;
use Svc\BaiduTranslate;

class TranslateController extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        /*
        $source     = new Source();
        $article    = new Article();
        $result = $source->save(10, [$article, 'saveAll']);
         */
        $callback = function ($data) {
            $data = json_decode($data, true);
            $article = new Article();
            if ($data['lang'] == 'en' && isset($result['label_list']) && isset($result['text_list'])) {//翻译
                $result = json_decode($data['result'], true);
                $content = '';
                $transClient = new BaiduTranslate();
                for ($i=0; $i < count($result['text_list']); $i++) {
                    $p = $result['text_list'][$i];
                    if ($result['label_list'][$i] = 'text') {
                        $p = $transClient->run($p);
                    }
                    $content .= '<p>'.$p.'</p>';
                }
                $result['content'] = $content;
                $data['result'] = json_encode($result);
                //保存中文结果
                $article->saveAll($data['job'], [$data], 'article_zh');
            }
            //保存原本结果
            $article->saveAll($data['job'], [$data], 'article_'.$data['lang']);
        };

        Queue::ins()->pull('translate_queue', $callback);
    }
}

