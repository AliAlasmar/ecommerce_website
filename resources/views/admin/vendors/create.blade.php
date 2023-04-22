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
                                <li class="breadcrumb-item"><a href=""> المتاجر الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item active">إضافة متجر رئيسي
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة متجر رئيسي </h4>
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
                                        <form class="form" action="{{route('admin.vendors.store')}}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> شعار التاجر </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="logo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('logo')
                                                <span class="text-danger">{{$message}} </span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات التاجر </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="projectinput1"> اسم التاجر </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control "
                                                                   placeholder="ادخل اسم القسم  "
                                                                   name="name">
                                                            @error('name')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الهاتف </label>
                                                            <input type="text" value="" id="mobile"
                                                                   class="form-control"
                                                                   placeholder="ادخل  رقم الهاتف  "

                                                                   name="mobile">
                                                            <span class="text-danger"> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الايميل </label>
                                                            <input type="text" value="" id="email"
                                                                   class="form-control"
                                                                   placeholder="ادخل الايميل  "
                                                                   name="email">
                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> كلمة المرور </label>
                                                            <input type="password" value="" id="password"
                                                                   class="form-control"
                                                                   placeholder="ادخل الكلمة المرور  "
                                                                   name="password">
                                                            @error('email')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-6" style="margin-right: -1%">
                                                        <div class="form-group col-12">
                                                            <label for="projectinput2"> اختر التصنيف </label>
                                                            <select name="academy_id" class="select2 form-control">
                                                                <optgroup label="من فضلك أختر  التصنيف ">
                                                                    @isset($categories)
                                                                        @foreach($categories as $cat)
                                                                            <option
                                                                                value="{{$cat->id}}">  {{$cat->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endisset
                                                                </optgroup>
                                                            </select>
                                                            @error('academy_id')
                                                            <span class="text-danger">{{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">

                                                    <div class="content">

                                                        <div class="mapform">
                                                            <br>
                                                            <div style="margin-right: -20%">
                                                                <center>عنوان التاجر</center>
                                                            </div>
                                                            <br><br>
                                                            <div class="row">

                                                                <div class="col-5">
                                                                    <input type="text" class="form-control"
                                                                           placeholder="lat" name="lat" id="lat">
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="text" class="form-control"
                                                                           placeholder="lng" name="lng" id="lng">
                                                                </div>
                                                            </div>

                                                            <div id="map" style="height:400px; width: 800px;"
                                                                 class="my-3"></div>
                                                            <?php
                                                            //$lat = \App\Models\Location::where('id',6)->first()
                                                            ?>

                                                        </div>


                                                    </div>
                                                </div>


                                                {{--                                                </div>--}}


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
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
                <?php
                $lat = 35.26391696034807;
                $lng = 36.37705035450414?> //خط الطول//
                <iframe
                    width="700"
                    height="370"
                    frameborder="0"
                    scrolling="no"
                    marginheight="0"
                    marginwidth="0"
                    src="https://maps.google.com/maps?q={{$lat}},{{$lng}}&hl=es&z=14&amp;output=embed"
                >
                </iframe>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        let map;
        let lat = 35.4;
        let lan = 36.3;

        function initMap() {
            let lat = 35.26391696034807;
            let lng = 36.37705035450414;
            let pos = new google.maps.LatLng(lat, lng);

            let map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: pos,
                scrollwheel: true
            });

            let marker = new google.maps.Marker({
                position: pos,
                map: map,
                draggable: true
            });

            let infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, 'position_changed', function() {
                let lat = marker.position.lat();
                let lng = marker.position.lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
            });

            google.maps.event.addListener(map, 'click', function(event) {
                pos = event.latLng;
                marker.setPosition(pos);
            });

            google.maps.event.addListener(marker, 'mouseover', function() {
                let geocoder = new google.maps.Geocoder();
                geocoder.geocode({'location': marker.getPosition()}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            let contentString = '<h2>' + results[0].formatted_address + '</h2>';
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                        } else {
                           // window.alert('لا يوجد نتائج');
                        }
                    } else {
                        //window.alert('حدث خطأ ما: ' + status);
                    }
                });
            });

            google.maps.event.addListener(marker, 'mouseout', function() {
                infowindow.close();
            });
        }
    </script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCth5l4nCl2dY9JxgeQGVKZHhjNK4Ue1b0&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC"
            async defer></script>

@stop
