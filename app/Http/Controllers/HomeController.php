<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller {
    public function index() {
        try {
            $banners = HomeBanner::all();
            return view( 'pages.home', compact( 'banners' ) );
        } catch ( \Throwable $th ) {
            Log::error( $th );
        }
    }
}