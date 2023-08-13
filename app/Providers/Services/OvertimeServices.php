<?php

namespace App\Providers\Services;

use App\Http\Middleware\specifications\ListOvertimeByCategory;
use App\Providers\Interfaces\IOvertimeCategory;
use App\Providers\Interfaces\IOvertimeSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OvertimeServices extends ListOvertimeByCategory implements IOvertimeCategory
{
    use HasFactory;

    public function overtime_categories(string $category)
    {
        return ListOvertimeByCategory::filter_category_list($category);
    }

}
