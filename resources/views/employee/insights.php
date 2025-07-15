<?php
// Employee Career Insights Page
$user_id = $_SESSION['user_id'] ?? null;
?>

<div class="p-6 bg- min-h-screen rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-h3 text-white mb-2">Career Insights</h1>
        <p class="text-p-regular text-lightgray">Analytics and recommendations for your career growth</p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-r from-orange to-orange/80 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Career Growth</p>
                    <p class="text-2xl font-bold">+85%</p>
                </div>
                <div class="text-3xl opacity-60">📈</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-blue-600 to-blue-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Skill Level</p>
                    <p class="text-2xl font-bold">Expert</p>
                </div>
                <div class="text-3xl opacity-60">🎯</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-600 to-green-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Market Value</p>
                    <p class="text-2xl font-bold">$120K</p>
                </div>
                <div class="text-3xl opacity-60">💰</div>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Job Satisfaction</p>
                    <p class="text-2xl font-bold">9.2/10</p>
                </div>
                <div class="text-3xl opacity-60">😊</div>
            </div>
        </div>
    </div>

    <!-- Skills Analysis -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Skills Proficiency</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-p-regular text-white">JavaScript</span>
                        <span class="text-p-regular text-white font-medium">95%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-orange h-2 rounded-full" style="width: 95%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-p-regular text-white">React</span>
                        <span class="text-p-regular text-white font-medium">90%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-orange h-2 rounded-full" style="width: 90%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-p-regular text-white">Node.js</span>
                        <span class="text-p-regular text-white font-medium">85%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-orange h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-p-regular text-white">AWS</span>
                        <span class="text-p-regular text-white font-medium">80%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-orange h-2 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-p-regular text-white">Python</span>
                        <span class="text-p-regular text-white font-medium">75%</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="bg-orange h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-black/40 rounded-lg p-6 shadow">
            <h2 class="text-h4 text-orange mb-4">Career Growth Trends</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 bg-darkgray rounded-lg">
                    <div>
                        <p class="text-p-regular text-white font-medium">Salary Growth</p>
                        <p class="text-p-small text-lightgray">Last 3 years</p>
                    </div>
                    <div class="text-right">
                        <p class="text-green-400 font-bold">+45%</p>
                        <p class="text-p-small text-lightgray">$85K → $120K</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-darkgray rounded-lg">
                    <div>
                        <p class="text-p-regular text-white font-medium">Role Progression</p>
                        <p class="text-p-small text-lightgray">Career advancement</p>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-400 font-bold">+2 Levels</p>
                        <p class="text-p-small text-lightgray">Junior → Senior</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-darkgray rounded-lg">
                    <div>
                        <p class="text-p-regular text-white font-medium">Skills Acquired</p>
                        <p class="text-p-small text-lightgray">New technologies</p>
                    </div>
                    <div class="text-right">
                        <p class="text-purple-400 font-bold">+8 Skills</p>
                        <p class="text-p-small text-lightgray">Cloud, AI, ML</p>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 bg-darkgray rounded-lg">
                    <div>
                        <p class="text-p-regular text-white font-medium">Project Impact</p>
                        <p class="text-p-small text-lightgray">Success rate</p>
                    </div>
                    <div class="text-right">
                        <p class="text-orange font-bold">95%</p>
                        <p class="text-p-small text-lightgray">12/13 projects</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Recommendations -->
    <div class="mb-8">
        <h2 class="text-h4 text-orange mb-4">AI Career Recommendations</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-gradient-to-r from-blue-600 to-blue-900 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="text-3xl mr-3">🤖</div>
                    <h3 class="text-h5 font-semibold">Skill Development</h3>
                </div>
                <p class="text-p-regular mb-4">Based on market trends, consider learning:</p>
                <ul class="text-p-regular space-y-2">
                    <li>• Machine Learning</li>
                    <li>• Blockchain Development</li>
                    <li>• DevOps Practices</li>
                </ul>
                <button class="btn-2 mt-4 w-full">View Courses</button>
            </div>

            <div class="bg-gradient-to-r from-green-600 to-green-900 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="text-3xl mr-3">💼</div>
                    <h3 class="text-h5 font-semibold">Career Path</h3>
                </div>
                <p class="text-p-regular mb-4">Recommended next steps:</p>
                <ul class="text-p-regular space-y-2">
                    <li>• Lead Developer Role</li>
                    <li>• Technical Architect</li>
                    <li>• Engineering Manager</li>
                </ul>
                <button class="btn-2 mt-4 w-full">Explore Roles</button>
            </div>

            <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="text-3xl mr-3">📊</div>
                    <h3 class="text-h5 font-semibold">Market Analysis</h3>
                </div>
                <p class="text-p-regular mb-4">Current market insights:</p>
                <ul class="text-p-regular space-y-2">
                    <li>• High demand for React</li>
                    <li>• Cloud skills +25% salary</li>
                    <li>• Remote work opportunities</li>
                </ul>
                <button class="btn-2 mt-4 w-full">View Report</button>
            </div>
        </div>
    </div>

    <!-- Performance Analytics -->
    <div class="mb-8">
        <h2 class="text-h4 text-orange mb-4">Performance Analytics</h2>
        <div class="bg-black/40 rounded-lg p-6 shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-24 h-24 mx-auto mb-4 relative">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-700" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-orange" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="85, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-white">85%</span>
                        </div>
                    </div>
                    <h3 class="text-h5 text-white font-semibold">Overall Performance</h3>
                    <p class="text-p-regular text-lightgray">Excellent rating</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 mx-auto mb-4 relative">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-700" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-green-400" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="92, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-white">92%</span>
                        </div>
                    </div>
                    <h3 class="text-h5 text-white font-semibold">Team Collaboration</h3>
                    <p class="text-p-regular text-lightgray">Outstanding</p>
                </div>

                <div class="text-center">
                    <div class="w-24 h-24 mx-auto mb-4 relative">
                        <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-700" stroke="currentColor" stroke-width="2" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-blue-400" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="78, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-xl font-bold text-white">78%</span>
                        </div>
                    </div>
                    <h3 class="text-h5 text-white font-semibold">Innovation</h3>
                    <p class="text-p-regular text-lightgray">Good progress</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Items -->
    <div class="bg-gradient-to-r from-orange to-orange/80 rounded-lg p-6 text-white shadow-lg">
        <h2 class="text-h4 font-semibold mb-4">Recommended Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white/10 rounded-lg p-4 text-white">
                <h3 class="text-h5 font-semibold mb-2">Short Term (1-3 months)</h3>
                <ul class="text-p-regular space-y-1">
                    <li>• Complete AWS certification</li>
                    <li>• Lead a team project</li>
                    <li>• Attend 2 tech conferences</li>
                </ul>
            </div>
            <div class="bg-white/10 rounded-lg p-4 text-white">
                <h3 class="text-h5 font-semibold mb-2">Long Term (6-12 months)</h3>
                <ul class="text-p-regular space-y-1">
                    <li>• Apply for Lead Developer role</li>
                    <li>• Learn Machine Learning</li>
                    <li>• Build open-source project</li>
                </ul>
            </div>
        </div>
        <button class="btn-2 mt-4">Create Action Plan</button>
    </div>
</div> 