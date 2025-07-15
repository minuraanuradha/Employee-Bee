<!-- Employee Management / Inactive Employees -->
<div class="max-w-5xl mx-auto mt-8">
    <div class="mb-4">
        <h2 class="text-h5 text-orange mb-1">Employee Management <span class="text-xs text-gray-400">/ Inactive Employees</span></h2>
        <p class="text-p-regular text-lightgray">View all employees who are no longer active in your company.</p>
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
                    <th class="px-4 py-3 font-medium">Last Day</th>
                    <th class="px-4 py-3 font-medium">Time Period</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                <tr>
                    <td class="px-4 py-3 text-white">Michael Brown</td>
                    <td class="px-4 py-3 text-lightgray">Backend Developer</td>
                    <td class="px-4 py-3 text-lightgray">Engineering</td>
                    <td class="px-4 py-3 text-lightgray">2019-05-20</td>
                    <td class="px-4 py-3 text-lightgray">2023-01-15</td>
                    <td class="px-4 py-3 text-lightgray">3 years 7 months</td>
                    <td class="px-4 py-3"><span class="text-red-400 font-semibold">Inactive</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 text-white">Sara White</td>
                    <td class="px-4 py-3 text-lightgray">Project Manager</td>
                    <td class="px-4 py-3 text-lightgray">Management</td>
                    <td class="px-4 py-3 text-lightgray">2020-02-10</td>
                    <td class="px-4 py-3 text-lightgray">2022-03-01</td>
                    <td class="px-4 py-3 text-lightgray">2 years 1 month</td>
                    <td class="px-4 py-3"><span class="text-red-400 font-semibold">Inactive</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
                <tr>
                    <td class="px-4 py-3 text-white">David Kim</td>
                    <td class="px-4 py-3 text-lightgray">QA Engineer</td>
                    <td class="px-4 py-3 text-lightgray">Quality Assurance</td>
                    <td class="px-4 py-3 text-lightgray">2018-11-01</td>
                    <td class="px-4 py-3 text-lightgray">2021-12-20</td>
                    <td class="px-4 py-3 text-lightgray">4 years 2 months</td>
                    <td class="px-4 py-3"><span class="text-red-400 font-semibold">Inactive</span></td>
                    <td class="px-4 py-3"><button class="btn-3 text-xs">View Profile</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
