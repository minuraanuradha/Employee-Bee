<?php
// Detect current path for active state
$currentPath = $_GET['path'] ?? 'dashboard';
?>
<aside id="sidebar" class="w-52 m-2 transition-all duration-300 lg:block text-white rounded-lg shadow-xl hidden">
    <div class="p-4 flex flex-col justify-between h-full">
        <!-- Logo Section -->
        <div class="pb-4 flex items-center justify-center">
            <img src="assets/images/Logo.png" alt="Company Logo" class="h-8 w-24 rounded-full full-logo">
            <img src="assets/images/SmallLogo.png" alt="Small Company Logo" class="h-8 w-8 rounded-full small-logo hidden">
        </div>
        <!-- Sidebar Navigation -->
        <nav class="h-full overflow-hidden pt-0">
            <ul class="space-y-2 content-start min-h-full overflow-hidden text-xs">
                <!-- Dashboard -->
                <li>
                    <a href="?path=company/dashboard"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?php if($currentPath=='company/dashboard') echo 'active bg-gray-700'; ?>">
                        <img src="assets/icons/Dashboard.svg" alt="Dashboard Icon" class="h-3 w-3 mr-1 img">
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <!-- Profile -->
                <li>
                    <a href="?path=company/profile"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?php if($currentPath=='company/profile') echo 'active bg-gray-700'; ?>">
                        <img src="assets/icons/User.svg" alt="Profile Icon" class="h-3.5 w-3.5 mr-1 img">
                        <span class="sidebar-text">Profile</span>
                    </a>
                </li>
                <!-- Employees -->
                <li>
                    <a href="?path=company/employees"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?php if($currentPath=='company/employees') echo 'active bg-gray-700'; ?>">
                        <img src="assets/icons/User.svg" alt="Employees Icon" class="h-3.5 w-3.5 mr-1 img">
                        <span class="sidebar-text">Employees</span>
                    </a>
                </li>
                <!-- Settings -->
                <li>
                    <a href="?path=company/settings"
                        class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?php if($currentPath=='company/settings') echo 'active bg-gray-700'; ?>">
                        <img src="assets/icons/GearSix.svg" alt="Settings Icon" class="h-4 w-4 mr-1 img">
                        <span class="sidebar-text">Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Logout -->
        <div class="flex items-center sidebar-toggle h-4 w-full mt-4">
            <form method="POST" action="?path=logout" class="w-full">
                <button type="submit" class="flex items-center justify-center w-full space-x-1 border border-orange rounded-md text-small logout hover:bg-orange p py-1">
                    <img src="assets/icons/Signin.svg" alt="Logout Icon" class="h-4 w-4 mr-1">
                    <span class="text-xs sidebar-text">Logout</span>
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
        display: flex;
        justify-content: center;
        align-items: center;
    }
    /* Active state */
    .active {
        background-color: #FF3F00 !important;
        font-weight: 600;
    }
</style>
