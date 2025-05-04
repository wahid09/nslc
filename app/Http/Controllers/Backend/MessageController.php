<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('message-index');
        $messages = Message::all();
        return view('backend.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('message-create');
        return view('backend.messages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('message-create');
        $this->validate($request, [
            'title_bn'=>'required',
            'description_bn'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message_from'=>'required',
            'appointment'=>'required'
        ]);

        $image = $request->file('image');
        $name = Str::slug($request->input('message_from'));
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('messages/'))
            {
                Storage::disk('public')->makeDirectory('messages/');
            }
            $makImage = Image::make($image)->resize(450,450)->stream();
            Storage::disk('public')->put('messages/'.$imageName,$makImage);
        } else {
            $imageName = "default.png";
        }

        $message = Message::create([
            'title_bn'=>$request->title_bn,
            'description_bn'=>$request->description_bn,
            'image'=>$imageName,
            'message_from'=>$request->message_from,
            'appointment'=>$request->appointment,
            'status'=>$request->filled('status')
        ]);

        notify()->success("Message Added", "Success");
        return redirect()->route('app.messages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        Gate::authorize('message-update');
        return view('backend.messages.form', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        Gate::authorize('message-update');
        $this->validate($request, [
            'title_bn'=>'required',
            'description_bn'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message_from'=>'required',
            'appointment'=>'required'
        ]);
        $image = $request->file('image');
        $name = Str::slug($request->input('message_from'));
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('messages/'))
            {
                Storage::disk('public')->makeDirectory('messages/');
            }
            $makImage = Image::make($image)->resize(450,450)->stream();
            Storage::disk('public')->put('messages/'.$imageName,$makImage);
        }

        if(!empty($imageName)){
            if (Storage::disk('public')->exists('messages/'.$message->image)){
                Storage::disk('public')->delete('messages/'.$message->image);
            }
        }

        if(empty($imageName) && !empty($message->image)){
            $imageName = $message->image;
        }
        //return $imageName;
        $message->update([
            'title_bn'=>$request->title_bn,
            'description_bn'=>$request->description_bn,
            'image'=>$imageName,
            'message_from'=>$request->message_from,
            'appointment'=>$request->appointment,
            'status'=>$request->filled('status')
        ]);
        notify()->success("Message Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        Gate::authorize('message-delete');
        if (Storage::disk('public')->exists('messages/'.$message->image)){
            Storage::disk('public')->delete('messages/'.$message->image);
        }
        $message->delete();
        notify()->success("Message Deleted", "Success");
        return back();
    }
}
