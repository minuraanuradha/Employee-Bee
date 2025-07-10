<?php if (!isset($title)) $title = "Sign Up"; ?>
<main class="min-h-screen w-full flex items-center justify-center bg-black text-white px-4">
  <div class="bg-[#111111] p-8 rounded-2xl shadow-md w-full max-w-md text-center">
    <h1 class="text-h2 mb-3">Get Started</h1>
    <p class="text-p-regular text-lightgray mb-6">Choose your registration type below</p>

    <div class="space-y-4">
      <a href="?path=signup/employee"
         class="block w-full bg-orange hover:bg-orange-600 text-white p-3 rounded-full font-medium transition">
        I'm an Employee →
      </a>
      <a href="?path=signup/company"
         class="block w-full bg-darkgray hover:bg-zinc-700 text-white p-3 rounded-full font-medium transition">
        I'm a Company →
      </a>
    </div>

    <p class="text-p-small mt-6 text-lightgray">
      Already have an account?
      <a href="?path=login" class="text-orange underline hover:text-orange-300">Log in</a>
    </p>

    <p class="text-p-small mt-4 text-lightgray">
      © 2025 Employee Bee | <a href="#" class="underline">Privacy</a> | <a href="#" class="underline">Terms</a>
    </p>
  </div>
</main>
