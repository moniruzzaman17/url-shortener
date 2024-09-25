<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Validator;

class UrlShortenerController extends Controller
{
    public function shorten(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $shortCode = $this->generateUniqueShortCode();

        $url = Url::create([
            'original_url' => $request->original_url,
            'short_url' => $shortCode,
            'user_id' => null,
            'is_from_api' => 1,
        ]);
        return response()->json([
            'success' => true,
            'short_url' => url($shortCode),
            'long_url' => $url->original_url,
        ], 200);
    }

    private function generateUniqueShortCode()
    {
        do {
            $shortCode = substr(md5(uniqid()), 0, 6);
        } while (Url::where('short_url', $shortCode)->exists());

        return $shortCode;
    }
}
