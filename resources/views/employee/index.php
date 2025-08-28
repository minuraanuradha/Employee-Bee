<?php
// Employee Dashboard Page
$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? null;
$unique_id = $_SESSION['unique_id'] ?? null;
// $employee is expected to be provided by the controller
$employee = $employee ?? [];
$username = $employee['full_name'] ?? $_SESSION['full_name'] ?? 'Employee';
$unique_id_display = $employee['unique_id'] ?? $unique_id ?? 'N/A';

// Debug: Print variables to see what's being passed
// error_log("Index View - Employee: " . print_r($employee, true));
// error_log("Index View - Employment History: " . print_r($employmentHistory, true));
// error_log("Index View - Career Stats: " . print_r($careerStats, true));
?>

<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-orange to-orange/80 rounded-xl shadow-lg p-6 mb-6 text-white h-1/2">
    <h1 class="text-h3 font-bold mb-2">Welcome, <?= htmlspecialchars(explode(' ', $username)[0]) ?>!</h1>
    <p class="text-p-regular">Here's your career dashboard at a glance</p>
    <div class="flex flex-wrap gap-4 mt-4">
        <a href="?path=employee/history" class="btn-2 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            View Employment History
        </a>
        <a href="?path=employee/insights" class="btn-2 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.378 3.378 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
            Career Insights
        </a>
    </div>
</div>



<!-- Chart.js & Calendar Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
// Chart.js Career Progress Example
document.addEventListener('DOMContentLoaded', function() {
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

    // Flatpickr Calendar with dark theme
    flatpickr("#dashboard-calendar", {
        inline: true,
        theme: 'dark',
        defaultDate: new Date(),
        locale: {
            firstDayOfWeek: 1
        },
        onChange: function(selectedDates, dateStr, instance) {
            // Optional: Add functionality when date changes
        }
    });

    // Skills Proficiency Chart
    const skillsCtx = document.getElementById('skillsChart').getContext('2d');
    new Chart(skillsCtx, {
        type: 'bar',
        data: {
            labels: ['JavaScript', 'React', 'Node.js', 'Python', 'AWS', 'Machine Learning'],
            datasets: [{
                label: 'Proficiency %',
                data: [95, 90, 85, 75, 80, 70],
                backgroundColor: [
                    'rgba(255, 63, 0, 0.7)',
                    'rgba(255, 63, 0, 0.6)',
                    'rgba(255, 63, 0, 0.5)',
                    'rgba(255, 63, 0, 0.4)',
                    'rgba(255, 63, 0, 0.3)',
                    'rgba(255, 63, 0, 0.2)'
                ],
                borderColor: '#FF3F00',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { ticks: { color: '#fff' }, grid: { color: '#333' } },
                y: { 
                    ticks: { color: '#fff', callback: function(value) { return value + '%' } },
                    grid: { color: '#333' },
                    min: 0,
                    max: 100
                }
            }
        }
    });

    // Performance Metrics Chart
    const performanceCtx = document.getElementById('performanceChart').getContext('2d');
    new Chart(performanceCtx, {
        type: 'radar',
        data: {
            labels: ['Communication', 'Technical Skills', 'Teamwork', 'Problem Solving', 'Leadership', 'Creativity'],
            datasets: [{
                label: 'Current Performance',
                data: [85, 92, 78, 88, 75, 80],
                backgroundColor: 'rgba(128, 0, 128, 0.2)',
                borderColor: 'rgba(128, 0, 128, 1)',
                pointBackgroundColor: 'rgba(128, 0, 128, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(128, 0, 128, 1)'
            }, {
                label: 'Target Performance',
                data: [90, 95, 85, 92, 80, 85],
                backgroundColor: 'rgba(255, 63, 0, 0.2)',
                borderColor: 'rgba(255, 63, 0, 1)',
                pointBackgroundColor: 'rgba(255, 63, 0, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 63, 0, 1)'
            }]
        },
        options: {
            plugins: {
                legend: { 
                    labels: { color: '#fff' }
                }
            },
            scales: {
                r: {
                    angleLines: { color: '#333' },
                    grid: { color: '#333' },
                    pointLabels: { color: '#fff' },
                    ticks: { 
                        color: '#fff', 
                        backdropColor: 'transparent',
                        callback: function(value) { return value + '%' }
                    }
                }
            }
        }
    });

    // Work Time & Company Distribution Chart
    const workTimeCtx = document.getElementById('workTimeChart').getContext('2d');
    new Chart(workTimeCtx, {
        type: 'radar',
        data: {
            labels: ['Company A', 'Company B', 'Company C', 'Company D', 'Company E', 'Freelance'],
            datasets: [{
                label: 'Time Distribution (%)',
                data: [40, 35, 15, 5, 3, 2],
                backgroundColor: 'rgba(255, 63, 0, 0.2)',
                borderColor: 'rgba(255, 63, 0, 1)',
                pointBackgroundColor: 'rgba(255, 63, 0, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 63, 0, 1)'
            }]
        },
        options: {
            plugins: {
                legend: { 
                    labels: { color: '#fff' }
                }
            },
            scales: {
                r: {
                    angleLines: { color: '#333' },
                    grid: { color: '#333' },
                    pointLabels: { color: '#fff' },
                    ticks: { 
                        color: '#fff', 
                        backdropColor: 'transparent',
                        callback: function(value) { return value + '%' }
                    },
                    min: 0,
                    max: 50
                }
            }
        }
    });

    // Work History Chart
    const workHistoryCtx = document.getElementById('workHistoryChart').getContext('2d');
    new Chart(workHistoryCtx, {
        type: 'bar',
        data: {
            labels: ['Company A', 'Company B', 'Company C', 'Company D', 'Freelance'],
            datasets: [{
                label: 'Work Period (months)',
                data: [24, 18, 36, 12, 8],
                backgroundColor: [
                    'rgba(255, 63, 0, 0.7)',
                    'rgba(255, 63, 0, 0.6)',
                    'rgba(255, 63, 0, 0.5)',
                    'rgba(255, 63, 0, 0.4)',
                    'rgba(255, 63, 0, 0.3)'
                ],
                borderColor: '#FF3F00',
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: { color: '#fff' }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#fff' },
                    grid: { color: '#333' }
                },
                y: {
                    ticks: { color: '#fff' },
                    grid: { color: '#333' },
                    min: 0
                }
            }
        }
    });
});
</script>


            }
        }
    });
});
</script>

