<?php
$company_id = $_SESSION['company_id'] ?? null;
if (!$company_id) {
    header('Location: ?path=login');
    exit();
}
?>
<div class="mx-auto p-2">
    <div class="mb-6 pt-0">
        <h2 class="text-h5 text-orange flex items-center">Employee Management <span class="text-orange text-xs font-medium bg-orange/10 px-4 py-1 rounded-full ml-2">Add Employee</span></h2>
        <p class="text-p-regular text-lightgray">Onboard a new employee by searching their unique Employee ID (e.g., BEE-SL1452).</p>
    </div>
    <!-- Search Employee to Add -->
    <div class="mb-6 bg-black/40 rounded-lg shadow-lg p-6">
        <div class="flex gap-2 items-center">
            <input type="text" id="searchInput" class="rounded-lg bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 flex-1 text-sm" placeholder="Search by employee name, email, or ID...">
            <button class="btn-1 px-6 py-2" id="searchBtn">Search</button>
        </div>
        
        <!-- Search Results -->
        <div id="resultsContainer" class="mt-4">
            <!-- Results will be populated here -->
        </div>
    </div>
    
    <!-- Search Tips -->
    <div class="glass-effect rounded-lg p-4 mb-6">
        <div class="flex items-start gap-2">
            <svg class="w-5 h-5 text-orange mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h4 class="text-white font-medium mb-1">Search Tips</h4>
                <ul class="text-lightgray text-xs space-y-1">
                    <li>• Use complete Employee ID for exact matches (e.g., BEE-SL1452)</li>
                    <li>• Search by full name or email for broader results</li>
                    <li>• Only employees with valid unique IDs can be added to your company</li>
                </ul>
            </div>
        </div>
    </div>
    
    <script>
        // Initialize with empty results message
        document.addEventListener('DOMContentLoaded', function() {
            const resultsContainer = document.getElementById('resultsContainer');
            resultsContainer.innerHTML = '<div class="text-gray-400 text-center py-4">Enter a search term</div>';
        });
    </script>

