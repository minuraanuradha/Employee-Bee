<!-- Employee Management / Inactive Employees -->
<div class="mx-auto  p-2">
    <div class="mb-6 pt-0">
        <h2 class="text-h5 text-orange flex  items-center">Employee Management <span class="text-orange text-xs font-medium bg-orange/10 px-4 py-1  rounded-full ml-2">Inctive Employees</span></h2>
        <p class="text-p-regular text-lightgray">View all employees who are no longer active in your company.</p>
    </div>
    <!-- Search Bar -->
    <div class="mb-4 flex flex-col sm:flex-row gap-2 items-center justify-between">
        <div class="w-1/2 gap-2 flex">
            <input type="text" id="inactiveEmployeeSearch" class="rounded-lg bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full  text-sm" placeholder="Search employees by name or role, ...">
            <button id="inactiveSearchBtn" class="btn-1 px-6 py-2">Search</button>
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
    // Fetch employee counts
    fetchEmployeeCounts();

    // Fetch active and inactive employees
    fetchActiveEmployees();
    fetchInactiveEmployees();

    // Set up search functionality
    setupSearch('employeeSearch', 'searchBtn', 'active-employees-table');
    setupSearch('inactiveEmployeeSearch', 'inactiveSearchBtn', 'inactive-employees-table');

    // Set up modal event listeners
    setupModalListeners();
});

function fetchEmployeeCounts() {
    // Fetch Active Employees count
    fetch('/Employee-Bee/public/api/getemployees.php?action=active')
        .then(res => res.json())
        .then(data => {
            document.getElementById("total-active-employees").textContent = Array.isArray(data) ? data.length : 0;
        })
        .catch(err => {
            console.error("Active count error:", err);
            document.getElementById("total-active-employees").textContent = "0";
        });

    // Fetch Inactive Employees count
    fetch('/Employee-Bee/public/api/getemployees.php?action=inactive')
        .then(res => res.json())
        .then(data => {
            document.getElementById("total-inactive-employees").textContent = Array.isArray(data) ? data.length : 0;
        })
        .catch(err => {
            console.error("Inactive count error:", err);
            document.getElementById("total-inactive-employees").textContent = "0";
        });
}

