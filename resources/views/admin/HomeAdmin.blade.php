@extends('master.layout')
@section( "title", "Admin dashboard" )
@section("header") @include('admin.components.Header') @endsection
@section('content')
    @section("js") <script src="{{asset('js/jquery.js')}}"></script> @endsection
    @section("js_custom")
        <script>
            $.ajax({
                type: "GET",
                url: "{{url('/tests')}}",
                success: function (response) {
                    response.datas.map((d,i)=>{
                        console.log( JSON.parse( d.doctors ) )
                    })
                }
            });
        </script>
    @endsection
  <section>

        <h1 class="py-[20px] text-2xl" >Dashboard</h1>
        <section class="flex gap-[10px] justify-between" >
            <section class="w-6/12 p-2 drop-shadow items-center gap-[40px] bg-white rounded flex justify-center" >
                <div class="w-7/12" >
                    <h1 class="text-xl" >Hello, Doctor Huor.</h1>
                    <p>Welcome to your dashboard    </p>
                </div>
                <div class="w-5/12 text-center" >
                    <img class="h-auto max-w-full" src="{{asset('assets/illustrator_1.png')}}" />
                </div>
            </section>
            <section class="w-6/12 bg-white drop-shadow rounded flex gap-[10px]" >
                <div class="flex flex-col items-center  w-4/12 p-3 justify-center gap-[5px]" >
                    <i class="fa-solid fa-bed-pulse text-2xl"></i>
                    <h1>Total Patients</h1>
                    <h1>168</h1>
                </div>
                <div class="flex flex-col items-center  w-4/12 p-3 justify-center gap-[5px]" >
                    <i class="fa-solid fa-user-doctor text-2xl"></i>
                    <h1>Total Doctors</h1>
                    <h1>168</h1>
                </div>
                <div class="flex flex-col items-center  w-4/12 p-3 justify-center gap-[5px]" >
                    <i class="fa-solid fa-list-check text-2xl"></i>
                    <h1>Total Department</h1>
                    <h1>168</h1>
                </div>
            </section>
        </section>

  </section>

@endsection