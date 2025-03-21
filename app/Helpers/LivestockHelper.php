<?php

namespace App\Helpers;

use App\Enums\LivestockEnum;
use App\Services\Livestock\Chicken;
use App\Services\Livestock\Cow;
use App\Services\Livestock\Livestock;

class LivestockHelper
{

    public static function addAnimal(LivestockEnum $enum): Livestock
    {
        return match ($enum->value) {
            'cow' => new Cow($enum),
            'chicken' => new Chicken($enum),
        };

    }
}
