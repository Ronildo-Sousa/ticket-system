<?php

namespace App\Enums\user;

enum Roles: int
{
    case Regular = 1;
    case Agent = 2;
    case Administrator = 3;
}
