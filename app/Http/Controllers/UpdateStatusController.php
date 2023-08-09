<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStatusStoreRequest;
use App\Models\Post;
use App\Models\UpdateStatusTime;
use Illuminate\Http\Request;

class UpdateStatusController extends Controller
{
    public function store(UpdateStatusStoreRequest $request)
    {
        try{
            $updateStatusTime = UpdateStatusTime::create([
                'model_name' => $request->model_name ?? Post::class,
                'status' => $request->status ?? Post::ON_HOLD,
                'time' => $request->time,
            ]);

            return response()->json([
                'message' => 'Update status time created successfully',
                'data' => $updateStatusTime
            ], 201);

        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UpdateStatusStoreRequest $request, UpdateStatusTime $updateStatusTime)
    {
        try{
            $updateStatusTime->update([
                'model_name' => $request->model_name ?? $updateStatusTime->model_name,
                'status' => $request->status ?? Post::ON_HOLD,
                'time' => $request->time,
            ]);

            return response()->json([
                'message' => 'Update status time updated successfully',
                'data' => $updateStatusTime
            ], 200);

        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