</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const resultsContainer = document.getElementById('resultsContainer');
    let openFormUniqueId = null;

    function renderResults(results) {
        if (!results.length) {
            resultsContainer.innerHTML = '<div class="text-gray-400 text-center py-4">No employees found</div>';
            return;
        }

        let html = '<div class="space-y-3">';
        for (const emp of results) {
            // Status badge
            let statusHtml = '';
            if (emp.status) {
                let color = 'bg-gray-700';
                let label = emp.status.charAt(0).toUpperCase() + emp.status.slice(1);
                if (emp.status === 'active') color = 'bg-green-700';
                else if (emp.status === 'inactive') color = 'bg-gray-700';
                else if (emp.status === 'resigned') color = 'bg-orange-600';
                else if (emp.status === 'terminated') color = 'bg-red-700';
                statusHtml = `<span class="text-xs ${emp.status === 'active' ? 'text-green-400' : 'text-gray-400'}"> ${label}</span>`;
            } else {
                statusHtml = `<span class="text-xs text-gray-400">Not added</span>`;
            }
            
            html += `
                <div class="flex items-center justify-between p-3 bg-black border border-white/20 rounded-lg" data-employee-card data-unique_id="${emp.unique_id}">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-orange/20 flex items-center justify-center text-orange font-bold">
                            ${emp.full_name ? emp.full_name.charAt(0).toUpperCase() : 'E'}
                        </div>
                        <div>
                            <div class="text-white font-medium flex items-center gap-2">${emp.full_name || 'N/A'} ${statusHtml}</div>
                            <div class="text-sm text-gray-400">${emp.email} • ${emp.unique_id}</div>
                        </div>
                    </div>
                    <button class="btn-1 add-btn" data-unique_id="${emp.unique_id}">Add</button>
                </div>
                <div class="add-form-container bg-black/40 rounded-lg shadow-lg p-6" id="add-form-${emp.unique_id}" style="display:none;">
                    <form class="space-y-4 add-employee-form" data-unique_id="${emp.unique_id}">
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Assign Role / Job Title</label>
                            <input type="text" name="role_title" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" placeholder="e.g., Data Analyst" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Required Skills</label>
                            <input type="text" name="skills_on_hire" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" placeholder="e.g., SQL, Python, Excel">
                            <div class="text-xs text-gray-500 mt-1">(Comma-separated or use tags in future)</div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-400 mb-1">Date of Joining</label>
                            <input type="date" name="start_date" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 text-sm w-full" required>
                        </div>
                        <div class="flex gap-4">
                            <button type="submit" class="btn-1 flex-1">Add to Company</button>
                            <button type="button" class="btn-3 cancel-add px-6" data-unique_id="${emp.unique_id}">Cancel</button>
                        </div>
                    </form>
                </div>
            `;
        }
        html += '</div>';
        resultsContainer.innerHTML = html;
        
        // Attach click event to each Add button
        document.querySelectorAll('.add-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Close any open form
                document.querySelectorAll('.add-form-container').forEach(f => f.style.display = 'none');
                // Open this form
                const uniqueId = this.dataset.unique_id;
                const formDiv = document.getElementById('add-form-' + uniqueId);
                if (formDiv) formDiv.style.display = 'block';
                openFormUniqueId = uniqueId;
            });
        });
        
        // Attach click event to each Cancel button
        document.querySelectorAll('.cancel-add').forEach(btn => {
            btn.addEventListener('click', function() {
                const uniqueId = this.dataset.unique_id;
                const formDiv = document.getElementById('add-form-' + uniqueId);
                if (formDiv) formDiv.style.display = 'none';
                openFormUniqueId = null;
            });
        });
        
        // Attach submit event to each add-employee form
        document.querySelectorAll('.add-employee-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                addEmployee(this);
            });
        });
    }

    function doSearch() {
        const q = searchInput.value.trim();
        if (!q) {
            resultsContainer.innerHTML = '<div class="text-gray-400 text-center py-4">Enter a search term</div>';
            return;
        }
        resultsContainer.innerHTML = '<div class="text-gray-400 text-center py-4">Searching...</div>';
        fetch('/employee-bee/public/?path=company/search-employees-ajax&q=' + encodeURIComponent(q))
            .then(res => res.json())
            .then(data => renderResults(data))
            .catch(() => {
                resultsContainer.innerHTML = '<div class="text-red-400 text-center py-4">Error searching employees</div>';
            });
    }

    searchBtn.addEventListener('click', doSearch);
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') doSearch();
    });

    // Add employee via AJAX
    function addEmployee(form) {
        const unique_id = form.dataset.unique_id;
        const formData = new FormData(form);
        formData.append('unique_id', unique_id);
        const card = document.querySelector(`[data-employee-card][data-unique_id="${unique_id}"]`);
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Adding...';
        // Remove any previous message
        let msgDiv = card.querySelector('.add-employee-msg');
        if (msgDiv) msgDiv.remove();
        fetch('/employee-bee/public/?path=company/add-employee', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                // Show message
                const msg = document.createElement('div');
                msg.className = 'add-employee-msg mt-2 text-center rounded p-2 ' + (data.success ? 'bg-green-700 text-white' : 'bg-red-700 text-white');
                msg.textContent = data.message;
                card.appendChild(msg);
                // Blockchain toast/modal
                if (data.blockchain) {
                    showBlockchainToast(data.blockchain, card);
                }
                if (data.success) {
                    // Collapse the form
                    form.parentElement.style.display = 'none';
                } else {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Add to Company';
                }
            })
            .catch(() => {
                const msg = document.createElement('div');
                msg.className = 'add-employee-msg mt-2 text-center rounded p-2 bg-red-700 text-white';
                msg.textContent = 'Error adding employee.';
                card.appendChild(msg);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Add to Company';
            });
    }

    // Show blockchain status as a toast/modal
    function showBlockchainToast(blockchain, card) {
        // Remove any previous toast
        let oldToast = document.getElementById('blockchain-toast');
        if (oldToast) oldToast.remove();
        // Create toast/modal
        const toast = document.createElement('div');
        toast.id = 'blockchain-toast';
        toast.className = 'fixed top-8 right-8 z-50 bg-darkgray border border-orange text-white rounded-lg shadow-lg p-6 max-w-sm';
        let html = '';
        if (blockchain.success) {
            html += `<div class='flex items-center gap-2 mb-2'><span class='text-green-400 text-xl'>✔️</span> <span class='font-semibold'>Blockchain Success</span></div>`;
            html += `<div class='mb-2 text-sm'>Employee record added to blockchain.</div>`;
            if (blockchain.transaction_hash) {
                const etherscan = `https://sepolia.etherscan.io/tx/${blockchain.transaction_hash}`;
                html += `<div class='mb-2 text-xs'>Tx Hash: <a href='${etherscan}' target='_blank' class='text-orange underline'>${blockchain.transaction_hash.slice(0, 16)}...</a></div>`;
            }
            // Add badge to card
            const nameDiv = card.querySelector('.text-white.font-medium');
            if (nameDiv && !card.querySelector('.blockchain-badge')) {
                nameDiv.innerHTML += ` <span class='blockchain-badge inline-block px-2 py-1 rounded text-xs font-semibold bg-green-700 text-white ml-2'>Blockchain Verified</span>`;
            }
        } else {
            html += `<div class='flex items-center gap-2 mb-2'><span class='text-red-400 text-xl'>❌</span> <span class='font-semibold'>Blockchain Error</span></div>`;
            html += `<div class='mb-2 text-sm'>${blockchain.error || 'Blockchain transaction failed.'}</div>`;
            if (blockchain.transaction_hash) {
                const etherscan = `https://sepolia.etherscan.io/tx/${blockchain.transaction_hash}`;
                html += `<div class='mb-2 text-xs'>Tx Hash: <a href='${etherscan}' target='_blank' class='text-orange underline'>${blockchain.transaction_hash.slice(0, 16)}...</a></div>`;
            }
        }
        html += `<button onclick='this.parentElement.remove()' class='mt-2 px-4 py-1 bg-orange rounded text-white text-xs'>Close</button>`;
        toast.innerHTML = html;
        document.body.appendChild(toast);
        // Auto-close after 8 seconds
        setTimeout(() => {
            if (toast) toast.remove();
        }, 8000);
    }
    
    
</script>
<style>
    .glass-effect {
        background: rgba(26, 26, 26, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(249, 115, 22, 0.1);
    }

    .glass-effect-green {
        background: rgba(0, 186, 19, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 186, 19, 0.4);
    }

    .hover-glow:hover {
        box-shadow: 0 0 20px rgba(249, 115, 22, 0.3);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .hover-glow-green:hover {
        box-shadow: 0 0 8px rgba(0, 186, 19, 0.3);
        transform: translateY(-1px);
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

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: .5;
        }
    }

    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .search-highlight {
        background: rgba(249, 115, 22, 0.2);
        border-radius: 4px;
        padding: 2px 4px;
    }

    .blockchain-badge {
        background: linear-gradient(45deg, #10B981, #059669);
        animation: shimmer 2s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% {
            background-position: -468px 0;
        }

        100% {
            background-position: 468px 0;
        }
    }
</style>