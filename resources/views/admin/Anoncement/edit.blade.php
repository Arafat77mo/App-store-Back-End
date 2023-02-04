@extends("layouts.admin")
@section("title", "الاعلانات  ")
@section("title-side")

@endsection

@section("content")
    <div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
        <form method='post' action='{{route("Anoncement.update",$Announcement->id)}}'enctype="multipart/form-data" >
            @csrf
            @method("put")
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label"> محتوى الاعلان</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control m-input" placeholder="ادخل محتوى الاعلان" name="text" value='{{$Announcement->text}}'>
                        </div>
                    </div>
                     <div class="form-group m-form__group row">
                            <label class="col-lg-3 col-form-label">الصوره</label>
                            <div class="col-lg-6">
                                <input type="file" name="image"  class="form-control m-input my-5" >
                                <img src="{{$Announcement->image}}" width="300px">
 @if ($errors->has('image'))
                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                        </div>
                    
                    
                    
                </div>
                <button class="btn btn-primary" type="submit">تعديل</button>
                <a class='btn btn-light' href='{{route("Anoncement.index")}}'>الغاء الأمر</a>

            </div>
        </form>
    </div>

@endsection
