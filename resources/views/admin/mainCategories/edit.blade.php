@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة قسم رئيسي
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.dashboard.includes.alert.sucess')
                                @include('admin.dashboard.includes.alert.error')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.maincategories.update',['id'=>$mainCategories->id])}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input onchange="previewImage(this);" type="file" id="file"
                                                           name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                <img width="100px" id="preview" height="100px"
                                                     src="{{asset('assets/images/maincategories/'.$mainCategories->photo)}}">
                                                @error('photo')
                                                <span class="text-danger">{{$message}} </span>
                                                @enderror
                                            </div>

                                            <script>
                                                function previewImage(input) {
                                                    var preview = document.getElementById('preview');
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function (e) {
                                                            preview.src = e.target.result;
                                                            preview.style.display = 'block';
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    } else {
                                                        preview.src = '#';
                                                        preview.style.display = 'none';
                                                    }
                                                }
                                            </script>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم
                                                                القسم-{{__('messages.'.$mainCategories->translation_lang)}} </label>
                                                            <input type="text" value="{{$mainCategories->name}}"
                                                                   id="name"
                                                                   class="form-control"
                                                                   placeholder="ادخل اسم القسم  "
                                                                   name="name">
                                                            @error('category.*.name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أختصار اللغة </label>
                                                            <input type="text"
                                                                   value="{{$mainCategories->translation_lang}}"
                                                                   id="abbr"
                                                                   class="form-control"
                                                                   placeholder="ادخل أختصار اللغة  "
                                                                   readonly
                                                                   name="abbr">
                                                            <span class="text-danger"> </span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                {{$mainCategories->active == 'مفعل' ?'checked' :''}}/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            <span class="text-danger"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="bottom-border">

                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">


                            <div class="card-content">
                                <div class="card-body">
                                    <h3><code>اللغات المفعلة للقسم</code>
                                    </h3>
                                    <ul class="nav nav-tabs nav-justified no-hover-bg">
                                        @php
                                            $transAbbrName = $mainCategories->abbrs->name;

                                        @endphp



                                        @foreach($mainCategories->categories as $index=>$subcat)
                                        <li class="nav-item">
                                            <a class="nav-link @if($index == 0 ) active @endif " id="base-tab32" data-toggle="tab" aria-controls="tab32"
                                               href="#tab{{$index}}"
                                               aria-expanded="false"> {{$subcat->translation_lang}}</a>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                      @foreach($mainCategories->categories as $index=>$subcat)
                                        <div class="tab-pane @if($index == 0 ) active @endif " id="tab{{$index}}" aria-labelledby="base-tab32">
                                            <div class="card-body">
                                                <form class="form"
                                                      id="update-category-form"
                                                      action="{{route('admin.maincategories.update',['id'=>$subcat->id])}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf


                                                    <div class="form-body">
                                                        <h4 class="form-section"><i class="ft-home"></i> بيانات القسم </h4>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم
                                                                        القسم-{{__('messages.'.$subcat->translation_lang)}} </label>
                                                                    <input type="text" value="{{$subcat->name}}"
                                                                           id="name"
                                                                           class="form-control"
                                                                           placeholder="ادخل اسم القسم  "
                                                                           name="name">
                                                                    @error('category.*.name')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> أختصار اللغة </label>
                                                                    <input type="text"
                                                                           value="{{$subcat->translation_lang}}"
                                                                           id="abbr"
                                                                           class="form-control"
                                                                           placeholder="ادخل أختصار اللغة  "
                                                                           readonly
                                                                           name="abbr">
                                                                    <span class="text-danger"> </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group mt-1">
                                                                    <input type="checkbox" name="active"
                                                                           id="switcheryColor4"
                                                                           class="switchery" data-color="success"
                                                                        {{$subcat->active == 'مفعل' ?'checked' :''}}/>
                                                                    <label for="switcheryColor4"
                                                                           class="card-title ml-1">الحالة </label>

                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-actions">
                                                        <button type="button" class="btn btn-warning mr-1"
                                                                onclick="history.back();">
                                                            <i class="ft-x"></i> تراجع
                                                        </button>
                                                        <button id="update-category-btn" type="submit" class="btn btn-primary">
                                                            <i class="la la-check-square-o"></i> حفظ
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
@stop
