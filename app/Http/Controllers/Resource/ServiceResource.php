<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Package;
use Setting;
use Exception;
use App\Helpers\Helper;
use App\Zones;
use App\ServiceType;
use App\PeakAndNight;
use App\FareSetting;
use App\Page;
use App\Country;
use App\Zone;
use App\RideType;

class ServiceResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $services = ServiceType::all();
        if($request->ajax()) {
            return $services;
        } else {
            return view('admin.service.index', compact('services'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $ridetypes = RideType::get();
        $zones = Zones::orderBy('created_at' , 'desc')->get();
        return view('admin.service.create',compact('countries','zones','ridetypes'));
    }
    
    
    public function allocation()
    {
        
        $services = ServiceType::select('id','name')->whereNotIn('name',['Pool'])->get();
        $fare = FareSetting::select('id','fare_plan_name','from_km','upto_km')->get();
        $zones = Zones::orderBy('created_at' , 'desc')->get();
        $countries = Country::get();
        $ridetypes = RideType::get();
        
        return view('admin.service.allocation',compact('services','fare','zones','countries','ridetypes'));
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

        // var_dump( $request->all() );
        
        
        $this->validate($request, [
            'name' => 'required|max:255|unique:service_types,name',
            'capacity' => 'required|numeric',
            'fixed' => 'required|numeric',
            'distance' => 'required|numeric',
            'image' => 'mimes:ico,png,jpeg,jpg',
            'vehicle_image' => 'mimes:ico,png,jpeg,jpg'
        ]);

        try {
            $service = $request->all();

            if($request->hasFile('image')) {
                $service['image'] = Helper::upload_picture($request->file('image'));
            }
            if($request->hasFile('vehicle_image')) {
                $service['vehicle_image'] = Helper::upload_picture($request->file('vehicle_image'));
            }
            $data['slug'] = str_slug(strtolower($request->name), '-');
            $slug = Page::select('slug')->where('slug',$data['slug'])->get();
            $data['en_title'] = $request->name;
            if(count($slug)==''){                         
            Page::create($data);
            }
            $service['ride_types'] = implode(',',$request->ride_types);
            
            $service = ServiceType::create($service);

            return back()->with('flash_success','Service Type Saved Successfully');
        } catch (Exception $e) {
            // dd("Exception", $e);
            return back()->with('flash_error', 'Service Type Not Found');
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
            return ServiceType::findOrFail($id);
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
               $countries = Country::get();
               $zones = Zones::orderBy('created_at' , 'desc')->get();
               $service = ServiceType::findOrFail($id);
               $ridetypes = RideType::get();
            return view('admin.service.edit',compact('service','countries','zones','ridetypes'));
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
        //dd('hiii');
         $this->validate($request, [
            'name' => 'required|max:255',
            'capacity' => 'required|numeric',
            'fixed' => 'required|numeric',
            'distance' => 'required|numeric',
            'image' => 'mimes:ico,png,jpeg,jpg',
            'vehicle_image' => 'mimes:ico,png,jpeg,jpg',
            //'ride_type_id' =>'required|exists:ride_types,id'
        ]);
       
        try {
            $service = $request->all();

            if($request->hasFile('image')) {
                $service['image'] = Helper::upload_picture($request->image);
            }
            if($request->hasFile('vehicle_image')) {
                $service['vehicle_image'] = Helper::upload_picture($request->vehicle_image);
            }
            $service =ServiceType::findOrFail($request->id);
            $service->name = $request->name;
            $service->fixed = $request->fixed;
            $service->distance = $request->distance;
            $service->minute = $request->minute;
            $service->price = $request->price;
            $service->capacity = $request->capacity;
            $service->description = $request->description;
            //$service->country_id = $request->country_id;
            //$service->zone_id = $request->zone_id;
            //$service->ride_type_id = $request->ride_type_id;
            $service->save();
            return redirect()->route('admin.service.index')->with('flash_success', 'Service Type Updated Successfully'); 
            // return redirect('admin/allocation_list')->with('flash_success','Updated successfully');   
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }


    public function update_mapped(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'provider_name' => 'required|max:255',
            'fixed' => 'required|numeric',
            // 'two_passanger_percent' => 'numeric|min:1',
            // 'one_passanger_percent' => 'numeric|min:1',
            'image' => 'mimes:ico,png'
            
        ]);

        try {

            $package = Package::findOrFail($request->id);           

            $package->name = $request->name;
            $package->provider_name = $request->provider_name;
            $package->fixed = $request->fixed;
            // $service->price = $request->price;
            // $service->minute = $request->minute;
            // $service->distance = $request->distance;
            // $service->calculator = $request->calculator;
            $package->capacity = $request->capacity;
            $package->description = $request->description;
            $package->two_passanger_percent = "".$request->two_passanger_percent;
            $package->one_passanger_percent = "".$request->one_passanger_percent;
            $package->save();

            return redirect()->route('admin.service.index')->with('flash_success', 'Service Type Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
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
            ServiceType::find($id)->delete();
            return back()->with('message', 'Service Type deleted successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Service Type Not Found');
        }
    }
}