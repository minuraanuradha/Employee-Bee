<!--Employee Profile-->

<div class="mx-auto p-2">
    <div class="mb-4 pt-0">
        <h2 class="text-h5 text-orange ">Employee Profile</h2>
        <p class="text-p-regular-new text-lightgray">View and manage your personal information and preferences.</p>
    </div>
    <!-- Profile Card -->
    <div class="bg-gradient-to-r from-orange/70 to-orange/20 rounded-xl shadow-xl p-4 flex flex-col md:flex-row items-start gap-8">
        <!-- Profile Picture -->
        <div class="flex-shrink-0 flex flex-col items-center ">
            <?php 
            $profilePicPath = !empty($employee['profile_picture']) ? '/employee-bee/' . htmlspecialchars($employee['profile_picture']) : '/assets/images/Logo/Lgo.png';
            ?>
            <img src="<?= $profilePicPath ?>" alt="Profile Picture" class="h-28 w-28 rounded-xl border-1.5 border-white shadow-xl bg-white" />
        </div>
        <!-- Info -->
        <div class="flex-1 w-full">
            <div class="flex flex-col md:flex-col md:items-s md:justify-between gap-2 mb-2">
                <div class="text-2xl font-bold text-white"><?= htmlspecialchars($employee['full_name'] ?? 'No Name') ?></div>
                <div class="text-gray-300 text-xs mb-2"><span class="text-p-regular text-white font-medium"><?= htmlspecialchars($employee['unique_id'] ?? 'No ID') ?></span></div>
            </div>
            <div class="text-lightgray text-sm mb-1">Position: <span class="font-semibold text-white">  <?= htmlspecialchars($employee['position'] ?? 'Employee') ?></span></div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
        <!-- Personal Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Personal Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Full Name:</span>
                    <span class="text-p-regular-new text-white "><?= htmlspecialchars($employee['full_name'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Email:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['email'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Phone:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['phone_number'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Location:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['location'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Country:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['country'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">Birth Date:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['birthdate'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular-new text-lightgray">NIC/National ID:</span>
                    <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['nic_or_national_id'] ?? 'N/A') ?></span>
                </div>
            </div>
        </div>
        <!-- Professional Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow space-y-3 flex flex-col">
            <h3 class="text-h5 text-orange mb-4">Professional Information</h3>
            <div class="flex justify-between">
                <span class="text-p-regular-new text-lightgray">Employee ID:</span>
                <span class="text-p-regular-new text-white font-medium"><?= htmlspecialchars($employee['unique_id'] ?? 'N/A') ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-p-regular-new text-lightgray">LinkedIn:</span>
                <?php if (!empty($employee['linkedin_url'])): ?>
                    <a href="<?= htmlspecialchars($employee['linkedin_url']) ?>" 
                       class="text-p-regular-new text-orange/50 font-medium cursor-pointer hover:text-orange hover:underline" 
                       target="_blank" rel="noopener noreferrer">
                        <?= htmlspecialchars($employee['linkedin_url']) ?>
                    </a>
                <?php else: ?>
                    <span class="text-p-regular-new text-orange/50 font-medium cursor-pointer">N/A</span>
                <?php endif; ?>
            </div>
            <div class="flex justify-between">
                <span class="text-p-regular-new text-lightgray">Portfolio:</span>
                <?php if (!empty($employee['portfolio_url'])): ?>
                    <a href="<?= htmlspecialchars($employee['portfolio_url']) ?>" 
                       class="text-p-regular-new text-orange/50 font-medium cursor-pointer hover:text-orange hover:underline" 
                       target="_blank" rel="noopener noreferrer">
                        <?= htmlspecialchars($employee['portfolio_url']) ?>
                    </a>
                <?php else: ?>
                    <span class="text-p-regular-new text-orange/50 font-medium cursor-pointer">N/A</span>
                <?php endif; ?>
            </div>
            <div class="flex justify-between">
                <span class="text-p-regular-new text-lightgray">Resume:</span>
                <?php if (!empty($employee['resume_path'])): ?>
                    <div class="flex gap-2">
                        <a href="?path=employee/view-resume" 
                           class="flex items-center gap-1 text-white hover:text-orange transition-colors duration-200 p-1 border rounded-md hover:bg-white" 
                           target="_blank" rel="noopener noreferrer"
                           title="View Resume">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>

                        </a>
                        <a href="?path=employee/download-resume" 
                           class="flex items-center gap-1 text-white hover:text-orange transition-colors duration-200 p-1 border rounded-md hover:bg-white"
                           title="Download Resume">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>

                        </a>
                    </div>
                <?php else: ?>
                    <span class="text-p-regular-new text-orange/50 font-medium cursor-pointer">N/A</span>
                <?php endif; ?>
            </div>
        </div>
        <!-- Skills & Education -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Skills & Education</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-p-regular-new text-lightgray">Skills:</span>
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
                    <span class="text-p-regular-new text-lightgray">Education:</span>
                    <div class="mt-2">
                        <?php 
                        $education = $employee['education'] ? json_decode($employee['education'], true) : [];
                        if (!empty($education)) {
                            foreach ($education as $edu) {
                                echo '<div class="text-p-regular-new text-white">• ' . htmlspecialchars($edu) . '</div>';
                            }
                        } else {
                            echo '<div class="text-gray-500 text-sm">No education listed</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Preferences -->
        <!--<div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Preferences</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-p-regular-new text-lightgray">Email Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular-new text-lightgray">SMS Notifications:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-p-regular-new text-lightgray">Two-Factor Auth:</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
            </div>
        </div>-->
    </div>
    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4 mt-6">
        <!--<a href="?path=employee" class="btn-3">Back to Dashboard</a>-->
        <a href="?path=employee/edit-profile" class="btn-1">Edit Profile</a>
    </div>
</div> 