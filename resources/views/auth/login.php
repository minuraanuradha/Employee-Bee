<?php if (!isset($title)) $title = "Login"; ?>
<div class="h-full w-full  flex flex-col justify-between px-6 lg:px-0">
        <div class="flex-1 flex flex-col justify-center items-center w-full h-full">
            <!-- Back Button -->
            <div class="absolute top-8 left-8">
                <button onclick="history.back()" class="btn-3 transition-colors duration-300 cursor-pointer">
                    Back
                </button>
            </div>
            
            <!-- Success Message -->
            <!-- <?php if (isset($_SESSION['signup_success'])): ?> -->
            <!-- <div class="mb-6 p-4 bg-green-900/20 border border-green-500 rounded-lg text-green-400 text-center max-w-sm">
                <?php echo htmlspecialchars($_SESSION['signup_success']); ?>
                <?php unset($_SESSION['signup_success']); ?>
            </div> -->
            <!-- <?php endif; ?> -->
            
            <!-- Centered Login Form -->
            <form method="POST" action="?path=login" class="flex flex-col items-center w-full max-w-sm">
                <!-- Logo -->
                <div class="  flex flex-col items-center ">
                    <div class="px-4 py-2 border-orange rounded-lg bg-black ">
                        <img src="assets/images/Logo/Lgo.png" alt="EmployeeBee Logo" class="h-20 w-auto object-contain" />
                    </div>
                </div>
                
                <!-- Heading -->
                <h1 class="text-h2 font-bold text-white tracking-widest mb-2 pt-2">LOG IN</h1>
                <p class="text-gray-300 mb-4 text-sm">
                    First time here ? 
                    <a href="?path=signup" class="text-orange hover:underline font-semibold">Sign Up for free</a>
                </p>
                
                <!-- Inputs -->
                <div class="w-full space-y-4 mb-4">
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        placeholder="Enter your mail"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" 
                    />
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Password"
                        class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" 
                    />
                </div>
                
                <!-- Forgot Password -->
                <div class="w-full text-right mb-4">
                    <a href="#" class="text-orange text-sm hover:underline">Forget Password?</a>
                </div>
                
                <!-- Button -->
                <button 
                    type="submit" 
                    class="w-full py-2 rounded-lg bg-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300"
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
    </div>
