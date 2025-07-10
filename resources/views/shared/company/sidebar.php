<aside id="sidebar" class="w-52 bg-gray-64 border-r transition-all duration-300 lg:block ">
    <div class="p-4 flex flex-col justify-between h-full">
        <!-- Sidebar Menu -->
        <div class="pb-4 flex items-center justify-center">
            <img src="{{ asset('assets/images/Logo.png') }}" alt="Company Logo" class="h-8 w-24 rounded-full full-logo">
            <img src="{{ asset('assets/images/SmallLogo.png') }}" alt="Small Company Logo"
                class="h-8 w-8 rounded-full small-logo hidden">
        </div>
        <!-- Sidebar Navigation -->
        <nav class="h-full overflow-hidden pt-0">
            <ul class="space-y-2 content-start min-h-full  overflow-hidden text-xs">
                <!-- Dashboard -->
                <li>
                    <a href="#"
                        class="flex items-center p-2 px-4 w-full rounded-lg hover:bg-sky-100 sidebar-toggle space-x-2 active:bg-sky-100">
                        <img src="{{ asset('assets/icons/DiamondsFour.svg') }}" alt="Dashboard Icon" class="h-4 w-4 ">
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <!-- Branches (with Submenu) -->
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/Elevator.svg') }}" alt="Branches Icon" class="h-4 w-4">
                            <span class="sidebar-text">Branches</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Submenu for Branches -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href="centers"
                                class="flex items-center justify-start p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/MapPinLine.svg') }}" alt="Centers Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Centers</span>
                            </a>
                        </li>
                        <li>
                            <a href="members"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/Users.svg') }}" alt="Members Icon" class="h-4 w-4">
                                <span class="sidebar-text-mini">Members</span>
                            </a>
                        </li>
                        <li>
                            <a href="recentlyAdded"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/Timer.svg') }}" alt="Recently Added Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Recently Added</span>
                            </a>
                        </li>
                        <li>
                            <a href="memberSummery"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/IdentificationBadge.svg') }}" alt="Centers Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Member Summery</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Income (with Submenu) -->
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/CurrencyDollar.svg') }}" alt="Income Icon" class="h-4 w-4">
                            <span class="sidebar-text">Income</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Submenu for Income -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href="income"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Report Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Income Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="collections"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/CurrencyCircleDollar.svg') }}" alt="Collections Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Collections</span>
                            </a>
                        </li>
                        <li>
                            <a href="underPayments"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/pay01.svg') }}" alt="Under Payments Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Under Payments</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Payments (with Submenu) -->
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon" class="h-4 w-4">
                            <span class="sidebar-text">Payments</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Submenu for Payments -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href=""
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/Money.svg') }}" alt="Payments Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Payments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Pending</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/MinusCircle.svg') }}" alt="No Paid Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">No Paid</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports (with Submenu) -->
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/IdentificationCard.svg') }}" alt="Reports Icon"
                                class="h-4 w-4">
                            <span class="sidebar-text">Reports</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Submenu for Reports -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/ChartBarHorizontal.svg') }}" alt="Lone Issue Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Lone Issue</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/ChartLineUp.svg') }}" alt="Income Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Income</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/HourglassHigh.svg') }}" alt="Pending Payments Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Pending Payments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/Lockers.svg') }}" alt="Center Managers Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Center Managers</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/UserGear.svg') }}" alt="Member Managers Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Member Managers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings (with Submenu) -->
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon" class="h-4 w-4">
                            <span class="sidebar-text">Settings</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <!-- Submenu for Settings -->
                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/UserSwitch.svg') }}" alt="User Account Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">User Account</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/GearSix.svg') }}" alt="Settings Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="{{ asset('assets/icons/UserList.svg') }}" alt="User Logs Icon"
                                    class="h-4 w-4">
                                <span class="sidebar-text-mini">User Logs</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
        <!-- User Avatar -->
        <div class="h-12 px-2 content-end sidebar-toggle">
            <div class="flex items-center space-x-2 border border-blue-300 rounded-full text-small username ">
                <img src="{{ asset('icons/Users.png') }}" alt="User Avatar"
                    class=" h-6 w-6 rounded-full bg-blue-800 border border-blue-300">
                <span class="text-xs sidebar-text">Dunura Hansaja</span>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Logo toggle */
    #sidebar.w-20 .full-logo {
        display: none;
    }

    #sidebar.w-20 .small-logo {
        display: block;
    }

    #sidebar .full-logo {
        display: block;
    }

    #sidebar .small-logo {
        display: none;
    }

    /* Hide text and arrows in small sidebar */
    #sidebar.w-20 .sidebar-text,
    #sidebar.w-20 .sidebar-arrow {
        display: none;
    }

    /* Center icons in small sidebar */
    #sidebar.w-20 .flex.items-center {
        justify-content: center;
    }

    /* Ensure submenu is visible and styled for both sidebar sizes */
    #sidebar .submenu {
        left: 100%;
        top: 0;
        z-index: 10;
    }

    #sidebar.w-20 .submenu {
        position: absolute;
        left: 100%;
        top: 0;
        z-index: 100;
        width: 11rem;
        /* w-44 */
    }

    #sidebar.w-20 .submenu {
        left: 4rem;
        /* Adjust based on small sidebar width */
    }

    #sidebar.w-20 .username {
        border: none;
        /* Adjust based on small sidebar width */
    }

    /* Active state styling */
    .active {
        background-color: #e5e7eb !important;
        /* gray-200 */
        font-weight: 600;
    }
</style>
