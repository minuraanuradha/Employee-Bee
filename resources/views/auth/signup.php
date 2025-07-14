<div class="h-full w-full  flex flex-col justify-between px-6 lg:px-0">
        <div class="flex-1 flex flex-col justify-center items-center w-full h-full">
            <!-- Back Button -->
            <div class="absolute top-8 left-8">
                <button onclick="history.back()" class="btn-3 transition-colors duration-300 cursor-pointer">
                    Back
                </button>
            </div>
            
            <!-- Centered Signup Form -->
            <form method="POST" action="?path=signup" class="flex flex-col items-center w-full max-w-sm">
                <!-- Logo -->
                <div class="  flex flex-col items-center ">
                    <div class="px-4 py-2 border-orange rounded-lg bg-black ">
                        <img src="assets/images/Logo/Lgo.png" alt="EmployeeBee Logo" class="h-20 w-auto object-contain" />
                    </div>
                </div>
                
                <!-- Heading -->
                <h1 class="text-h2 font-bold text-white tracking-widest mb-2 pt-2">SIGN UP</h1>
                <p class="text-gray-300 mb-4 text-sm">
                    Already have an account? 
                    <a href="?path=login" class="text-orange hover:underline font-semibold">Sign In now</a>
                </p>
                
                <!-- Account Type Section -->
                <div class="w-full mb-8">
                    <h2 class="text-lg text-gray-300 mb-6 text-sm">1. Choose account type</h2>
                    
                    <!-- Account Type Buttons -->
                    <div class="flex gap-4 mb-6">
                        <button 
                            type="button"
                            onclick="selectAccountType('employee')" 
                            id="employeeBtn"
                            class="flex-1 py-2 bg-orange text-white text-sm font-semibold rounded-lg transition-colors duration-300"
                        >
                            Employee
                        </button>
                        <button 
                            type="button"
                            onclick="selectAccountType('company')" 
                            id="companyBtn"
                            class="flex-1 py-2 bg-transparent border border-gray-600 text-sm text-gray-300 font-semibold rounded-lg hover:border-orange hover:text-orange transition-colors duration-300"
                        >
                            Company
                        </button>
                    </div>

                    <!-- Hidden input to store selected account type -->
                    <input type="hidden" name="account_type" id="accountType" value="employee">
                    
                    <!-- Next Steps Button -->
                    <button 
                        type="button"
                        onclick="goToNextStep()"
                        class="w-full py-3 bg-transparent border border-orange  text-sm font-semibold rounded-lg hover:bg-orange text-white transition-colors duration-300"
                    >
                        Next Steps
                    </button>
                </div>
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
/* Account Type Selection */
let selectedAccountType = 'employee';

function selectAccountType(type) {
    selectedAccountType = type;
    
    const employeeBtn = document.getElementById('employeeBtn');
    const companyBtn = document.getElementById('companyBtn');
    const accountTypeInput = document.getElementById('accountType');
    
    if (type === 'employee') {
        employeeBtn.className = 'flex-1 py-2 bg-orange text-white text-sm font-semibold rounded-lg transition-colors duration-300';
        companyBtn.className = 'flex-1 py-2 bg-transparent border  text-sm border-gray-600 text-gray-300 font-semibold rounded-lg hover:border-orange hover:text-orange transition-colors duration-300';
        accountTypeInput.value = 'employee';
    } else {
        companyBtn.className = 'flex-1 py-2 bg-orange text-white text-sm font-semibold rounded-lg transition-colors duration-300';
        employeeBtn.className = 'flex-1 py-2 bg-transparent border  text-sm border-gray-600 text-gray-300 font-semibold rounded-lg hover:border-orange hover:text-orange transition-colors duration-300';
        accountTypeInput.value = 'company';
    }
}

function goToNextStep() {
    const type = document.getElementById('accountType').value;
    if (type === 'employee') {
        window.location.href = '?path=signup/employee';
    } else {
        window.location.href = '?path=signup/company';
    }
}
    </script>
    </div>
