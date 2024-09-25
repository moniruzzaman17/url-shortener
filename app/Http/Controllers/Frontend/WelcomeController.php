<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Url;

class WelcomeController extends Controller
{
    public function index(Request $request) {

        $userUrls = Auth::check() ? Auth::user()->urls()->latest()->take(6)->get() : [];
        return view('frontend.welcome', compact('userUrls'));
    }
    public function shortenUrl(Request $request){
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'input_url' => 'required|url'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            $shortCode = $this->generateUniqueShortCode();

            // Save the URL to the database
            $url = Url::create([
                'original_url' => $request->input_url,
                'short_url' => $shortCode,
                'user_id' => Auth::check() ? Auth::id() : null,
            ]);

            // Return the shortened URL in the response
            return response()->json([
                'success' => true,
                'short_url' => url($shortCode),
                'long_url' => $url->original_url
            ]);
        }
    }

    private function generateUniqueShortCode()
    {
        do {
            $shortCode = substr(md5(uniqid()), 0, 6);
        } while (Url::where('short_url', $shortCode)->exists());
    
        return $shortCode;
    }

    public function redirectUrl($shortCode)
    {
        $url = Url::where('short_url', $shortCode)->firstOrFail();
        $url->increment('click_count');
        return redirect($url->original_url);
    }
}
