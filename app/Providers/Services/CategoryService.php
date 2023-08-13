<?php

namespace App\Providers\Services;

use App\Http\Middleware\specifications\GetCategoryByName;
use App\Providers\Interfaces\ICategorySpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryService extends GetCategoryByName implements ICategorySpec
{
    use HasFactory;

    public static function get_category(string $name)
    {
        return GetCategoryByName::select_category($name);
    }
}
