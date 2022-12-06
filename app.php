<?php

include 'vendor/autoload.php';;

use GuzzleHttp\Client;
use Orhanerday\OpenAi\OpenAi;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

define("OPEN_AI_KEY", getenv('OPEN_AI_KEY'));
// TODO implement VALUESERP_KEY
//define("VALUESERP_KEY", getenv('VALUESERP_KEY'));

$openAi = new OpenAi(OPEN_AI_KEY);
$client = new Client();

$topic = $argv[1];
$generationLimit = 150;
$wordCount = 500;
$terms = [$topic];
$generated = [];

while (true) {
    $term = array_shift($terms);
    $prompt = "Peux tu me rédiger un article de {$wordCount} mots sur ";
    $openAiRes = $openAi->completion([
        'model' => 'text-davinci-002',
        'prompt' => $prompt . $term,
        'temperature' => .9,
        'max_tokens' => $wordCount
    ]);

    $json = json_decode($openAiRes);
    $text = trim($json->choices[0]->text);

    // TODO implement Value erp to retrieve related search and generate accurate article
    // $res = $client->get('https://api.valueserp.com/search?api_key=' . VALUESERP_KEY . '&q=' . urlencode($term));
    // $related = array_map(function($e){
    //    return $e->query;
    //}, json_decode($res->getBody()->getContents())->related_searches);

    // Saved in html generated article
    file_put_contents('./generated/' . uniqid() . '.html', "<h1>{$term}</h1><div class='container'>{$text}</div>");

    $generated[] = $terms;

    if (count($generated) > $generationLimit) {
        break;
    }
}
