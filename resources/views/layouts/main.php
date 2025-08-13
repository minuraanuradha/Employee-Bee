<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Bee - <?php echo isset($title) ? htmlspecialchars($title) : 'Home'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>/css/app.css" rel="stylesheet"> <!-- Relative to /public -->
</head>
<body class="min-h-screen flex flex-col justify-between sm:mx-10 lg:mx-28 font-roboto bg-orange max-h-screen overflow-hidden bg-gradient-to-r from-black via-black/95 to-black">

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 py-4 border-b border-orange sm:border-none ">
    <!-- Logo -->
                    <div class="px-4 py-2 border-orange rounded-lg ">
                        <img src="assets/images/Logo/9999.png" alt="EmployeeBee Logo" class="h-7 w-auto object-contain" />
                    </div>

    <!-- Hamburger Menu (Mobile Only) -->
    <div class="sm:hidden">
      <button id="menu-toggle" class="focus:outline-none">
        <!-- Hamburger Icon -->
        <svg id="hamburger-icon" class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>

        <!-- Close Icon -->
        <svg id="close-icon" class="w-6 h-6 text-white hidden" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden sm:flex space-x-10 border border-orange/70 px-16 py-2 rounded-xl items-center bg-orange/5 shadow-md shadow-black">
      <?php
        $currentPage = $_SERVER['REQUEST_URI'];
        $homeActive = (strpos($currentPage, '/home') !== false || $currentPage === '/') ? 'text-orange' : 'text-white';
        $companiesActive = strpos($currentPage, '/companies') !== false ? 'text-orange' : 'text-white';
        $aboutActive = strpos($currentPage, '/about-us') !== false ? 'text-orange' : 'text-white';
        $helpActive = strpos($currentPage, '/help') !== false ? 'text-orange' : 'text-white';
      ?>
      <a href="<?php echo $baseURL; ?>/home" class="text-p-regular hover:text-orange <?php echo $homeActive; ?>">Home</a>
      <a href="<?php echo $baseURL; ?>/companies" class="text-p-regular hover:text-orange <?php echo $companiesActive; ?>">Companies</a>
      <a href="<?php echo $baseURL; ?>/about-us" class="text-p-regular hover:text-orange <?php echo $aboutActive; ?>">About</a>
      <a href="<?php echo $baseURL; ?>/help" class="text-p-regular hover:text-orange <?php echo $helpActive; ?>">Help</a>
    </nav>

    <!-- Profile Button -->
    <?php
    $isLoggedIn = isset($_SESSION['role']) && (isset($_SESSION['user_id']) || isset($_SESSION['company_id']));
    $profileUrl = $isLoggedIn ? "?path=profile" : "?path=login";
    ?>
    <button class="hidden sm:flex btn-3 shadow-md shadow-black" onclick="window.location.href='<?php echo $profileUrl; ?>'">
      Profile
    </button>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="space-y-4 py-6 sm:hidden hidden">
    <div class="flex flex-col space-y-4 items-center text-center">
      <?php
        $currentPage = $_SERVER['REQUEST_URI'];
        $homeActive = (strpos($currentPage, '/home') !== false || $currentPage === '/') ? 'text-orange' : 'text-white';
        $companiesActive = strpos($currentPage, '/companies') !== false ? 'text-orange' : 'text-white';
        $aboutActive = strpos($currentPage, '/about-us') !== false ? 'text-orange' : 'text-white';
        $helpActive = strpos($currentPage, '/help') !== false ? 'text-orange' : 'text-white';
      ?>
      <a href="<?php echo $baseURL; ?>/home" class="text-p-regular hover:text-orange <?php echo $homeActive; ?>">Home</a>
      <a href="<?php echo $baseURL; ?>/companies" class="text-p-regular hover:text-orange <?php echo $companiesActive; ?>">Companies</a>
      <a href="<?php echo $baseURL; ?>/about-us" class="text-p-regular hover:text-orange <?php echo $aboutActive; ?>">About</a>
      <a href="<?php echo $baseURL; ?>/help" class="text-p-regular hover:text-orange <?php echo $helpActive; ?>">Help</a>
      <button class="btn-3" onclick="window.location.href='<?php echo $profileUrl; ?>'">
        Profile
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div id="main-content" class="flex items-center justify-center text-center px-4 h-full w-full">
    <?php echo isset($content) ? $content : '<h1>Welcome to Employee Bee</h1>'; ?>
</div>

  <!-- Footer -->
  <footer class="hidden sm:block text-center text-p-small text-white py-4">
    © 2025 Employee Bee. All rights reserved.  | 
    <a href="#" class="hover:underline">Privacy</a>  | 
    <a href="#" class="hover:underline">Legal</a>  | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>

  <!-- Mobile Footer -->
  <footer class="sm:hidden text-center text-p-small text-white py-4">
    © 2025 Employee Bee. All rights reserved. <br>
    <a href="#" class="hover:underline">Privacy</a>  | 
    <a href="#" class="hover:underline">Legal</a>  | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>

  <script src="<?php echo $baseURL; ?>/js/app.js"></script>
</body>
<style>
@keyframes fade-in {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fade-in 1.2s ease-out forwards;
}

.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: rgba(255,63,0,0.1);
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(255,63,0,0.5);
  border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: rgba(255,63,0,0.7);
}
</style>
</html>