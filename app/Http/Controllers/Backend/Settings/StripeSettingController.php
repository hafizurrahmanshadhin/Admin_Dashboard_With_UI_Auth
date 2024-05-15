<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Throwable;

class StripeSettingController extends Controller {
    /**
     * Display the Stripe settings page.
     *
     * @return View
     */
    public function index() {
        return view('backend.layouts.settings.stripe_settings');
    }

    /**
     * Update the Stripe settings.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request) {
        if (User::find(auth()->user()->id)->hasPermissionTo('profile setting')) {
            $request->validate([
                'stripe_key'    => 'nullable|string',
                'stripe_secret' => 'nullable|string',
            ]);
            try {
                $envContent = File::get(base_path('.env'));
                $lineBreak  = "\n";
                $envContent = preg_replace([
                    '/STRIPE_KEY=(.*)\s/',
                    '/STRIPE_SECRET=(.*)\s/',
                ], [
                    'STRIPE_KEY=' . $request->stripe_key . $lineBreak,
                    'STRIPE_SECRET=' . $request->stripe_secret . $lineBreak,
                ], $envContent);

                if ($envContent !== null) {
                    File::put(base_path('.env'), $envContent);
                }
                return redirect()->back()->with('t-success', 'Stripe Setting Update successfully.');
            } catch (Throwable) {
                return redirect()->back()->with('t-error', 'Stripe Setting Update Failed');
            }
        }
        return redirect()->back();
    }
}
