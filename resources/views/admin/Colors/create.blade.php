@extends("layouts.admin")
@section("title","اضافة لون جديد")

@section("content")
<div class="m-portlet m-portlet--mobile col-md-12 col-sm-12 col-lg-12 col-auto">
    <form enctype="multipart/form-data" method='post' action='{{route("color.store")}}'>
        @csrf
        <div class='m-form'>
            <div class="m-portlet__body">
                <div class="m-form__section m-form__section--first">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-3 col-form-label"> اختر اللون</label>
                        <div class="col-lg-6">
                            <input type="color" placeholder="اختر اللون" name="name">
                        </div>
                    </div>

                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <button class="btn btn-primary" type="submit">إضافة</button>
                            <a href='{{route("color.index")}}' class="btn btn-secondary">الغاء الامر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section("css")
<link rel="stylesheet" href="{{asset('chosen/chosen.css')}}">
@endsection
@section("js")
<script src="{{asset('chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script>
    $(function(){
        $(".select").chosen();
    })
</script>
@endsection
