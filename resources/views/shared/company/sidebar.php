<?php
$currentPath = $_GET['path'] ?? 'company/dashboard';

// Menu state flags
$employeeSubPaths = ['company/search-employees', 'company/update-employees'];
$isEmployeeOpen = in_array($currentPath, $employeeSubPaths);

$recordSubPaths = ['company/add-update-records', 'company/achievements', 'company/skills', 'company/active-employees', 'company/inactive-employees'];
$isRecordOpen = in_array($currentPath, $recordSubPaths);

$settingsSubPaths = ['company/account-settings', 'company/export-data'];
$isSettingsOpen = in_array($currentPath, $settingsSubPaths);
?>

<aside id="sidebar" class="w-52  m-2 transition-all duration-300 lg:block text-white rounded-lg shadow-xl  hidden">
    <div class="p-4 pt-2 flex flex-col justify-between h-full">
        <!-- Logo Section -->
        <div class="pb-4 flex items-center justify-center">
            <img src="assets/images/Logo/Group 19.png" alt="EMPLogo" class="w-24 full-logo">
            <img src="assets/images/Logo/Asset 1.png" alt="Small EMP Logo" class="h-7 w-7 small-logo hidden">
        </div>

        <!-- Sidebar Navigation -->
        <nav class="h-full overflow-hidden pt-4">
            <ul class="space-y-2 content-start min-h-full overflow-hidden text-xs">

                <!-- Dashboard -->
                <li>
                    <a href="?path=company/dashboard" class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'company/dashboard' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/Dashboard.svg" alt="Dashboard Icon" class="h-3 w-3 mr-1 img">
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>

                <!-- Company Profile -->
                <li>
                    <a href="?path=company/profile" class="flex items-center p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 <?= $currentPath == 'company/profile' ? 'active bg-gray-700' : '' ?>">
                        <img src="assets/icons/House.svg" class="h-4 w-4 mr-1 img">
                        <span class="sidebar-text">Company Profile</span>
                    </a>
                </li>

                <!-- Employee Management -->
                <li>
                    <button class="flex items-center justify-between p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 toggle-btn">
                        <div class="flex items-center space-x-2">
                            <img src="assets/icons/User.svg" alt="Employee Management Icon" class="h-3.5 w-3.5 mr-1 img">
                            <span class="sidebar-text">Employees</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200 arrow <?= $isEmployeeOpen ? 'rotate-180' : '' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="pl-6 mt-1 space-y-1 submenu <?= $isEmployeeOpen ? 'block' : 'hidden' ?>">
                        <li><a href="?path=company/search-employees" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/search-employees' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Search.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Search</span></a></li>
                        <li><a href="?path=company/update-employees" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/update-employees' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Search.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Update</span></a></li>
                    </ul>
                </li>

                <!-- Employee Records -->
                <li>
                    <button class="flex items-center justify-between p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 toggle-btn">
                        <div class="flex items-center space-x-2">
                            <img src="assets/icons/Books.svg" alt="Records Icon" class="h-4 w-4 mr-1 img">
                            <span class="sidebar-text">Records</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200 arrow <?= $isRecordOpen ? 'rotate-180' : '' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="pl-6 mt-1 space-y-1 submenu <?= $isRecordOpen ? 'block' : 'hidden' ?>">
                        <li><a href="?path=company/active-employees" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/active-employees' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Check.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Active</span></a></li>
                        <li><a href="?path=company/inactive-employees" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/inactive-employees' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Folder.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Inactive</span></a></li>
                    </ul>
                </li>

                <!-- Settings -->
                <li>
                    <button class="flex items-center justify-between p-2 px-4 w-full rounded-md hover:bg-gray-700 sidebar-toggle space-x-2 toggle-btn">
                        <div class="flex items-center space-x-2">
                            <img src="assets/icons/GearSix.svg" alt="Settings Icon" class="h-4 w-4 mr-1 img">
                            <span class="sidebar-text">Settings</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform duration-200 arrow <?= $isSettingsOpen ? 'rotate-180' : '' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <ul class="pl-6 mt-1 space-y-1 submenu <?= $isSettingsOpen ? 'block' : 'hidden' ?>">
                        <li><a href="?path=company/account-settings" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/account-settings' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Lock.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Account</span></a></li>
                        <li><a href="?path=company/export-data" class="flex items-center p-2 w-full rounded hover:bg-gray-700 <?= $currentPath == 'company/export-data' ? 'active bg-gray-700' : '' ?>"><img src="assets/icons/Export.svg" class="h-3 w-3 mr-1"> <span class="sidebar-text">Export</span></a></li>
                    </ul>
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

<!-- Sidebar Styles -->
<style>
    #sidebar.w-20 .full-logo { display: none; }
    #sidebar.w-20 .small-logo { display: block; }
    #sidebar .full-logo { display: block; }
    #sidebar .small-logo { display: none; }
    #sidebar.w-20 .sidebar-text, #sidebar.w-20 .sidebar-arrow { display: none; }
    #sidebar.w-20 .flex.items-center { justify-content: center; }
        #sidebar.w-20 .img{
        margin: 0 !important;
        display: block !important;
        width: 15px !important;
        max-width: 1.5rem !important;
        max-height: 1.5rem !important;
    }
    .sidebar-toggle:hover{
        background: #FF3F00;
        background: linear-gradient(90deg,rgba(255, 63, 0, 0.84) 0%, rgba(201, 51, 2, 1) 18%, rgba(22, 22, 22, 1) 100%);
    }
    /* Active state */
    .active {
        background-color: #c93302 !important;
        background: #FF3F00;
        background: linear-gradient(90deg,rgba(255, 63, 0, 0.84) 0%, rgba(201, 51, 2, 1) 18%, rgba(22, 22, 22, 1) 100%);
        /* Tailwind gray-800 */
        font-weight: 600;
    }
    .arrow.rotate-180 {
        transform: rotate(180deg);
    }
</style>
