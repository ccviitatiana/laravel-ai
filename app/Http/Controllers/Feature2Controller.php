<?php

namespace App\Http\Controllers;

use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Http\Request;
use App\Models\Feature;
use App\Http\Resources\FeatureResource;
use App\Models\UsedFeature;
use Inertia\Inertia;
use Inertia\Response;

class Feature2Controller extends Controller
{
    public ?Feature $feature = null;

    public function __construct()
    {
        $this->feature = Feature::where("route_name", "feature2.index")->where("active", true)->firstOrFail();
    }
    public function index()
    {
        return Inertia('Feature2/Index', [
            'feature' => new FeatureResource($this->feature),
            'answer' => session('answer')
        ]);
    }
}
