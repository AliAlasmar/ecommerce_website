<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\MainCategory;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class VendorsController extends Controller
{
    public function index()
    {


        $vendors = Vendor::with('category')->paginate(5);
        //return($vendors);
        return view('admin.vendors.index', compact('vendors',));

    }

    public function create()
    {
        $categories = MainCategory::where('translation_of',0)->active()->get();
        //return $categories;
        return view('admin.vendors.create',compact('categories'));
    }

    public function store(Request $request)
    {
       // return $request;
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required'
        ], [
            'name.required' => 'هذا الحقل مطلوب'
        ]);
        $active = $request->active == 'on' ? 1 : 0;
        $imageName = time() . '.' . $request->logo->extension();

        $request->logo->move(public_path('assets/images/vendors'), $imageName);
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->mobile = $request->mobile;
        $vendor->email = $request->email;
        $vendor->logo = $imageName;
        $vendor->lng = $request->lng;
        $vendor->lat = $request->lat;
        $vendor->category_id = $request->academy_id;
        $vendor->password = bcrypt($request->password);
        $vendor->active = $active;

        $vendor->save();
        Notification::send($vendor,new VendorCreated($vendor));
        return redirect()->route('admin.vendors')->with(['success' => 'تمت الاضافة ينجاح']);
    }

    public function edit($id)
    {

        $vendor = Vendor::with('category')->where('id',$id)->first();
       // return $vendor;
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $lat= $request->lat;
        $lng= $request->lng;
        $vendor = Vendor::find($id);
        //return $vendor;
        $imageName = $vendor->logo;
        $password = $vendor->password;
        //return $password;
        if($request->has('logo')){
            $imageName = time() . '.' . $request->logo->extension();

            $request->logo->move(public_path('assets/images/vendors'), $imageName);

        }
        if ( $request->password != null){
            $password= bcrypt($request->password);
        }

        $active = $request->active == 'on' ? 1 : 0;
        $vendors = Vendor::find($id);
        $vendors->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'email' => $request->email,
            'category_id' => $request->academy_id,
            'logo' => $imageName,
            'password' => $password,
            'active' => $active,
        ]);
        return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
    }
}
