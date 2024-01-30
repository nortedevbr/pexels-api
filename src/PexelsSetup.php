<?php

namespace Nortedevbr\PexelsApi;

use Nortedevbr\PexelsApi\Exception\PexelsException;

class PexelsSetup
{
    private string $urlBase = 'https://api.pexels.com/';
    private string $urlFotos = 'v1/';
    private string $urlVideos = 'videos/';
    private string|null $apiKey = null;
    private PexelsFotos $fotos;
    private PexelsVideos $videos;

    public function __construct(string $apiKey = null)
    {
        $this->apiKey = $apiKey;
        $this->fotos = new PexelsFotos($this->getUrlFotos(), $this->apiKey);
        $this->videos = new PexelsVideos($this->getUrlVideos(), $this->apiKey);
    }

    private function getUrlFotos(): string
    {
        return $this->urlBase . $this->urlFotos;
    }

    private function getUrlVideos(): string
    {
        return $this->urlBase . $this->urlVideos;
    }

    public function fotos(): PexelsFotos
    {
        return $this->fotos;
    }

    public function videos(): PexelsVideos
    {
        return $this->videos;
    }
}