<?php

namespace App\Enums\ticket;


enum Status: string
{
    case Open = 'open';
    case Closed = 'closed';
}
