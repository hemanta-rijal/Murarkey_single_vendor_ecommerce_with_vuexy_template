<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{

    public function fallback()
    {
        return response()->json([
    'data' => [],
    'success' => false,
    'status' => 404,
    'message' => 'Invalid Route',
]);

    }
}
