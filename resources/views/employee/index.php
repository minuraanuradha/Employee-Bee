<?php
// Employee Dashboard Page
$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? null;
$unique_id = $_SESSION['unique_id'] ?? null;
// $employee is expected to be provided by the controller
$username = $employee['full_name'] ?? $_SESSION['full_name'] ?? 'Employee';
$unique_id_display = $employee['unique_id'] ?? $unique_id ?? 'N/A';
?>

<!-- Dashboard Container -->
<div class="min-h-screen bg- p-6">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
        <!-- Profile Card -->
        <div class="col-span-1 bg-black/40 rounded-xl shadow-lg p-6 flex flex-col items-center">
            <div class="w-24 h-24 rounded-xl bg-black/60 border-4 border-orange flex items-center justify-center mb-4">
                <span class="text-4xl font-bold text-orange bg-white/10 rounded-full p-6">
                    <?= strtoupper(substr($username, 0, 1)) ?>
                </span>
            </div>
            <h2 class="text-xl font-semibold text-white mb-1"><?= htmlspecialchars($username) ?></h2>
            <p class="text-lightgray mb-1">Employee ID: <span class="text-white font-medium"><?= htmlspecialchars($unique_id_display) ?></span></p>
            <p class="text-lightgray mb-2">Role: <span class="text-white font-medium"><?= ucfirst($user_role ?? 'Employee') ?></span></p>
            <button class="btn-2 w-full mt-2">View Profile</button>
        </div>

        <!-- Calendar Widget -->
        <div class="col-span-2 bg-black/40 rounded-xl shadow-lg p-6 flex flex-col">
            <h3 class="text-h5 text-orange mb-4">Calendar</h3>
            <div id="dashboard-calendar" class="bg-darkgray rounded-lg p-2"></div>
        </div>

        <!-- Blockchain Status & AI Insights -->
        <div class="col-span-1 flex flex-col gap-6">
            <!-- Blockchain Status -->
            <div class="bg-gradient-to-r from-orange to-orange/80 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center mb-2">
                    <svg class="w-7 h-7 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 13l-10-5v6a2 2 0 002 2h16a2 2 0 002-2v-6l-10 5z"/></svg>
                    <span class="text-lg font-semibold">Blockchain Verified</span>
                </div>
                <p class="text-p-regular">Your employment record is <span class="text-green-400 font-bold">verified</span> on the blockchain.</p>
                <button class="btn-2 mt-4 w-full">View Blockchain Record</button>
            </div>
            <!-- AI Insights -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center mb-2">
                    <svg class="w-7 h-7 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M12 4v16m0 0l-4-4m4 4l4-4"/></svg>
                    <span class="text-lg font-semibold">AI Career Insights</span>
                </div>
                <ul class="list-disc pl-5 text-p-regular">
                    <li>Next best job: <span class="text-orange font-bold">Lead Developer</span></li>
                    <li>Skill to improve: <span class="text-orange font-bold">Machine Learning</span></li>
                    <li>Recommended course: <span class="text-orange font-bold">AWS Certified Developer</span></li>
                </ul>
                <button class="btn-2 mt-4 w-full">See All Insights</button>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
        <!-- Quick Stats -->
        <div class="col-span-1 bg-black/40 rounded-xl shadow-lg p-6 flex flex-col gap-2">
            <h3 class="text-h5 text-orange mb-2">Quick Stats</h3>
            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <span class="text-lightgray">Verified Jobs</span>
                    <span class="text-white font-bold">3</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-lightgray">Years Experience</span>
                    <span class="text-white font-bold">3.5</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-lightgray">Companies</span>
                    <span class="text-white font-bold">2</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-lightgray">AI Score</span>
                    <span class="text-orange font-bold">92</span>
                </div>
            </div>
        </div>
        <!-- Analytics Chart -->
        <div class="col-span-3 bg-black/40 rounded-xl shadow-lg p-6">
            <h3 class="text-h5 text-orange mb-4">Career Progress</h3>
            <canvas id="careerChart" height="80"></canvas>
        </div>
    </div>

    <!-- Activity Feed & Chat/Insight Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Activity Feed -->
        <div class="col-span-2 bg-black/40 rounded-xl shadow-lg p-6">
            <h3 class="text-h5 text-orange mb-4">Recent Activity</h3>
            <ul class="divide-y divide-gray-700">
                <li class="py-2 flex items-center justify-between">
                    <span class="text-white">Employment verified on blockchain</span>
                    <span class="text-xs text-green-400">Just now</span>
                </li>
                <li class="py-2 flex items-center justify-between">
                    <span class="text-white">AI suggested new skill: Machine Learning</span>
                    <span class="text-xs text-orange">2h ago</span>
                </li>
                <li class="py-2 flex items-center justify-between">
                    <span class="text-white">Profile updated</span>
                    <span class="text-xs text-lightgray">1d ago</span>
                </li>
            </ul>
        </div>
        <!-- Chat/Insight Area -->
        <div class="col-span-1 bg-black/40 rounded-xl shadow-lg p-6 flex flex-col">
            <h3 class="text-h5 text-orange mb-4">AI Chat / Insights</h3>
            <div class="flex-1 flex flex-col justify-center items-center">
                <span class="text-lightgray mb-2">(Coming soon: Ask CareerBee anything!)</span>
                <button class="btn-2">Try Demo</button>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js & Calendar Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
// Chart.js Career Progress Example
const ctx = document.getElementById('careerChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['2019', '2020', '2021', '2022', '2023'],
        datasets: [{
            label: 'Career Progress',
            data: [20, 40, 55, 75, 92],
            borderColor: '#FF3F00',
            backgroundColor: 'rgba(255,63,0,0.1)',
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#FF3F00',
            pointBorderColor: '#fff',
            pointRadius: 5,
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: '#fff' } }
        },
        scales: {
            x: { ticks: { color: '#fff' }, grid: { color: '#333' } },
            y: { ticks: { color: '#fff' }, grid: { color: '#333' } }
        }
    }
});

// Flatpickr Calendar
flatpickr("#dashboard-calendar", {
    inline: true,
    theme: 'dark',
    defaultDate: new Date(),
    locale: {
        firstDayOfWeek: 1
    }
});
</script>
