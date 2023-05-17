<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Item;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Schema::defaultStringLength(125);
        $this->generateAdviceForAllItems();
    }
    public function generateAdviceForAllItems()
    {
        $items = Item::all();

        foreach ($items as $item) {
            // Calculate the age of the device
            $dateBought = Carbon::createFromFormat('Y-m-d', $item->date_purchased);
            $ageInYears = $dateBought->diffInYears(Carbon::now());

            // Fetch the estimated lifespan from the associated item category
            $estimatedLifespan = $item->itemCategory->estimated_lifespan;

            // Adjust the estimated lifespan based on the purchased_as value
            if ($item->purchased_as === 'Used') {
                $estimatedLifespan -= 2;
            }

            // Generate advice based on the age of the device and estimated lifespan
            $advice = [];

if ($ageInYears >= $estimatedLifespan) {
    $advice = $item->itemCategory->message;
    

            } 
            else {
                $advice = 'Device in optimal condition.';
            }

            // Save the advice to the database
            $item->update([
                'advice' => json_encode($advice),
            ]);
        }
    }
}


