@extends("layouts.admin")
@section("title","اضافة تصنيف جديد")

@section("title-side")
<!--a href="{{asset('admin/category/create')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
    <span>
        <i class="la la-plus"></i>
        <span>
            اضافة تصنيف جديد
        </span>
    </span>
</a-->
@endsection

@section("content")
<div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
    @foreach ($errors->all() as $error)
                <li class="text-danger m-5">{{ $error }}</li>
            @endforeach
    <form enctype="multipart/form-data" method='post' action='{{route("category.store")}}'>
        @csrf
        <div class='m-form'>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">اسم الصنف </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input" placeholder="ادخل اسم الصنف" name="name">
                        </div>
                    </div>



                    <div class="m-form__group form-group row">
                        <label class=" col-lg-3 col-form-label">الحالة</label>
                        <div class="m-radio-inline col-lg-6">
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active')=='1'?"checked":""}} type="radio" name="active" checked=""
                                    value="1" aria-describedby="account_group-error"> فعال
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active')=='0'?"checked":""}} type="radio" name="active" value="0"> غير
                                فعال
                                <span></span>
                            </label>
                        </div>
                        <span class="m-form__help"></span>
                    </div>

                    <div class="m-form__group form-group row">
                            <label class="col-lg-3 col-form-label" for="image">الصورة الرئيسية</label>
                            <input class="col-lg-6" type='file' name="image" id="image" />
                    </div>

                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-3">
                           </div>
                        <div class="col-lg-6">

                            <button class="btn btn-primary" type="submit">إضافة</button>

                            <a href='{{route("category.index")}}' class="btn btn-secondary">الغاء الامر</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
