<?php if (!isset($title)) $title = "Sign Up - Company"; ?>
<div class="h-full w-full flex flex-col justify-between px-4 lg:px-0">
  <style>
    /* Custom styling for select dropdown options to match the dark theme */
    select#industry option {
      background-color: #F97316; /* Tailwind gray-800 */
      color: #FFFFFF; /* White text */
      padding: 8px;
    }
    select#industry option:hover {
      background-color: #F97316; /* Tailwind orange-500 */
      color: #FFFFFF;
    }
    select#industry:focus option {
      background-color:rgb(26, 26, 26);
      color: #FFFFFF;
    }
  </style>
  <div class="flex-1 flex flex-col justify-center items-center w-full">
    <!-- Back Button -->
    <div class="absolute top-8 left-8 fixed">
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
      <h1 class="text-h2 font-bold text-white tracking-widest mb-2 text-center">COMPANY</h1>
      <p class="text-gray-300 text-sm text-center">Start building your company profile today.</p>
      
      <p class="text-center text-p-small text-lightgray mt-0 mb-4">
        Already have an account?
        <a href="?path=login" class="text-orange underline hover:text-orange-300">Log in</a>
      </p>
      
      <!-- Scrollable Form Container -->
      <div class="overflow-y-auto pr-2">
        <form id="signup-form" method="POST" action="?path=signup/company" enctype="multipart/form-data" class="space-y-4">
          <!-- Company Name -->
          <div>
            <label for="company_name" class="block text-xs text-white mb-1">
              Company Name <span class="text-orange">*</span>
            </label>
            <input type="text" id="company_name" name="company_name" required placeholder="Enter your company name"
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
          
          <!-- Confirm Password -->
          <div>
            <label for="password_confirm" class="block text-xs text-white mb-1">
              Confirm Password <span class="text-orange">*</span>
            </label>
            <input type="password" id="password_confirm" name="password_confirm" required placeholder="Confirm your password"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Industry -->
          <div>
            <label for="industry" class="block text-xs text-white mb-1">
              Industry <span class="text-gray-400">(optional)</span>
            </label>
            <select id="industry" name="industry"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm focus:outline-none focus:border-orange transition-colors duration-300 appearance-none">
              <option value="" disabled selected>Select an industry</option>
              <option value="Technology">Technology</option>
              <option value="Finance">Finance</option>
              <option value="Healthcare">Healthcare</option>
              <option value="Education">Education</option>
              <option value="Manufacturing">Manufacturing</option>
              <option value="Retail">Retail</option>
              <option value="Hospitality">Hospitality</option>
              <option value="Construction">Construction</option>
              <option value="Marketing">Marketing</option>
              <option value="Transportation">Transportation</option>
              <option value="Other">Other</option>
            </select>
          </div>
          
          <!-- Location -->
          <div>
            <label for="location" class="block text-xs text-white mb-1">
              Location <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="location" name="location" placeholder="Enter your city/location"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Company Size -->
          <div>
            <label for="company_size" class="block text-xs text-white mb-1">
              Company Size <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="company_size" name="company_size" placeholder="Enter company size (e.g., 50-100 employees)"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Business Registration Number -->
          <div>
            <label for="business_registration_number" class="block text-xs text-white mb-1">
              Business Registration Number <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="business_registration_number" name="business_registration_number" placeholder="Enter business registration number"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Description -->
          <div>
            <label for="description" class="block text-xs text-white mb-1">
              Description <span class="text-gray-400">(optional)</span>
            </label>
            <textarea id="description" name="description" rows="3" placeholder="Describe your company"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300"></textarea>
          </div>
          
          <!-- Website URL -->
          <div>
            <label for="website_url" class="block text-xs text-white mb-1">
              Website URL <span class="text-gray-400">(optional)</span>
            </label>
            <input type="url" id="website_url" name="website_url" placeholder="https://yourcompany.com"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- LinkedIn URL -->
          <div>
            <label for="linkedin_url" class="block text-xs text-white mb-1">
              LinkedIn URL <span class="text-gray-400">(optional)</span>
            </label>
            <input type="url" id="linkedin_url" name="linkedin_url" placeholder="https://linkedin.com/company/yourcompany"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Contact Person -->
          <div>
            <label for="contact_person" class="block text-xs text-white mb-1">
              Contact Person <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="contact_person" name="contact_person" placeholder="Enter contact person name"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Phone Number -->
          <div>
            <label for="phone_number" class="block text-xs text-white mb-1">
              Phone Number <span class="text-gray-400">(optional)</span>
            </label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
          
          <!-- Company Logo -->
          <div>
            <label for="logo_path" class="block text-xs text-white mb-1">
              Company Logo <span class="text-gray-400">(optional)</span>
            </label>
            <input type="file" id="logo_path" name="logo_path"
              class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-transparent text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300" />
          </div>
        </form>
      </div>
      
      <!-- Button -->
      <button type="submit" form="signup-form"
        class="w-full py-2 rounded-lg bg-orange text-white text-sm font-semibold hover:bg-orange/90 transition-colors duration-300 mt-6">
        Register Company →
      </button>
      
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="hidden sm:block text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved. | 
    <a href="#" class="hover:underline">Privacy</a> | 
    <a href="#" class="hover:underline">Legal</a> | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
  
  <!-- Mobile Footer -->
  <footer class="sm:hidden text-center text-p-small text-white py-2">
    © 2025 Employee Bee. All rights reserved. <br>
    <a href="#" class="hover:underline">Privacy</a> | 
    <a href="#" class="hover:underline">Legal</a> | 
    <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
</div>