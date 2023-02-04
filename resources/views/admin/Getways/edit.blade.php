@extends("layouts.admin")
@section("title", "الاعلانات  ")
@section("title-side")

@endsection

@section("content")
    <div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
        <form method='post' action='{{route("getways.update",$getway->id)}}'>
            @csrf
            @method("put")
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label"> اسم البوابة</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input" placeholder="ادخل اسم البوابة" name="name" value='{{$getway->name}}'>
                        </div>
                    </div>

                    <div class="m-form__group form-group row">
                        <label class=" col-lg-3 col-form-label">الحالة</label>
                        <div class="m-radio-inline col-lg-6">
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active',$getway->active)=='1'?"checked":""}} type="radio" name="active" checked=""
                                    value="1" aria-describedby="account_group-error"> فعال
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active',$getway->active)=='0'?"checked":""}} type="radio" name="active" value="0"> غير
                                فعال
                                <span></span>
                            </label>
                        </div>
                        <span class="m-form__help"></span>
                    </div>


                </div>
                <button class="btn btn-primary" type="submit">تعديل</button>
                <a class='btn btn-light' href='{{route("getways.index")}}'>الغاء الأمر</a>

            </div>
        </form>
    </div>

@endsection
