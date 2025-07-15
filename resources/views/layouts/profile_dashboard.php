<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>/css/app.css" rel="stylesheet"> <!-- Relative to /public -->
</head>
<body class="h-screen w-screen font-sans leading-normal tracking-normal bg-stone-950">

<div class="flex h-full w-full">
  
  <!-- Sidebar -->
  <div id="sidebar" class="hidden lg:flex w-52 bg-stone-950 border-r  shadow-md">
    <?php include __DIR__ . '/../shared/employee/sidebar.php'; ?>
  </div>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col w-full h-full overflow-hidden">
    
    <!-- Topbar -->
    <?php include __DIR__ . '/../shared/employee/navbar.php'; ?>
    
    <!-- Mobile Dropdown -->
    <?php include __DIR__ . '/../shared/employee/mobiledropdown.php'; ?>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4">
      <?= $content ?>
    </div>
    
  </main>
</div>

<script>
  // Toggle logic (Mobile and Desktop)
  document.getElementById('mobileMenuButton')?.addEventListener('click', () => {
    document.getElementById('mobileSidebar')?.classList.toggle('hidden');
  });

  document.getElementById('closeMobileMenu')?.addEventListener('click', () => {
    document.getElementById('mobileSidebar')?.classList.add('hidden');
  });

  const sidebar = document.getElementById('sidebar');
  const sidebarToggleButton = document.getElementById('sidebarToggleButton');

  sidebarToggleButton?.addEventListener('click', () => {
    sidebar.classList.toggle('w-20');
    sidebar.classList.toggle('w-52');

    document.querySelectorAll('.arrow').forEach(arrow => arrow.classList.toggle('hidden'));
    document.querySelectorAll('.submenu').forEach(sub => sub.classList.add('hidden'));
  });

  document.querySelectorAll('.sidebar-toggle').forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      const submenu = toggle.nextElementSibling;
      const arrow = toggle.querySelector('.arrow');
      const isMinimized = sidebar.classList.contains('w-20');

      document.querySelectorAll('.submenu').forEach(s => {
        if (s !== submenu) {
          s.classList.add('hidden');
          const a = s.previousElementSibling?.querySelector('.arrow');
          if (a) a.classList.remove('rotate-180');
        }
      });

      submenu.classList.toggle('hidden');
      if (arrow) arrow.classList.toggle('rotate-180');

      if (isMinimized && !submenu.classList.contains('hidden')) {
        const toggleRect = toggle.getBoundingClientRect();
        const sidebarRect = sidebar.getBoundingClientRect();
        submenu.style.top = `${toggleRect.top - sidebarRect.top}px`;
      }
    });
  });
</script>

</body>
</html>
