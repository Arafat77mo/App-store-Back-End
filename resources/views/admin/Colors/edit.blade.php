@extends("layouts.admin")
@section("title", "الالوان")
@section("title-side")

@endsection

@section("content")
    <div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
        <form method='post' action='{{route("color.update",$color->id)}}'>
            @csrf
            @method("put")
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label">اللون</label>
                        <div class="col-lg-6">
                            <input type="color"  placeholder="ادخل اللون" name="name" value='{{$color->name}}'>
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary" type="submit">تعديل</button>
                <a class='btn btn-light' href='{{route("color.index")}}'>الغاء الأمر</a>

            </div>
        </form>
    </div>

@endsection
