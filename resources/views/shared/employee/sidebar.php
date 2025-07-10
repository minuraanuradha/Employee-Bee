<?php
// Detect current path for active state
$currentPath = $_GET['path'] ?? 'home';
?>

<aside id="sidebar" class="w-52  m-2 transition-all duration-300 lg:block text-white rounded-lg shadow-xl  hidden">
    <div class="p-4 flex flex-col justify-between h-full">
        <!-- Logo Section -->
        <div class="pb-4 flex items-center justify-center">
            <img src="assets/images/Logo.png" alt="EMP Logo" class="h-8 w-24 rounded-full full-logo">
            <img src="assets/images/SmallLogo.png" alt="Small EMP Logo" class="h-8 w-8 rounded-full small-logo hidden">
        </div>

        <!-- Sidebar Navigation -->
        <nav class="h-full overflow-hidden pt-0">
            <ul class="space-y-2 content-start min-h-full overflow-hidden text-xs">

                <!-- Dashboard -->
                <li>
                    <a href="?path=profile"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'profile' ? 'active bg-gray-700' : '' ?>">
                        <img src="" alt="Dashboard Icon" class="h-4 w-4">
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                <!-- My Profile -->
                <li>
                    <a href="?path=profile-overview"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'profile-overview' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/UserCircle.svg" alt="Profile Icon" class="h-4 w-4">
                        <span class="sidebar-text">My Profile</span>
                    </a>
                </li>

                <!-- Projects -->
                <li>
                    <a href="?path=history"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'projects' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/Briefcase.svg" alt="Work History Icon" class="h-4 w-4">
                        <span class="sidebar-text">Work History</span>
                    </a>
                </li>

                <!-- Career Insights -->
                <li>
                    <a href="?path=insights"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'insights' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/Graph.svg" alt="Insights Icon" class="h-4 w-4">
                        <span class="sidebar-text">Career Insights</span>
                    </a>
                </li>

                <!-- Edit Profile -->
                <li>
                    <a href="?path=edit-profile"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'insights' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/Graph.svg" alt="edit profile Icon" class="h-4 w-4">
                        <span class="sidebar-text">Edit Profile</span>
                    </a>
                </li>

                <!-- Settings (submenu - still commented for later use) -->
                <!--
                <li>
                    <button
                        class="flex items-center justify-between p-2 px-4 w-full rounded-lg hover:bg-sky-100 active:bg-sky-200 sidebar-toggle space-x-2">
                        <div class="flex items-center space-x-2">
                            <img src="assets/icons/GearSix.svg" alt="Settings Icon" class="h-4 w-4">
                            <span class="sidebar-text">Settings</span>
                        </div>
                        <svg class="w-4 h-4 transform transition-transform duration-200 arrow sidebar-arrow"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <ul class="space-y-2 submenu hidden pl-4 mt-2 bg-white w-44">
                        <li>
                            <a href="#"
                               class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="assets/icons/UserSwitch.svg" alt="User Account Icon" class="h-4 w-4">
                                <span class="sidebar-text-mini">User Account</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="assets/icons/GearSix.svg" alt="Settings Icon" class="h-4 w-4">
                                <span class="sidebar-text-mini">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center p-1 px-4 rounded-md space-x-2 hover:bg-sky-100 active:bg-sky-200">
                                <img src="assets/icons/UserList.svg" alt="User Logs Icon" class="h-4 w-4">
                                <span class="sidebar-text-mini">User Logs</span>
                            </a>
                        </li>
                    </ul>
                </li>
                -->

            </ul>
        </nav>

        <!-- User Avatar -->
        <div class=" flex items-center sidebar-toggle h-4  w-full ">
            <form method="POST" action="?path=logout" class="w-full">
                <button type="submit" class="flex items-center justify-center w-full space-x-1 border border-orange rounded-md text-small logout hover:bg-orange p py-1">
                    <span class="text-xs sidebar-text ">Logout</span>    
                                                         
                </button>
            </form>
            <form method="POST" action="?path=logout" class="w-full h-full hidden mini pr-2">
                <button type="submit" class="flex items-center justify-center w-full border border-orange rounded-md text-small  hover:bg-orange p-1">
                    
            <img src="assets/icons/Graph.svg" alt="Insights Icon" class="h-4 w-4 buttonlog"> 
                                                         
                </button>
            </form>
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
        padding-left: 0;
    }

    /* Submenu positioning for compact mode */
    #sidebar .submenu {
        left: 100%;
        top: 0;
        z-index: 10;
    }

    #sidebar.w-20 .submenu {
        position: absolute;
        left: 4rem;
        top: 0;
        z-index: 100;
        width: 11rem;
    }

    #sidebar.w-20 .logout {
        border: none;
        display: none;
        
        padding-left: 0;
    }
    #sidebar.w-20 .mini {
        display: flex;
    }



    /* Active state */
    .active {
        background-color: #FF3F00 !important;
        /* Tailwind gray-800 */
        font-weight: 600;
        border-left: #FF3F00 5px solid;
    }
</style>