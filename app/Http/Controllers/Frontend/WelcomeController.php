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

        $userUrls = Auth::check() ? Auth::user()->urls()->latest()->get() : [];
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

            $url = Url::create([
                'original_url' => $request->input_url,
                'short_url' => $shortCode,
                'user_id' => Auth::check() ? Auth::id() : null,
            ]);

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
    
    public function regenerate($id)
    {
        $url = Url::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $newShortCode = $this->generateUniqueShortCode();

        $url->short_url = $newShortCode;
        $url->save();

        return response()->json([
            'success' => true,
            'short_url' => $newShortCode,
        ]);
    }

    public function delete($id)
    {
        $url = Url::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $url->delete();

        return response()->json([
            'success' => true,
            'message' => 'URL deleted successfully',
        ]);
    }

    public function apiDocs(){
        return view('frontend.api-docs');
    }

    public function showTrackUrlForm(){
        if (request('shorten_url')) {
            $shortUrl = str_replace(url('/') . '/', '', request('shorten_url'));
            $url = Url::where('short_url', $shortUrl)->first();
            if ($url) {
                $short_url = request('shorten_url');
                $click_count = $url->click_count;
            }
            else{
                return redirect()->back()->with('failed', 'Url not found!');
            }
        }
        else{
            $short_url = "";
            $click_count = 0;
        }
        return view('frontend.track-url', compact('short_url', 'click_count'));
    }
    public function trackClicks(Request $request)
    {
        $request->validate([
            'input_url' => 'required|url',
        ]);

        $shortUrl = str_replace(url('/') . '/', '', $request->input_url);

        $url = Url::where('short_url', $shortUrl)->first();

        if ($url) {
            return response()->json([
                'success' => true,
                'short_url' => $request->input_url,
                'click_count' => $url->click_count
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Shortened URL not found'
            ], 404);
        }
    }
}
