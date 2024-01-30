<?php

namespace Nortedevbr\PexelsApi;

use Nortedevbr\PexelsApi\Enums\CorEnum;
use Nortedevbr\PexelsApi\Enums\OrientacaoEnum;
use Nortedevbr\PexelsApi\Enums\TamanhoEnum;
use Nortedevbr\PexelsApi\Exception\PexelsException;
use Nortedevbr\PexelsApi\Helpers\Validador;
use Nortedevbr\PexelsApi\Traits\RequestTrait;

class PexelsVideos
{
    use RequestTrait;

    public function __construct(string $urlBase, string $apiKey = null)
    {
        $this->apiKey = $apiKey;
        $this->urlBase = $urlBase;
    }

    /**
     * @param int|null $menorLargura em pixels
     * @param int|null $menorAltura em pixels
     * @param int|null $menorDuracao em segundos
     * @param int|null $maximaDuracao em segundos
     * @param int $pagina
     * @param int $porPagina
     * @return bool|string
     * @throws PexelsException
     */
    public function populares(
        int $menorLargura = null,
        int $menorAltura = null,
        int $menorDuracao = null,
        int $maximaDuracao = null,
        int $pagina = 1,
        int $porPagina = 10
    ): bool|string
    {
        if ($porPagina > 80) {
            throw new PexelsException(PexelsException::MAX_REGISTROS);
        }
        $url = $this->getUrlBase() . "popular?" . http_build_query(array_filter([
                'min_width' => $menorLargura,
                'min_height' => $menorAltura,
                'min_duration' => $menorDuracao,
                'max_duration' => $maximaDuracao,
                'page' => $pagina,
                'per_page' => $porPagina
            ]));
        return $this->request($url);
    }

    /**
     * @throws PexelsException
     */
    public function buscarPorId(int $id): bool|string
    {
        $url = $this->getUrlBase() . "videos/" . $id;
        return $this->request($url);
    }
}