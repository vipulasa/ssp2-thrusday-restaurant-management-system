<?php

namespace App\Enums;

enum UserRole : int
{
    case Administrator = 1;

    case RestaurantManager = 2;

    case Customer = 3;
}
