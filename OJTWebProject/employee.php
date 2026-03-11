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
</head>
<body class="flex">
    <?php
        include 'navbar.php'
    ?>
    <section id="EmployeeList" class="flex-1 h-screen">
        <div class="bg-gray-200 w-full h-fit p-3 flex shadow-xl border-b-1 justify-between border-gray-300 ">
            <div class="text-black font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2 ml-2 text-green-400">
                            <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                EmployeeList
            </div>
            <div class="flex text-[10px] font-bold text-black items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3 text-green-500 mr-1">
                    <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                </svg>
                WH1 SANTA ROSA
            </div>
        </div>
        <div class="w-auto mx-auto max-w-7xl h-fit bg-gray-200 p-4 m-4 flex items-center rounded-3xl">
            <div class="w-auto flex items-center border-1 m-2 px-2 py-1 rounded-2xl hover:shadow-gray-400 hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>
                <input type="text" placeholder="Search for ID Num, Employee ID, First Name, Last Name...." class="w-120 p-1 outline-none">
            </div>
            <form method="GET" action="">
                <div class="relative flex items-center border-2 rounded-4xl m-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 w-5 h-5 text-black absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                        <path d="M18.75 12.75h1.5a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM12 6a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 6ZM12 18a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 12 18ZM3.75 6.75h1.5a.75.75 0 1 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5ZM5.25 18.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 0 1.5ZM3 12a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 3 12ZM9 3.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM12.75 12a2.25 2.25 0 1 1 4.5 0 2.25 2.25 0 0 1-4.5 0ZM9 15.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                    </svg>
                    <select name="Filter" id="" class="appearance-none border border-black rounded-full pl-5 pr-6 py-1 text-sm bg-transparent w-12 h-10 cursor-pointer hover:bg-gray-300">
                        <option value="" selected hidden></option>
                        <option value="">DEPARTMENT</option>
                        <option value="">POSITION</option>
                        <option value="">EMPLOYEEID</option>
                    </select>
                </div>
            </form>
            <form method="GET" action="">
                <div class="relative flex items-center border-2 rounded-4xl m-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 w-5 h-5 text-black absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                        <path fill-rule="evenodd" d="M2.25 4.5A.75.75 0 0 1 3 3.75h14.25a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Zm0 4.5A.75.75 0 0 1 3 8.25h9.75a.75.75 0 0 1 0 1.5H3A.75.75 0 0 1 2.25 9Zm15-.75A.75.75 0 0 1 18 9v10.19l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V9a.75.75 0 0 1 .75-.75Zm-15 5.25a.75.75 0 0 1 .75-.75h9.75a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                    <select name="Filter" id="" class="appearance-none border border-black rounded-full pl-5 pr-6 py-1 text-sm bg-transparent w-12 h-10 cursor-pointer hover:bg-gray-300">
                        <option value="" selected hidden></option>
                        <option value="">A-Z Name</option>
                        <option value="">Z-A Name</option>
                        <option value="">Date Hired: Newest </option>
                        <option value="">Date Hired: Oldest </option>
                        <option value="">EmployeeID Ascending</option>
                        <option value="">EmployeeID Descending</option>
                    </select>
                </div>
            </form>
            <div class="flex items-center bg-green-400  mr-2 p-2 px-6 rounded-3xl cursor-pointer text-white duration-200 transition-all hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                    <path fill-rule="evenodd" d="M4.125 3C3.089 3 2.25 3.84 2.25 4.875V18a3 3 0 0 0 3 3h15a3 3 0 0 1-3-3V4.875C17.25 3.839 16.41 3 15.375 3H4.125ZM12 9.75a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H12Zm-.75-2.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H12a.75.75 0 0 1-.75-.75ZM6 12.75a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5H6Zm-.75 3.75a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM6 6.75a.75.75 0 0 0-.75.75v3c0 .414.336.75.75.75h3a.75.75 0 0 0 .75-.75v-3A.75.75 0 0 0 9 6.75H6Z" clip-rule="evenodd" />
                    <path d="M18.75 6.75h1.875c.621 0 1.125.504 1.125 1.125V18a1.5 1.5 0 0 1-3 0V6.75Z" />
                </svg>
                Export
            </div>
            <div class="flex items-center bg-cyan-400  mr-2 p-2 px-6 rounded-3xl cursor-pointer text-white duration-200 transition-all hover:bg-cyan-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                    <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 0 0 3 3h.27l-.155 1.705A1.875 1.875 0 0 0 7.232 22.5h9.536a1.875 1.875 0 0 0 1.867-2.045l-.155-1.705h.27a3 3 0 0 0 3-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0 0 18 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM16.5 6.205v-2.83A.375.375 0 0 0 16.125 3h-8.25a.375.375 0 0 0-.375.375v2.83a49.353 49.353 0 0 1 9 0Zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 0 1-.374.409H7.232a.375.375 0 0 1-.374-.409l.526-5.784a.373.373 0 0 1 .333-.337 41.741 41.741 0 0 1 8.566 0Zm.967-3.97a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H18a.75.75 0 0 1-.75-.75V10.5ZM15 9.75a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V10.5a.75.75 0 0 0-.75-.75H15Z" clip-rule="evenodd" />
                </svg>
                Print
            </div>
            <div class="bg-blue-400  p-2 px-6 rounded-3xl cursor-pointer text-white duration-200 transition-all hover:bg-blue-700">
                <a href="addemployee.php" class="flex w-auto h-auto items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                        <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                    Add Employee
                </a>
            </div>
        </div>
       <div class="w-full max-w-7xl mx-auto">
            <div class="bg-gray-200 border border-gray-200 rounded-3xl shadow-sm p-3">
                <h2 class="text-lg font-bold text-center text-gray-800 mb-2">Employee List</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center border">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="p-3 border-b">Employee ID</th>
                                <th class="p-3 border-b">Full Name</th>
                                <th class="p-3 border-b">Birthdate</th>
                                <th class="p-3 border-b">Gender</th>
                                <th class="p-3 border-b">Contact Number</th>
                                <th class="p-3 border-b">Department</th>
                                <th class="p-3 border-b">Position</th>
                                <th class="p-3 border-b">Status</th>
                                <th class="p-3 border-b">Branch / Area</th>
                                <th class="p-3 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">EMP-001</td>
                                <td class="p-3 border-b">Juan Dela Cruz</td>
                                <td class="p-3 border-b">2001-05-14</td>
                                <td class="p-3 border-b">Male</td>
                                <td class="p-3 border-b">09123456789</td>
                                <td class="p-3 border-b">IT</td>
                                <td class="p-3 border-b">System Admin</td>
                                <td class="p-3 border-b">
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                        Active
                                    </span>
                                </td>
                                <td class="p-3 border-b">WH1 SANTA ROSA</td>
                                <td class="p-3 border-b">
                                    <div class="flex justify-center gap-2">
                                        <button class="px-3 py-1 rounded-lg bg-blue-500 text-white text-xs hover:bg-blue-600 transition">
                                            Edit
                                        </button>
                                        <button class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-xs hover:bg-yellow-600 transition">
                                            Archive
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">EMP-002</td>
                                <td class="p-3 border-b">Maria Santos</td>
                                <td class="p-3 border-b">1999-11-02</td>
                                <td class="p-3 border-b">Female</td>
                                <td class="p-3 border-b">09987654321</td>
                                <td class="p-3 border-b">HR</td>
                                <td class="p-3 border-b">HR Assistant</td>
                                <td class="p-3 border-b">
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-medium">
                                        Probationary
                                    </span>
                                </td>
                                <td class="p-3 border-b">WH3 SANTA ROSA</td>
                                <td class="p-3 border-b">
                                    <div class="flex justify-center gap-2">
                                        <button class="px-3 py-1 rounded-lg bg-blue-500 text-white text-xs hover:bg-blue-600 transition">
                                            Edit
                                        </button>
                                        <button class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-xs hover:bg-yellow-600 transition">
                                            Archive
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">EMP-003</td>
                                <td class="p-3 border-b">Carlo Reyes</td>
                                <td class="p-3 border-b">1998-03-22</td>
                                <td class="p-3 border-b">Male</td>
                                <td class="p-3 border-b">09112223344</td>
                                <td class="p-3 border-b">Warehouse</td>
                                <td class="p-3 border-b">Supervisor</td>
                                <td class="p-3 border-b">
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-medium">
                                        Active
                                    </span>
                                </td>
                                <td class="p-3 border-b">WH5 CABUYAO</td>
                                <td class="p-3 border-b">
                                    <div class="flex justify-center gap-2">
                                        <button class="px-3 py-1 rounded-lg bg-blue-500 text-white text-xs hover:bg-blue-600 transition">
                                            Edit
                                        </button>
                                        <button class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-xs hover:bg-yellow-600 transition">
                                            Archive
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>
</html>