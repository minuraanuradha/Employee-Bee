<?php if (!isset($title)) $title = "Sign Up - Employee"; ?>
<div class="h-full w-full flex flex-col justify-between px-4 lg:px-0">
  <div class="flex-1 flex flex-col justify-center items-center w-full">
    <!-- Back Button -->
    <div class="absolute top-8 left-8 fixed ">
      <button onclick="history.back()" class="btn-3 transition-colors duration-300 cursor-pointer">
        Back
      </button>
    </div>
    
    <!-- Centered Signup Form Container -->
    <div class="w-full max-w-md px-4 overflow-y-auto max-h-[75vh]">
      <!-- Logo -->
      <div class="flex flex-col items-center mb-6">
        <div class="px-4 py-2 border-orange rounded-lg bg-black">
          <img src="assets/images/Logo/Lgo.png" alt="EmployeeBee Logo" class="h-20 w-auto object-contain" />
        </div>
      </div>
      
      <!-- Heading -->
      <h1 class="text-h2 font-bold text-white tracking-widest mb-2 text-center">SIGN UP</h1>
      <p class="text-gray-300  text-sm text-center">Start building your verified career profile today.</p>
        
  <p class="text-center text-p-small text-lightgray mt-0 mb-4">
        Already have an account?
        <a href="?path=login" class="text-orange underline hover:text-orange-300">Log in</a>
      </p>
      
      <!-- Scrollable Form Container -->
      <div class=" overflow-y-auto pr-2 ">
        <form id="signup-form" method="POST" action="?path=signup/employee" class="space-y-4">
          <!-- Full Name -->
          <div>
            <label for="full_name" class="block text-xs text-white mb-1">
              Full Name <span class="text-orange">*</span>
            </label>
            <input type="text" id="full_name" name="full_name" required placeholder="Enter your full name"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Email -->
          <div>
            <label for="email" class="block text-xs text-white mb-1">
              Email <span class="text-orange">*</span>
            </label>
            <input type="email" id="email" name="email" required placeholder="Enter your email address"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Password -->
          <div>
            <label for="password" class="block text-xs text-white mb-1">
              Password <span class="text-orange">*</span>
            </label>
            <input type="password" id="password" name="password" required placeholder="Create a strong password"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- NIC/National ID -->
          <div>
            <label for="nic_or_national_id" class="block text-xs text-white mb-1">
              NIC/National ID <span class="text-orange">*</span>
            </label>
            <input type="text" id="nic_or_national_id" name="nic_or_national_id" required placeholder="Enter your national ID"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Country and Birthdate Row -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="country" class="block text-xs text-white mb-1">
                Country <span class="text-orange">*</span>
              </label>
              <select id="country" name="country"
                class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm focus:outline-none focus:border-orange transition-colors duration-300">
                <option value="SL" selected>Sri Lanka</option>
                <option value="US">United States</option>
                <option value="UK">United Kingdom</option>
                <option value="CA">Canada</option>
                <option value="AU">Australia</option>
                <option value="IN">India</option>
                <option value="SG">Singapore</option>
                <option value="MY">Malaysia</option>
                <option value="AE">UAE</option>
                <option value="OTHER">Other</option>
              </select>
            </div>
            <div>
              <label for="birthdate" class="block text-xs text-white mb-1">
                Birth Date <span class="text-orange">*</span>
              </label>
              <input type="date" id="birthdate" name="birthdate"
                class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm focus:outline-none focus:border-orange transition-colors duration-300" />
            </div>
          </div>
          
          <!-- Phone Number -->
          <div>
            <label for="phone_number" class="block text-xs text-white mb-1">
              Phone Number <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Location -->
          <div>
            <label for="location" class="block text-xs text-white mb-1">
              Location <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="location" name="location" placeholder="Enter your city/location"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- LinkedIn URL -->
          <div>
            <label for="linkedin_url" class="block text-xs text-white mb-1">
              LinkedIn URL <span class="text-gray-400">(optional)</span>
            </label>
            <input type="url" id="linkedin_url" name="linkedin_url" placeholder="https://linkedin.com/in/yourprofile"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Portfolio URL -->
          <div>
            <label for="portfolio_url" class="block text-xs text-white mb-1">
              Portfolio URL <span class="text-gray-400">(optional)</span>
            </label>
            <input type="url" id="portfolio_url" name="portfolio_url" placeholder="https://yourportfolio.com"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Skills -->
          <div>
            <label for="skills" class="block text-xs text-white mb-1">
              Skills <span class="text-gray-400">(optional)</span>
            </label>
            <textarea id="skills" name="skills" rows="3" placeholder="e.g., JavaScript, Python, React, UI/UX Design"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300"></textarea>
          </div>
          
          <!-- Education -->
          <div>
            <label for="education" class="block text-xs text-white mb-1">
              Education <span class="text-gray-400">(optional)</span>
            </label>
            <textarea id="education" name="education" rows="3" placeholder="e.g., Bachelor's in Computer Science, University of XYZ"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300"></textarea>
          </div>
        </form>
      </div>
      
      <!-- Button -->
      <button type="submit" form="signup-form"
        class="w-full py-2 rounded-lg bg-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300 mt-6">
        Create My Account →
      </button>
      
    </div>
  </div>


  <!-- Footer -->
  <footer class="hidden sm:block text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved.  | 
    <a href="#" class="hover:underline">Privacy</a>  | 
    <a href="#" class="hover:underline">Legal</a>  | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
  
  <!-- Mobile Footer -->
  <footer class="sm:hidden text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved. <br>
    <a href="#" class="hover:underline">Privacy</a>  | 
    <a href="#" class="hover:underline">Legal</a>  | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
</div>
