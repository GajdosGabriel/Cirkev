<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01.11.2017
 * Time: 8:58
 */

namespace App\Services;


class SpamDetector
{
    public function detect($body)
    {
        // detect invalid keywords
        $this->detectInvalidKeywords($body);
        $this->detectKeyHeldDown($body);

        return false;
    }

    protected function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'spam',
            'Gabriel je somár'
        ];

        foreach( $invalidKeywords as $keyword)
        {
            if(stripos($body, $keyword ) !== false)
            {
                throw new \Exception('Vaša správa sa podobá SPAMU');
            }
        }
    }

    protected function detectKeyHeldDown($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body))
        {
            throw new \Exception('Vaša správa neobsahuje myšlienku!');
        }
    }


}