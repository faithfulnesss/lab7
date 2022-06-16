<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Test;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $record = Test::where('user_id', Auth::id())->first();
        return view('user', [
            'record' => $record
        ]);
    }

    public function delete_best_record(Request $request)
    {
        $test = Test::where('user_id', $request->user()->id)->first();
        if($test != null) {
            $test->delete();
        }
        return redirect()->to('/user');
    }

}
