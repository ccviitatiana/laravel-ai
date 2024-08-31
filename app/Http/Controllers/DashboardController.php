<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsedFeatureResource;
use Illuminate\Support\Facades\Auth;
use App\Models\UsedFeature;

class DashboardController extends Controller

{
    public function index()
    {
        $usedFeatures = usedFeature::query()->with(['feature'])->where("user_id", Auth::id())->latest()->paginate();
        return Inertia('Dashboard', [
            'usedFeatures' => UsedFeatureResource::collection($usedFeatures),
        ]);
    }
}
