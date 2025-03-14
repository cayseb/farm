<?php

namespace App\Services\Livestock;

abstract class ProductiveLivestock extends Livestock
{

    private bool $hasProducedToday = false;


    public function produceProduct(): int|float
    {

        if ($this->isReadyToProduce()) {
            $product = $this->generateProduct();
            $this->hasProducedToday = true;
            return $product;
        }
        return 0;

    }

    public function isReadyToProduce(): bool
    {
        return !$this->hasProducedToday;
    }


    public function resting(): void
    {
        $this->hasProducedToday = false;
    }

    abstract protected function generateProduct(): int|float;


    public function canProduce(): true
    {
        return true;
    }
}
