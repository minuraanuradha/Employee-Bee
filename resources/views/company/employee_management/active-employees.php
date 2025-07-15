<!-- Employee Management / Active Employees -->
<div class="max-w-5xl mx-auto mt-8">
    <div class="mb-4">
        <h2 class="text-h5 text-orange mb-1">Employee Management <span class="text-xs text-gray-400">/ Active Employees</span></h2>
        <p class="text-p-regular text-lightgray">View and manage all currently active employees in your company.</p>
    </div>
    <!-- Search Bar -->
    <div class="mb-4 flex flex-col sm:flex-row gap-2 items-center justify-between">
        <input type="text" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full sm:w-72" placeholder="Search employees by name, role, or department...">
        <button class="btn-1 px-6 py-2">Search</button>
    </div>
    <!-- Minimalist Table -->
    <div class="overflow-x-auto bg-black/40 rounded-lg shadow-lg">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-darkgray text-lightgray">
                <tr>
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Role</th>
                    <th class="px-4 py-3 font-medium">Department</th>
                    <th class="px-4 py-3 font-medium">Join Date</th>
                    <th class="px-4 py-3 font-medium">Time Period</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                <tr>
                    <td class="px-4 py-3 text-white">John Doe</td>
                    <td class="px-4 py-3 text-lightgray">Frontend Developer</td>
                    <td class="px-4 py-3 text-lightgray">Engineering</td>
                    <td class="px-4 py-3 text-lightgray">2022-01-15</td>
                    <td class="px-4 py-3 text-lightgray">2 years 3 months</td>
                    <td class="px-4 py-3"><span class="text-green-400 font-semibold">Active</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 text-white">Jane Smith</td>
                    <td class="px-4 py-3 text-lightgray">QA Engineer</td>
                    <td class="px-4 py-3 text-lightgray">Quality Assurance</td>
                    <td class="px-4 py-3 text-lightgray">2021-08-10</td>
                    <td class="px-4 py-3 text-lightgray">2 years 8 months</td>
                    <td class="px-4 py-3"><span class="text-green-400 font-semibold">Active</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 text-white">Anna Lee</td>
                    <td class="px-4 py-3 text-lightgray">UI/UX Designer</td>
                    <td class="px-4 py-3 text-lightgray">Design</td>
                    <td class="px-4 py-3 text-lightgray">2023-03-01</td>
                    <td class="px-4 py-3 text-lightgray">1 year 1 month</td>
                    <td class="px-4 py-3"><span class="text-green-400 font-semibold">Active</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
