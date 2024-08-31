<?php

namespace App\Http\Controllers;

use App\Services\OllamaService;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Http\Resources\FeatureResource;
use App\Models\UsedFeature;
use Illuminate\Support\Str;

class Feature2Controller extends Controller
{
    private ?Feature $feature = null;
    private OllamaService $ollamaService;

    public function __construct(OllamaService $ollamaService)
    {
        $this->feature = Feature::where("route_name", "feature2.index")->where("active", true)->firstOrFail();
        $this->ollamaService = $ollamaService;
    }
    public function index()
    {
        return Inertia('Feature2/Index', [
            'feature' => new FeatureResource($this->feature),
            'answer' => session('answer')
        ]);
    }

    public function ollamaResponse(Request $request)
    {
        $user = $request->user();
        if ($user->available_credits < $this->feature->required_credits) {
            return back()->withErrors(['error' => 'Not enough credits.']);
        }

        $data = $request->validate([
            'user_prompt' => ['required'],
        ]);

        $ollamaResponse = $this->ollamaService->ask($request);

        $responseContent = json_decode($ollamaResponse->content(), true);

        $responseText = $responseContent['response'] ?? 'No response available';

        $user->decreasedCredits($this->feature->required_credits);

        $dataStore = ([
            'user_prompt' => $request->input('user_prompt'),
            'response_text' => $responseText
        ]);

        $new_used_feature = new UsedFeature();
        $new_used_feature->id = (string) Str::uuid();
        $new_used_feature->feature_id = $this->feature->id;
        $new_used_feature->user_id = $user->id;
        $new_used_feature->credits = $this->feature->required_credits;
        $new_used_feature->data = $dataStore;
        $new_used_feature->save();

        return to_route('feature2.index')->with('answer', $responseText);
    }
}
