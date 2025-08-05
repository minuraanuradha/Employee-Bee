<?php
$company_id = $_SESSION['company_id'] ?? null;
if (!$company_id) {
    header('Location: ?path=login');
    exit();
}
?>
<div class="mx-auto p-2">
    <div class="mb-6 pt-0">
        <h2 class="text-h5 text-orange flex items-center">Employee Management <span class="text-orange text-xs font-medium bg-orange/10 px-4 py-1 rounded-full ml-2">Update Employee</span></h2>
        <p class="text-p-regular text-lightgray">Update employee status, role, add feedback, and manage employment records.</p>
    </div>

    <!-- Search Employee to Update -->
    <div class="mb-6 bg-black/40 rounded-lg shadow-lg p-6">

        <div class="flex gap-2 items-center">
            <input type="text" id="employeeSearchInput" class="rounded-lg bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 flex-1 text-sm" placeholder="Search by employee name, email, or ID...">
            <button class="btn-1 px-6 py-2" id="searchEmployeeBtn">Search</button>
        </div>
        
        <!-- Search Results -->
        <div id="employeeSearchResults" class="mt-4">
            <!-- Results will be populated here -->
        </div>
    </div>

    <!-- Update Form (Initially Hidden) -->
    <div id="updateEmployeeForm" class="bg-black/40 rounded-lg shadow-lg p-6" style="display: none;">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-h5 text-orange mb-4">Employee Data Update Form</h3>
            <button id="closeUpdateForm" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Employee Info Display -->
        <div id="employeeInfo" class="mb-6 p-4 bg-black  rounded-lg border border-orange/40">
            <!-- Employee info will be populated here -->
        </div>

        <!-- Update Form -->
        <form id="employeeUpdateForm" class="space-y-6">
            <input type="hidden" id="employeeUniqueId" name="employee_unique_id">
            
            <!-- Status Update -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs text-gray-400 mb-2">Employment Status</label>
                    <select name="status" id="employeeStatus" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full">
                        <option value="">Keep Current Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="resigned">Resigned</option>
                        <option value="terminated">Terminated</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs text-gray-400 mb-2">End Date (if changing to inactive)</label>
                    <input type="date" name="end_date" id="endDate" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full">
                </div>
            </div>

            <!-- Role Update -->
            <div>
                <label class="block text-xs text-gray-400 mb-2">Update Role/Position</label>
                <input type="text" name="role_title" id="roleTitle" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" placeholder="e.g., Senior Developer, Team Lead">
                <div class="text-xs text-gray-500 mt-1">Leave empty to keep current role</div>
            </div>

            <!-- New Skills -->
            <div>
                <label class="block text-xs text-gray-400 mb-2">New Skills Acquired</label>
                <input type="text" name="new_skills" id="newSkills" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" placeholder="e.g., React, Node.js, AWS">
                <div class="text-xs text-gray-500 mt-1">Skills gained during employment period</div>
            </div>

            <!-- Feedback -->
            <div>
                <label class="block text-xs text-gray-400 mb-2">Feedback/Comments</label>
                <textarea name="feedback_text" id="feedbackText" rows="4" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" placeholder="Performance feedback, achievements, recommendations..."></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="btn-1 flex-1">Update Employee Record</button>
                <button type="button" id="cancelUpdate" class="btn-3 px-6">Cancel</button>
            </div>
        </form>

        <!-- Feedback History -->
        <div id="feedbackHistory" class="mt-8">
            <h4 class="text-lg font-semibold text-white mb-4">Previous Updates & Feedback</h4>
            <div id="feedbackHistoryContent">
                <!-- Feedback history will be populated here -->
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="updateMessages" class="mt-4">
        <!-- Messages will be shown here -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('employeeSearchInput');
    const searchBtn = document.getElementById('searchEmployeeBtn');
    const searchResults = document.getElementById('employeeSearchResults');
    const updateForm = document.getElementById('updateEmployeeForm');
    const employeeForm = document.getElementById('employeeUpdateForm');
    const closeBtn = document.getElementById('closeUpdateForm');
    const cancelBtn = document.getElementById('cancelUpdate');
    const statusSelect = document.getElementById('employeeStatus');
    const endDateInput = document.getElementById('endDate');

    // Search employees
    function searchEmployees() {
        const query = searchInput.value.trim();
        if (!query) {
            searchResults.innerHTML = '<div class="text-gray-400 text-center py-4">Enter a search term</div>';
            return;
        }

        searchResults.innerHTML = '<div class="text-gray-400 text-center py-4">Searching...</div>';
        
        fetch(`/employee-bee/public/?path=company/search-employees-ajax&q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    searchResults.innerHTML = '<div class="text-gray-400 text-center py-4">No employees found</div>';
                    return;
                }

                let html = '<div class="space-y-3">';
                data.forEach(emp => {
                    if (emp.status) { // Only show employees that are already added to company
                        const statusColor = emp.status === 'active' ? 'text-green-400' : 'text-gray-400';
                        html += `
                            <div class="flex items-center justify-between p-3 bg-black border border-white/20 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange/20 flex items-center justify-center text-orange font-bold">
                                        ${emp.full_name ? emp.full_name.charAt(0).toUpperCase() : 'E'}
                                    </div>
                                    <div>
                                        <div class="text-white font-medium flex items-center gap-2">${emp.full_name || 'N/A'} <span>
                                        <div class="text-xs ${statusColor}"> ${emp.status}</div></span></div>
                                        <div class="text-sm text-gray-400">${emp.email} • ${emp.unique_id}</div>
                                    </div>
                                </div>
                                <button class="btn-2 select-employee-btn" data-employee-id="${emp.unique_id}">
                                    Update
                                </button>
                            </div>
                        `;
                    }
                });
                html += '</div>';
                
                if (html === '<div class="space-y-3"></div>') {
                    searchResults.innerHTML = '<div class="text-gray-400 text-center py-4">No employees found in your company</div>';
                } else {
                    searchResults.innerHTML = html;
                    
                    // Attach click events to select buttons
                    document.querySelectorAll('.select-employee-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            selectEmployeeForUpdate(this.dataset.employeeId);
                        });
                    });
                }
            })
            .catch(err => {
                searchResults.innerHTML = '<div class="text-red-400 text-center py-4">Error searching employees</div>';
            });
    }

    // Select employee for update
    function selectEmployeeForUpdate(employeeId) {
        fetch(`/employee-bee/public/?path=company/get-employee-for-update&employee_id=${employeeId}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    populateUpdateForm(data.employee, data.feedback_history);
                    updateForm.style.display = 'block';
                    updateForm.scrollIntoView({ behavior: 'smooth' });
                } else {
                    showMessage('Error loading employee data: ' + data.message, 'error');
                }
            })
            .catch(err => {
                showMessage('Error loading employee data', 'error');
            });
    }

    // Populate update form with employee data
    function populateUpdateForm(employee, feedbackHistory) {
        document.getElementById('employeeUniqueId').value = employee.unique_id;
        document.getElementById('employeeStatus').value = employee.status;
        document.getElementById('roleTitle').value = employee.role_title;
        
        // Show employee info
        const employeeInfo = document.getElementById('employeeInfo');
        employeeInfo.innerHTML = `
            <div class="flex items-center gap-4 ">
                <div class="w-16 h-16 rounded-full bg-orange/20 flex items-center justify-center text-orange font-bold text-xl">
                    ${employee.full_name ? employee.full_name.charAt(0).toUpperCase() : 'E'}
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white">${employee.full_name || 'N/A'}</h4>
                    <p class="text-gray-400 text-sm">${employee.email} • ${employee.unique_id}</p>
                    <p class="text-sm text-gray-400">Current Role: ${employee.role_title} • Status: <span class="text-${employee.status === 'active' ? 'green' : 'gray'}-400">${employee.status}</span></p>
                    <p class="text-sm text-gray-400">Start Date: ${employee.start_date}</p>
                </div>
            </div>
        `;

        // Show feedback history
        const historyContent = document.getElementById('feedbackHistoryContent');
        if (feedbackHistory && feedbackHistory.length > 0) {
            let historyHtml = '<div class="space-y-3">';
            feedbackHistory.forEach(feedback => {
                historyHtml += `
                    <div class="p-3 bg-darkgray/50 rounded-lg">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-orange font-medium capitalize">${feedback.feedback_type}</span>
                            <span class="text-xs text-gray-400">${feedback.date_recorded}</span>
                        </div>
                        ${feedback.feedback_text ? `<p class="text-gray-300 text-sm mb-2">${feedback.feedback_text}</p>` : ''}
                        ${feedback.updated_role ? `<p class="text-sm text-gray-400">Role: ${feedback.updated_role}</p>` : ''}
                        ${feedback.new_skills ? `<p class="text-sm text-gray-400">Skills: ${feedback.new_skills}</p>` : ''}
                    </div>
                `;
            });
            historyHtml += '</div>';
            historyContent.innerHTML = historyHtml;
        } else {
            historyContent.innerHTML = '<div class="text-gray-400 text-center py-4">No previous updates</div>';
        }
    }

    // Handle status change to show/hide end date
    statusSelect.addEventListener('change', function() {
        if (['inactive', 'resigned', 'terminated'].includes(this.value)) {
            endDateInput.style.display = 'block';
            endDateInput.required = true;
        } else {
            endDateInput.style.display = 'none';
            endDateInput.required = false;
            endDateInput.value = '';
        }
    });

    // Handle form submission
    employeeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        
        submitBtn.disabled = true;
        submitBtn.textContent = 'Updating...';
        
        fetch('/employee-bee/public/?path=company/update-employee', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showMessage('Employee updated successfully!', 'success');
                
                // Show blockchain status
                if (data.blockchain) {
                    showBlockchainStatus(data.blockchain);
                }
                
                // Reset form
                employeeForm.reset();
                updateForm.style.display = 'none';
                searchResults.innerHTML = '';
                searchInput.value = '';
            } else {
                showMessage('Error: ' + data.message, 'error');
            }
        })
        .catch(err => {
            showMessage('Error updating employee', 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Update Employee Record';
        });
    });

    // Show messages
    function showMessage(message, type) {
        const messagesDiv = document.getElementById('updateMessages');
        const messageClass = type === 'success' ? 'bg-green-700 text-white' : 'bg-red-700 text-white';
        
        messagesDiv.innerHTML = `
            <div class="${messageClass} p-4 rounded-lg mb-4">
                ${message}
            </div>
        `;
        
        setTimeout(() => {
            messagesDiv.innerHTML = '';
        }, 5000);
    }

    // Show blockchain status
    function showBlockchainStatus(blockchain) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-8 right-8 z-50 bg-darkgray border border-orange text-white rounded-lg shadow-lg p-6 max-w-sm';
        
        let html = '';
        if (blockchain.success) {
            html += `<div class='flex items-center gap-2 mb-2'><span class='text-green-400 text-xl'>✔️</span> <span class='font-semibold'>Blockchain Updated</span></div>`;
            html += `<div class='mb-2 text-sm'>Employee record updated on blockchain.</div>`;
            if (blockchain.transaction_hash) {
                html += `<div class='mb-2 text-xs'>Tx: ${blockchain.transaction_hash.slice(0, 16)}...</div>`;
            }
        } else {
            html += `<div class='flex items-center gap-2 mb-2'><span class='text-red-400 text-xl'>❌</span> <span class='font-semibold'>Blockchain Error</span></div>`;
            html += `<div class='mb-2 text-sm'>${blockchain.error || 'Blockchain update failed.'}</div>`;
        }
        html += `<button onclick='this.parentElement.remove()' class='mt-2 px-4 py-1 bg-orange rounded text-white text-xs'>Close</button>`;
        
        toast.innerHTML = html;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            if (toast) toast.remove();
        }, 8000);
    }

    // Event listeners
    searchBtn.addEventListener('click', searchEmployees);
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') searchEmployees();
    });

    closeBtn.addEventListener('click', function() {
        updateForm.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function() {
        updateForm.style.display = 'none';
    });
});
</script>

<style>
.glass-effect {
    background: rgba(26, 26, 26, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(249, 115, 22, 0.1);
}

.hover-glow:hover {
    box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);
    transform: translateY(-2px);
    transition: all 0.3s ease;
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