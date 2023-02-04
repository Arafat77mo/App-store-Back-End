@extends("layouts.admin")
@section("title","تعديل المنتج")

@section("content")
<div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">

    <form enctype="multipart/form-data" method='post' action='{{route('products.update',$product->id)}}'>
        @csrf
        @method("put")
        <div class='m-form'>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">اسم المنتج </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input" name="title"
                                value='{{ old("title",$product->title) }}'>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">الوصف </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input" name="slug"
                                value='{{ old("slug",$product->slug) }}'>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">القسم الفرعي </label>
                        <div class="col-lg-6">
                        <select class='form-control select2' name='subcategory_id' id='subcategory_id'>
                            <option value=''>-اختر القسم-</option>
                            @foreach($SubCategories as $SubCategoriy)
                            <option {{old('subcategory_id',$product->subcategory_id)==$SubCategoriy->id?'selected':''}}
                                value='{{$SubCategoriy->id}}'>{{$SubCategoriy->sub_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">نسبة الخصم </label>
                        <div class="col-lg-6">
                            <select class="form-control chosen-rtl select" name='offer_id' id='offer_id'>
                                <option selected>-اختر  الخصم- </option>
                                <option>لايوجد خصم</option>
                                @foreach($offers as $offer)
                                <option {{old('offer_id',$product->offer_id)==$offer->id?'selected':''}}    value='{{$offer->id}}'>
                                    {{$offer->offer_price}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label" for="details">تفاصيل المنتج</label>
                        <textarea class="form-control col-lg-6" id="details" name="details"
                            rows="3">{{ old("details",$product->details) }}</textarea>
                    </div>
                    
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">لون المنتج </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input"
                                name="color" value='{{ old("color",$product->color) }}'>
                        </div>
                    </div>
                    

                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">السعر العادي </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input"
                                name="regular_price" value='{{ old("regular_price",$product->regular_price) }}'>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">سعر البيع </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input"
                                name="sale_price" value='{{ old("sale_price",$product->sale_price) }}'>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">الكمية المتوفرة</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input"
                                 name="quantity"
                                value='{{ old("quantity",$product->quantity) }}'>
                        </div>
                    </div>
                    <div class="m-form__group form-group row">
                        <label class=" col-lg-3 col-form-label">الحالة</label>
                        <div class="m-radio-inline col-lg-6">
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active',$product->active)=='1'?"checked":""}} type="radio" name="active" checked=""
                                    value="1" aria-describedby="account_group-error"> فعال
                                <span></span> 
                            </label>
                            <label class="m-radio m-radio--solid m-radio--brand">
                                <input {{old('active',$product->active)=='0'?"checked":""}} type="radio" name="active" value="0"> غير
                                فعال
                                <span></span>
                            </label>
                        </div>
                        <span class="m-form__help"></span>
                    </div>
                    
                      <div class="m-form__group form-group row">
                        <label class="col-lg-3 col-form-label" for="image">لينك اليوتيوب</label>
                        <input class="col-lg-6" type='url' name="link" id="link" value="{{$product->link}}" />
                </div>


                     @foreach (json_decode($product->image) as $image)
                    <img height=50 width=50
                    src='{{$image}}'
                    alt="">
                    <div class="input-group control-group increment" >
                        <input type="file" name="image[]" class="form-control" value="{{$image}}">
                        <div class="input-group-btn">
                          <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                        </div>
                      </div>
                      @endforeach

                      <div class="clone hide">
                        <div class="control-group input-group" style="margin-top:10px">
                          <input type="file" name="image[]" class="form-control">
                          <div class="input-group-btn">
                            <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                          </div>
                        </div>
                      </div>

                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary" type="submit">تعديل</button>
                            <a href='{{route("products.indexx")}}' class="btn btn-secondary">الغاء الامر</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section("js")
<script src="{{asset('chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script>
    $(function(){
        $(".select").chosen();
    })

    $(document).ready(function() {
      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>
@endsection
