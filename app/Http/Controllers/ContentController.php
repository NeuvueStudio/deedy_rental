<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Log;
use App\Models\Content;
use App\Models\ContentMeta;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ['title' => 'Banners | Deedy Admin Panel'];
        $contents = Content::all();
        return view('admin.pages.cms.contents', compact('data', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createBanner(Request $request)
    {
        //
        $data = ['title' => 'Add Banner | Deedy Admin Panel'];
        return view('admin.pages.cms.add_banner', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_name' => 'nullable|string|max:255',
            'post_type' => 'required|string',
            'post_status' => 'required|string',
            'post_content' => 'nullable|string',
            'banner_image' => 'nullable|file|image|max:2048', // adjust file rules as needed
        ]);

        DB::beginTransaction();

        try {
            // Handle Slug
            $slug = $request->post_name ?: Str::slug($request->post_title);
            
            $content = new Content();
            $content->post_title = $request->post_title;
            $content->post_name = $slug;
            $content->post_content = $request->post_content;
            $content->post_type = $request->post_type;
            $content->post_status = $request->post_status;
            $content->parent_id = 0; // or from request
            $content->post_date = now();
            $content->save();

            // Process meta fields
            
            
            // If the content type is 'banner', store the banner image
            if ($request->post_type == 'banner' && $request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('upload/banners');
                $file->move($destinationPath, $filename);
                $path = 'upload/banners/' . $filename;
                
                // Store the banner image in the content_meta table
                $contentMeta = new ContentMeta();
                $contentMeta->content_id = $content->id;
                $contentMeta->meta_key = 'banner_image';
                $contentMeta->meta_value = $path;
                $contentMeta->save();
            }

            DB::commit();
            return redirect()->route('content.index')->with('success', 'Banner created successfully.');

        } 
        catch (\Throwable $e) 
        {
            DB::rollback();
            //Log::error('Error saving content', ['message' => $e->getMessage()]);
            return redirect()
                ->back()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = ['title' => 'Add Banner | Deedy Admin Panel'];
        $content = Content::with('meta')->findOrFail($id);
        return view('admin.pages.cms.edit_banner', compact('data', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_name' => 'nullable|string|max:255',
            'post_type' => 'required|string',
            'post_status' => 'required|string',
            'post_content' => 'nullable|string',
            'banner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,bmp|max:2048',
        ]);
    
        DB::beginTransaction();
    
        try {
            $slug = $request->post_name ?: Str::slug($request->post_title);
    
            // Find the existing content
            $content = Content::with('meta')->findOrFail($id);
            $content->post_title = $request->post_title;
            $content->post_name = $slug;
            $content->post_content = $request->post_content;
            $content->post_type = $request->post_type;
            $content->post_status = $request->post_status;
            $content->save();
    
            // Handle banner image
            if ($request->post_type == 'banner' && $request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('upload/banners');
                $path = 'upload/banners/' . $filename;
                // Check if meta exists
                $bannerMeta = $content->meta->firstWhere('meta_key', 'banner_image');
                
                
            if ($bannerMeta && file_exists(public_path($bannerMeta->meta_value))) {
                unlink(public_path($bannerMeta->meta_value));
            }

            $file->move($destinationPath, $filename);

                if ($bannerMeta) {
                    $bannerMeta->meta_value = $path;
                    $bannerMeta->save();
                } else {
                    $newMeta = new ContentMeta();
                    $newMeta->content_id = $content->id;
                    $newMeta->meta_key = 'banner_image';
                    $newMeta->meta_value = $path;
                    $newMeta->save();
                }
            }
    
            DB::commit();
            return redirect()->route('content.index')->with('success', 'Banner updated successfully.');
        } catch (\Throwable $e) {
            DB::rollback();
            //Log::error('Error updating content', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
