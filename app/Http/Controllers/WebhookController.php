<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
        public function handle(Request $request)
    {
        $expectedToken = config("auto_seo_bearer_token");

        $token = str_replace(
            'Bearer ',
            '',
            $request->header('Authorization')
        );

        if ($token !== $expectedToken) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
