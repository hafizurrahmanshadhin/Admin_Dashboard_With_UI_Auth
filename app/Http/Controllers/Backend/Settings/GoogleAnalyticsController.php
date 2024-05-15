<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\GoogleAnalytics;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoogleAnalyticsController extends Controller {
    public function index() {
        $analytics = GoogleAnalytics::latest('id')->first();
        return view('backend.layouts.settings.google_analytics', compact('analytics'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $setting              = GoogleAnalytics::firstOrNew();
            $setting->description = $request->description;

            $setting->save();
            return back()->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return back()->with('t-error', 'Failed to update');
        }
    }
}
