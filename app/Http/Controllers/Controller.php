<?php

namespace App\Http\Controllers;

use App\Traits\ResponseSender;

abstract class Controller
{
    use ResponseSender;
}
