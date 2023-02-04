@extends("layouts.admin")
@section("title","الرسائل")
@section("content")
<div class="m-portlet m-portlet--mobile  col-md-12 col-sm-12 col-lg-12 col-auto">
        <div class="m-portlet__body">
            @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<form action="{{route('bulksend')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Title" name="title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Message</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Description" name="body" required>
        </div>
         <div class="form-group">
         <select class="form-control chosen-rtl select" name='to_user_id' id='subcategory_id'>
                    <option selected value='' >-  جميع المستخدمين    </option>
                    @foreach($users as $user)
                    <option value='{{$user->id}}'>
                        {{$user->f_name}} {{$user->l_name}}   </option>
                    @endforeach
                </select>
                </div>
        <button type="submit" class="btn btn-primary">Send Notification</button>
    </form>

    </div>
        </div>

    <script>
        function loadPhoto(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    
    
    @endsection
