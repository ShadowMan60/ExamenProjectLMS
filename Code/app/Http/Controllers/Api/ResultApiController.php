<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\ResultDetail;
use Illuminate\Http\Request;

class ResultApiController extends Controller
{
    // Get all results for a specific user (with details)
    public function index($userId)
    {
        $results = Result::where('user_id', $userId)->with('resultDetails')->get();
        return response()->json($results);
    }

    // Store a new result with details
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'score' => 'required|integer',
            'details' => 'required|array',
            'details.*.question_id' => 'required|integer|exists:questions,id',
            'details.*.answer_id' => 'nullable|integer|exists:answers,id',
            'details.*.was_correct' => 'required|boolean',
        ]);

        $result = Result::create([
            'user_id' => $data['user_id'],
            'score' => $data['score'],
        ]);

        foreach ($data['details'] as $detail) {
            ResultDetail::create([
                'result_id' => $result->id,
                'question_id' => $detail['question_id'],
                'answer_id' => $detail['answer_id'] ?? null,
                'was_correct' => $detail['was_correct'],
            ]);
        }

        return response()->json([
            'message' => 'Result saved successfully',
            'result_id' => $result->id,
        ], 201);
    }
}
