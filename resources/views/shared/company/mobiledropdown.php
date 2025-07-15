<div id="mobileSidebar" class="absolute max-h-fit top-16 bottom-5 mac-h-1/2 w-5/6 inset-0 shadow lg:hidden hidden ml-4 mt-2 rounded-xl bg-gray-200">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4 ">
            <div class="text-xl font-bold ">Company Name</div>
            <button id="closeMobileMenu" class="text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <nav class="  ">
            <ul class="space-y-1 min-h-full  overflow-y-scroll  scrollbar-hide scroll-smooth">

                <!-- Dashboard -->
                <li>
                    <a href="#" class="flex items-center p-1 px-4 w-full rounded-lg hover:bg-gray-50 sidebar-toggle space-x-2">
                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4 ">
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <!-- Branches (with Submenu) -->
                <li>
                    <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/Elevator.svg') }}" alt="Branches Icon" class="h-4 w-4">
                            <span class="sidebar-text">Branches</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Submenu for Branches -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-60">
                        <li>
                            <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/MapPinLine.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                <span class="sidebar-text">Centers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/Users.svg') }}" alt="Members Icon" class="h-4 w-4">
                                <span class="sidebar-text">Members</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/Timer.svg') }}" alt="Recently Added Icon" class="h-4 w-4">
                                <span class="sidebar-text">Recently Added</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/IdentificationBadge.svg') }}" alt="Centers Icon" class="h-4 w-4">
                                <span class="sidebar-text">Member Summery</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Income (with Submenu) -->
                <li>
                    <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/CurrencyDollar.svg') }}" alt="Income Icon" class="h-4 w-4">
                            <span class="sidebar-text">Income</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Submenu for Income -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-w-60">
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Report Icon" class="h-4 w-4">
                                <span class="sidebar-text">Income Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/CurrencyCircleDollar.svg') }}" alt="Collections Icon" class="h-4 w-4">
                                <span class="sidebar-text">Collections</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/pay01.svg') }}" alt="Under Payments Icon" class="h-4 w-4">
                                <span class="sidebar-text">Under Payments Added</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Payments (with Submenu) -->
                <li>
                    <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                            <span class="sidebar-text">Payments</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Submenu for Payments -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-w-60">
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                                <span class="sidebar-text">Payments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Icon" class="h-4 w-4">
                                <span class="sidebar-text">Pending</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/MinusCircle.svg') }}" alt="No Paid Icon" class="h-4 w-4">
                                <span class="sidebar-text">No Paid</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports (with Submenu) -->
                <li>
                    <button class="flex items-center justify-between p-1 px-4 w-full rounded-lg hover:bg-gray-100 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/IdentificationCard.svg') }}" alt="Reports Icon" class="h-4 w-4">
                            <span class="sidebar-text">Reports</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Submenu for Reports -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-gray-200 w-w-60">
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/ChartBarHorizontal.svg') }}" alt="Lone Issue Icon" class="h-4 w-4">
                                <span class="sidebar-text">Lone Issue</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Icon" class="h-4 w-4">
                                <span class="sidebar-text">Income</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Payments Icon" class="h-4 w-4">
                                <span class="sidebar-text">Pending Payments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/Lockers.svg') }}" alt="Center Managers Icon" class="h-4 w-4">
                                <span class="sidebar-text">Center Managers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-gray-100">
                                <img src="{{ asset('assets/icons/UserGear.svg') }}" alt="Member Managers Icon" class="h-4 w-4">
                                <span class="sidebar-text">Member Managers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings (with Submenu) -->
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
                    <!-- Submenu for Settings -->
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
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>