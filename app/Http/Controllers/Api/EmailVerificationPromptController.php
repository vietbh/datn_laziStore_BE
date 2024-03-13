<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationPromptController extends Controller
{
    //
    public function __invoke(Request $request): Response
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email đã được xác minh']);
        }
    
        return response()->json(['status' => session('status')]);
    }
}
