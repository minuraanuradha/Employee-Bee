<div class="p-6 bg- min-h-screen rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-h3 text-white mb-2">My Profile</h1>
        <p class="text-p-regular text-lightgray">Manage your personal information and preferences</p>
    </div>

    <!-- Profile Header -->
    <div class="bg-gradient-to-r from-orange to-orange/80 rounded-xl p-4 mb-6 text-white shadow-lg">
        <div class="flex items-center space-x-4">
            <div class="h-20 w-20 rounded-xl border-2 border-white shadow">
                <span class="text-2xl font-bold text-white">
                    <?= substr($_SESSION['username'] ?? 'U', 0, 1) ?>
                </span>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-white mb-2"><?= $_SESSION['full-name'] ?? 'Employee' ?></h2>
                <p class="text-lightgray text-sm mb-1">Employee ID: <span class="text-white font-medium"> <?= $user_id ?? 'N/A' ?></span></p>
                <p class="text-lightgray text-sm mb-1">Role: <span class="text-white font-medium"> <?= ucfirst($user_role ?? 'Employee') ?></span></p>
            </div>
        </div>
    </div>

    <!-- Profile Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Personal Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Full Name:</span>
                    <span class="text-p-regular text-white font-medium">John Doe</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Email:</span>
                    <span class="text-p-regular text-white font-medium">john.doe@example.com</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Phone:</span>
                    <span class="text-p-regular text-white font-medium">+1 (555) 123-4567</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Location:</span>
                    <span class="text-p-regular text-white font-medium">New York, NY</span>
                </div>
            </div>
            <button class="btn-1 mt-4">Edit Information</button>
        </div>

        <!-- Employment Details -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Employment Details</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Position:</span>
                    <span class="text-p-regular text-white font-medium">Software Developer</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Department:</span>
                    <span class="text-p-regular text-white font-medium">Engineering</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Start Date:</span>
                    <span class="text-p-regular text-white font-medium">January 15, 2023</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-p-regular text-lightgray">Status:</span>
                    <span class="text-green-400 font-medium">Active</span>
                </div>
            </div>
        </div>

        <!-- Skills & Certifications -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h3 class="text-h5 text-orange mb-4">Skills & Certifications</h3>
            <div class="space-y-3">
                <div>
                    <span class="text-p-regular text-lightgray">Skills:</span>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="bg-orange text-white px-3 py-1 rounded-full text-xs">JavaScript</span>
                        <span class="bg-orange text-white px-3 py-1 rounded-full text-xs">React</span>
                        <span class="bg-orange text-white px-3 py-1 rounded-full text-xs">Node.js</span>
                        <span class="bg-orange text-white px-3 py-1 rounded-full text-xs">PHP</span>
                    </div>
                </div>
                <div>
                    <span class="text-p-regular text-lightgray">Certifications:</span>
                    <div class="mt-2 space-y-1">
                        <div class="text-p-regular text-white">• AWS Certified Developer</div>
                        <div class="text-p-regular text-white">• Google Cloud Professional</div>
                    </div>
                </div>
            </div>
            <button class="btn-2 mt-4">Add Skills</button>
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
        <button class="btn-3">Cancel</button>
        <button class="btn-1">Save Changes</button>
    </div>
</div> 