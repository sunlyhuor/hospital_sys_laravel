@section( "css" )
    <style>
        .actived{
            /* left: 0px !important; */
            right: 0px !important;
            z-index: 10;
            top: 60px;
        }
        .actived > ul{
            background-color: blue;
            flex-direction: column;
        }
    </style>
@endsection
<header class="bg-black h-auto py-2" >
    
    <div class="flex justify-between items-center min-[0px]:w-11/12 lg:w-10/12 mx-auto" >

        <div>
            <a  href="{{url('/admin/dashboard')}}" >
                <img class="w-6/12" src="{{asset('assets/logo.png')}}" />
            </a>
        </div>
        {{-- <nav id="menu" class="" > --}}
        <nav id="menu" class="min-[0px]:absolute min-[0px]:right-[1550px] lg:static" >
            <ul class="flex gap-[10px]" >
                <li class="p-[10px]  text-white {{Request::path() == 'admin/dashboard' ? 'border-2 border-white' : '' }}" >
                    <a class="p-[10px]  md:text-[15px] flex items-center justify-center gap-[5px] xl:text-[15px]" href="{{ url('/admin/dashboard') }}"> <i class="fa-solid fa-gauge"></i> Dashboard</a>
                </li>
                <li class="p-[10px] text-white {{Request::path() == 'admin/department' ? 'border-2 border-white' : '' }}" >
                    <a class="p-[10px]  md:text-[15px] flex items-center justify-center gap-[5px] xl:text-[15px]" href="{{ url('/admin/department') }}"> <i class="fa-solid fa-list-check"></i> Department</a>
                </li>
                <li class="p-[10px]  text-white {{Request::path() == 'admin/doctor' ? 'border-2 border-white' : '' }}" >
                    <a class="p-[10px]  md:text-[15px] flex items-center justify-center gap-[5px] xl:text-[15px]" href="{{ url('/admin/doctor') }}"> <i class="fa-solid fa-user-doctor"></i> Doctor</a>
                </li>
                <li class="p-[10px]  text-white {{Request::path() == 'admin/receptionist' ? 'border-2 border-white' : '' }}" >
                    <a class="p-[10px] md:text-[15px] flex items-center justify-center gap-[5px] xl:text-[15px]" href="{{ url('/admin/receptionist') }}"> <i class="fa-solid fa-receipt"></i> Receptionist</a>
                </li>
                {{-- <li class="p-[10px]  text-white" >
                    <a class="p-[10px]" href="{{ url('/admin/dashboard') }}"> <i class="fa-solid fa-hospital-user"></i> Patient</a>
                </li> --}}
                <li class="p-[10px]  text-white" >
                    <a class="p-[10px]  md:text-[15px] flex items-center justify-center gap-[5px] xl:text-[15px]" href="{{ url('/logout') }}"> <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                </li>
            </ul>
        </nav>
        <button id="hamberger" class="lg:hidden">
            <i class="fa-solid fa-bars text-white text-xl"></i>
        </button>
    
    </div>
  
</header>
<script>
    const menu = document.getElementById("menu")
    const hamberger = document.getElementById("hamberger")
    hamberger.addEventListener("click", ()=>{
        menu.classList.toggle("actived")
    })
</script>