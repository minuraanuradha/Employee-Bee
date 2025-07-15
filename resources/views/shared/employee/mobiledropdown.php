<div id="mobileSidebar" class="absolute max-h-full top-16  w-full inset-0 shadow lg:hidden hidden  bg-black flex-col justify-center items-center">
    <div class="p-4 text-white">
        <div class="flex justify-between items-center mb-4 ">
            <div class="text-xl font-bold ">Company Name</div>
            <button id="closeMobileMenu" class="text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav class=" w-full  ">
            <ul class="space-y-1 min-h-full  overflow-y-scroll  scrollbar-hide scroll-smooth">

                <!-- Dashboard -->
                <li>
                    <a href="#" class="flex items-center p-1 px-4 w-full rounded-lg hover:bg-gray-50 sidebar-toggle space-x-2">
                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4 ">
                        <span class="sidebar-text text-xs">Dashboard</span>
                    </a>
                </li>




                <!-- Settings (with Submenu) 
                <li>
                    <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                            <span class="sidebar-text">Settings</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                     Submenu for Settings 
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-60">
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/UserSwitch.svg') }}" alt="User Account Icon" class="h-4 w-4">
                                <span class="sidebar-text">User Account</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                                <span class="sidebar-text">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/UserList.svg') }}" alt="User Logs Icon" class="h-4 w-4">
                                <span class="sidebar-text">User Logs</span>
                            </a>
                        </li>-->

            </ul>
            </li>

            </ul>
        </nav>
    </div>
</div>