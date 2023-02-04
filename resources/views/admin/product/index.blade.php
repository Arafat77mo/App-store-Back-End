@extends('layouts.admin')
@section('title', 'إدارة المنتجات ')
@section('css')
    <style>
        .cbActive+div {
            display: none;
        }
    </style>
@endsection
@section('title-side')

    <a href="{{ route('products.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
        <span>
            <i class="la la-plus"></i>
            <span>
                اضافة منتج جديد
            </span>
        </span>
    </a>
@endsection

@section('js')
    <script>
        $(function() {
            $(".cbActive").click(function() {
                var id = $(this).val();
                var cb = $(this);
                $(this).hide();
                $(this).next().show();
                //var checked= $(this).is(":checked");
                //var checked= $(this).prop("checked");
                //alert("ID: "+id+", Checked: "+checked);
                $.get('/admin/products/' + id + '/activate', function() {
                    //alert("Updated successfully")
                    $(cb).next().hide();
                    $(cb).show();
                })
            })
        })
    </script>
@endsection


@section('content')
@if (session('error'))
<div class="alert alert-danger d-flex justify-content-center" style="margin-left:25%;width:400px;" role="alert">{{ session('error') }}</div>
@endif
    <div class="m-portlet m-portlet--mobile  col-md-12 col-sm-12 col-lg-12 col-auto">
        <div class="m-portlet__body">
          
            <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($products->count() > 0)
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
                                        <th>اسم المنتج</th>
                                        <th>القسم الفرعى</th>
                                        <th>القسم الرئيسى</th>
                                        <th>نسبة الخصم</th>
                                        <th>لون المنتج</th>
                                        <th>السعر العادي</th>
                                        <th>سعر البيع</th>
                                        <th>الكمية المتوفرة</th>
                                        <th>الحالة</th>
                                        <th>لينك اليوتيوب</th>

                                        <th>الصورة الرئيسية</th>
                                        <th width='15%'>خيارات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr role="row" class="odd">
                                            <td width="5%" class=" dt-right" tabindex="0">
                                                <label
                                                    class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                                    <input type="checkbox" value="" class="m-checkable">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{empty($product->subCategory->sub_name)? "لا يوجد قسم فرعي" :$product->subCategory->sub_name  }}</td>
                                            <td>{{empty($product->category->name)? "لا يوجد قسم رئيسي" : $product->category->name }}</td>
                                            <td>{{empty($product->offer->offer_price)? "لا يوجد خصم":$product->offer->offer_price }}</td>
                                            <td>{{empty($product->colors[0]['name'])?"لا يوجد لون":$product->colors[0]['name']}}</td>
                                            
                                            <td>{{ $product->regular_price == '' ? "$0" : "{$product->regular_price}$" }}</td>
                                            <td>{{ $product->sale_price == '' ? "$0" : "{$product->sale_price}$" }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td align='center'><input value='{{ $product->id }}' type='checkbox'
                                                    class='cbActive' {{ $product->active == '1' ? 'checked' : '' }} />
                                                <div class="m-spinner"></div>
                                            </td>
                                            <td><a href="{{$product->link}}">{{empty($product->link)?"لا يوجد" : $product->link}}</td>

                                                <td>
                                                @foreach (json_decode($product->image) as $image)
                                                <img height=50 width=50
                                                    src='{{$image}}'
                                                    alt="">
                                                @endforeach
                                            </td>
                                            <td width="15%">
                                                <a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only"
                                                    href="{{ route('products.show', $product->id) }}" title="عرض"><i
                                                        class="la la-eye"></i> </a>
                                                <a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only"
                                                    href="{{ route('products.edit', $product->id) }}" title="تعديل"><i
                                                        class="la la-edit"></i> </a>
                                                <a class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only"
                                                    href="{{ route('products.delete', $product->id) }}"
                                                    onclick="return confirm('هل انت متأكد من حذف {{ $product->name }} ؟')"
                                                    title="حذف"><i class="la la-remove"></i> </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          {{ $products->links() }} 
                        @else
                            <div class='alert alert-info'><b>نأسف</b> !لا توجد نتائج
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

@endsection
