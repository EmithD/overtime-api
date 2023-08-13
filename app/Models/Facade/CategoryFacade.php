<?php

namespace App\Models\Facade;

use App\Enums\Rates;
use App\Models\Category;
use App\Providers\Services\CategoryService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryFacade
{
    use HasFactory;

    // Function-> 
    static function get_hourly_rate_facade(string $name)
    {
        $response = CategoryService::get_category($name);

        if (!empty($response)) {

            switch ($response->category) {
                case 'Permanent':
                    return Rates::Permanent;
                    break;
                case 'Casual':
                    return Rates::Casual;
                    break;

                default:
                    return Rates::Default;
                    break;
            }
        }
    }
}
