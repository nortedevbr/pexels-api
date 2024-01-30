<?php

namespace Nortedevbr\PexelsApi\Traits;

use ReflectionClass;

trait EnumTrait
{
    public static function toArray(): array {
        $reflection = new ReflectionClass(static::class);
        return array_map(function ($enum){
            return $enum->value;
        },$reflection->getConstants());
    }
}