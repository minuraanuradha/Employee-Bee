<!--Company Profile-->

<div class="mx-auto  p-2">
    <div class="mb-4 pt-0">
        <h2 class="text-h5 text-orange ">Company Profile</h2>
        <p class="text-p-regular-new text-lightgray">View and manage your company profile and preferences.</p>
    </div>
    <!-- Profile Card -->
    <div class="bg-gradient-to-r from-orange/70 to-orange/20 rounded-xl shadow-xl p-4 flex flex-col md:flex-row items-start gap-8">
        <!-- Logo -->
        <div class="flex-shrink-0 flex flex-col items-center ">
            <?php 
            $logoPath = !empty($company['logo_path']) ? '/employee-bee/' . htmlspecialchars($company['logo_path']) : '/assets/images/Logo/Lgo.png';
            ?>
            <img src="<?= $logoPath ?>" alt="Company Logo" class="h-28 w-28 rounded-xl border-1.5 border-white shadow-xl bg-white" />
        </div>
        <!-- Info -->
        <div class="flex-1 w-full">
            <div class="flex flex-col md:flex-row md:items-end md:justify-right gap-2 mb-2">
                <div class="text-2xl font-bold text-white"><?= htmlspecialchars($company['company_name'] ?? 'No Name') ?></div>
                <div class="text-gray-300 text-xs "><span class="text-p-regular-new text-lightgray ">( <?= htmlspecialchars($company['industry'] ?? 'N/A') ?> )</span></div>
            </div>
            <div class="text-p-regular-new text-lightgray"><?= htmlspecialchars($company['description'] ?? 'No description') ?></div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
        <!-- Company Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Company Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Company Name:</span>
                    <span class="text-p-regular-new text-white "><?= htmlspecialchars($company['company_name'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Industry:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['industry'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Location:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['location'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Contact Email:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['email'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Phone:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['phone_number'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Website:</span>
                    <?php if (!empty($company['website_url'])): ?>
                        <a href="<?= htmlspecialchars($company['website_url']) ?>" 
                        class="text-p-regular-new text-orange/50 font-medium cursor-pointer hover:text-orange hover:underline"
                        target="_blank" rel="noopener noreferrer">
                            <?= htmlspecialchars($company['website_url']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-p-regular-new text-orange/50 font-medium cursor-pointer">N/A</span>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">LinkedIn:</span>
                    <?php if (!empty($company['linkedin_url'])): ?>
                        <a href="<?= htmlspecialchars($company['linkedin_url']) ?>" 
                        class="text-p-regular-new  text-orange/50 font-medium cursor-pointer hover:text-orange hover:underline" 
                        target="_blank" rel="noopener noreferrer">
                            <?= htmlspecialchars($company['linkedin_url']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-p-regular text-orange font-medium cursor-pointer">N/A</span>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Contact Person:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['contact_person'] ?? 'N/A') ?></span>
                </div>
            </div>
        </div>
        <!-- Registration & Verification -->
        <div class="space-y-4 flex flex-col">
            <div class="bg-black/40 rounded-lg p-6 shadow">
                <h3 class="text-h5 text-orange mb-4">Registration & Verification</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-p-regular-new text-lightgray">Registration No.:</span>
                        <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['business_registration_number'] ?? 'N/A') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular-new text-lightgray">Founded:</span>
                        <span class="text-p-regular text-white font-medium">N/A</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular-new text-lightgray">Company Size:</span>
                        <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($company['company_size'] ?? 'N/A') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular-new text-lightgray">Blockchain Verified:</span>
                        <span class="text-green-400 font-medium">N/A</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- Preferences (static for now) -->
        <!--<div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Preferences</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">Email Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">SMS Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">Two-Factor Auth:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
            </div>
        </div>-->
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 mt-4">
        <!-- Registration & Verification -->
        <div class="space-y-4 flex flex-col">

            <!-- About Company -->
            <div class="bg-black/40 rounded-lg p-6 shadow lg:col-span-2">
                <h3 class="text-h5 text-orange mb-4">About Company</h3>
                <div class="text-p-regular-new text-lightgray/80"><?= htmlspecialchars($company['description'] ?? 'No description') ?></div>
            </div>
        </div>
        <!-- Preferences (static for now) -->
        <!--<div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Preferences</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">Email Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">SMS Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular text-lightgray">Two-Factor Auth:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
            </div>
        </div> -->
    </div>
    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4 mt-6">
        <!--<a href="?path=company" class="btn-3">Back to Dashboard</a>-->
        <a href="?path=company/edit-profile" class="btn-1">Edit Profile</a>
    </div>
</div>
