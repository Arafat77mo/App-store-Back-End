@extends("layouts.admin")
@section("title","عرض التصنيف")

@section("title-side")
 
@endsection

@section("content")
<div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
       
        <div class='m-form'>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input disabled type="text" name="name" value="{{$item->sub_name}}" class="form-control m-input" placeholder="ادخل الاسم ">
                        </div>
                    </div>
                
<td><img height=50 width=50
                                                    src='{{$item->photo}}'
                                                    alt=""></td>
                    <div class="col-lg-6 m-form__group form-group">
                       
                        <div class='row'>
                            <div class='col-sm-8'>
                                <select disabled class='form-control' name='status'>
                                    @foreach($category as $categoryy)
                                        <option {{old('category_id',$categoryy->id)==$item->category_id?"selected":""}} value='{{$categoryy->id}}'>{{$categoryy->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                        </div>
                         
                    </div>
                                        </form>

                    <div class="m-form__group form-group row">
                        <label class=" col-lg-3 col-form-label">فعال / غير فعال</label>
                        <div class="m-radio-inline col-lg-6">
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input disabled {{$item->active=='1'?"checked":""}} type="radio" name="active" checked="" value="1"
                                    aria-describedby="account_group-error"> فعال
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input disabled {{$item->active=='0'?"checked":""}} type="radio" name="active" value="0"> غير فعال
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
                            <a href="{{route("sub_category.index")}}" class="btn btn-secondary">الغاء الامر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>
@endsection