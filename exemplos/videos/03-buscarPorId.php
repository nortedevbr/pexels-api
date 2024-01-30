<?php

use Nortedevbr\PexelsApi\Exception\PexelsException;
use Nortedevbr\PexelsApi\PexelsSetup;

include dirname(__DIR__) . "/bootstrap.php";

$pexels = new PexelsSetup($_ENV['API_KEY']);

try {
    $id = 4058068;
    $resposta = $pexels->videos()->buscarPorId($id);
    $resposta = json_decode($resposta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (PexelsException $e) {
    $resposta = $e->getMessage();
}

dd($resposta);