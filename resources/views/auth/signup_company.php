<?php if (!isset($title)) $title = "Sign Up - Company"; ?>
<div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl text-center mb-4">Sign Up</h2>
    <p class="text-center mb-4 text-orange-500">Already have an account? <a href="?path=login" class="underline">Sign in now</a></p>
    <form method="POST" action="?path=signup/company" class="space-y-4">
        <div>
            <label for="companyName" class="block mb-1">Company Name</label>
            <input type="text" id="companyName" name="companyName" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter company name" required>
        </div>
        <div>
            <label for="email" class="block mb-1">Email Address</label>
            <input type="email" id="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter company email" required>
        </div>
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter password" required>
        </div>
        <div>
            <label for="industry" class="block mb-1">Industry</label>
            <input type="text" id="industry" name="industry" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="e.g., Information Technology">
        </div>
        <div>
            <label for="location" class="block mb-1">Location</label>
            <input type="text" id="location" name="location" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="e.g., New York, USA">
        </div>
        <div>
            <label for="contact_person" class="block mb-1">Contact Person</label>
            <input type="text" id="contact_person" name="contact_person" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="e.g., Jane Smith">
        </div>
        <div>
            <label for="phone_number" class="block mb-1">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter phone number">
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded">Next Steps</button>
    </form>
    <p class="text-center mt-4 text-gray-400">© 2025 Employee Bee. All rights reserved. | <a href="#" class="underline">Privacy</a> | <a href="#" class="underline">Terms of Service</a></p>
</div>