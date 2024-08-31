<?php

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Http\Request;

class OllamaService
{
    public function ask(Request $request)
    {
        $response = Ollama::agent('You are an Ai assitant')
            ->prompt($request->input('user_prompt'))
            ->model('qwen2:1.5b')
            ->options(['temperature' => 0.8])
            ->stream(false)
            ->ask();

        return response()->json($response, 200);
    }
}