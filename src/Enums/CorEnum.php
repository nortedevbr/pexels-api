<?php

namespace Nortedevbr\PexelsApi\Enums;

use Nortedevbr\PexelsApi\Traits\EnumTrait;

enum CorEnum: string
{
    use EnumTrait;

    case VERMELHO = 'red';
    case LARANJA = 'orange';
    case AMARELO = 'yellow';
    case VERDE = 'green';
    case TURQUESA = 'turquoise';
    case AZUL = 'blue';
    case VIOLETA = 'violet';
    case ROSA = 'pink';
    case MARROM = 'brown';
    case PRETO = 'black';
    case CINZA = 'gray';
    case BRANCO = 'white';
}
