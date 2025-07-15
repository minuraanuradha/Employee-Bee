<!-- Company Settings Page -->
<div class="p-6 min-h-screen rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-h3 text-white mb-2">Settings</h1>
        <p class="text-p-regular text-lightgray">Manage your company account settings and preferences</p>
    </div>

    <!-- Settings Navigation -->
    <div class="flex space-x-1 mb-6 bg-black/40 rounded-lg p-1">
        <button class="flex-1 py-2 px-4 rounded-md bg-darkgray text-orange font-medium shadow-sm">Account</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Security</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Notifications</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Privacy</button>
    </div>

    <div class="space-y-6">
        <!-- Account Information -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Company Information</h2>
            <form class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-p-regular text-lightgray font-medium mb-2">Company Name</label>
                        <input type="text" value="Acme Corporation" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-p-regular text-lightgray font-medium mb-2">Contact Email</label>
                        <input type="email" value="info@acme.com" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Company Phone</label>
                    <input type="tel" value="+1 (555) 123-4567" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Location</label>
                    <input type="text" value="San Francisco, CA" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">About Company</label>
                    <textarea rows="3" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">Leading provider of innovative tech solutions for modern businesses.</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-1">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Security Settings -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Security Settings</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Two-Factor Authentication</h3>
                        <p class="text-p-regular text-lightgray">Add an extra layer of security to your company account</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-3">Change Password</h3>
                    <form class="space-y-3">
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">Current Password</label>
                            <input type="password" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">New Password</label>
                            <input type="password" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">Confirm New Password</label>
                            <input type="password" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                        </div>
                        <button type="submit" class="btn-1">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Preferences -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Notification Preferences</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Email Notifications</h3>
                        <p class="text-p-regular text-lightgray">Receive company updates via email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">SMS Notifications</h3>
                        <p class="text-p-regular text-lightgray">Receive company updates via SMS</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Push Notifications</h3>
                        <p class="text-p-regular text-lightgray">Receive browser push notifications</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>
                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-3">Notification Types</h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-3" checked>
                            <span class="text-p-regular text-white">Project updates and deadlines</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-3" checked>
                            <span class="text-p-regular text-white">Company announcements</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-3">
                            <span class="text-p-regular text-white">Marketing and promotional content</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="mr-3" checked>
                            <span class="text-p-regular text-white">Security alerts and account activity</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Privacy & Security -->
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Privacy & Security</h2>
            <div class="space-y-6">
                <!-- API Key Management -->
                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-2">API Key</h3>
                    <div class="flex items-center gap-2 mb-2">
                        <input type="text" readonly value="sk_live_1234abcd5678efgh" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white text-xs focus:outline-none">
                        <button class="btn-2 text-xs">Copy</button>
                        <button class="btn-3 text-xs">Regenerate</button>
                    </div>
                    <div class="text-xs text-gray-400">Keep your API key secure. Regenerate if you suspect compromise.</div>
                </div>
                <!-- Permissions -->
                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-2">Permissions</h3>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="accent-orange" checked>
                            <span class="text-p-regular text-white">Allow employee data export</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="accent-orange">
                            <span class="text-p-regular text-white">Allow third-party integrations</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="accent-orange" checked>
                            <span class="text-p-regular text-white">Enable blockchain verification</span>
                        </label>
                    </div>
                </div>
                <!-- Blockchain Settings -->
                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-2">Blockchain Settings</h3>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-p-regular text-white">Status:</span>
                            <span class="text-green-400 font-semibold">Enabled</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-p-regular text-white">Network:</span>
                            <span class="text-orange font-semibold">Ethereum Mainnet</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-p-regular text-white">Contract Address:</span>
                            <span class="text-xs text-gray-400">0x1234...abcd</span>
                        </div>
                    </div>
                    <button class="btn-3 mt-3">View on Blockchain Explorer</button>
                </div>
            </div>
        </div>
    </div>
</div>
