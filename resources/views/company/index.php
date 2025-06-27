<?php if (!isset($title)) $title = "Company Profile"; ?>
     <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
         <h2 class="text-2xl text-center mb-4">Company Profile</h2>
         <p>Welcome, Company! Company ID: <?php echo $_SESSION['company_id'] ?? 'Not logged in'; ?></p>
         <a href="?path=login" class="text-orange-500 underline">Logout</a>
     </div>