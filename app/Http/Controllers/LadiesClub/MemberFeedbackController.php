<?php

namespace App\Http\Controllers\LadiesClub;

use App\Http\Controllers\Controller;
use App\Models\MemberFeedBack;
use Illuminate\Http\Request;
use Auth;

class MemberFeedbackController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'subject' => 'required',
            'details' => 'required',
        ]);

        $data = MemberFeedBack::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->get('subject'),
            'details' => $request->get('details'),
            'created_at' => date('d-m-y')
        ]);
        return redirect()->back();
    }
}
