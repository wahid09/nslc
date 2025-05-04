<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Footer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FooterManagementController extends Controller
{
    public function index(){
        Gate::authorize('footer-index');
        $footers = Footer::first();
        //dd($footers);
        return view('backend.footers.footer', compact('footers'));
    }
    public function footerEdit(Request $request, $id){
        Gate::authorize('footer-update');
        $fInfo = Footer::findOrFail($id);
        return view('backend.footers.footer_edit', compact('fInfo'));
    }
    public function footerUpdate(Request $request, $id){
        Gate::authorize('footer-update');
        $this->validate($request, [
            'slogan_bn'=>'required',
            'contact_bn'=>'required',
            'logo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fInfo = Footer::findOrFail($id);

        $image = $request->file('logo');
        $name = Str::slug(str_limit($request->input('slogan_bn'), 10));
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('logo/'))
            {
                Storage::disk('public')->makeDirectory('logo/');
            }
            $makImage = Image::make($image)->resize(155,150)->stream();
            Storage::disk('public')->put('logo/'.$imageName,$makImage);
        }
        if(!empty($imageName)){
            if (Storage::disk('public')->exists('logo/'.$fInfo->logo)){
                Storage::disk('public')->delete('logo/'.$fInfo->logo);
            }
        }

        if(empty($imageName) && !empty($fInfo->logo)){
            $imageName = $fInfo->logo;
        }

        $data = [
            'slogan_bn'=>$request->slogan_bn,
            'contact_bn'=>$request->contact_bn,
            'logo'=>$imageName
        ];
        $affected = DB::table('footers')
            ->where('id', $id)
            ->update($data);
        return back();
    }
}
