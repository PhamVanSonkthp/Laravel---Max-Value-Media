<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChatAI;
use App\Models\MetatripError;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatAIController extends Controller
{

    private $model;

    public function __construct(Slider $model)
    {
        $this->model = $model;
    }

    public function genContent(Request $request)
    {

        $request->validate([
            'code' => 'required',
            "text" => "required",
        ]);



        if (1 == 1) {
            // gemini

            $raw = [];



            $raw = [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => $request->text
                            ]
                        ]
                    ]
                ]
            ];

            try {
                $headers = [
                    'Content-Type' => 'application/json',
                ];

                $response = Http::withHeaders($headers)->timeout(300)
                    ->send('POST', "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $request->token, [
                        'body' => json_encode($raw)
                    ])->json();

                return response()->json([
                    'code' => 200,
                    'message' => $response['candidates'][0]['content']['parts'][0]['text']
                ]);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
    }
}
