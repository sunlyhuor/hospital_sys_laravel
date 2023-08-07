    @php $limit = 10 @endphp
    @extends("master.layout")
    @section("title", "Doctor page")
    @section("header") @include( "admin.components.Header" ) @endsection
    @section("content")
        <div class="mb-[20px] h-auto" >
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="mr-2">
                        <a href="{{url('/admin/doctor')}}" class="{{ (Request::get("tab") != 'new' && Request::get("tab") != 'update' ) ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500" aria-current="page"> <i class="fa-solid fa-user-doctor"></i> Doctor</a>
                    </li>
                    <li class="mr-2">
                        <a href="{{url('/admin/doctor?tab=new')}}" class="{{ Request::get("tab") == 'new' ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500"> <i class="fa-solid fa-plus"></i> New</a>
                    </li>
                    @if( Request::get("tab") == "update" )
                        <li class="mr-2">
                            <a href="{{url('/admin/doctor?tab=update')}}" class="{{ Request::get("tab") == 'update' ? 'border-b-2 border-blue-600 active  text-blue-600' : '' }} inline-block p-4 rounded-t-lg hover:border-gray-300 dark:text-blue-500 dark:border-blue-500"> <i class="fa-regular fa-pen-to-square"></i> Update</a>
                        </li>
                    @endif
                </ul>
            </div>
            <section>
                @if( Request::get("tab") != "new" && Request::get("tab") != "update" && Request::get("tab") != "view" )
                    @section("js") <script src="{{asset('js/jquery.js')}}"></script> @endsection
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
                                    </style>
                                `
                                var msg = "",search = ""

                                function LoadDoctors(){
                                    msg = ""
                                    $("#loading").html( loading_source )
                                    $.ajax({
                                        type: "GET",
                                        url: "{{url('/admin/get/doctor?page='.(( Request::get('page') && Request::get('page') > 0) ? Request::get('page') : 1  ) ) }}",
                                        // data: "data",
                                        // dataType: "dataType",
                                        success: function (response) {
                                            // console.log(response);
                                            response.datas.map(function( d, i ){
                                                    msg += `
                                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                            <td class="px-6 py-4">
                                                                ${ i + 1 }
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                <a class="hover:text-blue-500" href="{{url('/admin/doctor?tab=view&id=${d.doctor_id}')}}" >${d.doctor_id} </a>
                                                            </td>
                                                            <th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                <a class="hover:text-blue-500" href="{{url('/admin/doctor?tab=view&id=${d.doctor_id}')}}" >${d.doctor_name} </a>
                                                            </th>
                                                            <td class="px-6 py-4">
                                                                ${d.doctor_address}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                ${d.doctor_phone}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                ${d.doctor_email}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                ${d.doctor_profile}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                ${d.department_name}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                ${d.doctor_role_name}
                                                            </td>
                                                            <td class="px-6 py-4 flex flex-col gap-[5px]">
                                                                <button class="bg-red-600 py-[5px] px-[10px] text-white rounded" onclick="DeleteDoctor(${d.doctor_id} ,'${d.doctor_name}')" >Delete</button>
                                                                <a href="{{url('/admin/doctor?tab=update&id=${d.doctor_id}')}}" class="bg-green-600 py-[5px] px-[10px] text-white rounded">Update</a>
                                                            </td>
                                                        </tr>
                                                    `     
                                            })
                                            $("#show_datas").html( msg )
                                            $("#loading").html("")
                                        }
                                    });
                                }

                                function DeleteDoctor(id, name){
                                    const csrfToken = $('meta[name="csrf-token"]').attr('content');
                                    if(confirm( `Are you want delete doctor name : ${name}` )){
                                        $.ajax({
                                            type: "POST",
                                            url: `{{url('/admin/delete/doctor/${id}')}}`,
                                            // url: `{{url('/admin/delete/department/${id}')}}`,
                                            data: {
                                                _token:csrfToken
                                            },
                                            // dataType: "dataType",
                                            success: function (response) {
                                                msg = ""
                                                $("#show_datas").html("")
                                                LoadDoctors()
                                            },
                                            error: function (xhr, status, error) {
                                                console.log("AJAX request failed. Error:", error);
                                            }
                                        });
                                    }
                                }

                                LoadDoctors()
                                
                                $("document").ready(function(e){

                                    $("#search_navbar").on("input", (e)=>{
                                        if( $("#search_navbar").val().length < 1 ){
                                            LoadDoctors()
                                        }
                                        else{
                                            $("#loading").html( loading_source )
                                            $.ajax({
                                                    type: "GET",
                                                    url: "@php echo Request::root(); @endphp/admin/search/doctor/"+$('#search_navbar').val().toLowerCase(),
                                                    // data: "data",
                                                    // dataType: "dataType",
                                                    success: function (response) {
                                                        if( response.datas.length > 0 ){
                                                            search = ""
                                                            response.datas.map(function( d, i ){
                                                                search += `
                                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                                        <td class="px-6 py-4">
                                                                            ${ i + 1 }
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_id}
                                                                        </td>
                                                                        <th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                            ${d.doctor_name} 
                                                                        </th>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_address}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_phone}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_email}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_profile}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.department_name}
                                                                        </td>
                                                                        <td class="px-6 py-4">
                                                                            ${d.doctor_role_name}
                                                                        </td>
                                                                        <td class="px-6 py-4 flex flex-col gap-[5px]">
                                                                            <button class="bg-red-600 py-[5px] px-[10px] text-white rounded" onclick="DeleteDoctor(${d.doctor_id} ,'${d.doctor_name}')" >Delete</button>
                                                                            <a href="{{url('/admin/doctor?tab=update&id=${d.doctor_id}')}}" class="bg-green-600 py-[5px] px-[10px] text-white rounded">Update</a>
                                                                        </td>
                                                                    </tr>
                                                                `     
                                                            })
                                                            $("#show_datas").html( search )
                                                            $("#loading").html("")

                                                        }else{
                                                            $("#show_datas").html("")
                                                            $("#loading").html(`
                                                                <h1 class="text-center w-full py-[20px]" >Not found</h1>
                                                            `)
                                                        }
                                                    },
                                                    error: function( x ,f, e ){
                                                        console.log( f )
                                                    }
                                            });
                                        }
                                    })

                                })
                                // $('#search_navbar')
                        </script> 
                    @endsection
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
                                        doctor id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Doctor name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Department Address
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Doctor phone
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Doctor email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Doctor profile
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Department
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="show_datas">
                                    {{-- Data departments --}}
                                    {{-- <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <td class="px-6 py-4">
                                            ID
                                        </td>
                                        <td class="px-6 py-4">
                                            Doctor Id
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Doctor name
                                        </th>
                                        <td class="px-6 py-4">
                                            Address
                                        </td>
                                        <td class="px-6 py-4">
                                            Phone
                                        </td>
                                        <td class="px-6 py-4">
                                            Email
                                        </td>
                                        <td class="px-6 py-4">
                                            Profile
                                        </td>
                                        <td class="px-6 py-4">
                                            Department
                                        </td>
                                        <td class="px-6 py-4">
                                            Role
                                        </td>
                                        <td class="px-6 py-4">
                                            Action
                                        </td>
                                    </tr> --}}
                            </tbody>
                        </table>
                        <div id="loading" class="w-full text-center"></div>
                    </div>
                    {{-- Pagination --}}
                    <div class="flex flex-col py-[20px] items-center">
                        <span class="text-sm text-gray-700 dark:text-gray-400">
                            {{ Request::get("page") ? Request::get("page") : 1  }} of <span>{{ intval($count / $limit) + 1 }} </span>
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                        <!-- Buttons -->
                            <a href="{{ url('/admin/doctor?page='.(Request::get('page') && Request::get('page') > 1 ? Request::get('page') - 1 : 1 ) )}}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                                </svg>
                                Prev
                            </a>
                            <a href="{{ url('/admin/doctor?page='.( Request::get('page') < (intval($count / $limit) + 1) ? 1 :  Request::get('page') ) )}}" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Next
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @elseif( Request::get("tab") == "new" )
                    <section class="min-[0px]:w-[90%] sm:w-[60%] lg:w-[50%] xl:w-[40%] mx-auto p-3 rounded mt-[30px] shadow" >
                        <h1 class="py-[10px] font-bold text-2xl" >Add Doctor</h1>
                        <span class="py-[10px] text-red-600" >{{ Request::get("message") }}</span>
                        <form action="{{url('/admin/add/doctor')}}" method="POST">
                            @csrf
                            <div class="py-[5px]" >
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor name</label>
                                <input type="text" name="doctor_name" id="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_name") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor address</label>
                                <input type="text" name="doctor_address" id="address" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_address") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor phone</label>
                                <input type="text" name="doctor_phone" id="phone" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_phone") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor email</label>
                                <input type="text" name="doctor_email" id="email" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_email") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor Date Of Birth</label>
                                <input type="date" name="doctor_dob" id="date" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_dob") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="place" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor Place Of Birth</label>
                                <input type="text" name="doctor_pob" id="place" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_pob") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor password</label>
                                <input type="password" name="doctor_password" id="password" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_password") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a role</label>
                                <select id="role" name="doctor_role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select a role</option>
                                    @foreach( $roles as $role )
                                        <option value="{{$role->doctor_role_id}}">{{ $role->doctor_role_name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-red-600" >@error("doctor_role_id") {{$message}} @enderror</label>

                            </div>
                            <div class="py-[5px]" >
                                
                                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a department</label>
                                <select id="departmen" name="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Select a department</option>
                                    @foreach( $departments as $department )
                                        <option value="{{ $department->department_id}}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                <label class="text-red-600" >@error("department_id") {{$message}} @enderror</label>

                            </div>
                            <div class="py-[5px]" >
                                <button class="bg-green-500 rounded px-[20px] py-[5px] text-white font-bold" >Add</button>
                            </div>
                        </form>
                    </section>
                @elseif( Request::get("tab") == "update" )
                    @section("js") <script src="{{asset('js/jquery.js')}}"></script> @endsection
                    @section("js_custom")
                        <script>

                            function GetDoctorById(){
                                var department_option = "<option value='' >Select a department</option>"
                                var role_option = " <option value='' >Select a role</option>"
                                $.ajax({
                                    type: "GET",
                                    url: "@php echo Request::root(); @endphp/admin/get/doctor/@php echo Request::get('id') @endphp",
                                    // data: "data",
                                    // dataType: "dataType",
                                    success: function (response) {
                                        if(response.data.length > 0){
                                            JSON.parse($("#department").attr("datas")).map((d, i)=>{
                                                if( response.data[0].department_id == d.department_id ){
                                                    department_option += `
                                                        <option selected value="${d.department_id}" >${d.department_name}</option>
                                                    `
                                                }else{
                                                    department_option += `
                                                        <option value="${d.department_id}" >${d.department_name}</option>
                                                    `
                                                }
                                            })

                                            JSON.parse($("#role").attr("datas")).map((d, i)=>{
                                                if( response.data[0].doctor_role_id == d.doctor_role_id ){
                                                    role_option += `
                                                        <option selected value="${d.doctor_role_id}" >${d.doctor_role_name}</option>
                                                    `
                                                }else{
                                                    role_option += `
                                                        <option value="${d.doctor_role_id}" >${d.doctor_role_name}</option>
                                                    `
                                                }
                                            })

                                            $("#department").html( department_option )
                                            $("#role").html( role_option )
                                            console.log( response.data[0] )
                                            $("#name").val( response.data[0].doctor_name )                                   
                                            $("#address").val( response.data[0].doctor_address )                                   
                                            $("#phone").val( response.data[0].doctor_phone )                                   
                                            $("#email").val( response.data[0].doctor_email )                                   
                                            // $("#name").val( response.data[0].doctor_name )                                   

                                        }else{
                                            window.location.href = "@php echo Request::root(); @endphp/admin/doctor"
                                        }
                                    },
                                    error: function(x ,c, e){
                                        window.location.href = "@php echo Request::root(); @endphp/admin/doctor"
                                    }
                                });
                            }

                            GetDoctorById()

                        </script>
                    @endsection
                    <section class="min-[0px]:w-[90%] sm:w-[60%] lg:w-[50%] xl:w-[40%] mx-auto p-3 rounded mt-[30px] shadow" >
                        <h1 class="py-[10px] font-bold text-2xl" >Update Doctor</h1>
                        <span class="py-[10px] text-red-600" >{{ Request::get("message") }}</span>
                        <form action=" {{ url('/admin/update/doctor/'.Request::get('id')) }}" method="POST">
                            @csrf
                            <div class="py-[5px]" >
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor name</label>
                                <input type="text" name="doctor_name" id="name" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_name") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor address</label>
                                <input type="text" name="doctor_address" id="address" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_address") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor phone</label>
                                <input type="text" name="doctor_phone" id="phone" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_phone") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Doctor email</label>
                                <input type="text" name="doctor_email" id="email" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <label class="text-red-600" >@error("doctor_email") {{$message}} @enderror</label>
                            </div>
                            <div class="py-[5px]" >
                                
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a role</label>
                                <select id="role" datas="{{$roles}}" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    {{-- <option value="">Select a role</option>
                                    @foreach( $roles as $role )
                                        <option value="{{$role->doctor_role_id}}">{{ $role->doctor_role_name }}</option>
                                    @endforeach --}}
                                </select>
                                <label class="text-red-600" >@error("role") {{$message}} @enderror</label>

                            </div>
                            <div class="py-[5px]" >
                                
                                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a department</label>
                                <select id="department" datas="{{$departments}}" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    {{-- <option value="">Select a department</option> --}}
                                    {{-- @foreach( $departments as $department )
                                        <option value="{{ $department->department_id}}">{{ $department->department_name }}</option>
                                    @endforeach --}}
                                </select>
                                <label class="text-red-600" >@error("department") {{$message}} @enderror</label>

                            </div>
                            <div class="py-[5px]" >
                                <button class="bg-green-500 rounded px-[20px] py-[5px] text-white font-bold" >Update</button>
                            </div>
                        </form>
                    </section>
                @else
                    @section("js") <script src="{{asset('js/jquery.js')}}"></script> @endsection
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
                                    </style>
                                `
                            var limit = 1
                            var page = 1
                            var patient_datas = ""
                            var patient_pagiantion = ""
                            function GetDoctorById(){
                                
                                $("#show_datas").html("")
                                $("#loading").html(loading_source)
                                $.ajax({
                                    type: "GET",
                                    url: "@php echo Request::root(); @endphp/admin/get/view/doctor/@php echo Request::get('id') @endphp",
                                    // data: "data",
                                    // dataType: "dataType",
                                    success: function (response) {
                                        if( response.data.length > 0 ){
                                            response.data.map((d)=>{
                                                $("#doctor_name").html( d.doctor_name )
                                                $("#doctor_id").html( d.doctor_id )
                                                $("#patient_total").html( d.patient_count )
                                                if( d.patient_count < 1 ){
                                                    $("#loading").html( "<h1 class='text-center py-[10px]' >No data</h1>" )
                                                }else{
                                                    GetPatientByDoctorId()
                                                }
                                            })
                                        }else{
                                            $("#loading").html( "<h1 class='text-center py-[10px]' >No data</h1>" )
                                            // window.location.href = "@php echo Request::root(); @endphp/admin/doctor"
                                        }
                                    },
                                    error: function(x ,c, e){
                                        // console.log(e )  
                                        alert("Please check doctor id again!")
                                        $("#loading").html( "<h1 class='text-center py-[10px]' >No data</h1>" )
                                        // window.location.href = "@php echo Request::root(); @endphp/admin/doctor"
                                    }
                                });
                            }

                            function GetPatientByDoctorId(){
                                $("#loading").html( loading_source )
                                $.ajax({
                                    type: "GET",
                                    url: '@php echo Request::root(); @endphp/patient/get/patient_by_doctor/@php echo Request::get("id"); @endphp?page='+page+"&limit="+limit,
                                    // url: "{{url('/patient/get/patient_by_doctor/'.Request::get('id') ) }}",
                                    // data: "data",
                                    // dataType: "dataType",
                                    success: function (response) {
                                        if( response.datas.length > 0 ){
                                            response.datas.map((d, i)=>{
                                                patient_pagiantion += `
                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            ${ i + 1 }
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            ${ d.patient_id }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.patient_name }
                                                        </td>
                                                        <td class="px-6 py-4 ${ d.patient_dob ? '' : 'bg-yellow-200'} ">
                                                            ${ d.patient_blood_group ? d.patient_blood_group : '' }
                                                        </td>
                                                        <td class="px-6 py-4 ${ d.patient_dob ? '' : 'bg-yellow-200'} ">
                                                            ${ d.patient_dob ? d.patient_dob : '' }
                                                        </td>
                                                        <td class="px-6 py-4 ${ d.patient_email ? '' : 'bg-yellow-200' } ">
                                                            ${ d.patient_email ? d.patient_email : ''  }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.patient_phone }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.patient_sex }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.receptionist_id }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            ${ d.receptionist_name }
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                        </td>
                                                    </tr>
                                                `
                                            })
                                            $("#loading").html( "" )
                                            $("#show_datas").html( patient_pagiantion )
                                        }else{
                                            $("#loading").html( "<h1 class='text-center py-[10px]' >No data</h1>" )
                                        }
                                    },
                                    error: function( x ,c, e ){
                                        $("#loading").html( "<h1 class='text-center py-[10px]' >No data</h1>" )
                                        // window.localtion.href = "{{url('/admin/doctor')}}"
                                    }
                                });
                            }

                            function morePagination(){
                                page++
                                GetPatientByDoctorId()
                            }

                            $("#more").on("click", ()=>{
                                morePagination()
                            })

                            GetDoctorById()

                        </script>
                    @endsection
                        <div class="flex flex-col gap-[10px] py-[20px]" >
                            <div class="flex" >
                                <span>Doctor id : </span>
                                <h1 class="font-bold" id="doctor_id" ></h1>
                            </div>
                            <div class="flex" >
                                <span>Doctor name : </span>
                                <h1 class="font-bold" id="doctor_name" ></h1>
                            </div>
                            <div class="flex" >
                                <span>Patient total : </span>
                                <h1 class="font-bold" id="patient_total" ></h1>
                            </div>
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Id
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            patient id
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            blood group
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Date Of Birth
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Phone
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Sex
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            receptionist id
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            receptionist name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="show_datas" >
                                    {{-- <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            id
                                        </th>
                                        <td class="px-6 py-4">
                                            patient id
                                        </td>
                                        <td class="px-6 py-4">
                                            name
                                        </td>
                                        <td class="px-6 py-4">
                                            blood
                                        </td>
                                        <td class="px-6 py-4">
                                            dob
                                        </td>
                                        <td class="px-6 py-4">
                                            email
                                        </td>
                                        <td class="px-6 py-4">
                                            phone
                                        </td>
                                        <td class="px-6 py-4">
                                            sex
                                        </td>
                                        <td class="px-6 py-4">
                                            re id
                                        </td>
                                        <td class="px-6 py-4">
                                            re name
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                            <div id="loading" ></div>
                        </div>
                        {{-- More Button --}}
                        <div class="text-center my-[10px]" >
                            <button id="more" onclick="morePagination" class="px-[15px] py-[5px] bg-blue-500 rounded text-white">More</button>
                        </div>
                
                @endif
            </section>
        </div>
    @endsection