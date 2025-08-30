<?php
// Employee Settings Page
$user_id = $_SESSION['user_id'] ?? null;
?>

<div class="p-2 bg- min-h-screen rounded-lg shadow-md">
    <div class="mb-4 pt-0">
        <h1 class="text-h5 text-orange ">Settings</h1>
        <p class="text-p-regular-new text-lightgray">Manage your account settings and preferences</p>
    </div>

    <!-- Settings Navigation 
    <div class="flex space-x-1 mb-6 bg-black/40 rounded-lg p-1">
        <button class="flex-1 py-2 px-4 rounded-md bg-darkgray text-orange font-medium shadow-sm">Account</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Security</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Notifications</button>
        <button class="flex-1 py-2 px-4 rounded-md text-lightgray hover:bg-darkgray hover:text-orange transition-colors">Privacy</button>
    </div> -->

    <!-- Account Settings -->
    <div class="space-y-6">
        <!-- Profile Information 
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Profile Information</h2>
            <form class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-p-regular text-lightgray font-medium mb-2">First Name</label>
                        <input type="text" value="John" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-p-regular text-lightgray font-medium mb-2">Last Name</label>
                        <input type="text" value="Doe" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Email Address</label>
                    <input type="email" value="john.doe@example.com" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Phone Number</label>
                    <input type="tel" value="+1 (555) 123-4567" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Location</label>
                    <input type="text" value="New York, NY" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                </div>
                <div>
                    <label class="block text-p-regular text-lightgray font-medium mb-2">Bio</label>
                    <textarea rows="3" class="w-full px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">Experienced software developer with expertise in modern web technologies and cloud platforms.</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="btn-1">Save Changes</button>
                </div>
            </form>
        </div> -->

        <!-- Security Settings -->
        <div class="bg-black/40 rounded-lg p-6 shadow border border-white/10 ">
            <h2 class="text-h5 text-orange mb-4">Change Password</h2>
            <div class="space-y-4">
                <!--<div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Two-Factor Authentication</h3>
                        <p class="text-p-regular text-lightgray">Add an extra layer of security to your account</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Login Notifications</h3>
                        <p class="text-p-regular text-lightgray">Get notified when someone logs into your account</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Session Management</h3>
                        <p class="text-p-regular text-lightgray">Manage active sessions and devices</p>
                    </div>
                    <button class="btn-2">Manage Sessions</button>
                </div> -->

                <div class="">
                    <!--<h3 class="text-lg text-white font-bold mb-1">Change Password</h3>-->
                    <form class="space-y-3">
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">Current Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-black text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300">
                        </div>
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">New Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-black text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300">
                        </div>
                        <div>
                            <label class="block text-p-regular text-lightgray font-medium mb-1">Confirm New Password</label>
                            <input type="password" class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-black text-white text-sm placeholder-gray-400 focus:outline-none focus:border-orange transition-colors duration-300">
                        </div>
                        <button type="submit" class="btn-1">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Settings 
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Notification Preferences</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Email Notifications</h3>
                        <p class="text-p-regular text-lightgray">Receive updates via email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">SMS Notifications</h3>
                        <p class="text-p-regular text-lightgray">Receive updates via SMS</p>
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
                            <span class="text-p-regular text-white">Career opportunities and insights</span>
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
        </div> -->

        <!-- Privacy Settings -->
        <div class="bg-black/40 rounded-lg p-6 shadow border border-white/10">
            <h2 class="text-h5 text-orange mb-4">Privacy Settings</h2>
            <div class="space-y-4">
                <!--<div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Profile Visibility</h3>
                        <p class="text-p-regular text-lightgray">Control who can see your profile information</p>
                    </div>
                    <select class="px-3 py-2 border border-gray-700 rounded-md bg-darkgray text-white focus:outline-none focus:ring-2 focus:ring-orange focus:border-transparent">
                        <option>Public</option>
                        <option>Employers Only</option>
                        <option>Private</option>
                    </select>
                </div>

                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Employment History</h3>
                        <p class="text-p-regular text-lightgray">Show employment history to potential employers</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-4 bg-darkgray rounded-lg">
                    <div>
                        <h3 class="text-h5 text-white font-medium">Skills & Certifications</h3>
                        <p class="text-p-regular text-lightgray">Display skills and certifications on profile</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange"></div>
                    </label>
                </div>

                <div class="p-4 bg-darkgray rounded-lg">
                    <h3 class="text-h5 text-white font-medium mb-3">Data Export</h3>
                    <p class="text-p-regular text-lightgray mb-3">Download a copy of your data</p>
                    <button class="btn-2">Export My Data</button>
                </div> -->

                <div class="p-4 bg-black rounded-lg flex justify-between items-center">
                    <div>
                        <h3 class="text-lg text-white font-bold mb-1">Account Deletion</h3>
                        <p class="text-p-regular text-lightgray ">Permanently delete your account and all associated data</p>
                    </div>
                    <button class="bg-red-900/70 border border-red-700  text-white px-6 py-1 rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
</div> 