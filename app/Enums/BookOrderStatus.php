<?php

namespace App\Enums;

abstract class BookOrderStatus
{
    const PENDING = 1;
    const PROCESSING = 2;
    const COMPLETED = 3;
    const CANCELLED = 4;
}