function fetchActiveEmployees() {
    fetch('/Employee-Bee/public/api/getemployees.php?action=active')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("active-employees-table");
            tbody.innerHTML = "";
            if (!Array.isArray(data) || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-lightgray py-4">No active employees found.</td></tr>`;
                return;
            }
            data.forEach(emp => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="px-4 py-2 text-white">${emp.full_name || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${emp.role_title || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${emp.start_date || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${getTimePeriod(emp.start_date, emp.end_date)}</td>
                    <td class="px-4 py-2"><span class="text-green-400 font-semibold capitalize">${emp.status || 'N/A'}</span></td>
                    <td class="px-4 py-2"><button class="border border-gray-700 rounded-lg text-xs px-4 py-0.5 text-white view-employee-btn" data-employee='${encodeURIComponent(JSON.stringify(emp))}'>View</button></td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error("Fetch active employees error:", error));
}

function fetchInactiveEmployees() {
    fetch('/Employee-Bee/public/api/getemployees.php?action=inactive')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("inactive-employees-table");
            tbody.innerHTML = "";
            if (data.error || !Array.isArray(data) || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center text-lightgray py-4">${data.error || "No inactive employees found."}</td></tr>`;
                return;
            }
            data.forEach(emp => {
                const timePeriod = `${emp.start_date || 'N/A'} to ${emp.end_date || 'N/A'}`;
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="px-4 py-2 text-white">${emp.full_name || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${emp.role_title || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${emp.start_date || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${emp.end_date || 'N/A'}</td>
                    <td class="px-4 py-2 text-lightgray">${timePeriod}</td>
                    <td class="px-4 py-2"><span class="text-red-600 font-semibold capitalize">${emp.status || 'N/A'}</span></td>
                    <td class="px-4 py-2"><button class="border border-gray-700 rounded-lg text-xs px-4 py-0.5 text-white view-employee-btn" data-employee='${encodeURIComponent(JSON.stringify(emp))}'>View</button></td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error("Fetch inactive employees error:", error));
}

function getTimePeriod(start, end) {
    const startDate = new Date(start);
    const endDate = end ? new Date(end) : new Date();
    if (isNaN(startDate)) return "N/A";
    const years = endDate.getFullYear() - startDate.getFullYear();
    const months = endDate.getMonth() - startDate.getMonth();
    const totalMonths = years * 12 + months;
    const y = Math.floor(totalMonths / 12);
    const m = totalMonths % 12;
    return `${y} year${y !== 1 ? 's' : ''} ${m} month${m !== 1 ? 's' : ''}`;
}

function setupSearch(inputId, buttonId, tableId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    if (!input || !button) return;

    const search = () => {
        const searchTerm = input.value.toLowerCase();
        const rows = document.querySelectorAll(`#${tableId} tr`);
        rows.forEach(row => {
            const nameCell = row.cells[0]?.textContent.toLowerCase() || '';
            const roleCell = row.cells[1]?.textContent.toLowerCase() || '';
            row.style.display = nameCell.includes(searchTerm) || roleCell.includes(searchTerm) ? '' : 'none';
        });
    };

    button.addEventListener('click', search);
    input.addEventListener('keyup', (event) => {
        if (event.key === 'Enter') search();
    });
}

function setupModalListeners() {
    let currentModal = null;

    // Create modal once
    function createModal() {
        let modal = document.getElementById('employee-modal-inactive');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'employee-modal-inactive';
            modal.className = 'employee-modal-inactive ';
            modal.innerHTML = `
                <div class="employee-modal-content ">
                    <div class="employee-modal-header">
                        <h3 class="text-h5 text-white">Employee Details</h3>
                        <button class="close-modal">&times;</button>
                    </div>
                    <div class="employee-modal-body" id="modal-body"></div>
                </div>
            `;
            document.body.appendChild(modal);
        }
        return modal;
    }

    // Show modal with employee data
    function showModal(employee) {
        const modal = createModal();
        const modalBody = modal.querySelector('#modal-body');
        const isInactive = employee.end_date && employee.status.toLowerCase() === 'inactive';
        modalBody.innerHTML = `
            <div class="employee-detail-row">
                <div class="employee-detail-label text-sm">Full Name</div>
                <div class="employee-detail-value text-sm">${employee.full_name || 'N/A'}</div>
            </div>
            <div class="employee-detail-row">
                <div class="employee-detail-label text-sm">Role</div>
                <div class="employee-detail-value text-sm">${employee.role_title || 'N/A'}</div>
            </div>
            <div class="employee-detail-row">
                <div class="employee-detail-label text-sm">Join Date</div>
                <div class="employee-detail-value text-sm">${employee.start_date || 'N/A'}</div>
            </div>
            <div class="employee-detail-row">
                <div class="employee-detail-label text-sm">${isInactive ? 'Last Day' : 'Time Period'}</div>
                <div class="employee-detail-value text-sm">${isInactive ? (employee.end_date || 'N/A') : getTimePeriod(employee.start_date, employee.end_date)}</div>
            </div>
            <div class="employee-detail-row">
                <div class="employee-detail-label text-sm">Status</div>
                <div class="employee-detail-value text-sm"><span class="${employee.status.toLowerCase() === 'active' ? 'text-green-400' : 'text-red-600'} font-semibold capitalize">${employee.status || 'N/A'}</span></div>
            </div>
        `;
        modal.classList.add('active');
        currentModal = modal;
    }

    // Hide modal
    function hideModal() {
        if (currentModal) {
            currentModal.classList.remove('active');
            currentModal = null;
        }
    }

    // Event listeners for view buttons and modal controls
    document.querySelectorAll('.overflow-x-auto').forEach(container => {
        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-employee-btn')) {
                try {
                    const employeeData = JSON.parse(decodeURIComponent(e.target.getAttribute('data-employee')));
                    showModal(employeeData);
                } catch (error) {
                    console.error('Error parsing employee data:', error);
                }
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-modal') || e.target.classList.contains('close-modal-btn')) {
            hideModal();
        }
        if (e.target.id === 'employee-modal-inactive') {
            hideModal();
        }
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

    /*Employee Modal Styles*/
    .employee-modal-inactive {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7)  !important;
        backdrop-filter: blur(5px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .employee-modal-inactive.active {
        display: flex;
        background: #fff;
    }

    .employee-modal-content {
        background: #1a1a1a;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        padding: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        animation: fadeInUp 0.3s ease-out;
    }

    .employee-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #333;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .employee-modal-header h3 {
        margin: 0;
    }

    .close-modal {
        background: none;
        border: none;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
    }

    .employee-modal-body {
        margin-bottom: 20px;
    }

    .employee-detail-row {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px solid #333;
    }

    .employee-detail-label {
        color: #a0a0a0;
        font-weight: 400;
    }

    .employee-detail-value {
        color: #fff;
        text-align: right;
        font-weight: 400;
    }

    .employee-modal-footer {
        text-align: right;
    }

</style>



