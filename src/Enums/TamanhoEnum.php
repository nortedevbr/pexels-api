<?php

namespace Nortedevbr\PexelsApi\Enums;

use Nortedevbr\PexelsApi\Traits\EnumTrait;

enum TamanhoEnum: string
{
    use EnumTrait;

    case GRANDE = "large";
    case MEDIO = "medium";
    case PEQUENO = "small";
}
