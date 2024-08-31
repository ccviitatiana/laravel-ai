<?php

namespace App\Http\Controllers;

use App\Services\OllamaService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AskController extends Controller
{
    private OllamaService $ollamaService;

    public function __construct(OllamaService $ollamaService)
    {
        $this->ollamaService = $ollamaService;
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'question' => 'required|string|min:5|max:500',
        ]); 

        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $response = $this->ollamaService->ask($request);

        return $response;
    }
}

