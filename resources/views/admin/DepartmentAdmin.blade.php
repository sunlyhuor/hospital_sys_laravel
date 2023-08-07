@php $limit = 10; @endphp
@extends('master.layout')
@section( "title", "Admin Department" )
@section("header") @include('admin.components.Header') @endsection
@section('content')
    {{-- <h1> @php echo Request::root();  @endphp </h1> --}}
    <div>
        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="{{url('/admin/department')}}" class="{{ (Request::get("tab") != 'new' && Request::get("tab") != 'update' ) ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500" aria-current="page"> <i class="fa-solid fa-list-check"></i> Department</a>
                </li>
                <li class="mr-2">
                    <a href="{{url('/admin/department?tab=new')}}" class="{{ Request::get("tab") == 'new' ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500"> <i class="fa-solid fa-plus"></i> New</a>
                </li>
                @if( Request::get("tab") == "update" )
                    <li class="mr-2">
                        <a href="{{url('/admin/department?tab=update')}}" class="{{ Request::get("tab") == 'update' ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500"> <i class="fa-regular fa-pen-to-square"></i> Update</a>
                    </li>
                @endif
            </ul>
        </div>
        @if( Request::get("tab") != "new" && Request::get("tab") != "update" )
            @section("js")
                <script src="{{asset('js/jquery.js')}}"></script>
            @endsection
              {{-- Add Js Custom for Tab new  --}}
            @section("js_custom")
                <script>
                    const loading_source = `<div class="text-center w-full" >
                                <div class="loadingio-spinner-wedges-jp3uc3s7xp"><div class="ldio-i8bkaguxclf">
                                <div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div>
                                </div></div>    
                            </div>
                            <style type="text/css">
                            @keyframes ldio-i8bkaguxclf {
                            0% { transform: rotate(0deg) }
                            100% { transform: rotate(360deg) }
                            }
                            .ldio-i8bkaguxclf > div > div {
                            transform-origin: 100px 100px;
                            animation: ldio-i8bkaguxclf 3.0303030303030303s linear infinite;
                            opacity: 0.8
                            }
                            .ldio-i8bkaguxclf > div > div > div {
                            position: absolute;
                            left: 30px;
                            top: 30px;
                            width: 70px;
                            height: 70px;
                            border-radius: 70px 0 0 0;
                            transform-origin: 100px 100px
                            }.ldio-i8bkaguxclf > div div:nth-child(1) {
                            animation-duration: 0.7575757575757576s
                            }
                            .ldio-i8bkaguxclf > div div:nth-child(1) > div {
                            background: #e15b64;
                            transform: rotate(0deg);
                            }.ldio-i8bkaguxclf > div div:nth-child(2) {
                            animation-duration: 1.0101010101010102s
                            }
                            .ldio-i8bkaguxclf > div div:nth-child(2) > div {
                            background: #f47e60;
                            transform: rotate(0deg);
                            }.ldio-i8bkaguxclf > div div:nth-child(3) {
                            animation-duration: 1.5151515151515151s
                            }
                            .ldio-i8bkaguxclf > div div:nth-child(3) > div {
                            background: #f8b26a;
                            transform: rotate(0deg);
                            }.ldio-i8bkaguxclf > div div:nth-child(4) {
                            animation-duration: 3.0303030303030303s
                            }
                            .ldio-i8bkaguxclf > div div:nth-child(4) > div {
                            background: #abbd81;
                            transform: rotate(0deg);
                            }
                            .loadingio-spinner-wedges-jp3uc3s7xp {
                            width: 200px;
                            height: 200px;
                            display: inline-block;
                            overflow: hidden;
                            background: #ffffff;
                            }
                            .ldio-i8bkaguxclf {
                            width: 100%;
                            height: 100%;
                            position: relative;
                            transform: translateZ(0) scale(1);
                            backface-visibility: hidden;
                            transform-origin: 0 0; /* see note above */
                            }
                            .ldio-i8bkaguxclf div { box-sizing: content-box; }
                            /* generated by https://loading.io/ */
                            </style>`
                    var msg = "",search = ""
                    var page = `{{ Request::get('page') && Request::get('page') > 0 ? Request::get('page') : 1  }}`
                    
                    function LoadDepartments(){
                        $("#loading").html(loading_source)
                        $.ajax({
                            type: "get",
                            url: `{{ url('/admin/get/department?page=${page}') }}` ,
                            dataType: "json",
                            success: function (response) {
                                console.log( response )
                                msg = ""
                                response.datas.map((d, i)=>{
                                    msg += `
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                ${ i + 1 }
                                            </td>
                                            <td class="px-6 py-4">
                                                ${ d.department_id }
                                            </td>
                                            <th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                ${ d.department_name }
                                            </th>
                                            <td class="px-6 py-4">
                                                ${ d.department_description ? d.department_description : '.' }
                                            </td>
                                            <td class="px-6 py-4">
                                                ${ d.doctor_count }
                                            </td>
                                            <td class="px-6 py-4">
                                                ${ JSON.parse( d.doctors ) ? JSON.parse( d.doctors ).map((d)=> `<a class="hover:text-blue-600 hover:font-bold" href="@php Request::root(); @endphp/admin/doctor?tab=view&id=${d.doctor_id ? d.doctor_id : ''}" >${d.doctor_name ? d.doctor_name : "" }</a>` ) : "." }
                                            </td>
                                            <td class="px-6 py-4">
                                                ${ d.patient_count }
                                            </td>
                                            <td class="px-6 py-4 flex gap-[5px] flex-wrap">
                                                <button class="bg-red-600 py-[5px] px-[10px] text-white rounded" onclick="DeleteDepartment(${d.department_id} ,'${d.department_name}')" >Delete</button>
                                                <a href="{{url('/admin/department?tab=update&id=${d.department_id}')}}" class="bg-green-600 py-[5px] px-[10px] text-white rounded">Update</a>
                                            </td>
                                        </tr>
                                    `
                                })
                                $("#show_datas").html( msg );
                                $("#loading").html( "" )
                            }
                        });
                    } 
        
                    function DeleteDepartment(id, name){
                        const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        if(confirm( `Are you want delete department name : ${name}` )){
                            $.ajax({
                                type: "POST",
                                url: `{{url('/admin/delete/department/${id}')}}`,
                                // url: `{{url('/admin/delete/department/${id}')}}`,
                                data: {
                                    _token:csrfToken
                                },
                                // dataType: "dataType",
                                success: function (response) {
                                    msg = ""
                                    $("#show_datas").html("")
                                    LoadDepartments()
                                },
                                error: function (xhr, status, error) {
                                    console.log("AJAX request failed. Error:", error);
                                }
                            });
                        }
                    }

                    // 
                    $("document").ready(function(){

                        $("#search_navbar").on("input", function(e){
                            if( $("#search_navbar").val().length < 1 ){
                                LoadDepartments()
                            }else{
                                $("#loading").html(loading_source)
                                $.ajax({
                                    type: "GET",
                                    url: ` @php echo Request::root(); @endphp/admin/search/department/${ $("#search_navbar").val() }`,
                                    // data: "data",
                                    // dataType: "dataType",
                                    success: function (response) {
                                        if( response.datas.length > 0 ){
                                            search = ""
                                            response.datas.map((d, i)=>{
                                                search = search += `
                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                        <td class="px-6 py-4">
                                                            ${ i + 1 }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.department_id }
                                                        </td>
                                                        <th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            ${ d.department_name }
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            ${ d.department_description }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.doctor_count }
                                                        </td>
                                                        <td class="px-6 py-4 flex gap-[5px] flex-wrap">
                                                            <button class="bg-red-600 py-[5px] px-[10px] text-white rounded" onclick="DeleteDepartment(${d.department_id} ,'${d.department_name}')" >Delete</button>
                                                            <a href="{{url('/admin/department?tab=update&id=${d.department_id}')}}" class="bg-green-600 py-[5px] px-[10px] text-white rounded">Update</a>
                                                        </td>
                                                    </tr>
                                                `
                                            })
                                            $("#show_datas").html(search)
                                            $("#loading").html("")
                                        }else{
                                            $("#show_datas").html("")
                                            $("#loading").html(`
                                                <h1 class="text-center w-full py-[20px]" >Not found</h1>
                                            `)
                                        }
                                    },
                                    error:function(x, v, e){
                                        console.log(e);
                                    }
                                });
                                // console.log( $("#search_navbar").val().length )
                            }
                        })
                    })
                    // 

                    LoadDepartments()
                </script>
            @endsection
            {{-- End add js custom for tab new --}}
            <div class="relative w-5/12 py-[10px]">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>
                <input type="text" id="search_navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doctor number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doctor names
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Patient Total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="show_datas">
                            {{-- Data departments --}}
                    </tbody>
                </table>
                <div id="loading" class="w-full text-center"></div>
            </div>
            <div class="flex flex-col py-[20px] items-center">
                <!-- Help text -->
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    {{ Request::get("page") ? Request::get("page") : 1  }} of <span>{{ intval($count / $limit) + 1 }} </span>
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                  <!-- Buttons -->
                    <a href="{{ url('/admin/department?page='.(Request::get('page') && Request::get('page') > 1 ? Request::get('page') - 1 : 1 ) )}}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                        </svg>
                        Prev
                    </a>
                    <a href="{{ url('/admin/department?page='.( Request::get('page') < (intval($count / $limit) + 1) ?  Request::get('page') + 1 :  Request::get('page') ) )}}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
              </div>
        @elseif( Request::get("tab") == "new" )
            <section class="min-[0px]:w-[90%] sm:w-[60%] lg:w-[50%] xl:w-[40%] mx-auto p-3 rounded mt-[30px] shadow" >
                <h1 class="py-[10px] font-bold text-2xl" >Add Department</h1>
                <span class="py-[10px] text-red-600" >{{ Request::get("message") }}</span>
                <form action="{{url('/admin/add/department')}}" method="POST">
                    @csrf
                    <div class="py-[5px]" >
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Title</label>
                        <input type="text" name="department_name" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <label class="text-red-600" >@error("department_name") {{$message}} @enderror</label>
                    </div>
                    <div class="py-[5px]" >
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department description</label>
                        <input type="text" name="department_description" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="py-[5px]" >
                        <button class="bg-green-500 rounded px-[20px] py-[5px] text-white font-bold" >Add</button>
                    </div>
                </form>
            </section>
        @else
            @section("js")
                <script src="{{asset('js/jquery.js')}}"></script>
            @endsection
            @section( "js_custom" )
                <script>
                    function LoadDepartmentById(){
                        $.ajax({
                            type: "GET",
                            url: "{{ url('/admin/get/department/'.Request::get('id')) }}",
                            // data: "data",
                            // dataType: "dataType",
                            success: function (response) {
                                if( response.data ){
                                    $("#title").val( response.data.department_name )
                                    $("#description").val( response.data.department_description )
                                }else{
                                    window.location.href = "@php echo Request::root(); @endphp/admin/department"
                                }
                            },
                            error: function( x, b, e ){
                                console.log( e )
                            }
                        });
                    }
                    LoadDepartmentById()
                </script>
            @endsection
            <section class="min-[0px]:w-[90%] sm:w-[60%] lg:w-[50%] xl:w-[40%] mx-auto p-3 rounded mt-[30px] shadow" >
                <h1 class="py-[10px] font-bold text-2xl" >Update Department</h1>
                <span class="py-[10px] text-red-600" >{{ Request::get("message") }}</span>
                <form action="{{url('/admin/update/department/'.Request::get('id'))}}" method="POST">
                    @csrf
                    <div class="py-[5px]" >
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Title</label>
                        <input type="text" name="department_name" id="title" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <label class="text-red-600" >@error("department_name") {{$message}} @enderror</label>
                    </div>
                    <div class="py-[5px]" >
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department description</label>
                        <textarea type="text" id="description" name="department_description" id="small-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div class="py-[5px]" >
                        <button class="bg-green-500 rounded px-[20px] py-[5px] text-white font-bold" >Update</button>
                    </div>

                </form>
            </section>
        @endif

    </div>

@endsection
