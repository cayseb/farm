<?php

namespace App\Console\Commands;

use App\Enums\LivestockEnum;
use App\Services\Farm;
use Illuminate\Console\Command;

class RunFarmCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run life on farm';

    /**
     * Execute the console command.
     */
    public function handle(Farm $farm): void
    {
        $this->info('the farm came to life');

        $this->info('add 10 cows');

        $this->addLivestock($farm,LivestockEnum::COW, 10);


        $this->info('add 20 chickens');

        $this->addLivestock($farm,LivestockEnum::CHICKEN, 20);


        $this->info('Livestock counting');

        $typeCounts = $farm->countLivestock();
        foreach ($typeCounts as $type => $count) {
            $this->info("There are {$count} {$type}(s) on the farm.");
        }

        $this->info('collecting products');

        $products = $this->weeklyFee($farm);

        foreach ($products as $type => $count) {
            $this->info("Collected {$count} units of product from {$type}(s) on the farm this week.");
        }

        $farm->soldProducts();

        $this->info('add 5 cows');

        $this->addLivestock($farm,LivestockEnum::COW, 5);

        $this->info('add one chicken');

        $this->addLivestock($farm,LivestockEnum::CHICKEN, 1);

        $this->info('Livestock counting');

        $typeCounts = $farm->countLivestock();
        foreach ($typeCounts as $type => $count) {
            $this->info("There are {$count} {$type}(s) on the farm.");
        }

        $products = $this->weeklyFee($farm);

        foreach ($products as $type => $count) {
            $this->info("Collected {$count} units of product from {$type}(s) on the farm this week.");
        }
    }

    public function weeklyFee(Farm $farm): array
    {
        for ($i = 1; $i <= 7; $i++) {
            $products = $farm->collectProducts();
            $farm->nextDay();
        }
        return $products;
    }

    private function addLivestock(Farm $farm, LivestockEnum $enum, $quantity): void
    {
        for ($i = 1; $i <= $quantity; $i++) {
            $farm->add($enum);
        }
    }
}
