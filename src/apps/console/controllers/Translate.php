<?php
use Stichoza\GoogleTranslate\TranslateClient;

class TranslateController extends Yaf\Controller_Abstract
{
    public function indexAction()
    {
        $source = '我要用爬虫爬数据';

        $tr = new TranslateClient();

        $tr->setSource('auto');
        $tr->setTarget('en');
        $tr->setUrlBase('https://translate.google.cn/translate_a/single');

        $target = $tr->translate($source);

        \Libyaf\Helper\Debug::vars($target);
    }
}

