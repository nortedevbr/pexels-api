<?php

use Nortedevbr\PexelsApi\Enums\OrientacaoEnum;
use Nortedevbr\PexelsApi\Enums\TamanhoEnum;
use Nortedevbr\PexelsApi\Enums\CorEnum;
use Nortedevbr\PexelsApi\Exception\PexelsException;
use Nortedevbr\PexelsApi\PexelsSetup;

include dirname(__DIR__) . "/bootstrap.php";

$pexels = new PexelsSetup($_ENV['API_KEY']);

try {
    $resposta = $pexels->fotos()->buscar(
        null,
        OrientacaoEnum::HORIZONTAL,
        TamanhoEnum::GRANDE,
        CorEnum::AZUL
    );
    $resposta = json_decode($resposta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (PexelsException $e) {
    $resposta = $e->getMessage();
}

dd($resposta);