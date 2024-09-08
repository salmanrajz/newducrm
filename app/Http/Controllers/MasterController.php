<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MasterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function MasterLogin(Request $request)
    {
        // return auth()->user()->role;
        if (auth()->user()->role == 'MainAdmin') {
            $data = User::findorfail($request->id);
            Auth::login($data);
            return redirect()->route('home');
        } else {
            abort(404);
        }
    }
}
