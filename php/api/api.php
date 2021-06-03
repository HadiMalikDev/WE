<?php

use GuzzleHttp\Client;

require_once 'C:/xampp/htdocs/phpFile/php/vendor/autoload.php';

class Api
{

    private static $instance = null;
    private function __construct()
    {
        $this->client = new Client();
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Api();
        }
        return self::$instance;
    }

    private $client;
    
    public function fetchSurahs()
    {
        $url = "https://api.quran.com/api/v4/chapters?language=en";
        $response = $this->client->get($url);
        echo $response->getBody();
    }
    public function fetchVerses($chapter)
    {
        $scriptType = 'uthmani';
        $scriptUrl = "https://api.quran.com/api/v4/quran/verses/${scriptType}?chapter_number=${chapter}";
        $response = $this->client->get($scriptUrl);
        $responseBody = $response->getBody();

        $decodedBody = json_decode($responseBody, true)['verses'];

        $returnArray = array();

        foreach ($decodedBody as $verse) {
            $verseTranslation = $this->fetchVerseTranslation($verse['verse_key']);

            array_push(
                $returnArray,
                array(
                    'verse_key' => $verse['verse_key'],
                    'verse' => $verse["text_${scriptType}"],
                    'verseTranslation' => $verseTranslation,    
                ),
            );
        }
        return $returnArray;
    }

    private function fetchVerseTranslation($verse_key)
    {
        $translationId = 131;
        $translationUrl = "https://api.quran.com/api/v4/quran/translations/${translationId}?verse_key=${verse_key}";
        $response = $this->client->get($translationUrl);
        $responseBody = $response->getBody();
        $decodedBody = json_decode($responseBody, true)['translations'][0]['text'];
        return $decodedBody;
    }
}
