<?php
// Employee History Page - Dynamic Version
$user_id = $_SESSION['user_id'] ?? null;
$unique_id = $_SESSION['unique_id'] ?? null;

// Data should be passed from controller
$employmentHistory = $employmentHistory ?? [];
$careerStats = $careerStats ?? [];
$achievements = $achievements ?? [];
$blockchainTransactions = $blockchainTransactions ?? [];
$blockchainRecords = $blockchainRecords ?? [];
?>

<div class="p-6 bg- min-h-screen rounded-lg shadow-md">
    <div class="mb-6">
        <h1 class="text-h3 text-white mb-2">Employee History</h1>
        <p class="text-p-regular text-lightgray">View your complete employment history and project timeline</p>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="text-center py-8">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-orange mx-auto mb-4"></div>
        <p class="text-lightgray">Loading your employment history...</p>
    </div>

    <!-- Main Content (Initially Hidden) -->
    <div id="historyContent" style="display: none;">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-r from-orange to-orange/80 rounded-lg p-4 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-80">Total Experience</p>
                        <p class="text-2xl font-bold" id="totalExperience">
                            <?= isset($careerStats['total_experience_years']) ? $careerStats['total_experience_years'] . ' Years' : '0 Years' ?>
                        </p>
                    </div>
                    <div class="text-3xl opacity-60">📅</div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-600 to-blue-900 rounded-lg p-4 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-80">Total Positions</p>
                        <p class="text-2xl font-bold" id="totalPositions">
                            <?= $careerStats['total_positions'] ?? 0 ?>
                        </p>
                    </div>
                    <div class="text-3xl opacity-60">📊</div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-600 to-green-900 rounded-lg p-4 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-80">Companies Worked</p>
                        <p class="text-2xl font-bold" id="companiesWorked">
                            <?= $careerStats['companies_worked'] ?? 0 ?>
                        </p>
                    </div>
                    <div class="text-3xl opacity-60">🏢</div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-4 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm opacity-80">Skills Acquired</p>
                        <p class="text-2xl font-bold" id="skillsAcquired">
                            <?= $careerStats['skills_acquired'] ?? 0 ?>
                        </p>
                    </div>
                    <div class="text-3xl opacity-60">🎯</div>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-h4 text-orange">Employment Timeline</h2>
                <div class="flex gap-2">
                    <button id="refreshHistory" class="btn-3 text-xs px-3 py-1">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Refresh
                    </button>
                    <button id="exportHistory" class="btn-2 text-xs px-3 py-1">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export
                    </button>
                </div>
            </div>
            
            <div class="relative" id="employmentTimeline">
                <!-- Timeline Line -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-orange/40"></div>
                
                <!-- Timeline Items will be populated by JavaScript -->
                <div id="timelineItems" class="space-y-6">
                    <!-- Dynamic content will be inserted here -->
                </div>
            </div>
        </div>

        <!-- Achievements & Feedback -->
        <div class="mb-8" id="achievementsSection">
            <h2 class="text-h4 text-orange mb-4">Achievements & Feedback</h2>
            <div id="achievementsList" class="space-y-4">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>

        <!-- Blockchain Records -->
        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-h4 text-orange">Blockchain Employment Records</h2>
                <button id="verifyBlockchain" class="btn-1 text-xs px-3 py-1">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Verify on Blockchain
                </button>
            </div>
            
            <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg p-6 text-white shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-h5 font-semibold">Verified Employment History</h3>
                    <div class="text-2xl">🔗</div>
                </div>
                <p class="text-p-regular mb-4">Your employment records are securely stored on the blockchain and verified by previous employers.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-white/10 rounded-lg p-3 text-white">
                        <p class="text-sm opacity-80">Records Verified</p>
                        <p class="text-xl font-bold" id="blockchainRecordsCount">
                            <?= count($blockchainTransactions) ?>
                        </p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 text-white">
                        <p class="text-sm opacity-80">Blockchain Status</p>
                        <p class="text-xl font-bold" id="blockchainStatus">
                            <span class="text-green-400">✓ Verified</span>
                        </p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-3 text-white">
                        <p class="text-sm opacity-80">Last Updated</p>
                        <p class="text-xl font-bold" id="lastBlockchainUpdate">
                            <?= !empty($blockchainTransactions) ? date('M d, Y', strtotime($blockchainTransactions[0]['created_at'])) : 'Never' ?>
                        </p>
                    </div>
                </div>
                
                <!-- Blockchain Transactions -->
                <div id="blockchainTransactions" class="mt-4">
                    <h4 class="text-lg font-semibold mb-2">Recent Blockchain Transactions</h4>
                    <div id="transactionsList" class="space-y-2 max-h-40 overflow-y-auto">
                        <!-- Dynamic content will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error State -->
    <div id="errorState" class="text-center py-8" style="display: none;">
        <div class="text-red-400 text-6xl mb-4">⚠️</div>
        <h3 class="text-xl font-semibold text-white mb-2">Error Loading History</h3>
        <p class="text-lightgray mb-4">We couldn't load your employment history. Please try again.</p>
        <button id="retryLoad" class="btn-1">Retry</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load initial data
    loadEmployeeHistory();
    
    // Event listeners
    document.getElementById('refreshHistory').addEventListener('click', loadEmployeeHistory);
    document.getElementById('exportHistory').addEventListener('click', exportHistory);
    document.getElementById('verifyBlockchain').addEventListener('click', verifyBlockchain);
    document.getElementById('retryLoad').addEventListener('click', loadEmployeeHistory);
});

