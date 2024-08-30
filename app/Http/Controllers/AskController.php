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

    // public function index(Request $request) {
        
    // }

    public function __invoke(Request $request)
    {
        $request->validate([
            'role_description' => 'required|string|min:5|max:500',
            'question' => 'required|string|min:5|max:500',
        ]); 

        $response = $this->ollamaService->ask($request);

        return $response;
    }
}

