<?php

use Illuminate\Support\Facades\Schedule;

Schedule::call('backup:run')
    ->daily();
