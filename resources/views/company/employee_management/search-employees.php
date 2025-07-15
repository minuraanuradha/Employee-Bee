<!-- Employee Management / Search & Add Employee -->
<div class="max-w-xl mx-auto mt-10">
    <div class="mb-6">
        <h2 class="text-h5 text-orange mb-1">Employee Management <span class="text-xs text-gray-400">/ Search & Add Employee</span></h2>
        <p class="text-p-regular text-lightgray">Onboard a new employee by searching their unique Employee ID (e.g., BEE-SL1452).</p>
    </div>
    <!-- Search by Unique ID -->
    <form class="flex gap-2 mb-8">
        <input type="text" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="Enter Employee Unique ID (e.g., BEE-SL1452)">
        <button class="btn-1 px-6 py-2">Search</button>
    </form>

    <!-- If employee found (placeholder) -->
    <div class="bg-black/40 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-full bg-darkgray flex items-center justify-center text-2xl font-bold text-orange">E</div>
            <div>
                <div class="text-lg font-semibold text-white">Emily Carter</div>
                <div class="text-sm text-gray-400">emily.carter@email.com</div>
                <div class="text-xs text-lightgray">Unique ID: <span class="text-white">BEE-SL1452</span></div>
            </div>
        </div>
        <form class="space-y-4">
            <div>
                <label class="block text-xs text-gray-400 mb-1">Assign Role / Job Title</label>
                <input type="text" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="e.g., Data Analyst">
            </div>
            <div>
                <label class="block text-xs text-gray-400 mb-1">Required Skills</label>
                <input type="text" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="e.g., SQL, Python, Excel">
                <div class="text-xs text-gray-500 mt-1">(Comma-separated or use tags in future)</div>
            </div>
            <div>
                <label class="block text-xs text-gray-400 mb-1">Date of Joining</label>
                <input type="date" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full">
            </div>
            <button class="btn-1 w-full mt-2">Add to Company</button>
        </form>
    </div>

    <!-- If employee not found (placeholder) -->
    <!--
    <div class="bg-black/40 rounded-lg shadow-lg p-6 text-center text-gray-400">
        <span>No employee found with that ID.</span>
    </div>
    -->

    <div class="text-xs text-gray-500 mt-4">* Only employees with a valid unique ID can be added. This process creates an official job record and relationship in your company.</div>
</div>
