<?php

namespace App\Services;

use App\Enums\LivestockEnum;
use App\Factories\LivestockFactory;
use App\Services\Livestock\Livestock;

class Farm
{
    /**
     * @var Livestock[] $animals
     */
    private array $livestock;

    private array $products;


    public function add(LivestockEnum $animal): void
    {
        $this->livestock[] = LivestockFactory::addAnimal($animal);
    }


    public function countLivestock(): array
    {
        $typeCounts = [];

        foreach ($this->livestock as $animal) {
            $type = $animal->getType();
            if (!isset($typeCounts[$type])) {
                $typeCounts[$type] = 0;
            }
            $typeCounts[$type]++;
        }

        return $typeCounts;
    }

    public function collectProducts(): array
    {
        foreach ($this->livestock as $animal) {

            if ($animal->canProduce()){
                $type = $animal->getType();
                $product = $animal->produceProduct();

                if (isset($this->products[$type])) {
                    $this->products[$type] += $product;
                } else {
                    $this->products[$type] = $product;
                }
            }
        }

        return $this->products;
    }


    public function nextDay(): void
    {
        foreach ($this->livestock as $animal) {
            $animal->resting();
        }
    }

    public function soldProducts(): void
    {
        $this->products = [];
    }


}
