<?php

namespace App\Traits;
use Illuminate\Notifications\RoutesNotifications;

trait CustomNotifiable
{
    use CustomHasDatabaseNotifications, RoutesNotifications;
}
