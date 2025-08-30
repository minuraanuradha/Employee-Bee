<?php
$employeeName = $_SESSION['full_name'] ?? 'Employee';
$profilePic = $_SESSION['profile_picture'] ?? 'assets/images/default-user.png';
// Fix path for web root
if (strpos($profilePic, 'storage/') === 0) {
    // If running in a subfolder, set your base URL here:
    $baseURL = '/Employee-Bee/';
    $profilePic = $baseURL . $profilePic;
}
?>

    <div class="bg-stone-950 p-2 h-12 border-b">
        <header class=" flex justify-between items-center lg:space-x-4  rounded-lg shadow-lg f-full">

            <!-- Hamburger Menu Icon(Mobile) -->
            <button id="mobileMenuButton" class="lg:hidden text-gray-600 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <!-- Logo -->
            <div class="text-xl font-bold hidden">Company Name</div>

            <!--  Icon -->
            <button id="sidebarToggleButton" class="text-gray-600 pr-4 hidden lg:block">
                <img src="assets/icons/Sidebar.svg" alt="Sidebar Icon" class="h-5 w-5">
            </button>

            <!-- Search Bar -->
            <div class="hidden lg:hidden flex-1 mx-4 text-xs">
                <div class="relative w-11/12 ">
                    <input type="text" placeholder="" class="w-full px-4 py-1 border rounded-lg focus:outline-none focus:ring-2  bg--white">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-white pr-2">
                        <!-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2.828-4.828A7.962 7.962 0 0018 10a8 8 0 10-8 8c1.657 0 3.175-.51 4.414-1.414l4.586 4.586z"></path>
                </svg> -->
                    </button>
                </div>
            </div>

            <!-- Notifications and User -->
            <div class="flex items-center space-x-4 lg:space-x-6 pr-2 ">

                <!-- Notifications Icon -->
                <button class="text-gray-600">
                    <img src="assets/icons/Bell.svg" alt="Sidebar Icon" class="h-5 w-5">
                </button>
                <!-- User Avatar -->
                <div class="flex items-center space-x-2 ">
                    <div class="flex items-center space-x-3 text-white text-small username">
                        <div class="flex flex-col p-0">
                            <span class="text-sm font-medium sidebar-text"><?= htmlspecialchars($employeeName) ?></span>
                        </div>
                        <img src="<?= htmlspecialchars($profilePic) ?>" alt="User Avatar" class="h-7 w-7 rounded-md border border- bg-white">
                    </div>
                </div>
            </div>

        </header>
    </div>
    