@php
    $check_password = false   
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/tailwindcss.js') }}"></script>
    <script src="{{ asset('js/flowbit.js') }}"></script>
</head>
<body>
   <main>
        <section class="min-[0px]:w-[90%] sm:w-[60%] lg:w-[50%] xl:w-[40%] mx-auto p-3 rounded mt-[30px] shadow" >
            <form  method="POST" action="{{route('loginhandle')}}" >
                @csrf
                <label for="email" class="block mb-2 text-sm font-medium text-red-900"> {{ request()->get("message") }} </label>
                <div class="flex min-[0px]:flex-col sm:flex-row sm:flex-between mb-[10px]">
                    <h1>Hospital System Login as : </h1>
                    <select name="type" id="">
                        <option value="admin">Admin</option>
                        <option value="doctor">Doctor</option>
                        <option selected value="receptionist">Receptionist</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <label for="email" class="block mb-2 text-sm font-medium text-red-900">@error('email') {{$message}} @enderror</label>
                    <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@examole.com" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <label for="email" class="block mb-2 text-sm font-medium text-red-900">@error('password') {{$message}} @enderror</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <div class="flex items-center" >
                        <input type="checkbox" onclick="checkPassword()" name="" id="check_pas"><label for="check_pas">Show password</label>
                    </div>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </form>
  
        </section>
   </main>
   <script>
        function checkPassword(){
            const password = document.getElementById("password")
            if(password.getAttribute("type") == "password" ){
                password.setAttribute("type", "text")
            }else{
                password.setAttribute("type", "password")
            }
        }
   </script>
</body>
</html>