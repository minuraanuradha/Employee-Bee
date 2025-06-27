<?php if (!isset($title)) $title = "Sign Up - Employee"; ?>
<div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl text-center mb-4">Sign Up</h2>
    <p class="text-center mb-4 text-orange-500">Already have an account? <a href="?path=login" class="underline">Sign in now</a></p>
    <form method="POST" action="?path=signup/employee" class="space-y-4">
        <div>
            <label for="fullName" class="block mb-1">Full Name</label>
            <input type="text" id="fullName" name="fullName" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter your full name" required>
        </div>
        <div>
            <label for="email" class="block mb-1">Email Address</label>
            <input type="email" id="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter your email" required>
        </div>
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter password" required>
        </div>
        <div>
            <label for="phone_number" class="block mb-1">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter phone number">
        </div>
        <div>
            <label for="current_job_title" class="block mb-1">Current Job Title</label>
            <input type="text" id="current_job_title" name="current_job_title" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="e.g., Junior Web Developer">
        </div>
        <div>
            <label for="current_employer" class="block mb-1">Current Employer</label>
            <input type="text" id="current_employer" name="current_employer" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="e.g., TechCorp Inc.">
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded">Next Steps</button>
    </form>
    <p class="text-center mt-4 text-gray-400">© 2025 Employee Bee. All rights reserved. | <a href="#" class="underline">Privacy</a> | <a href="#" class="underline">Terms of Service</a></p>
</div>