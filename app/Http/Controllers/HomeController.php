<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$sessionId = $request->session()->getId();
		$currentSession = Session::where('id', $sessionId)->first();

        if (!$currentSession) {
            $currentSession = Session::create();
            $request->session()->put('session_id', $currentSession->id);
        }

		$variant = $currentSession->ab_test_variant;

		return view('welcome', compact('variant'));
	}
}