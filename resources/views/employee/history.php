<?php
// Employee History Page
$user_id = $_SESSION['user_id'] ?? null;
?>

<div class="p-6 bg- min-h-screen rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-h3 text-white mb-2">Employee History</h1>
        <p class="text-p-regular text-lightgray">View your complete employment history and project timeline</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-r from-orange to-orange/80 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Experience</p>
                    <p class="text-2xl font-bold">3.5 Years</p>
                </div>
                <div class="text-3xl opacity-60">📅</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-blue-600 to-blue-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Projects Completed</p>
                    <p class="text-2xl font-bold">12</p>
                </div>
                <div class="text-3xl opacity-60">📊</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Companies Worked</p>
                    <p class="text-2xl font-bold">3</p>
                </div>
                <div class="text-3xl opacity-60">🏢</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Skills Acquired</p>
                    <p class="text-2xl font-bold">8</p>
                </div>
                <div class="text-3xl opacity-60">🎯</div>
            </div>
        </div>
    </div>

    <!-- Timeline -->
    <div class="mb-8">
        <h2 class="text-h4 text-orange mb-4">Employment Timeline</h2>
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-orange/40"></div>
            
            <!-- Timeline Items -->
            <div class="space-y-6">
                <!-- Current Job -->
                <div class="relative flex items-start">
                    <div class="absolute left-2 w-4 h-4 bg-orange rounded-full border-4 border-darkgray shadow-md"></div>
                    <div class="ml-8 bg-black/40 rounded-lg p-4 flex-1 shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-h5 text-white font-semibold">Senior Software Developer</h3>
                            <span class="bg-green-700 text-white px-2 py-1 rounded-full text-xs">Current</span>
                        </div>
                        <p class="text-p-regular text-lightgray mb-2">TechCorp Inc.</p>
                        <p class="text-p-small text-gray-400">January 2023 - Present</p>
                        <div class="mt-3">
                            <h4 class="text-p-regular text-orange font-medium mb-2">Key Achievements:</h4>
                            <ul class="text-p-small text-lightgray space-y-1">
                                <li>• Led development of company's flagship product</li>
                                <li>• Mentored 5 junior developers</li>
                                <li>• Improved system performance by 40%</li>
                            </ul>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">React</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">Node.js</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">AWS</span>
                        </div>
                    </div>
                </div>

                <!-- Previous Job -->
                <div class="relative flex items-start">
                    <div class="absolute left-2 w-4 h-4 bg-gray-600 rounded-full border-4 border-darkgray shadow-md"></div>
                    <div class="ml-8 bg-black/40 rounded-lg p-4 flex-1 shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-h5 text-white font-semibold">Software Developer</h3>
                            <span class="bg-gray-700 text-white px-2 py-1 rounded-full text-xs">Completed</span>
                        </div>
                        <p class="text-p-regular text-lightgray mb-2">StartupXYZ</p>
                        <p class="text-p-small text-gray-400">March 2021 - December 2022</p>
                        <div class="mt-3">
                            <h4 class="text-p-regular text-orange font-medium mb-2">Key Achievements:</h4>
                            <ul class="text-p-small text-lightgray space-y-1">
                                <li>• Built MVP for mobile app with 10K+ users</li>
                                <li>• Implemented CI/CD pipeline</li>
                                <li>• Reduced bug reports by 60%</li>
                            </ul>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">JavaScript</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">React Native</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">Firebase</span>
                        </div>
                    </div>
                </div>

                <!-- First Job -->
                <div class="relative flex items-start">
                    <div class="absolute left-2 w-4 h-4 bg-gray-600 rounded-full border-4 border-darkgray shadow-md"></div>
                    <div class="ml-8 bg-black/40 rounded-lg p-4 flex-1 shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-h5 text-white font-semibold">Junior Developer</h3>
                            <span class="bg-gray-700 text-white px-2 py-1 rounded-full text-xs">Completed</span>
                        </div>
                        <p class="text-p-regular text-lightgray mb-2">WebSolutions Ltd.</p>
                        <p class="text-p-small text-gray-400">June 2020 - February 2021</p>
                        <div class="mt-3">
                            <h4 class="text-p-regular text-orange font-medium mb-2">Key Achievements:</h4>
                            <ul class="text-p-small text-lightgray space-y-1">
                                <li>• Developed 15+ client websites</li>
                                <li>• Learned modern web technologies</li>
                                <li>• Contributed to open-source projects</li>
                            </ul>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">HTML/CSS</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">JavaScript</span>
                            <span class="bg-orange text-white px-2 py-1 rounded text-xs">PHP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="mb-8">
        <h2 class="text-h4 text-orange mb-4">Recent Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-black/40 rounded-lg p-4 shadow">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-h5 text-white font-semibold">E-commerce Platform</h3>
                    <span class="bg-green-700 text-white px-2 py-1 rounded-full text-xs">Completed</span>
                </div>
                <p class="text-p-regular text-lightgray mb-3">Built a full-stack e-commerce solution with payment integration and admin dashboard.</p>
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">React</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">Node.js</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">Stripe</span>
                </div>
                <p class="text-p-small text-gray-400">Duration: 3 months</p>
            </div>

            <div class="bg-black/40 rounded-lg p-4 shadow">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-h5 text-white font-semibold">Mobile Banking App</h3>
                    <span class="bg-blue-700 text-white px-2 py-1 rounded-full text-xs">In Progress</span>
                </div>
                <p class="text-p-regular text-lightgray mb-3">Developing a secure mobile banking application with biometric authentication.</p>
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">React Native</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">Firebase</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">Biometrics</span>
                </div>
                <p class="text-p-small text-gray-400">Duration: 4 months (ongoing)</p>
            </div>

            <div class="bg-black/40 rounded-lg p-4 shadow">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-h5 text-white font-semibold">AI Chatbot</h3>
                    <span class="bg-green-700 text-white px-2 py-1 rounded-full text-xs">Completed</span>
                </div>
                <p class="text-p-regular text-lightgray mb-3">Created an intelligent chatbot for customer support using NLP and machine learning.</p>
                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">Python</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">TensorFlow</span>
                    <span class="bg-orange text-white px-2 py-1 rounded text-xs">NLP</span>
                </div>
                <p class="text-p-small text-gray-400">Duration: 2 months</p>
            </div>
        </div>
    </div>

    <!-- Blockchain Records -->
    <div>
        <h2 class="text-h4 text-orange mb-4">Blockchain Employment Records</h2>
        <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-6 text-white shadow-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-h5 font-semibold">Verified Employment History</h3>
                <div class="text-2xl">🔗</div>
            </div>
            <p class="text-p-regular mb-4">Your employment records are securely stored on the blockchain and verified by previous employers.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white/10 rounded-lg p-3 text-white">
                    <p class="text-sm opacity-80">Records Verified</p>
                    <p class="text-xl font-bold">3</p>
                </div>
                <div class="bg-white/10 rounded-lg p-3 text-white">
                    <p class="text-sm opacity-80">Total Experience</p>
                    <p class="text-xl font-bold">3.5 Years</p>
                </div>
                <div class="bg-white/10 rounded-lg p-3 text-white">
                    <p class="text-sm opacity-80">Last Updated</p>
                    <p class="text-xl font-bold">Today</p>
                </div>
            </div>
            <button class="btn-2 mt-4">View Blockchain Records</button>
        </div>
    </div>
</div> 