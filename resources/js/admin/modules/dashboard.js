import Chart from 'chart.js/auto';

const CHART_DATA_URL = document.getElementById('wa-chart')?.dataset.url;
let chart = null;

async function loadChart(year) {
    const loading = document.getElementById('chart-loading');
    if (loading) loading.style.display = 'flex';

    try {
        const res  = await fetch(`${CHART_DATA_URL}?year=${year}`);
        const json = await res.json();

        /* ── Update summary ── */
        const growth   = json.summary.growth;
        const growthEl = document.getElementById('summary-growth');
        const sign     = growth > 0 ? '+' : '';

        document.getElementById('summary-this-month').textContent = json.summary.this_month;
        document.getElementById('summary-last-month').textContent = json.summary.last_month;
        growthEl.textContent = `${sign}${growth}%`;
        growthEl.className   = `text-3xl font-semibold ${growth >= 0 ? 'text-green-500' : 'text-red-500'}`;

        /* ── Chart config ── */
        const config = {
            type: 'bar',
            data: {
                labels: json.labels,
                datasets: [
                    {
                        label:           'Float WA',
                        data:            json.datasets.float,
                        backgroundColor: 'oklch(72.3% 0.219 149.579)',
                        borderColor:     'oklch(52.7% 0.154 150.069)',
                        borderWidth:     1,
                        borderRadius:    4,
                    },
                    {
                        label:           'Kontak Kami',
                        data:            json.datasets.contact,
                        backgroundColor: 'oklch(62.3% 0.214 259.815)',
                        borderColor:     'oklch(48.8% 0.243 264.376)',
                        borderWidth:     1,
                        borderRadius:    4,
                    },
                    {
                        label:           'Detail Produk',
                        data:            json.datasets.product,
                        backgroundColor: 'oklch(63.7% 0.237 25.331)',
                        borderColor:     'oklch(50.5% 0.213 27.518)',
                        borderWidth:     1,
                        borderRadius:    4,
                    },
                    {
                        label:               'Total',
                        data:                 json.datasets.total,
                        type:                 'line',
                        borderColor:          '#4F5356',
                        backgroundColor:      '#4F5356',
                        borderWidth:           2,
                        pointRadius:           4,
                        pointBackgroundColor: 'rgb(79,83,86)',
                        tension:               0.3,
                        fill:                  false,
                    },
                ],
            },
            options: {
                responsive:          true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            footer: (items) => {
                                const sum = items
                                    .filter(i => i.dataset.type !== 'line')
                                    .reduce((a, b) => a + b.parsed.y, 0);
                                return `Total bar: ${sum} klik`;
                            },
                        },
                    },
                },
                scales: {
                    x: {
                        grid:  { display: false },
                        ticks: { font: { size: 12 } },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 12 } },
                        grid:  { color: 'rgba(0,0,0,0.05)' },
                    },
                },
            },
        };

        if (chart) {
            chart.data    = config.data;
            chart.options = config.options;
            chart.update();
        } else {
            chart = new Chart(document.getElementById('wa-chart'), config);
        }

    } catch (err) {
        console.error('Gagal memuat data chart:', err);
    } finally {
        if (loading) loading.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('wa-chart');
    if (!canvas) return;

    /* Init load */
    loadChart(document.getElementById('year-filter').value);

    /* Filter change */
    document.getElementById('year-filter')?.addEventListener('change', (e) => {
        loadChart(e.target.value);
    });
});