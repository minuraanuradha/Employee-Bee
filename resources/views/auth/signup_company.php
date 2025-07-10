<?php if (!isset($title)) $title = "Sign Up - Company"; ?>
<main class="min-h-screen w-full flex items-center justify-center bg-black text-white px-4">
  <div class="bg-[#111111] p-8 rounded-2xl shadow-md w-full max-w-xl">
    <h1 class="text-h2 text-center mb-2">Company Sign Up</h1>
    <p class="text-p-regular text-center text-lightgray mb-6">
      Manage employee records securely with blockchain.
    </p>

    <form method="POST" action="?path=signup/company" class="space-y-5">
      <div>
        <label for="companyName" class="block text-p-small mb-1 text-lightgray">Company Name</label>
        <input type="text" id="companyName" name="companyName" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="e.g., Lvra Global (Pvt) Ltd">
      </div>

      <div>
        <label for="email" class="block text-p-small mb-1 text-lightgray">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="Company contact email">
      </div>

      <div>
        <label for="password" class="block text-p-small mb-1 text-lightgray">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="Secure password">
      </div>

      <div class="flex space-x-4">
        <div class="w-1/2">
          <label for="industry" class="block text-p-small mb-1 text-lightgray">Industry</label>
          <input type="text" id="industry" name="industry"
                 class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
                 placeholder="e.g., Finance">
        </div>
        <div class="w-1/2">
          <label for="location" class="block text-p-small mb-1 text-lightgray">Location</label>
          <input type="text" id="location" name="location"
                 class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
                 placeholder="e.g., Colombo, SL">
        </div>
      </div>

      <div>
        <label for="contact_person" class="block text-p-small mb-1 text-lightgray">Contact Person</label>
        <input type="text" id="contact_person" name="contact_person"
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="e.g., Malith Senanayake">
      </div>

      <div>
        <label for="phone_number" class="block text-p-small mb-1 text-lightgray">Phone Number</label>
        <input type="text" id="phone_number" name="phone_number"
               class="w-full p-3 rounded-lg bg-zinc-900 text-white focus:ring-2 focus:ring-orange focus:outline-none"
               placeholder="e.g., +94 77 123 4567">
      </div>

      <button type="submit"
              class="w-full bg-orange hover:bg-orange-600 text-white py-3 rounded-full text-p-regular transition mt-2">
        Register Company →
      </button>
    </form>

    <p class="text-center text-p-small text-lightgray mt-6">
      Already registered?
      <a href="?path=login" class="text-orange underline hover:text-orange-300">Log in</a>
    </p>
  </div>
</main>
