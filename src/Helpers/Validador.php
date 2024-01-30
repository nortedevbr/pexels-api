<?php

namespace Nortedevbr\PexelsApi\Helpers;

final class Validador
{
    public static function isHexColor(string $color = null): bool
    {
        if (empty($color)) {
            return false;
        }
        $color = ltrim($color, '#');
        return preg_match('/^[a-fA-F0-9]{6}$/', $color) || preg_match('/^[a-fA-F0-9]{3}$/', $color);
    }
}