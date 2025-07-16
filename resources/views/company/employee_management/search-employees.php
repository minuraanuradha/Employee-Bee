<?php
$company_id = $_SESSION['company_id'] ?? null;
if (!$company_id) {
    header('Location: ?path=login');
    exit();
}
?>
<div class="max-w-xl mx-auto mt-10">
    <div class="mb-6">
        <h2 class="text-h5 text-orange mb-1">Employee Management <span class="text-xs text-gray-400">/ Search & Add Employee</span></h2>
        <p class="text-p-regular text-lightgray">Onboard a new employee by searching their unique Employee ID (e.g., BEE-SL1452).</p>
    </div>
    <!-- Search by Unique ID -->
    <div class="flex gap-2 mb-8">
        <input type="text" id="searchInput" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="Enter Employee Unique ID, Name, or Email">
        <button id="searchBtn" class="btn-1 px-6 py-2">Search</button>
    </div>
    <div id="resultsContainer"></div>
    <div class="text-xs text-gray-500 mt-4">* Only employees with a valid unique ID can be added. This process creates an official job record and relationship in your company.</div>
</div>

<script>
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const resultsContainer = document.getElementById('resultsContainer');
let openFormUniqueId = null;

function renderResults(results) {
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
                        <input type="text" name="role_title" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="e.g., Data Analyst" required>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Required Skills</label>
                        <input type="text" name="skills_on_hire" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" placeholder="e.g., SQL, Python, Excel">
                        <div class="text-xs text-gray-500 mt-1">(Comma-separated or use tags in future)</div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-1">Date of Joining</label>
                        <input type="date" name="start_date" class="rounded bg-black text-lightgray border border-gray-700 focus:border-orange focus:outline-none px-4 py-2 w-full" required>
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
</script>
