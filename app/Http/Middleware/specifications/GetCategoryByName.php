<?php

namespace App\Http\Middleware\specifications;

use App\Models\Category;
use Illuminate\Routing\Controllers\Middleware;

class GetCategoryByName extends Middleware
{
    protected static function select_category(string $name)
    {
        $category = Category::where('category', $name)->first();
        return $category;
    }
}
