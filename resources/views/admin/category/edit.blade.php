@extends("layouts.admin")
@section("title","التعديل على التصنيف")

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
    <form method="post" action="{{route("category.update",$item->id)}}" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class='m-form'>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{$item->name}}" class="form-control m-input" placeholder="ادخل الاسم ">
                            <span class="m-form__help">أدخل اسم التصنيف</span>
                        </div>
                    </div>
 <td><img height=50 width=50
                                                    src='{{$item->image}}'
                                                    alt=""></td>
                        <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">الصوره</label>
                            <div class="col-lg-6">
                                <input type="file" name="image" value="{{$item->image}}" class="form-control m-input" >
                                <span class="m-form__help"> الصوره </span>
                            </div>
                        </div>

                    <div class="m-form__group form-group row">
                        <label class=" col-lg-3 col-form-label">فعال / غير فعال</label>
                        <div class="m-radio-inline col-lg-6">
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{$item->active=='1'?"checked":""}} type="radio" name="active" checked="" value="1"
                                    aria-describedby="account_group-error"> فعال
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{$item->active=='0'?"checked":""}} type="radio" name="active" value="0"> غير فعال
                                <span></span>
                            </label>
                        </div>
                        <span class="m-form__help"></span>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">آخر تحديث</label>
                        <div class="col-lg-6">
                            <input disabled type="text" name="name" value="{{$item->updated_at}}" class="form-control m-input" placeholder="ادخل الاسم ">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                            <a href="{{route("category.index")}}" class="btn btn-secondary">الغاء الامر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection