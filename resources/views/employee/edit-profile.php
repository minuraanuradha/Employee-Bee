<div class="mx-auto p-4">
    <div class="mb-6">
        <h2 class="text-h5 text-orange mb-2">Edit Employee Profile</h2>
        <p class="text-p-regular text-lightgray">Update your personal information and preferences.</p>
    </div>

    <form method="POST" action="?path=employee/updateProfile" enctype="multipart/form-data" class="space-y-6">
        <!-- Personal Information Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Personal Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Full Name *</label>
                    <input 
                        type="text" 
                        name="full_name" 
                        value="<?= htmlspecialchars($employee['full_name'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                        required
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Email *</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="<?= htmlspecialchars($employee['email'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                        required
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Phone Number</label>
                    <input 
                        type="tel" 
                        name="phone_number" 
                        value="<?= htmlspecialchars($employee['phone_number'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Location</label>
                    <input 
                        type="text" 
                        name="location" 
                        value="<?= htmlspecialchars($employee['location'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Country</label>
                    <select 
                        name="country" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                        <option value="SL" <?= ($employee['country'] ?? '') === 'SL' ? 'selected' : '' ?>>Sri Lanka</option>
                        <option value="US" <?= ($employee['country'] ?? '') === 'US' ? 'selected' : '' ?>>United States</option>
                        <option value="UK" <?= ($employee['country'] ?? '') === 'UK' ? 'selected' : '' ?>>United Kingdom</option>
                        <option value="CA" <?= ($employee['country'] ?? '') === 'CA' ? 'selected' : '' ?>>Canada</option>
                        <option value="AU" <?= ($employee['country'] ?? '') === 'AU' ? 'selected' : '' ?>>Australia</option>
                        <option value="IN" <?= ($employee['country'] ?? '') === 'IN' ? 'selected' : '' ?>>India</option>
                        <option value="DE" <?= ($employee['country'] ?? '') === 'DE' ? 'selected' : '' ?>>Germany</option>
                        <option value="FR" <?= ($employee['country'] ?? '') === 'FR' ? 'selected' : '' ?>>France</option>
                        <option value="JP" <?= ($employee['country'] ?? '') === 'JP' ? 'selected' : '' ?>>Japan</option>
                        <option value="SG" <?= ($employee['country'] ?? '') === 'SG' ? 'selected' : '' ?>>Singapore</option>
                    </select>
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Birth Date</label>
                    <input 
                        type="date" 
                        name="birthdate" 
                        value="<?= htmlspecialchars($employee['birthdate'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">NIC/National ID</label>
                    <input 
                        type="text" 
                        name="nic_or_national_id" 
                        value="<?= htmlspecialchars($employee['nic_or_national_id'] ?? '') ?>" 
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
            </div>
        </div>

        <!-- Professional Information Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Professional Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">LinkedIn URL</label>
                    <input 
                        type="url" 
                        name="linkedin_url" 
                        value="<?= htmlspecialchars($employee['linkedin_url'] ?? '') ?>" 
                        placeholder="https://linkedin.com/in/yourprofile"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Portfolio URL</label>
                    <input 
                        type="url" 
                        name="portfolio_url" 
                        value="<?= htmlspecialchars($employee['portfolio_url'] ?? '') ?>" 
                        placeholder="https://yourportfolio.com"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none"
                    >
                </div>
            </div>
        </div>

        <!-- Skills & Education Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Skills & Education</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Skills (comma separated)</label>
                    <textarea 
                        name="skills" 
                        rows="4"
                        placeholder="JavaScript, React, Node.js, PHP, Python..."
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none resize-none"
                    ><?= htmlspecialchars($employee['skills'] ?? '') ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Enter skills separated by commas</p>
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray mb-2">Education (one per line)</label>
                    <textarea 
                        name="education" 
                        rows="4"
                        placeholder="Bachelor of Science in Computer Science&#10;Master of Business Administration&#10;Certification in AWS..."
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none resize-none"
                    ><?= htmlspecialchars($employee['education'] ?? '') ?></textarea>
                    <p class="text-xs text-gray-500 mt-1">Enter each education item on a new line</p>
                </div>
            </div>
        </div>

        <!-- Resume Upload Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Resume</h3>
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="block text-p-regular text-lightgray mb-2">Upload Resume (PDF)</label>
                    <input 
                        type="file" 
                        name="resume" 
                        accept=".pdf,.doc,.docx"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-orange file:text-white hover:file:bg-orange/80"
                    >
                    <p class="text-xs text-gray-500 mt-1">Max size: 5MB, Accepted formats: PDF, DOC, DOCX</p>
                </div>
                <?php if (!empty($employee['resume_path'])): ?>
                <div class="flex-shrink-0">
                    <span class="text-green-400 text-sm">✓ Resume uploaded</span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Profile Picture Upload Card -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Profile Picture</h3>
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0">
                    <img 
                        src="<?= !empty($employee['profile_picture']) ? '/employee-bee/' . htmlspecialchars($employee['profile_picture']) : '/assets/images/Logo/Lgo.png' ?>" 
                        alt="Current Profile Picture" 
                        class="h-20 w-20 rounded-lg border-2 border-gray-700"
                    />
                </div>
                <div class="flex-1">
                    <label class="block text-p-regular text-lightgray mb-2">Upload New Picture</label>
                    <input 
                        type="file" 
                        name="profile_picture" 
                        accept="image/*"
                        class="w-full rounded p-3 bg-black text-white border border-gray-700 focus:border-orange focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-orange file:text-white hover:file:bg-orange/80"
                    >
                    <p class="text-xs text-gray-500 mt-1">Recommended size: 200x200px, Max size: 2MB</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="?path=employee/profile" class="btn-3">Cancel</a>
            <button type="submit" class="btn-1">Save Changes</button>
        </div>
    </form>
</div>

<script>
// Form validation and character counter
document.addEventListener('DOMContentLoaded', function() {
    const skillsTextarea = document.querySelector('textarea[name="skills"]');
    const educationTextarea = document.querySelector('textarea[name="education"]');
    
    // Auto-format skills input
    if (skillsTextarea) {
        skillsTextarea.addEventListener('input', function() {
            // Remove extra spaces and format
            let value = this.value.replace(/\s*,\s*/g, ', ');
            this.value = value;
        });
    }
    
    // Auto-format education input
    if (educationTextarea) {
        educationTextarea.addEventListener('input', function() {
            // Remove empty lines and format
            let lines = this.value.split('\n').filter(line => line.trim() !== '');
            this.value = lines.join('\n');
        });
    }
});
</script> 