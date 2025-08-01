<?php
$company_id = $_SESSION['company_id'] ?? null;
if (!$company_id) {
    header('Location: ?path=login');
    exit();
}
?>
<div class="mx-auto  p-2">
    <div class="mb-6 pt-0 ">
        <h2 class="text-h5 text-orange flex  items-center">Employee Management <span class="text-orange text-xs font-medium bg-orange/10 px-4 py-1  rounded-full ml-2">Search & Add Employee</span></h2>
        <p class="text-p-regular text-lightgray">Onboard a new employee by searching their unique Employee ID (e.g., BEE-SL1452).</p>
    </div>
    <!-- Search by Unique ID -->
    <div class="mb-4 flex flex-col sm:flex-row gap-2 items-center justify-between">
        <div class="w-1/2 gap-2 flex">
            <input type="text" id="searchInput" class="rounded-lg bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full  text-sm" placeholder="Search employees by name or role, ...">
            <button class="btn-1 px-6 py-2" id="searchBtn">Search</button>
        </div>

        <div>
            <div class="flex">
                <div class="glass-effect-green rounded-lg px-4 py-1 flex items-center justify-between gap-2 hover-glow-green">
                    <div class="text-green-400 text-sm font-bold" id="search-results-count">0</div>
                    <div class="text-lightgray text-xs">Results Found</div>
                </div>

            </div>
        </div>
    </div>
    <!-- Quick Search Filters 
    <div class="flex flex-wrap gap-2 mb-4">
        <span class="text-lightgray text-sm">Quick filters:</span>
        <button class="filter-btn bg-gray-800 hover:bg-orange/20 text-lightgray hover:text-orange px-3 py-1 rounded-full text-xs transition-all duration-300" data-filter="BEE-">
            Employee IDs
        </button>
        <button class="filter-btn bg-gray-800 hover:bg-orange/20 text-lightgray hover:text-orange px-3 py-1 rounded-full text-xs transition-all duration-300" data-filter="@">
            Email addresses
        </button>
        <button class="clear-btn bg-red-900/20 hover:bg-red-900/40 text-red-400 px-3 py-1 rounded-full text-xs transition-all duration-300">
            Clear search
        </button>
    </div>-->

    <!-- Results Container -->
    <div id="resultsContainer" class="fade-in-up" style="animation-delay: 0.2s">
        <!-- Initial state -->
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-6 bg-darkgray/50 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-lightgray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-2">Ready to search</h3>
            <p class="text-lightgray">Enter an Employee ID, name, or email to get started</p>
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

</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const resultsContainer = document.getElementById('resultsContainer');
    let openFormUniqueId = null;

    function renderResults(results) {
    // ✅ Update result count
    const resultCountEl = document.getElementById('search-results-count');
    resultCountEl.textContent = results.length;

    if (!results.length) {
        resultsContainer.innerHTML = `<div class='bg-black/40 rounded-lg shadow-lg p-6 text-center text-gray-400'>
            <span>No employee found with that ID.</span>
        </div>`;
        return;
    }
        let html = '';
        for (const emp of results) {
            // Use profile picture or initial
            let profileHtml = '';
            if (emp.profile_picture && emp.profile_picture !== '/public/images/default-user.png') {
                profileHtml = `<img src="${emp.profile_picture}" class="w-16 h-16 rounded-full object-cover bg-darkgray" alt="Profile">`;
            } else {
                const initial = emp.full_name ? emp.full_name.charAt(0).toUpperCase() : 'E';
                profileHtml = `<div class="w-16 h-16 rounded-full bg-darkgray flex items-center justify-center text-2xl font-bold text-orange">${initial}</div>`;
            }
            // Status badge
            let statusHtml = '';
            if (emp.status) {
                let color = 'bg-gray-700';
                let label = emp.status.charAt(0).toUpperCase() + emp.status.slice(1);
                if (emp.status === 'active') color = 'bg-green-700';
                else if (emp.status === 'inactive') color = 'bg-gray-700';
                else if (emp.status === 'resigned') color = 'bg-orange-600';
                else if (emp.status === 'terminated') color = 'bg-red-700';
                statusHtml = `<span class="inline-block px-3 py-1 rounded text-xs font-semibold text-white ml-2 ${color}">Already added: ${label}</span>`;
            } else {
                statusHtml = `<span class="inline-block px-3 py-1 rounded text-xs font-semibold text-gray-400 bg-gray-800 ml-2">Not added</span>`;
            }
            html += `
        <div class="bg-black/40 rounded-lg shadow-lg p-6 mb-6" data-employee-card>
            <div class="flex items-center gap-4 mb-4">
                ${profileHtml}
                <div>
                    <div class="text-lg font-semibold text-white">${emp.full_name || '-'} ${statusHtml}</div>
                    <div class="text-sm text-gray-400">${emp.email || '-'}</div>
                    <div class="text-xs text-lightgray">Unique ID: <span class="text-white">${emp.unique_id || '-'}</span></div>
                </div>
            </div>
            <button class="btn-1 add-btn w-full mb-2" data-unique_id="${emp.unique_id}">Add</button>
            <div class="add-form-container" id="add-form-${emp.unique_id}" style="display:none;">
                <form class="space-y-4 add-employee-form" data-unique_id="${emp.unique_id}">
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Assign Role / Job Title</label>
                        <input type="text" name="role_title" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full" placeholder="e.g., Data Analyst" required text-xs>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Required Skills</label>
                        <input type="text" name="skills_on_hire" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full" placeholder="e.g., SQL, Python, Excel " text-xs>
                        <div class="text-xs text-gray-500 mt-1">(Comma-separated or use tags in future)</div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Date of Joining</label>
                        <input type="date" name="start_date" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-1 w-full" required text-xs>
                    </div>
                    <button type="submit" class="btn-1 w-full mt-2">Add to Company</button>
                </form>
            </div>
        </div>
        `;
        }
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
            resultsContainer.innerHTML = '<div class="bg-black/40 rounded-lg shadow-lg p-6 text-center text-gray-400">Enter a search term.</div>';
            return;
        }
        resultsContainer.innerHTML = '<div class="bg-black/40 rounded-lg shadow-lg p-6 text-center text-gray-400">Searching...</div>';
        fetch('/employee-bee/public/?path=company/search-employees-ajax&q=' + encodeURIComponent(q))
            .then(res => res.json())
            .then(data => renderResults(data))
            .catch(() => {
                resultsContainer.innerHTML = '<div class="bg-black/40 rounded-lg shadow-lg p-6 text-center text-red-500">Error fetching results.</div>';
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
        const card = form.closest('[data-employee-card]');
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
            const nameDiv = card.querySelector('.text-lg.font-semibold');
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