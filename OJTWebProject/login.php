<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <!-- tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style type="text/tailwindcss">
        @theme{
            --font-roboto: "Roboto", Sans-serif;
        }
        @layer base{
            body {
                @apply font-roboto;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-400 text-black flex justify-center">
        <div class="flex items-center">
            <div class="flex bg-white p-8 h-100 w-100 items-center flex-col rounded-2xl shadow-xl ">
                <h1 class="text-2xl font-roboto font-bold m-8">LOGIN</h1>
                <div class="relative">
                    <input type="text" placeholder="Username" class="w-full h-fit rounded-2xl border border-gray-300 bg-gray-300 py-3 pl-12 pr-3 text-gray-900 placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 h-5 w-5 transform -translate-y-1/2 text-black pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <div class="relative m-2">
                    <input type="password" placeholder="Password" class="w-full h-fit items-center rounded-2xl border border-gray-300 bg-gray-300 py-3 pl-12 pr-3 text-gray-900 placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 h-5 w-5 transform -translate-y-1/2 text-black pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <a class="border-4 w-40 py-2 px-4 mt-2 rounded-4xl text-green-700 font-medium duration-100 transition-all hover:bg-green-400 hover:border-green-400 hover:text-green-950 text-center" href="home.php">Login</a>
                <p class="font-light text-[12px] m-3">or</p>
                <p class="font-medium">Create an <span class="text-red-500 cursor-pointer">account</span></p>
            </div>
        </div>
    </div>  
</body>
</html>