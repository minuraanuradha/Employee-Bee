<?php if (!isset($title)) $title = "Sign Up - Employee"; ?>
<main class="min-h-screen w-full flex items-center justify-center bg-black text-white px-4">
  <div class="bg-[#111111] p-8 rounded-2xl shadow-md w-full max-w-xl">
    <h1 class="text-h2 text-center mb-2">Employee Sign Up</h1>
    <p class="text-p-regular text-center text-lightgray mb-6">
      Start building your verified career profile today.
    </p>

    <form method="POST" action="?path=signup/employee" class="space-y-5">
      <div>
        <label for="fullName" class="block text-p-small mb-1 text-lightgray">Full Name</label>
        <input type="text" id="fullName" name="fullName" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="e.g., Minura Jayasingha">
      </div>

      <div>
        <label for="email" class="block text-p-small mb-1 text-lightgray">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="e.g., you@email.com">
      </div>

      <div>
        <label for="password" class="block text-p-small mb-1 text-lightgray">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="Create a strong password">
      </div>

      <div>
        <label for="phone_number" class="block text-p-small mb-1 text-lightgray">Phone Number</label>
        <input type="text" id="phone_number" name="phone_number"
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="Optional">
      </div>

      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="current_job_title" class="block text-p-small mb-1 text-lightgray">Job Title</label>
          <input type="text" id="current_job_title" name="current_job_title"
                 class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
                 placeholder="e.g., UX Intern">
        </div>
        <div class="w-1/2">
          <label for="current_employer" class="block text-p-small mb-1 text-lightgray">Employer</label>
          <input type="text" id="current_employer" name="current_employer"
                 class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
                 placeholder="e.g., X-Venture">
        </div>
      </div>

      <button type="submit"
              class="w-full bg-orange hover:bg-orange-600 text-white py-3 rounded-full text-p-regular transition mt-2">
        Create My Account →
      </button>
    </form>

    <p class="text-center text-p-small text-lightgray mt-6">
      Already have an account?
      <a href="?path=login" class="text-orange underline hover:text-orange-300">Log in</a>
    </p>
  </div>
</main>
