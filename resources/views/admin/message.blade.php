@extends("layouts.admin")
@section("title","   الرسائل")
@section('title-side')

    <a href="{{ route('admin.deleteAllMessage')}}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
        <span>
            <i class="la la-plus"></i>
            <span>
حذف جميع الرسائل         
</span>
        </span>
    </a>
@endsection


@section("content")

 <div class="m-portlet m-portlet--mobile  col-md-12 col-sm-12 col-lg-12 col-auto">
        <div class="m-portlet__body">
 <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($push_notifications->count() > 0)
                            <table
                                class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                                id="m_table_1" role="grid" aria-describedby="m_table_1_info" style="width: 1150px;">
                                <thead>
                                    <tr role="row">
                                        <th>
                                            <label
                                                class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                                <input type="checkbox" value="" class="m-group-checkable">
                                                <span></span>
                                            </label>
                                        </th>

                                        <th>العنوان</th>
                                        <th>محتوي الرساله</th>
                                        <th>المستخدم</th>
                                                                                                                       <th>خيارات</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($push_notifications as $push_notification)
                                        <tr role="row" class="odd">
                                            <td width="5%" class=" dt-right" tabindex="0">
                                                <label
                                                    class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                                    <input type="checkbox" value="" class="m-checkable">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>{{$push_notification->title}}</td>
                                            
                                            
                                            <td>{{$push_notification->body}}</td>
                                            <td>
                                             <select disabled class='form-control' name='to_user_id'>
                                              <option> جميع المستخدمين</option>

                                             @foreach ($users as $user)
                                        <option {{old('to_user_id',$user->id)==$push_notification->to_user_id?"selected":"all users"}} value='{{$user->id}}'> {{!isset($user->f_name)? 'المستخدمين':$user->f_name}} {{!isset($user->l_name)?'جميع':$user->l_name}}</option>
                                    @endforeach
</select></td>
                                             <td width="15%">
                                                
                                                <a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only"
                                                    href="{{ route('admin.deleteMessage', $push_notification->id) }}"
                                                    onclick="return confirm('هل انت متأكد من حذف {{$push_notification->title }} ؟')"
                                                    title="حذف"><i class="la la-remove"></i> </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          {{$push_notifications->links()}}
                        @else
                            <div class='alert alert-info'><b></b> ! لا توجد رسائل 
                                <button type="button" class="close pt-0" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
     </div>
    </div>

    
    @endsection