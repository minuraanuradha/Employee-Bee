<div class="min-h-screen ">
    <!-- HERO / WELCOME SECTION -->
     <!--<div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
        <div class="flex items-center gap-4">
            <img src="/assets/images/Logo/Lgo.png" alt="Company Logo" class="h-14 w-14 rounded-full border-2 border-orange shadow" />
            <div>
                <div class="text-2xl font-bold text-orange">Welcome, Acme Corp!</div>
                <div class="text-lightgray text-sm">Here’s your company overview and latest activity.</div>
            </div>
        </div>
       <div class="flex gap-2 mt-4 md:mt-0">
            <button class="btn-1 flex items-center gap-1">Add Employee</button>
            <button class="btn-3 flex items-center gap-1">Settings</button>
            <button class="btn-3 flex items-center gap-1"> Export</button>
        </div>
    </div>-->

    <!-- KEY METRICS ROW -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
        <div class="bg-gradient-to-r from-orange/30 to-orange/50 rounded-lg shadow-xl p-5 flex flex-col border border-orange">
            <div class="text-4xl font-bold text-white"><?php echo $totalEmployees; ?></div>
            <div class="text-lightgray text-xs">Total Employees</div>
        </div>
        <div class="bg-black/40 rounded-lg shadow-xl p-5 flex flex-col border border-orange/40">
            <div class="text-4xl font-bold text-white"><?php echo $activeEmployees; ?></div>
            <div class="text-lightgray text-xs">Active Employees</div>
        </div>
        <div class="bg-black/40 rounded-lg shadow-xl p-5 flex flex-col border border-orange/40">
            <div class="text-4xl font-bold text-white"><?php echo $inactiveEmployees; ?></div>
            <div class="text-lightgray text-xs">Inactive Employees</div>
        </div>
        <div class="bg-black/40 rounded-lg shadow-xl p-5 flex flex-col border border-orange/40">
            <div class="text-4xl font-bold text-white"><?php echo $newEmployeesThisMonth; ?></div>
            <div class="text-lightgray text-xs">New Hires This Month</div>
        </div>
    </div>

    <!-- ACTIVE/INACTIVE MEMBERS + MOST COMMON ROLES -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 ">
        <!-- Active/Inactive Members -->
        <div class="bg-black/40 rounded-lg shadow-xl p-6 flex flex-col border border-white/10">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-h5 mb-4">Active/Inactive Members</h3>
            </div>
            <div class="flex-1 flex items-center justify-center">
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="activeInactiveChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
        <!-- Most Common Roles -->
        <div class="bg-black/40 rounded-lg shadow-xl p-6 flex flex-col border border-white/10">
            <h3 class="text-h5 mb-2">Most Common Roles</h3>
            <div class="flex-1 flex items-center justify-center">
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="commonRolesChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Active/Inactive Members Pie Chart
    var activeInactiveCtx = document.getElementById('activeInactiveChart').getContext('2d');
    var activeInactiveChart = new Chart(activeInactiveCtx, {
        type: 'pie',
        data: {
            labels: ['Active', 'Inactive'],
            datasets: [{
                data: [<?php echo $activeEmployees; ?>, <?php echo $inactiveEmployees; ?>],
                backgroundColor: [
                    '#4CAF50', // Green for active
                    '#F44336'  // Red for inactive
                ],
                borderColor: [
                    '#388E3C',
                    '#D32F2F'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#FFFFFF',
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.raw || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((value / total) * 100);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
    
    // Most Common Roles Pie Chart
    var commonRolesCtx = document.getElementById('commonRolesChart').getContext('2d');
    
    // Prepare data for the chart
    var rolesData = <?php echo json_encode($mostCommonRoles); ?>;
    var roleLabels = [];
    var roleCounts = [];
    var roleColors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
        '#FF9F40', '#8AC926', '#1982C4', '#6A4C93', '#F15BB5'
    ];
    var roleBorderColors = [
        '#FF1744', '#2979FF', '#FFD600', '#00B7C2', '#7E57C2',
        '#FF6D00', '#64DD17', '#0D47A1', '#4A148C', '#C2185B'
    ];
    
    if (rolesData && rolesData.length > 0) {
        for (var i = 0; i < rolesData.length; i++) {
            roleLabels.push(rolesData[i].role_title);
            roleCounts.push(rolesData[i].count);
        }
    } else {
        // Default data if no roles data available
        roleLabels = ['No Data'];
        roleCounts = [1];
    }
    
    var commonRolesChart = new Chart(commonRolesCtx, {
        type: 'pie',
        data: {
            labels: roleLabels,
            datasets: [{
                data: roleCounts,
                backgroundColor: roleColors.slice(0, roleLabels.length),
                borderColor: roleBorderColors.slice(0, roleLabels.length),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#FFFFFF',
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.raw || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = Math.round((value / total) * 100);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
});
</script>
</div>