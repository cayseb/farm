<?php

namespace App\Services\Livestock;


class Chicken extends ProductiveLivestock
{

    protected function generateProduct(): int
    {
        return rand(0, 1);
    }
}
