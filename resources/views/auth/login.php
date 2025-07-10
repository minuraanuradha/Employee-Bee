<?php if (!isset($title)) $title = "Login"; ?>
<main class="flex items-center justify-center min-h-screen bg-black px-4">
  <div class="bg-[#111111] text-white p-8 rounded-2xl shadow-md w-full max-w-md">
    <h1 class="text-h2 text-center mb-2">Welcome Back 👋</h1>
    <p class="text-p-regular text-center text-gray-400 mb-6">
      Log in to your Employee Bee account
    </p>

    <form method="POST" action="?path=login" class="space-y-5">

      <div>
        <label for="email" class="block mb-1 text-sm text-gray-300">Email</label>
        <input type="email" name="email" id="email" required
          class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-orange-500"
          placeholder="e.g., you@example.com">
      </div>

      <div>
        <label for="password" class="block mb-1 text-sm text-gray-300">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:outline-none focus:ring-2 focus:ring-orange-500"
          placeholder="Enter your password">
      </div>

      <button type="submit"
        class="w-full mt-4 bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-full text-p-regular transition">
        Log In →
      </button>
    </form>

    <p class="text-center text-sm text-gray-400 mt-6">
      New here?
      <a href="?path=signup" class="text-orange-400 underline hover:text-orange-300">Sign up now</a>
    </p>
  </div>
</main>
