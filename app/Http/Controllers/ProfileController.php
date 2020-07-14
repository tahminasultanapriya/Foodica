<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Console\Input\Input;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profiles.profile');
    }
    public function addProfile(Request $request)
    {

        
            $profiles = new Profile;
            $profiles->name= $request->input('name');
            $profiles->designation= $request->input('designation');
            $profiles->user_id= Auth::user()->id;
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $profiles->profile_pic = $url;
            $profiles->save();
            return redirect('/home')->with('response', 'Profile Created Successfully');

    }
}
