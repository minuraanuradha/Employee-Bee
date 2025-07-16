<div class="mx-auto p-4">
    <div class="mb-6">
        <h2 class="text-h5 text-orange mb-2">Edit Company Profile</h2>
        <p class="text-p-regular text-lightgray">Update your company information and preferences.</p>
    </div>

    <form method="POST" action="?path=company/updateProfile" enctype="multipart/form-data" class="space-y-6">
        <!-- Company Information Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Company Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Company Name *</label>
                    <input 
                        type="text" 
                        name="company_name" 
                        value="<?= htmlspecialchars($company['company_name'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                        required
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Industry</label>
                    <input 
                        type="text" 
                        name="industry" 
                        value="<?= htmlspecialchars($company['industry'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Location</label>
                    <input 
                        type="text" 
                        name="location" 
                        value="<?= htmlspecialchars($company['location'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Company Size</label>
                    <select 
                        name="company_size" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                        <option value="">Select Size</option>
                        <option value="1-10" <?= ($company['company_size'] ?? '') === '1-10' ? 'selected' : '' ?>>1-10 employees</option>
                        <option value="11-50" <?= ($company['company_size'] ?? '') === '11-50' ? 'selected' : '' ?>>11-50 employees</option>
                        <option value="51-200" <?= ($company['company_size'] ?? '') === '51-200' ? 'selected' : '' ?>>51-200 employees</option>
                        <option value="201-500" <?= ($company['company_size'] ?? '') === '201-500' ? 'selected' : '' ?>>201-500 employees</option>
                        <option value="501-1000" <?= ($company['company_size'] ?? '') === '501-1000' ? 'selected' : '' ?>>501-1000 employees</option>
                        <option value="1000+" <?= ($company['company_size'] ?? '') === '1000+' ? 'selected' : '' ?>>1000+ employees</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contact Information Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Contact Email *</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="<?= htmlspecialchars($company['email'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                        required
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Phone Number</label>
                    <input 
                        type="tel" 
                        name="phone_number" 
                        value="<?= htmlspecialchars($company['phone_number'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Contact Person</label>
                    <input 
                        type="text" 
                        name="contact_person" 
                        value="<?= htmlspecialchars($company['contact_person'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Business Registration Number</label>
                    <input 
                        type="text" 
                        name="business_registration_number" 
                        value="<?= htmlspecialchars($company['business_registration_number'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
            </div>
        </div>

        <!-- Online Presence Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Online Presence</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Website URL</label>
                    <input 
                        type="url" 
                        name="website_url" 
                        value="<?= htmlspecialchars($company['website_url'] ?? '') ?>" 
                        placeholder="https://example.com"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">LinkedIn URL</label>
                    <input 
                        type="url" 
                        name="linkedin_url" 
                        value="<?= htmlspecialchars($company['linkedin_url'] ?? '') ?>" 
                        placeholder="https://linkedin.com/company/example"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
            </div>
        </div>

        <!-- About Company Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">About Company</h3>
            <div>
                <label class="block text-p-regular text-lightgray mb-2">Company Description</label>
                <textarea 
                    name="description" 
                    rows="6"
                    placeholder="Tell us about your company, mission, values, and what makes you unique..."
                    class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none resize-none"
                ><?= htmlspecialchars($company['description'] ?? '') ?></textarea>
                <p class="text-xs text-gray-500 mt-1">Maximum 1000 characters</p>
            </div>
        </div>

        <!-- Logo Upload Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Company Logo</h3>
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <img 
                        src="<?= !empty($company['logo_path']) ? '/employee-bee/' . htmlspecialchars($company['logo_path']) : '/assets/images/Logo/Lgo.png' ?>" 
                        alt="Current Logo" 
                        class="h-20 w-20 rounded-lg border-2 border-gray-700"
                    />
                </div>
                <div class="flex-1">
                    <label class="block text-p-regular text-lightgray mb-2">Upload New Logo</label>
                    <input 
                        type="file" 
                        name="logo" 
                        accept="image/*"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-orange file:text-white hover:file:bg-orange/80"
                    >
                    <p class="text-xs text-gray-500 mt-1">Recommended size: 200x200px, Max size: 2MB</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="?path=company/profile" class="btn-3">Cancel</a>
            <button type="submit" class="btn-1">Save Changes</button>
        </div>
    </form>
</div>

<script>
// Form validation and character counter
document.addEventListener('DOMContentLoaded', function() {
    const descriptionTextarea = document.querySelector('textarea[name="description"]');
    const charCounter = document.querySelector('.text-xs.text-gray-500.mt-1');
    
    if (descriptionTextarea && charCounter) {
        descriptionTextarea.addEventListener('input', function() {
            const remaining = 1000 - this.value.length;
            charCounter.textContent = `${remaining} characters remaining`;
            
            if (remaining < 0) {
                charCounter.classList.add('text-red-500');
                charCounter.classList.remove('text-gray-500');
            } else {
                charCounter.classList.remove('text-red-500');
                charCounter.classList.add('text-gray-500');
            }
        });
    }
});
</script> 