<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all()->sortByDesc('wpm');
        return view('leaderboard', [
            'tests' => $tests,
        ]);
    }

    public function update(Request $request)
    {
        if($request->user() != null) {
                $test = Test::where('user_id', $request->user()->id)->first();
                $user_id = $request->user()->id;
                $user_name = $request->user()->name;
                $wpm = (int) $request->input('wpm');
                $missed = (int) $request->input('missed');
                $mistakes = (int) $request->input('mistakes');

                if($test == null) {
                    $test = new Test();
                    $test->user_id = $user_id;
                    $test->wpm = $wpm;
                    $test->missed = $missed;
                    $test->mistakes = $mistakes;
                    $test->user_name = $user_name;
                    $test->save();
                } else if($test->wpm < $wpm) {
                    $test->update(['wpm' => $wpm, 'missed' => $missed, 'mistakes' => $mistakes]);
                }

            return response()->json(['success' => true, 'test' => $test]);
        }
        return response()->json(['error' => 'User is not authorized!'], 401);
    }
}
