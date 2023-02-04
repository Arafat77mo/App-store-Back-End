@extends("layouts.admin")
@section("title", " الاشعارات")


@section('title-side')

    <a href="{{ route("notfy.deletenotfy") }}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
        <span>
<i class="la la-remove"></i>         
<span>
                حذف الاشعارات
            </span>
        </span>
    </a>
@endsection

@section("content")         


@forelse(\App\Models\AdminNote::all() as $note)

<div class="m-portlet m-5 p-5 m-portlet--mobile bg-success text-white col-md-6 col-sm-6 col-lg-6 col-auto" style="border-radius:10px">
{{$note->created_at }}

              <h4>{{$note->title }}</h4>
                 <h4>{{$note->content }} </h4>          
                 </div>
                  @empty
            <h3 class="text-center m-5 p-5">
                لا يوجد اشعارات
            </h3>

        


             

      </div>  
              @endforelse 
              
                  @php(\App\Models\AdminNote::query()->update(['seen'=>1]))


    @endsection