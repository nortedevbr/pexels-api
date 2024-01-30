<?php

namespace Nortedevbr\PexelsApi\Exception;

use Exception;

class PexelsException extends Exception
{
    const string TIPOS_ACEITOS = 'Somente são aceitas as seguintes %s (usar enum): %s';
    const string MAX_REGISTROS = 'Limite máximo de 80 registros por página';
}