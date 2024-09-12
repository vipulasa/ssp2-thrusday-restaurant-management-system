<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Analytics;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnalyticsController extends Controller
{
    public function makeHit(Request $request)
    {
        return rescue(function() use ($request){

            $data = $request->validate([
                'model' => 'required|string',
                'model_id' => 'required|integer',
                'user_id' => 'required|integer|exists:users,id',
                'payload' => 'required|array',
            ]);

            $analytics = Analytics::create($data);

            if($analytics){
                // REMOVE THIS RETURN WHEN THE SYSTEM IS MOVED TO PRODUCTION
                return response()->json([
                    'status' => true,
                    'message' => 'Analytics record created successfully',
                    'data' => $analytics,
                    '_time' => now()
                ]);
            }

            // throw an exception if the user is not authenticated
            throw new \Exception('Failed to create the analytics record');

        }, function($e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                '_time' => now()
            ], 401);
        });

    }
}
