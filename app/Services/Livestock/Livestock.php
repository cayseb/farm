<?php

namespace App\Services\Livestock;

use App\Enums\LivestockEnum;
use Ramsey\Uuid\Uuid;

abstract class Livestock
{
    private string $id;
    private string $type;

    public function __construct(LivestockEnum $livestockEnum)
    {
        $this->type = $livestockEnum->value;
        $this->id = Uuid::uuid4()->toString();
    }


    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    abstract public function canProduce(): bool;
}
