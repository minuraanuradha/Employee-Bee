<?php if (!isset($title)) $title = "Login"; ?>
<div class="h-full w-full bg-black flex flex-col justify-between ">
  <div class="flex-1 flex flex-col justify-center items-center w-full h-full">
    <!-- Back Button -->
    <div class="absolute top-8 left-8">
      <a href="/" class="btn-3">Back</a>
    </div>
    <!-- Centered Login Form -->
    <form method="POST" action="?path=login" class="flex flex-col items-center w-full max-w-sm mt-12">
      <!-- Logo -->
      <div class="mb-8 flex flex-col items-center">
        <div class="w-32 h-10 flex items-center justify-center border-2 border-orange rounded-lg mb-4">
          <span class="text-orange font-bold tracking-widest text-lg">LOO</span>
        </div>
      </div>
      <!-- Heading -->
      <h1 class="text-4xl font-bold text-white tracking-widest mb-2">LOG IN</h1>
      <p class="text-base text-white/80 mb-2">First time here ? <a href="?path=signup" class="text-orange hover:underline font-semibold">Sign Up for free</a></p>
      <!-- Inputs -->
      <input type="email" name="email" required placeholder="Enter your mail"
        class="w-full mb-4 px-4 py-3 rounded-md border border-gray-400 bg-transparent text-white placeholder:text-gray-400 focus:outline-none focus:border-orange transition" />
      <div class="w-full relative mb-4">
        <input type="password" name="password" required placeholder="Password"
          class="w-full px-4 py-3 rounded-md border border-gray-400 bg-transparent text-white placeholder:text-gray-400 focus:outline-none focus:border-orange transition" />
        <a href="#" class="absolute right-0 top-1/2 -translate-y-1/2 text-orange text-sm font-medium pr-2 hover:underline">Forget Password?</a>
      </div>
      <!-- Button -->
      <button type="submit" class="w-full bg-orange text-white py-2 rounded-lg font-semibold text-lg mt-2 hover:bg-orange/90 transition">Sign In</button>
    </form>
  </div>
  <!-- Footer -->
  <footer class="w-full text-center text-xs text-gray-400 pb-4 mt-8">
    © 2025 Employee Bee. All right reserved &nbsp;|&nbsp; <a href="#" class="hover:underline">Privacy</a> &nbsp;|&nbsp; <a href="#" class="hover:underline">Legal</a> &nbsp;|&nbsp; <a href="#" class="hover:underline">Terms of Service</a>
  </footer>
</div>
