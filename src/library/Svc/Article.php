<?php
namespace Svc;

use Model\Article as MA;

class Article
{
    public function saveAll($job, $data)
    {
        if (! $data) {
            return false;
        }

        $source = [];

        foreach ($data as $item) {
            if ($this->existSource($item['taskid'])) {
                continue;
            }

            $result = json_decode($item['result'], true);

            $source[] = [
                'title'         => strval($result['title']),
                'summary'       => '',
                'body'          => strval($result['content']),
                'source'        => $job,
                'source_id'     => $item['taskid'],
                'source_time'   => date('Y-m-d H:i:s', $item['updatetime']),
            ];
        }

        return (new MA)->saveAll($source);
    }

    public function existSource($sourceId)
    {
        $params = [
            'source_id' => $sourceId,
        ];

        return (new MA)->get($params) ? true : false;
    }

}

