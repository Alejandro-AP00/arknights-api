<?php

use App\Console\Commands\ImportAll;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ImportAll::class)->everyFourHours();
