<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\pageContent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('content-index');
        $contents = PageContent::all();
        return view('backend.page_contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('content-create');
        $pages = Page::active()->get();
        return view('backend.page_contents.form', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('content-create');
        Gate::authorize('content-create');
        //return $request;
        $this->validate($request, [
            'slogan_bn' => 'required|string|max:255',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'required'
        ]);

        $banner = $request->file('banner');
        $name = Str::slug($request->input('slogan_bn'));
        if (isset($banner)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $banner->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('content/banners')) {
                Storage::disk('public')->makeDirectory('content/banners/');
            }
            $makImage = Image::make($banner)->resize(759)->stream();
            Storage::disk('public')->put('content/banners/' . $imageName, $makImage);
        } else {
            $imageName = "";
        }
        /*
        $contents = pageContent::create([
            'slogan_bn' => $request->slogan_bn,
            'page_id' => $request->page,
            'banner' => $imageName,
            'description_bn' => $request->description_bn,
            'status' => $request->filled('status')
        ]);
        */
        //return $contents;
        //notify()->success('Page content Added', 'Success');
        //return redirect()->route('app.page_contents.index');
        $images = [];
        if ($request->hasFile('image')) {
            $i = 0;
            foreach ($request->file('image') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
                //get filename without extension
                $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filename = $fileName . '_' . uniqid() . '.' . $extension;
                if (!Storage::disk('public')->exists('content/images')) {
                    Storage::disk('public')->makeDirectory('content/images/');
                }
                $makImage = Image::make($file)->resize(384, 338)->stream();
                Storage::disk('public')->put('content/images/' . $filename, $makImage);
                $images[] = $filename;
                $i++;
            }
            //notify()->success('Page content Added', 'Success');
            //return redirect()->route('app.page_contents.index');
        }
        // $images = json_encode($images);
        // print_r($images);
        // exit;
        $contents = pageContent::create([
            'slogan_bn' => $request->slogan_bn,
            'page_id' => $request->page,
            'banner' => $imageName,
            'description_bn' => $request->description_bn,
            'short_description_bn' => $request->short_description_bn,
            'image' => json_encode($images),
            'status' => $request->filled('status')
        ]);
        notify()->success('Page content Added', 'Success');
        return redirect()->route('app.page_contents.index');
        // print_r($images);
        // exit;
        // else {
        //     notify()->success('Page content Added', 'Success');
        //     return redirect()->route('app.page_contents.index');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function show(pageContent $pageContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function edit(pageContent $pageContent)
    {
        Gate::authorize('content-update');
        Gate::authorize('content-update');
        $pages = Page::active()->get();
        return view('backend.page_contents.form', compact('pages', 'pageContent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pageContent $pageContent)
    {
        Gate::authorize('content-update');
        $this->validate($request, [
            'slogan_bn' => 'required|string|max:255',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'page' => 'required'
        ]);

        $image = $request->file('banner');
        $name = Str::slug($request->input('slogan_bn'));
        if (isset($image)) {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $name . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('content/banners')) {
                Storage::disk('public')->makeDirectory('content/banners/');
            }
            $makImage = Image::make($image)->resize(759)->stream();
            Storage::disk('public')->put('content/banners/' . $imageName, $makImage);
        }
        if (!empty($imageName)) {
            if (Storage::disk('public')->exists('content/banners/' . $pageContent->banner)) {
                Storage::disk('public')->delete('content/banners/' . $pageContent->banner);
            }
        }

        if (empty($imageName) && !empty($pageContent->banner)) {
            $imageName = $pageContent->banner;
        }

        $images = [];
        if ($request->hasFile('image')) {
            $i = 0;
            foreach ($request->file('image') as $file) {
                //get filename with extension
                $filenamewithextension = $file->getClientOriginalName();
                //get filename without extension
                $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $file->getClientOriginalExtension();

                //filename to store
                $filename = $fileName . '_' . uniqid() . '.' . $extension;
                if (!Storage::disk('public')->exists('content/images')) {
                    Storage::disk('public')->makeDirectory('content/images/');
                }
                $makImage = Image::make($file)->resize(384, 338)->stream();
                Storage::disk('public')->put('content/images/' . $filename, $makImage);
                $images[] = $filename;
                $i++;
            }
            //notify()->success('Page content Added', 'Success');
            //return redirect()->route('app.page_contents.index');
        }
        $images = json_encode($images);
        if (empty($request->hasFile('image'))) {
            $images = $pageContent->image;
        }
        $pageContent->update([
            'slogan_bn' => $request->slogan_bn,
            'page_id' => $request->page,
            'banner' => $imageName,
            'description_bn' => $request->description_bn,
            'short_description_bn' => $request->short_description_bn,
            'image' => $images,
            'status' => $request->filled('status')
        ]);
        notify()->success('Page content Updated', 'Success');
        //return redirect()->route('app.page_contents.index');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pageContent  $pageContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(pageContent $pageContent)
    {
        Gate::authorize('content-delete');
        if (Storage::disk('public')->exists('content/banners/' . $pageContent->banner)) {
            Storage::disk('public')->delete('content/banners/' . $pageContent->banner);
        }
        $pageContent->delete();
        notify()->success("Page Content Deleted", "Success");
        return back();
    }
}
