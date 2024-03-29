<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;


class LanguagesController extends Controller
{
    public function index()
    {
        $languages = Language::paginate(10);
        //return($languages);
        return view('admin.languages.index', compact('languages'));

    }
        public function create(){
            return view( 'admin.languages.create');
        }

        public function store(LanguageRequest $request){

            $active = $request->status == 'on' ? 1 : 0;

             $lang = new Language();
             $lang->name= $request->name;
            $lang->abbr= $request->abbr;
            $lang->direction= $request->academy_id;
            $lang->active= $active;

            $lang->save();
            return redirect()->route('admin.languages')->with(['success'=>'تمت الاضافة ينجاح']);
        }

        public function edit($id){
          $language = Language::where('id',$id)->first();
          return view('admin.languages.edit' ,compact('language'));
        }

        public function update(Request $request ,$id){
            $active = $request->status == 'on' ? 1 : 0;
        $lang = Language::find($id);
        $lang->update([
            'name'=>$request->name,
            'abbr'=>$request->abbr,
            'direction'=>$request->academy_id,
            'active'=>$active,
        ]);
        return redirect('/admin/languages')->with(['success'=>'تم التهديل بنجاح']);
        }
}
