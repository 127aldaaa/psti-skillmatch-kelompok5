// Set Default Font
Chart.defaults.font.family = "'Inter', sans-serif";
Chart.defaults.color = "#64748b";

// Line Chart (Pendaftaran Pengguna)
const lineCtx = document.getElementById('lineChart');
if (lineCtx) {
    const ctx = lineCtx.getContext('2d');
    // Create Gradient for Line Chart
    let gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)');
    gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pengguna Baru',
                data: [65, 85, 120, 150, 180, 210],
                borderColor: '#2563eb',
                backgroundColor: gradient,
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563eb',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 12,
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13 },
                    displayColors: false
                }
            },
            scales: {
                y: { 
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', drawBorder: false }
                },
                x: {
                    grid: { display: false, drawBorder: false }
                }
            }
        }
    });
}

// Pie/Doughnut Chart (Distribusi Peminatan)
const pieCtxEl = document.getElementById('pieChart');
if (pieCtxEl) {
    const pieCtx = pieCtxEl.getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Web Dev', 'Data Analysis', 'Cybersecurity', 'AI / ML'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.label + ': ' + context.raw + '%';
                        }
                    }
                }
            },
            cutout: '75%',
            layout: {
                padding: { top: 10, bottom: 10 }
            }
        }
    });
}
