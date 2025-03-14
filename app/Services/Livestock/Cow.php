<?php

namespace App\Services\Livestock;


class Cow extends ProductiveLivestock
{

    protected function generateProduct(): int
    {
        return rand(8, 12);
    }
}
