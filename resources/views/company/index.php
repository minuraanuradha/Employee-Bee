<!-- HERO / WELCOME SECTION -->
<div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
    <div class="flex items-center gap-4">
        <img src="/assets/images/Logo/Lgo.png" alt="Company Logo" class="h-14 w-14 rounded-full border-2 border-orange shadow" />
        <div>
            <div class="text-2xl font-bold text-orange">Welcome, Acme Corp!</div>
            <div class="text-lightgray text-sm">Here’s your company overview and latest activity.</div>
        </div>
    </div>
    <div class="flex gap-2 mt-4 md:mt-0">
        <button class="btn-1 flex items-center gap-1"><span>➕</span> Add Employee</button>
        <button class="btn-3 flex items-center gap-1"><span>⚙️</span> Settings</button>
        <button class="btn-3 flex items-center gap-1"><span>📄</span> Export</button>
    </div>
</div>

<!-- KEY METRICS ROW -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-black rounded-lg shadow-xl p-5 flex flex-col items-center">
        <div class="bg-orange/40 rounded-full p-2 mb-2"><svg class="h-6 w-6 text-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a4 4 0 0 0-3-3.87"/><path d="M9 20H4v-2a4 4 0 0 1 3-3.87"/><circle cx="12" cy="7" r="4"/></svg></div>
        <div class="text-2xl font-bold text-orange">128</div>
        <div class="text-lightgray text-xs">Total Employees</div>
    </div>
    <div class="bg-black rounded-lg shadow-xl p-5 flex flex-col items-center">
        <div class="bg-orange/40 rounded-full p-2 mb-2"><svg class="h-6 w-6 text-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20v-6"/><path d="M6 20v-4"/><path d="M18 20v-2"/></svg></div>
        <div class="text-2xl font-bold text-orange">7</div>
        <div class="text-lightgray text-xs">New Hires This Month</div>
    </div>
    <div class="bg-black rounded-lg shadow-xl p-5 flex flex-col items-center">
        <div class="bg-orange/40 rounded-full p-2 mb-2"><svg class="h-6 w-6 text-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/></svg></div>
        <div class="text-2xl font-bold text-orange">3</div>
        <div class="text-lightgray text-xs">Open Positions</div>
    </div>
    <div class="bg-black rounded-lg shadow-xl p-5 flex flex-col items-center">
        <div class="bg-orange/40 rounded-full p-2 mb-2"><svg class="h-6 w-6 text-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 17v-2a4 4 0 0 1 8 0v2"/><circle cx="12" cy="7" r="4"/></svg></div>
        <div class="text-2xl font-bold text-orange">94%</div>
        <div class="text-lightgray text-xs">Retention Rate</div>
    </div>
</div>

<!-- TRENDS & INSIGHTS + MOST COMMON ROLES -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Trends/Insights Chart Placeholder -->
    <div class="bg-darkgray rounded-lg shadow-xl p-6 col-span-1 lg:col-span-2 flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <div class="text-lg font-semibold text-orange">Employee Growth Trend</div>
            <button class="text-xs text-gray-400 hover:text-orange">View Details</button>
        </div>
        <div class="flex-1 flex items-center justify-center">
            <div class="w-full h-32 flex items-center justify-center text-gray-500 italic">[Chart Placeholder]</div>
        </div>
    </div>
    <!-- Most Common Roles -->
    <div class="bg-darkgray rounded-lg shadow-xl p-6 flex flex-col">
        <div class="text-lg font-semibold text-orange mb-4">Most Common Roles</div>
        <ul class="space-y-3">
            <li class="flex items-center justify-between">
                <span class="text-lightgray">Frontend Developer</span>
                <div class="flex items-center gap-2">
                    <div class="bg-orange h-2 rounded w-24"></div>
                    <span class="text-xs text-gray-400">12</span>
                </div>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-lightgray">Backend Developer</span>
                <div class="flex items-center gap-2">
                    <div class="bg-orange h-2 rounded w-20"></div>
                    <span class="text-xs text-gray-400">9</span>
                </div>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-lightgray">QA Engineer</span>
                <div class="flex items-center gap-2">
                    <div class="bg-orange h-2 rounded w-14"></div>
                    <span class="text-xs text-gray-400">6</span>
                </div>
            </li>
            <li class="flex items-center justify-between">
                <span class="text-lightgray">UI/UX Designer</span>
                <div class="flex items-center gap-2">
                    <div class="bg-orange h-2 rounded w-10"></div>
                    <span class="text-xs text-gray-400">4</span>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- RECENT ACTIVITY FEED & EXPORT/NOTIFICATION -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activity Feed -->
    <div class="bg-darkgray rounded-lg shadow-xl p-6 flex flex-col col-span-1 lg:col-span-2">
        <div class="text-lg font-semibold text-orange mb-4">Recent Activity</div>
        <ul class="space-y-3 text-sm text-lightgray">
            <li class="flex items-center gap-2"><span class="text-orange font-bold">+ John Doe</span> <span>was hired as Backend Developer</span></li>
            <li class="flex items-center gap-2"><span class="text-orange font-bold">- Jane Smith</span> <span>left the company</span></li>
            <li class="flex items-center gap-2"><span class="text-orange font-bold">+ New Policy</span> <span>uploaded by HR</span></li>
            <li class="flex items-center gap-2"><span class="text-orange font-bold">+ Anna Lee</span> <span>promoted to Team Lead</span></li>
        </ul>
    </div>
    <!-- Export & Notification Card -->
    <div class="bg-darkgray rounded-lg shadow-xl p-6 flex flex-col gap-6">
        <div>
            <div class="text-lg font-semibold text-orange mb-2">Quick Export</div>
            <div class="flex gap-3">
                <button class="btn-1 flex items-center gap-1"><span>📄</span> Export CSV</button>
                <button class="btn-3 flex items-center gap-1"><span>📄</span> Export PDF</button>
            </div>
        </div>
        <div>
            <div class="text-lg font-semibold text-orange mb-2">Send Notification</div>
            <form class="flex flex-col gap-2">
                <textarea class="rounded p-2 bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none" rows="2" placeholder="Type your message..."></textarea>
                <button class="btn-1 w-32 self-end">Send</button>
            </form>
            <div class="text-xs text-gray-500 mt-2">(Feature coming soon: send announcements to all employees)</div>
        </div>
    </div>
</div>