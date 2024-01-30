<?php

namespace Nortedevbr\PexelsApi\Enums;

use Nortedevbr\PexelsApi\Traits\EnumTrait;

enum OrientacaoEnum: string
{
    use EnumTrait;

    case HORIZONTAL = 'landscape';
    case VERTICAL = 'portrait';
    case QUADRADA = 'square';
}