function loadEmployeeHistory() {
    showLoading();
    
    fetch('/employee-bee/public/?path=employee/history-data')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateHistoryData(data.data);
                showContent();
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            console.error('Error loading history:', error);
            showError('Failed to load employment history');
        });
}

function populateHistoryData(data) {
    // Update statistics
    updateStatistics(data.career_stats);
    
    // Populate timeline
    populateTimeline(data.employment_history);
    
    // Populate achievements
    populateAchievements(data.achievements);
    
    // Populate blockchain transactions
    populateBlockchainTransactions(data.blockchain_transactions);
}

function updateStatistics(stats) {
    if (stats) {
        document.getElementById('totalExperience').textContent = (stats.total_experience_years || 0) + ' Years';
        document.getElementById('totalPositions').textContent = stats.total_positions || 0;
        document.getElementById('companiesWorked').textContent = stats.companies_worked || 0;
        document.getElementById('skillsAcquired').textContent = stats.skills_acquired || 0;
    }
}

function populateTimeline(history) {
    const timelineItems = document.getElementById('timelineItems');
    timelineItems.innerHTML = '';
    
    if (!history || history.length === 0) {
        timelineItems.innerHTML = '<div class="text-center text-lightgray py-8">No employment history found</div>';
        return;
    }
    
    // Group by company and position
    const groupedHistory = {};
    history.forEach(item => {
        const key = `${item.company_id}_${item.role_title}`;
        if (!groupedHistory[key]) {
            groupedHistory[key] = item;
            groupedHistory[key].feedback = [];
        }
        if (item.feedback_text) {
            groupedHistory[key].feedback.push({
                text: item.feedback_text,
                type: item.feedback_type,
                date: item.date_recorded,
                skills: item.new_skills
            });
        }
    });
    
    Object.values(groupedHistory).forEach((item, index) => {
        const isActive = item.status === 'active';
        const statusColor = isActive ? 'bg-green-700' : 'bg-gray-700';
        const statusText = isActive ? 'Current' : 'Completed';
        const dotColor = isActive ? 'bg-orange' : 'bg-gray-600';
        
        const timelineItem = document.createElement('div');
        timelineItem.className = 'relative flex items-start';
        timelineItem.innerHTML = `
            <div class="absolute left-2 w-4 h-4 ${dotColor} rounded-full border-4 border-darkgray shadow-md"></div>
            <div class="ml-8 bg-black/40 rounded-lg p-4 flex-1 shadow">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-h5 text-white font-semibold">${item.role_title || 'Unknown Position'}</h3>
                    <span class="${statusColor} text-white px-2 py-1 rounded-full text-xs">${statusText}</span>
                </div>
                <p class="text-p-regular text-lightgray mb-2">${item.company_name || 'Unknown Company'}</p>
                <p class="text-p-small text-gray-400">${formatDate(item.start_date)} - ${item.end_date ? formatDate(item.end_date) : 'Present'}</p>
                
                ${item.skills_on_hire ? `
                <div class="mt-3">
                    <h4 class="text-p-regular text-orange font-medium mb-2">Skills Required:</h4>
                    <div class="flex flex-wrap gap-2">
                        ${item.skills_on_hire.split(',').map(skill => 
                            `<span class="bg-orange text-white px-2 py-1 rounded text-xs">${skill.trim()}</span>`
                        ).join('')}
                    </div>
                </div>
                ` : ''}
                
                ${item.feedback.length > 0 ? `
                <div class="mt-3">
                    <h4 class="text-p-regular text-orange font-medium mb-2">Feedback & Updates:</h4>
                    <div class="space-y-2">
                        ${item.feedback.map(feedback => `
                            <div class="bg-darkgray/50 rounded p-2">
                                <div class="flex justify-between items-start mb-1">
                                    <span class="text-xs text-orange capitalize">${feedback.type}</span>
                                    <span class="text-xs text-gray-400">${formatDate(feedback.date)}</span>
                                </div>
                                ${feedback.text ? `<p class="text-sm text-lightgray">${feedback.text}</p>` : ''}
                                ${feedback.skills ? `<p class="text-xs text-gray-400 mt-1">New Skills: ${feedback.skills}</p>` : ''}
                            </div>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
            </div>
        `;
        timelineItems.appendChild(timelineItem);
    });
}

function populateAchievements(achievements) {
    const achievementsList = document.getElementById('achievementsList');
    achievementsList.innerHTML = '';
    
    if (!achievements || achievements.length === 0) {
        achievementsList.innerHTML = '<div class="text-center text-lightgray py-4">No achievements recorded yet</div>';
        return;
    }
    
    achievements.forEach(achievement => {
        const achievementItem = document.createElement('div');
        achievementItem.className = 'bg-black/40 rounded-lg p-4';
        achievementItem.innerHTML = `
            <div class="flex justify-between items-start mb-2">
                <h4 class="text-white font-semibold capitalize">${achievement.feedback_type}</h4>
                <span class="text-xs text-gray-400">${formatDate(achievement.date_recorded)}</span>
            </div>
            <p class="text-lightgray text-sm mb-2">${achievement.company_name} • ${achievement.role_title}</p>
            ${achievement.feedback_text ? `<p class="text-gray-300">${achievement.feedback_text}</p>` : ''}
            ${achievement.new_skills ? `<p class="text-sm text-orange mt-2">Skills: ${achievement.new_skills}</p>` : ''}
        `;
        achievementsList.appendChild(achievementItem);
    });
}

function populateBlockchainTransactions(transactions) {
    const transactionsList = document.getElementById('transactionsList');
    transactionsList.innerHTML = '';
    
    if (!transactions || transactions.length === 0) {
        transactionsList.innerHTML = '<div class="text-center text-gray-400 py-2">No blockchain transactions found</div>';
        return;
    }
    
    transactions.slice(0, 5).forEach(tx => {
        const statusColor = tx.status === 'confirmed' ? 'text-green-400' : tx.status === 'failed' ? 'text-red-400' : 'text-yellow-400';
        const txItem = document.createElement('div');
        txItem.className = 'bg-white/5 rounded p-2 text-sm';
        txItem.innerHTML = `
            <div class="flex justify-between items-center">
                <span class="capitalize">${tx.action}</span>
                <span class="${statusColor} capitalize">${tx.status}</span>
            </div>
            <div class="text-xs text-gray-400 mt-1">
                ${tx.transaction_hash ? `Hash: ${tx.transaction_hash.substring(0, 16)}...` : 'Processing...'}
            </div>
            <div class="text-xs text-gray-400">${formatDate(tx.created_at)}</div>
        `;
        transactionsList.appendChild(txItem);
    });
}

function verifyBlockchain() {
    const button = document.getElementById('verifyBlockchain');
    const originalText = button.innerHTML;
    button.innerHTML = '<div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white inline-block mr-2"></div>Verifying...';
    button.disabled = true;
    
    fetch('/employee-bee/public/?path=employee/blockchain-verification')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('Blockchain verification completed successfully!', 'success');
                // Update blockchain status
                document.getElementById('blockchainStatus').innerHTML = '<span class="text-green-400">✓ Verified</span>';
            } else {
                showMessage('Blockchain verification failed: ' + data.message, 'error');
            }
        })
        .catch(error => {
            showMessage('Error during blockchain verification', 'error');
        })
        .finally(() => {
            button.innerHTML = originalText;
            button.disabled = false;
        });
}

function exportHistory() {
    window.open('/employee-bee/public/?path=employee/export-history&format=json', '_blank');
}

function formatDate(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}

function showLoading() {
    document.getElementById('loadingState').style.display = 'block';
    document.getElementById('historyContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}

function showContent() {
    document.getElementById('loadingState').style.display = 'none';
    document.getElementById('historyContent').style.display = 'block';
    document.getElementById('errorState').style.display = 'none';
}

function showError(message) {
    document.getElementById('loadingState').style.display = 'none';
    document.getElementById('historyContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
}

function showMessage(message, type) {
    const toast = document.createElement('div');
    toast.className = `fixed top-8 right-8 z-50 p-4 rounded-lg shadow-lg text-white max-w-sm ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
    toast.innerHTML = `
        <div class="flex justify-between items-start">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">×</button>
        </div>
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        if (toast) toast.remove();
    }, 5000);
}
</script>

