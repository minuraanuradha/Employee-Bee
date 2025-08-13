<?php if (!isset($title)) $title = "Login"; ?>
<div class="h-[calc(100vh-16px)] w-full  flex flex-col justify-between items-center px-6 lg:px-0">
        <div class="flex-1 flex flex-col justify-center items-center w-full h-full">
            <!-- Back Button -->
            <div class="absolute top-8 left-8">
                <button onclick="history.back()" class="btn-3 bg-white/10 transition-colors duration-300 cursor-pointer">
                    Back
                </button>
            </div>
            
            <!-- Error Message -->
            <?php if (isset($_SESSION['login_error'])): ?>
            <div id="errorPopup" class="fixed inset-0 bg-black bg-opacity-95 flex items-center justify-center z-50">
                <div class=" bg-black rounded-xl p-6 w-11/12 max-w-md border border-orange/20 shadow-2xl shadow-orange/10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-h5 text-white font-medium">Login Error</h3>
                        <button id="closeErrorPopup" class="text-gray-400 hover:text-white text-xl">&times;</button>
                    </div>
                    <p class="text-p-regular text-gray-300 mb-4"><?php echo htmlspecialchars($_SESSION['login_error']); ?></p>
                    <button id="closeErrorButton" class="w-full py-2 rounded-lg bg-orange/50 border border-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300">
                        OK
                    </button>
                </div>
            </div>
            <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
            
            <!-- Success Message -->
            <?php if (isset($_SESSION['signup_success'])): ?>
            <div id="successPopup" class="fixed inset-0 bg-black bg-opacity-95 flex items-center justify-center z-50">
                <div class=" bg-black rounded-xl p-6 w-11/12 max-w-md border border-orange/20 shadow-2xl shadow-orange/10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-h5 text-white font-medium">Success</h3>
                        <button id="closeSuccessPopup" class="text-gray-400 hover:text-white text-xl">&times;</button>
                    </div>
                    <p class="text-p-regular text-gray-300 mb-4"><?php echo htmlspecialchars($_SESSION['signup_success']); ?></p>
                    <button id="closeSuccessButton" class="w-full py-2 rounded-lg bg-orange/50 border border-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300">
                        OK
                    </button>
                </div>
            </div>
            <?php unset($_SESSION['signup_success']); ?>
            <?php endif; ?>
            
            <!-- Centered Login Form -->
            <form method="POST" action="?path=login" class="flex flex-col items-center justify-center w-full max-w-sm h-full">
                <!-- Logo -->
                <div class="  flex flex-col items-center ">
                    <div class="px-4 py-2 border-orange rounded-lg ">
                        <img src="assets/images/Logo/Asset 2.png" alt="EmployeeBee Logo" class="h-16 w-auto object-contain " />
                    </div>
                </div>
                
                <!-- Heading -->
                <h1 class="text-h2 font-bold text-white tracking-widest mb-2 pt-2">LOG IN</h1>
                <p class="text-gray-300 mb-4 text-sm">
                    First time here ? 
                    <a href="?path=signup" class="text-orange hover:underline font-semibold">Sign Up for free</a>
                </p>
                
                <!-- Inputs -->
                <div class="w-full space-y-2 mb-2 ">
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        placeholder="Enter your mail"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-black text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300 " 
                    />
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-black text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300 " 
                    />
                </div>
                
                <!-- Forgot Password -->
                <div class="w-full text-right mb-4">
                    <a href="#" class="text-orange text-xs hover:underline">Forget Password?</a>
                </div>
                
                <!-- Button -->
                <button 
                    type="submit" 
                    class="w-full py-2 rounded-lg bg-orange/50 border border-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300"
                >
                    Sign In
                </button>
            </form>
        </div>
        
  <!-- Footer -->
  <footer class="hidden sm:block text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved.  | 
    <a href="#" class="hover:underline">Privacy</a>  | 
    <a href="#" class="hover:underline">Legal</a>  | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>

  <!-- Mobile Footer -->
  <footer class="sm:hidden text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved. <br>
    <a href="#" class="hover:underline">Privacy</a>  |
    <a href="#" class="hover:underline">Legal</a>  |
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
  
  <script>
    // Handle error popup closing
    document.addEventListener('DOMContentLoaded', function() {
      const errorPopup = document.getElementById('errorPopup');
      const closeErrorPopup = document.getElementById('closeErrorPopup');
      const closeErrorButton = document.getElementById('closeErrorButton');
      
      if (closeErrorPopup) {
        closeErrorPopup.addEventListener('click', function() {
          errorPopup.classList.add('hidden');
        });
      }
      
      if (closeErrorButton) {
        closeErrorButton.addEventListener('click', function() {
          errorPopup.classList.add('hidden');
        });
      }
      
      // Handle success popup closing
      const successPopup = document.getElementById('successPopup');
      const closeSuccessPopup = document.getElementById('closeSuccessPopup');
      const closeSuccessButton = document.getElementById('closeSuccessButton');
      
      if (closeSuccessPopup) {
        closeSuccessPopup.addEventListener('click', function() {
          successPopup.classList.add('hidden');
        });
      }
      
      if (closeSuccessButton) {
        closeSuccessButton.addEventListener('click', function() {
          successPopup.classList.add('hidden');
        });
      }
    });
  </script>
</div>
