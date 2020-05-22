<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Setting;
use Exception;
use App\Helpers\Helper;

use App\ServiceType;
use App\Page;

class FaqResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locale = session()->get('locale');
        if($locale){

             $locale;

           }else{

             $locale = 'en';

        }
        $data = Page::where('en_title','faq')->orderBy('id', 'DESC')->get();
        if($request->ajax()) {
            return $data;
        } else {
            return view('cms.faq.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Setting::get('demo_mode', 0) == 1) {
            return back()->with('flash_error','Disabled for demo purposes! Please contact us at info@appoets.com');
        }

        $this->validate($request, [
            'en_title' => 'required',
            'en_question' => 'required',
            'en_description' => 'required',
            'ar_title' => 'required',
            'ar_question' => 'required',
            'ar_description' => 'required',
            'fr_title' => 'required',
            'fr_question' => 'required',
            'fr_description' => 'required',
            'ru_title' => 'required',
            'ru_question' => 'required',
            'ru_description' => 'required',
            'sp_title' => 'required',
            'sp_question' => 'required',
            'sp_description' => 'required',
            'image' => 'mimes:ico,png,jpeg,jpg',
            // 'slug' => 'required | unique:pages'
        ],
        [
            'en_title.required'=>'Page en title not empty.',
            'en_title.unique'=>'Page en name is already exist.',
            'ar_title.required'=>'Page ar title not empty.',
            'ar_title.unique'=>'Page ar name is already exist.',
            'fr_title.required'=>'Page fr title not empty.',
            'fr_title.unique'=>'Page fr name is already exist.',
            'ru_title.required'=>'Page ru title not empty.',
            'ru_title.unique'=>'Page ru name is already exist.',
            'sp_title.required'=>'Page es title not empty.',
            'sp_question.required'=>'Page es question not empty.',
            'sp_description.required'=>'Page es description not empty.',
            'sp_title.unique'=>'Page name is already exist.'
        ]);

        try {
            
            $service = $request->all(); 
            
            if($request->hasFile('image')) {
                $service['image'] = \URL::to('/storage/app/public/').'/'.$request->image->store('uploads');
            }
            $service['en_title'] = "faq";
            $service['slug'] = str_slug(strtolower($service['en_title']), '-'); 

            $service = Page::create($service);

            return back()->with('flash_success','New Page created Successfully');
        } catch (Exception $e) {
            dd("Exception", $e);
            return back()->with('flash_error', 'Page  Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Page::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $service = Page::findOrFail($id);
            return view('cms.faq.edit',compact('service'));
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Setting::get('demo_mode', 0) == 1) {
            return back()->with('flash_error','Disabled for demo purposes! Please contact us at info@appoets.com');
        }

        $this->validate($request, [
            'en_title' => 'required',
            'en_question' => 'required',
            'en_description' => 'required',
            'ar_title' => 'required',
            'ar_question' => 'required',
            'ar_description' => 'required',
            'fr_title' => 'required',
            'fr_question' => 'required',
            'fr_description' => 'required',
            'ru_title' => 'required',
            'ru_question' => 'required',
            'ru_description' => 'required',
            'sp_title' => 'required',
            'sp_question' => 'required',
            'sp_description' => 'required',
            'image' => 'mimes:ico,png,jpeg,jpg'
            
        ],[
            'sp_title.required'=>'Page es title not empty.',
            'sp_question.required'=>'Page es question not empty.',
            'sp_description.required'=>'Page es description not empty.'            
        ]);

        try {

            $service = page::findOrFail($id);

            if($request->hasFile('image')) {
                if($service->image) {
                    //Helper::delete_picture($service->image);
                    \Storage::delete($service->image);
                }
                //$service->image = Helper::upload_picture($request->image);
                $service->image = \URL::to('/storage/app/public/').'/'.$request->image->store('uploads');
            }

            $service['en_title'] = "faq";
            $service->en_title = $service['en_title'];
            $service->en_question = $request->en_question;
            $service->en_description = $request->en_description;
            $service->ar_title = $request->ar_title;
            $service->ar_question = $request->ar_question;
            $service->ar_description = $request->ar_description;
            $service->fr_title = $request->fr_title;
            $service->fr_question = $request->fr_question;
            $service->fr_description = $request->fr_description;
            $service->ru_title = $request->ru_title;
            $service->ru_question = $request->ru_question;
            $service->ru_description = $request->ru_description;
            $service->sp_title = $request->sp_title;
            $service->sp_question = $request->sp_question;
            $service->sp_description = $request->sp_description; 
            
            $service->en_meta_keys = $request->en_meta_keys;
            $service->en_meta_description = $request->en_meta_description;
            $service->ar_meta_keys = $request->ar_meta_keys;
            $service->ar_meta_description = $request->ar_meta_description;
            $service->fr_meta_keys = $request->fr_meta_keys;
            $service->fr_meta_description = $request->fr_meta_description;
            $service->ru_meta_keys = $request->ru_meta_keys;
            $service->ru_meta_description = $request->ru_meta_description;
            $service->sp_meta_keys = $request->sp_meta_keys;
            $service->sp_meta_description = $request->sp_meta_description;         
           
            $service->save();

            return redirect()->route('cms.faq.index')->with('flash_success', 'Page Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Page Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Setting::get('demo_mode', 0) == 1) {
            return back()->with('flash_error','Disabled for demo purposes! Please contact us at info@appoets.com');
        }
        
        try {
            Page::find($id)->delete();
            return back()->with('message', 'Page deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Page Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Page Not Found');
        }
    }
}