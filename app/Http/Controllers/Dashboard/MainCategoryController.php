<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    public function index()
    {


        $mainCategories = MainCategory::where('translation_lang', get_defualt_language())->paginate(10);
        //return($mainCategories);
        return view('admin.maincategories.index', compact('mainCategories',));

    }

    public function create()
    {
        $languages = Language::active()->get();
        return view('admin.maincategories.create', compact('languages'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category.*.name' => 'required'
        ], [
            'category.*.name.required' => 'هذا الحقل مطلوب'
        ]);
        $active = $request->active == 'on' ? 1 : 0;
        $imageName = time() . '.' . $request->photo->extension();

        $request->photo->move(public_path('assets/images/maincategories'), $imageName);

        $main_cat = collect($request->category);
        DB::beginTransaction();
        $filter = $main_cat->filter(function ($value, $key) {
            return $value['abbr'] == get_defualt_language();
        })->map(function ($value2) use ($imageName) {
            $active = $value2['active'] == 'on' ? 1 : 0;
            return [
                MainCategory::insertGetId([
                    'translation_lang' => $value2['abbr'],
                    'translation_of' => 0,
                    'name' => $value2['name'],
                    'slug' => $value2['name'],
                    'active' => $active,
                    'photo' => $imageName
                ])
            ];
        })->first()[0];

        $filter2 = $main_cat->filter(function ($value, $key) {
            return $value['abbr'] != get_defualt_language();
        })->map(function ($value2) use ($imageName, $filter, $active) {
            $active = $value2['active'] == 'on' ? 1 : 0;
            return [
                MainCategory::insertGetId([
                    'translation_lang' => $value2['abbr'],
                    'translation_of' => $filter,
                    'name' => $value2['name'],
                    'slug' => $value2['name'],
                    'active' => $active,
                    'photo' => $imageName
                ])
            ];
        });
            DB::commit();
        return redirect()->route('admin.maincategories')->with(['success' => 'تمت الاضافة ينجاح']);
    }

    public function edit($id)
    {
        //$language = Language::where('id', $id)->first();
        $mainCategories = MainCategory::find($id);
        //return $mainCategories;
        return view('admin.maincategories.edit', compact('mainCategories'));
    }

    public function update(Request $request, $id)
    {
        return $request;
        $imageName = time() . '.' . $request->photo->extension();

        $request->photo->move(public_path('assets/images/maincategories'), $imageName);

        $active = $request->active == 'on' ? 1 : 0;
        $maincategories = MainCategory::find($id);
        $maincategories->update([
            'name' => $request->name,
            'abbr' => $request->abbr,
            'slug' => $request->name,
            'photo' => $imageName,
            'active' => $active,
        ]);
        return redirect('/admin/maincategories')->with(['success' => 'تم التعديل بنجاح']);
    }
}
