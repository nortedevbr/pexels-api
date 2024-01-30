<?php

namespace Nortedevbr\PexelsApi;

use Nortedevbr\PexelsApi\Enums\CorEnum;
use Nortedevbr\PexelsApi\Enums\OrientacaoEnum;
use Nortedevbr\PexelsApi\Enums\TamanhoEnum;
use Nortedevbr\PexelsApi\Exception\PexelsException;
use Nortedevbr\PexelsApi\Helpers\Validador;
use Nortedevbr\PexelsApi\Traits\RequestTrait;

class PexelsFotos
{
    use RequestTrait;

    public function __construct(string $urlBase, string $apiKey = null)
    {
        $this->apiKey = $apiKey;
        $this->urlBase = $urlBase;
    }

    /**
     * @throws PexelsException
     */
    public function recursos(
        int $pagina = 1,
        int $porPagina = 10
    ): string
    {
        if ($porPagina > 80) {
            throw new PexelsException(PexelsException::MAX_REGISTROS);
        }

        $url = $this->getUrlBase() . "curated?" . http_build_query(['page' => $pagina, 'per_page' => $porPagina]);
        return $this->request($url);
    }

    /**
     * @throws PexelsException
     */
    public function buscarPorId(int $id): bool|string
    {
        $url = $this->getUrlBase() . "photos/" . $id;
        return $this->request($url);
    }

}