<?php if (!isset($title)) $title = "Login"; ?>
<div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
    <h2 class="text-2xl text-center mb-4">Sign In</h2>
    <p class="text-center mb-4 text-orange-500">First time? <a href="?path=signup" class="underline">Sign up for free</a></p>
    <form method="POST" action="?path=login" class="space-y-4">
        <div>
            <label for="email" class="block mb-1">Enter your mail</label>
            <input type="email" id="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter your email" required>
        </div>
        <div>
            <label for="password" class="block mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 rounded bg-gray-700 text-white" placeholder="Enter password" required>
        </div>
        <div class="text-right">
            <a href="#" class="text-orange-500 underline">Forgot Password?</a>
        </div>
        <button type="submit" class="w-full bg-orange-500 text-white p-2 rounded">Sign In</button>
    </form>
    <p class="text-center mt-4 text-gray-400">© 2025 Employee Bee. All rights reserved. | <a href="#" class="underline">Privacy</a> | <a href="#" class="underline">Terms of Service</a></p>
</div>