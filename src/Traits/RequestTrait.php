<?php

namespace Nortedevbr\PexelsApi\Traits;

use Nortedevbr\PexelsApi\Enums\CorEnum;
use Nortedevbr\PexelsApi\Enums\OrientacaoEnum;
use Nortedevbr\PexelsApi\Enums\TamanhoEnum;
use Nortedevbr\PexelsApi\Exception\PexelsException;
use Nortedevbr\PexelsApi\Helpers\Validador;

trait RequestTrait
{
    private string $urlBase;
    private string|null $apiKey;

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(?string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function getUrlBase(): string
    {
        return $this->urlBase;
    }

    public function setUrlBase(string $urlBase): static
    {
        $this->urlBase = $urlBase;
        return $this;
    }



    /**
     * @param string|null $por
     * @param OrientacaoEnum|null $orientacao
     * @param TamanhoEnum|null $tamanho
     * @param CorEnum|string|null $cor
     * @param int $pagina
     * @param int $porPagina
     * @param string|null $idioma
     * @return string
     * @throws PexelsException
     */
    public function buscar(
        string|null         $por = null,
        OrientacaoEnum|null $orientacao = null,
        TamanhoEnum|null    $tamanho = null,
        CorEnum|string|null $cor = null,
        int                 $pagina = 1,
        int                 $porPagina = 10,
        string|null         $idioma = null,
    ): string
    {
        if (isset($orientacao) && !$orientacao instanceof OrientacaoEnum) {
            throw new PexelsException(sprintf(PexelsException::TIPOS_ACEITOS, 'orientações', implode(", ", OrientacaoEnum::toArray())));
        }
        if (isset($tamanho) && !$tamanho instanceof TamanhoEnum) {
            throw new PexelsException(sprintf(PexelsException::TIPOS_ACEITOS, 'dimensões', implode(", ", TamanhoEnum::toArray())));
        }
        if (!isset($cor) || (!$cor instanceof CorEnum && !Validador::isHexColor($cor))) {
            throw new PexelsException(sprintf(PexelsException::TIPOS_ACEITOS, 'cores', implode(", ", CorEnum::toArray()) . " ou em hexadecimal"));
        }
        if ($porPagina > 80) {
            throw new PexelsException(PexelsException::MAX_REGISTROS);
        }

        $idioma = match ($idioma) {
            "en", "en-US" => 'en-US',
            "es", "es-ES" => 'es-ES',
            default => 'pt-BR',
        };

        if (empty($por)) {
            $por = "finance";
        }

        $url = $this->getUrlBase() . "search?" . http_build_query(array_filter([
                'query' => $por,
                'orientation' => $orientacao->value ?? null,
                'size' => $tamanho->value ?? null,
                'color' => $cor->value ?? null,
                'locale' => $idioma,
                'page' => $pagina,
                'per_page ' => $porPagina
            ]));
        return $this->request($url);
    }

    /**
     * @throws PexelsException
     */
    private function request(string $url): bool|string
    {
        if (empty($this->getApiKey())) {
            throw new PexelsException();
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $headers = ['Authorization: ' . $this->getApiKey()];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new PexelsException('cUrlError:' . curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }
}