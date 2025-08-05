<!-- Employee Management / Inactive Employees -->
<div class="mx-auto  p-2">
    <div class="mb-6 pt-0">
        <h2 class="text-h5 text-orange flex  items-center">Employee Management <span class="text-orange text-xs font-medium bg-orange/10 px-4 py-1  rounded-full ml-2">Inctive Employees</span></h2>
        <p class="text-p-regular text-lightgray">View all employees who are no longer active in your company.</p>
    </div>
    <!-- Search Bar -->
    <div class="mb-4 flex flex-col sm:flex-row gap-2 items-center justify-between">
        <div class="w-1/2 gap-2 flex">
            <input type="text" class="rounded-lg bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full  text-sm" placeholder="Search employees by name or role, ...">
            <button class="btn-1 px-6 py-2">Search</button>
        </div>

        <div>
            <div class="flex">
                <div class="glass-effect rounded-lg px-4 py-1 flex items-center justify-between border border-green-400 gap-2 hover-glow">
                    <div class="text-red-600 text-sm font-bold" id="total-inactive-employees">100</div>
                    <div class="text-lightgray text-xs">Inactive Members</div>
                </div>

            </div>
        </div>
    </div>
    <!-- Minimalist Table -->
    <div class="overflow-x-auto bg-black/40 rounded-lg shadow-lg">
        <table class="min-w-full text-left text-xs" >
            <thead class="bg-darkgray text-lightgray">
                <tr>
                    <th class="px-4 py-2 font-medium">Name</th>
                    <th class="px-4 py-2 font-medium">Role</th>
                    <th class="px-4 py-2 font-medium">Department</th>
                    <th class="px-4 py-2 font-medium">Join Date</th>
                    <th class="px-4 py-2 font-medium">Last Day</th>
                    <th class="px-4 py-2 font-medium">Time Period</th>
                    <th class="px-4 py-2 font-medium">Status</th>
                    <th class="px-4 py-2 font-medium">Action</th>
                </tr>
            </thead>
            <tbody id="inactive-employees-table" class="divide-y divide-gray-800">
                <!-- JavaScript will insert rows here -->
            </tbody>

        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    fetchEmployeeCounts();
});

function fetchEmployeeCounts() {
    // Fetch Inactive Employees
    fetch('/Employee-Bee/public/api/getemployees.php?action=inactive')
        .then(res => res.json())
        .then(data => {
            if (Array.isArray(data)) {
                document.getElementById("total-inactive-employees").textContent = data.length;
            } else {
                console.warn("Unexpected inactive employee data:", data);
                document.getElementById("total-inactive-employees").textContent = "0";
            }
        })
        .catch(err => {
            console.error("Inactive count error:", err);
            document.getElementById("total-inactive-employees").textContent = "0";
        });
}

document.addEventListener("DOMContentLoaded", function () {
    fetchInactiveEmployees();
});

function fetchInactiveEmployees() {
    fetch('/Employee-Bee/public/api/getemployees.php?action=inactive')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("inactive-employees-table");
            tbody.innerHTML = "";

            if (data.error) {
                tbody.innerHTML = `<tr><td colspan="8" class="px-4 py-3 text-red-500">${data.error}</td></tr>`;
                return;
            }

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="8" class="px-4 py-3 text-gray-400">No inactive employees found.</td></tr>`;
                return;
            }

            data.forEach(emp => {
                const timePeriod = `${emp.start_date} to ${emp.end_date}`;
                const row = `
                    <tr>
                        <td class="px-4 py-2 text-white">${emp.full_name}</td>
                        <td class="px-4 py-2 text-lightgray">${emp.role_title}</td>
                        <td class="px-4 py-2 text-lightgray">${emp.department || '–'}</td>
                        <td class="px-4 py-2 text-lightgray">${emp.start_date}</td>
                        <td class="px-4 py-2 text-lightgray">${emp.end_date}</td>
                        <td class="px-4 py-2 text-lightgray">${timePeriod}</td>
                        <td class="px-4 py-2 text-red-600 font-semibold capitalize ">${emp.status}</td>
                        <td class="px-4 py-2">
                            <button class="border border-gray-700 border-1 rounded-lg text-xs px-4 py-0.5 text-white ">View</button>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML("beforeend", row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>
<style>
    .gradient-border {
        background: linear-gradient(90deg, #F97316, #EF4444);
        padding: 1px;
        border-radius: 12px;
    }

    .gradient-border-inner {
        background: #0A0A0A;
        border-radius: 11px;
    }

    .glass-effect {
        background: rgba(186, 9, 0, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(186, 9, 0, 0.4);
    }

    .hover-glow:hover {
        box-shadow: 0 0 8px rgba(186, 9, 0, 0.1);
        transform: translateY(-1px);
        transition: all 0.3s ease;
    }

    .status-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>



