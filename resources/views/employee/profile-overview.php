<div class="mx-auto p-4">
    <div class="mb-4">
        <h2 class="text-h5 text-orange ">Employee Profile</h2>
        <p class="text-p-regular text-lightgray">View and manage your personal information and preferences.</p>
    </div>

    <!-- Profile Card -->
    <div class="bg-gradient-to-r from-orange to-orange/80 rounded-xl shadow-xl p-6 flex flex-col md:flex-row items-center gap-8">
        <!-- Profile Picture -->
        <div class="flex-shrink-0 flex flex-col items-center">
            <?php 
            $profilePicPath = !empty($employee['profile_picture']) ? '/employee-bee/' . htmlspecialchars($employee['profile_picture']) : '/assets/images/Logo/Lgo.png';
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="h-28 w-28 rounded-xl border-2 border-white shadow" />
        </div>
        <!-- Info -->
        <div class="flex-1 w-full">
            <div class="flex flex-col md:flex-col md:items-s md:justify-between gap-2 mb-2">
                <div class="text-2xl font-bold text-white"><?= htmlspecialchars($employee['full_name'] ?? 'No Name') ?></div>
                <div class="text-gray-300 text-xs mb-2"><?= htmlspecialchars($employee['unique_id'] ?? 'No ID') ?></div>
            </div>
            <div class="text-lightgray text-sm mb-1">Position: <span class="font-semibold text-white"><?= htmlspecialchars($employee['position'] ?? 'Employee') ?></span></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Personal Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Personal Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Full Name:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['full_name'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Email:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['email'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Phone:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['phone_number'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Location:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['location'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Country:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['country'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Birth Date:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['birthdate'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">NIC/National ID:</span>
                    <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['nic_or_national_id'] ?? 'N/A') ?></span>
                </div>
            </div>
            <a href="?path=employee/edit-profile" class="btn-1 mt-4 inline-block">Edit Information</a>
        </div>

        <!-- Professional Information -->
        <div class="space-y-6 flex flex-col">
            <div class="bg-black/40 rounded-lg p-6 shadow">
                <h3 class="text-h5 text-orange mb-4">Professional Information</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-p-regular text-lightgray">Employee ID:</span>
                        <span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['unique_id'] ?? 'N/A') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular text-lightgray">LinkedIn:</span>
                        <span class="text-p-regular text-orange font-medium"><?= htmlspecialchars($employee['linkedin_url'] ?? 'N/A') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular text-lightgray">Portfolio:</span>
                        <span class="text-p-regular text-orange font-medium"><?= htmlspecialchars($employee['portfolio_url'] ?? 'N/A') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-p-regular text-lightgray">Resume:</span>
                        <span class="text-p-regular text-orange font-medium"><?= htmlspecialchars($employee['resume_path'] ?? 'N/A') ?></span>
                    </div>
                </div>
            </div>

            <!-- Skills & Education -->
            <div class="bg-black/40 rounded-lg p-6 shadow">
                <h3 class="text-h5 text-orange mb-4">Skills & Education</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-p-regular text-lightgray">Skills:</span>
                        <div class="flex flex-wrap gap-2 mt-2">
                            <?php 
                            $skills = $employee['skills'] ? json_decode($employee['skills'], true) : [];
                            if (!empty($skills)) {
                                foreach ($skills as $skill) {
                                    echo '<span class="bg-orange text-white px-3 py-1 rounded-full text-xs">' . htmlspecialchars($skill) . '</span>';
                                }
                            } else {
                                echo '<span class="text-gray-500 text-sm">No skills listed</span>';
                            }
                            ?>
                        </div>
                    </div>
                    <div>
                        <span class="text-p-regular text-lightgray">Education:</span>
                        <div class="mt-2">
                            <?php 
                            $education = $employee['education'] ? json_decode($employee['education'], true) : [];
                            if (!empty($education)) {
                                foreach ($education as $edu) {
                                    echo '<div class="text-p-regular text-white">• ' . htmlspecialchars($edu) . '</div>';
                                }
                            } else {
                                echo '<div class="text-gray-500 text-sm">No education listed</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferences -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
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
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4 mt-6">
        <a href="?path=employee" class="btn-3">Back to Dashboard</a>
        <a href="?path=employee/edit-profile" class="btn-1">Edit Profile</a>
    </div>
</div> 