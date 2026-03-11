<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
    
</head>
<body class="overflow-x-hidden">
    <nav class="bg-gray-200 w-screen h-auto p-4 shadow-md shadow-gray-500">
        <div class="flex justify-evenly items-center">
            <div class="bg-blue-400  p-1 px-4 rounded-3xl cursor-pointer text-white duration-200 transition-all hover:bg-blue-700 w-fit">
                <a href="employee.php" class="flex w-auto h-auto items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-1">
                        <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                    </svg>
                    Back
                </a>
            </div>
            <div class="flex items-center font-bold text-white bg-green-500 p-2 px-4 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2 text-red-400">
                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                </svg>
                ADD EMPLOYEE
            </div>
            <div class="flex items-center gap-2">
                <div>
                <div class="flex w-fit bg-gray-800 p-2 px-3 rounded-2xl items-center">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-green-400">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-2">
                        <h1 class="text-white text-[12px]">User</h1>
                    </div>
                </div>
            </div>
            <div class="flex text-[10px] font-bold text-black items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3 text-green-500 mr-1">
                    <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                </svg>
                WH1 SANTA ROSA
            </div>
            </div>
        </div>
    </nav>
    <section class="p-3 flex justify-center">
        <div class="border-2 p-3 w-auto h-auto ">
            <div class="w-full max-w-7xl mx-auto px-6 py-6">
                <form class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                    <!-- PERSONAL DETAILS -->
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-center text-black mb-5">Personal Details</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <input type="text" placeholder="First Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <input type="text" placeholder="Middle Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative md:col-span-2">
                                <input type="text" placeholder="Last Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <input type="date" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                            </div>

                            <div>
                                <select class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <option value="">Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div>
                                <select class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <option value="">Civil Status</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                </select>
                            </div>

                            <div class="relative">
                                <input type="text" placeholder="Birthplace" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v4l2 2"/>
                                </svg>
                            </div>

                            <div class="relative md:col-span-2">
                                <input type="tel" placeholder="Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a1.5 1.5 0 0 0 1.5-1.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.5 1.5 0 0 0-1.465.417l-.97.97a12.035 12.035 0 0 1-5.292-5.292l.97-.97a1.5 1.5 0 0 0 .417-1.465L8.28 4.602a1.125 1.125 0 0 0-1.09-.852H5.25a1.5 1.5 0 0 0-1.5 1.5v1.5Z"/>
                                </svg>
                            </div>

                            <textarea placeholder="Permanent Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none hover:border-blue-500"></textarea>

                            <textarea placeholder="Present Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none hover:border-blue-500"></textarea>
                        </div>
                    </div>

                    <!-- OTHER DETAILS -->
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                        <h2 class="text-lg font-bold text-center text-black mb-5">Family / Emergency / Education</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative md:col-span-2">
                                <input type="text" placeholder="Father's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative md:col-span-2">
                                <input type="text" placeholder="Mother's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <input type="text" placeholder="Emergency Contact Person" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <input type="tel" placeholder="Emergency Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a1.5 1.5 0 0 0 1.5-1.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.5 1.5 0 0 0-1.465.417l-.97.97a12.035 12.035 0 0 1-5.292-5.292l.97-.97a1.5 1.5 0 0 0 .417-1.465L8.28 4.602a1.125 1.125 0 0 0-1.09-.852H5.25a1.5 1.5 0 0 0-1.5 1.5v1.5Z"/>
                                </svg>
                            </div>

                            <div>
                                <select class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <option value="">Educational Attainment</option>
                                    <option>High School</option>
                                    <option>College Level</option>
                                    <option>College Graduate</option>
                                    <option>Vocational</option>
                                </select>
                            </div>

                            <div class="relative">
                                <input type="text" placeholder="Course" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 pl-11 pr-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14 3 9l9-5 9 5-9 5Zm0 0v6"/>
                                </svg>
                            </div>

                            <div class="md:col-span-2 border-t border-gray-200 pt-5 mt-2">
                                <h3 class="text-base font-semibold text-gray-800 mb-4">Company Details</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" placeholder="Employee ID" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <input type="text" placeholder="Department" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <input type="text" placeholder="Position" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <input type="date" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                    <select class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                        <option value="">Employment Status</option>
                                        <option>Active</option>
                                        <option>Probationary</option>
                                        <option>Resigned</option>
                                        <option>Terminated</option>
                                    </select>
                                    <input type="text" placeholder="Assigned Branch / Area" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:border-blue-500">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="xl:col-span-2 flex justify-end gap-3">
                        <div>
                            <a href="employee.php" class="px-5 py-3 w-fit h-fit cursor-pointer rounded-2xl bg-red-500 text-black hover:bg-red-800 transition">
                                Cancel
                            </a>
                        </div>
                        <div>
                            <a class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-medium hover:bg-blue-800 transition">
                                Save Employee
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>