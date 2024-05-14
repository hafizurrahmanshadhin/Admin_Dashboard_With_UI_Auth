<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {
    public function index() {
        return view('backend.layouts.dashboard');
    }

    public function settings() {
        return view('backend.partials.settings');
    }
}
