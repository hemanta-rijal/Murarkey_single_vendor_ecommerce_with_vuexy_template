<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyService;

class JoinMurarkeyController extends Controller
{
    private $joinMurarkeyService;

    public function __construct(JoinMurarkeyService $JoinMurarkeyService)
    {
        $this->joinMurarkeyService = $JoinMurarkeyService;
    }
    public function storeParlourProfession(Request $request)
    {
        $data = $request->all();
        $data['preferred_work'] = json_encode($request->preferred_work);
        $data['preferred_location'] = json_encode($request->preferred_location);
        if ($this->joinMurarkeyService->create($data)) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'successfully stored',
            ]);
        }
        return response()->json([
            'status' => 500,
            'success' => false,
            'message' => 'could not be stored',
        ]);

    }
}
