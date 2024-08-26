<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Http\Resources\FeatureResource;
use App\Models\UsedFeature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class Feature1Controller extends Controller
{
    public ?Feature $feature = null;

    public function __construct()
    {
        $this->feature = Feature::where("route_name", "feature1.index")->where("active", true)->firstOrFail();
    }
    public function index()
    {
        return Inertia('Feature1/Index', [
            'feature' => new FeatureResource($this->feature),
            'answer' => session('answer')
        ]);
    }

    public function calculate(Request $request)
    {
        $user = $request->user();
        if ($user->avaliable_credits < $this->feature->required_credits) {
            return back()->withErrors(['error' => 'Not enough credits.']);
        }

        $data = $request->validate([
            'number1' => ['required', 'numeric'],
            'number2' => ['required', 'numeric']
        ]);
        
        $number1 = (float) $data['number1'];
        $number2 = (float) $data['number2'];

        $user->decreasedCredits($this->feature->required_credits);

        UsedFeature::create([
            'feature_id' => $this->feature->id,
            'user_id' => $user->id,
            'credits' => $this->feature->required_credits,
            'data' => $data
        ]);

        return to_route('feature1.index')->with('answer', $number1 + $number2);
    }
}
