@extends("layouts.admin")
@section("title","الصفحة الرئيسية")
@section("content")

<style>
    .cards{

    transition: all 0.2s ease;
    cursor: pointer;
    

  }
    


.cards:hover{

    box-shadow: 5px 6px 6px 2px #e9ecef;
    transform: scale(1.1);
}
</style>
<div class="row container">
            <a href='{{route('order.neworder')}}' class="m-menu__link-bullet m-menu__link-bullet--dot">

<div class="card col-3 m-4" style="height:170px " >
    <h5 class="card-title mt-5">طلبات الجديدة</h5>
    <div class="card-body mt-2">
        <div class="square" style="background-color:#2fc9cb;width: 60px;height: 60px;display: inline-block;">
            <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
          </div>
                <Span class="card-text m-4 fs-1 fw-bold">{{empty($newOrder)?"لايوجد":$newOrder}}</span>
    </div></a>
  </div>

  <div class="card col-3 m-4" style="height:170px " >           
  <a href='{{route('order.orderDriver')}}' class="m-menu__link-bullet m-menu__link-bullet--dot">

    <h5 class="card-title mt-5">الطلبات مع السائق</h5>
    <div class="card-body">
        <div class="square" style="background-color:#e84e5c;width: 60px;height: 60px;display: inline-block;">
            <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
          </div>
                <Span class="card-text m-4 fs-1 fw-bold">{{empty($ordersend)?"لايوجد":$ordersend}}</span>
    </div></a>
  </div>

  <div class="card col-3 m-4" style="height:170px ">          
  <a href='{{route('order.workprogress')}}' class="m-menu__link-bullet m-menu__link-bullet--dot">

    <h5 class="card-title mt-5">قيد التجهيز </h5>
    <div class="card-body">
        <div class="square" style="background-color:#8646b4;width: 60px;height: 60px;display: inline-block;">
            <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
          </div>
                <Span class="card-text m-4 fs-1 fw-bold">{{empty($orderwork)?"لايوجد":$orderwork}}</span>
    </div></a>
  </div>
</div>

<div class="row container">
        <a href='{{ route('products.indexx') }}' class="m-menu__link-bullet m-menu__link-bullet--dot">

    <div class="card col-3 m-4" style="height:170px " >
        <h5 class="card-title mt-5">اجمالى المنتجات</h5>
        <div class="card-body mt-2">
            <div class="square" style="background-color:#3399dc;width: 60px;height: 60px;display: inline-block;">
                <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
              </div>
               <i
                                  <span></span></i> <Span class="card-text m-4 fs-1 fw-bold">{{empty($allProducts)?"لايوجد":$allProducts}}</span>
        </div></a>
      </div>

      <div class="card col-3 m-4" style="height:170px " >
                      <a href='{{route('order.indexx')}}' class="m-menu__link-bullet m-menu__link-bullet--dot">

        <h5 class="card-title mt-5">طلبات ملغاة</h5>
        <div class="card-body">
            <div class="square" style="background-color:#c49e49;width: 60px;height: 60px;display: inline-block;">
                <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
              </div>
                        <Span class="card-text m-4 fs-1 fw-bold">{{empty($orderCancel)?"لايوجد":$orderCancel}}</span>
        </div></a>
      </div>

      <div class="card col-3 m-4" style="height:170px ">           
      <a href='{{route('order.index')}}' class="m-menu__link-bullet m-menu__link-bullet--dot">

        <h5 class="card-title mt-5">  الطلبات</h5>
        <div class="card-body">
            <div class="square" style="background-color:#3798d4;width: 60px;height: 60px;display: inline-block;">
                <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
              </div>
                        <Span class="card-text m-4 fs-1 fw-bold">{{empty($allOrder)?"لايوجد":$allOrder}}</span>
        </div>
      </div></a>
    </div>

    <div class="row container"> 
    <a href='{{ route('user.index') }}' class="m-menu__link-bullet m-menu__link-bullet--dot">
        <div class="card col-3 m-4" style="height:170px " >
            <h5 class="card-title mt-5"> المستخدمين</h5>
            <div class="card-body mt-2">

                <div class="square" style="background-color:#c39d52;width: 60px;height: 60px;display: inline-block;">
                    <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
                  </div>               


                      
                        <i
                                  <span></span></i> <Span class="card-text m-4 fs-1 fw-bold">{{empty($users)?"لايوجد":$users}}</span>







            </div></a>
          </div>

          <div class="card col-3 m-4" style="height:170px " >   
          <a href='{{ route('products.productSoldOut') }}' class="m-menu__link-bullet m-menu__link-bullet--dot">

              
            <h5 class="card-title mt-5">  المنتجات التى نفذت </h5>
            <div class="card-body">
                <div class="square" style="background-color:#3598dc;width: 60px;height: 60px;display: inline-block;">
                    <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
                  </div>
              <Span class="card-text m-4 fs-1 fw-bold">{{empty($soldProducts)?"لايوجد":$soldProducts}}</span>
            </div></a>
          </div>

          <div class="card col-3 m-4" style="height:170px ">
                        <a href='{{ route('admin.message') }}' class="m-menu__link-bullet m-menu__link-bullet--dot">

            <h5 class="card-title mt-5">الرسائل</h5>
            <div class="card-body">
                <div class="square" style="background-color:#3598dc;width: 60px;height: 60px;display: inline-block;">
                    <img src="{{asset('assets/images/card.png')}}" class="m-3" width="35px">
                  </div>
                                <Span class="card-text m-4 fs-1 fw-bold">{{empty($Notification)?"لايوجد":$Notification}}</span>
            </div></a>
          </div>
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
