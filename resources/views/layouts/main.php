<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Bee - <?php echo isset($title) ? htmlspecialchars($title) : 'Home'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>/css/app.css" rel="stylesheet"> <!-- Relative to /public -->
</head>
<body class="min-h-screen flex flex-col justify-between sm:mx-10 lg:mx-28 font-roboto bg-black max-h-screen overflow-hidden">

  <!-- Navbar -->
  <header class="flex justify-between items-center px-6 py-4 border-b border-orange sm:border-none">
    <!-- Logo -->
    <div class="text-orange font-bold border border-orange px-4 py-1 rounded-full">
      LOGO
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
    <nav class="hidden sm:flex space-x-10 border border-orange px-16 py-2 rounded-xl items-center">
      <a href="<?php echo $baseURL; ?>/home" class="text-p-regular text-white hover:text-orange">Home</a>
      <a href="<?php echo $baseURL; ?>/companies" class="text-p-regular text-white hover:text-orange">Companies</a>
      <a href="<?php echo $baseURL; ?>/about-us" class="text-p-regular text-white hover:text-orange">About</a>
      <a href="<?php echo $baseURL; ?>/help" class="text-p-regular text-white hover:text-orange">Help</a>
    </nav>

    <!-- Profile Button -->
    <?php
    $isLoggedIn = isset($_SESSION['role']) && (isset($_SESSION['user_id']) || isset($_SESSION['company_id']));
    $profileUrl = $isLoggedIn ? "?path=profile" : "?path=login";
    ?>
    <button class="hidden sm:flex btn-3" onclick="window.location.href='<?php echo $profileUrl; ?>'">
      Profile
    </button>
  </header>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="space-y-4 py-6 sm:hidden hidden">
    <div class="flex flex-col space-y-4 items-center text-center">
      <a href="<?php echo $baseURL; ?>/home" class="text-p-regular text-white hover:text-orange">Home</a>
      <a href="<?php echo $baseURL; ?>/companies" class="text-p-regular text-white hover:text-orange">Companies</a>
      <a href="<?php echo $baseURL; ?>/about-us" class="text-p-regular text-white hover:text-orange">About</a>
      <a href="<?php echo $baseURL; ?>/help" class="text-p-regular text-white hover:text-orange">Help</a>
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
</html>