<?php

namespace Borto\Application\Controllers;

use Borto\Application\Traits\ApiResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequestsl;
    use DispatchesJobs;
    use ValidatesRequests;
    use ApiResponse;
}
