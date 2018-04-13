<?php
namespace Svc;

class BaiduTranslate
{
    public function __construct() {
        $this->appId = '20180412000145339';
        $this->key   = 'FdY2SwUF2gRk9ut5TsDp';
        $this->url   = 'http://api.fanyi.baidu.com/api/trans/vip/translate';
    }

    public function post($url, $data)
    {
        $postdata = http_build_query($data);

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    public function run($content, $from='en', $to='zh') {
        $salt = rand(1,10000000);
        $data = [
            'q'=>$content,
            'from'=>$from,
            'to'=>$to,
            'appid'=>$this->appId,
            'salt'=>$salt,
            'sign'=>strtolower(md5($this->appId.$content.$salt.$this->key))
        ];
        $result = $this->post($this->url, $data);
        if ($result) {
            $result = json_decode($result, true);
            return empty($result['trans_result'][0]['dst'])?'':$result['trans_result'][0]['dst'];
        }
        return '';
    }
}
