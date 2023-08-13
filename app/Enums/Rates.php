<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class Rates extends Enum
{
    const Permanent = 12.5;
    const Casual = 5.25;
    const Default = 1.5;
}
