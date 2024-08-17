<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>


<div class="row mt-5">
    <h2 class="fw-bold">Detail <?= $detail_page ?> Dosen</h2>
    <div class="d-flex gap-5">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-5 fw-bold">Program Studi</div>
            <div>
                <select id="prodiSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Informatika">Informatika</option>
                </select>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 my-4">
            <div class="fs-5 fw-bold">Nama</div>
            <div>
                <select id="dosenSelect" class="form-select form-select-sm" aria-label="Default select example">

                    <?php foreach ($dosen as $data): ?>
                        <option value="<?= $data; ?>"><?= $data; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="fs-5 fw-bold">Tahun:</div>
            <div>
                <select id="selectStartYear" class="form-select form-select-sm" aria-label="Default select example"></select>
            </div>
            <div>s/d</div>
            <div>
                <select id="selectEndYear" class="form-select form-select-sm" aria-label="Default select example"></select>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-3">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <figure class="highcharts-figure">
        <div id="public-container"></div>
    </figure>
    <div>
        <div class="fw-bold fs-5 mb-3">Jenis Beban</div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Pengajaran">
            <label class="form-check-label" for="flexRadioDefault1">
                Pengajaran
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Pengabdian">
            <label class="form-check-label" for="flexRadioDefault2">
                Pengabdian
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="Penelitian">
            <label class="form-check-label" for="flexRadioDefault3">
                Penelitian
            </label>
        </div>
    </div>

</div>
</div>
<div class="">
    <div class="fw-bold fs-5 mb-3">Daftar Kegiatan <?= $detail_page; ?> Dosen</div>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kegiatan</th>
                <th scope="col">Periode Awal</th>
                <th scope="col">Periode Akhir</th>
            </tr>
        </thead>
        <tbody id="table-kegiatan">
        </tbody>
    </table>
</div>
<div class="py-3">
    <figure class="highcharts-figure">
        <div id="line-container"></div>
    </figure>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan parameter 'section' dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');

        // Cari radio button yang sesuai dengan nilai 'section' dari URL
        if (section) {
            const radioButton = document.querySelector(`input[value="${section}"]`);
            if (radioButton) {
                radioButton.checked = true; // Pilih radio button
            }
        }

        // Tambahkan event listener pada radio button
        document.querySelectorAll('input[name="flexRadioDefault"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const selectedSection = this.value;
                // Redirect ke URL baru saat radio button diubah
                window.location.href = `http://localhost:8080/user/detail?section=${selectedSection}`;
            });
        });
    });

    var currentYear = new Date().getFullYear();
    var startYear = 2020;
    var selectedProdi = "Sistem Informasi"
    var selectedDosen = "<?= $dosen[0] ?>";

    const selectStartYear = document.getElementById("selectStartYear");
    const selectEndYear = document.getElementById("selectEndYear");
</script>
<!-- API FETCH -->
<script>
    function formatDate(dateString) {
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const date = new Date(dateString);
        const day = date.getDate();
        const month = months[date.getMonth()];
        const year = date.getFullYear();

        return `${day} ${month} ${year}`;
    }

    function fecthApi(startDate, endDate, prodi, selectedDosen) {
        return fetch(`http://localhost:8080/user/surat-detail?section=<?= $detail_page; ?>&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&dosen=${encodeURIComponent(selectedDosen)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null; // Mengembalikan null jika ada error
            });
    }

    fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, "Sistem Informasi", selectedDosen).then(data => {
        bebanKerjaChart(data)
        publikasiChart(data)
        populateTable(data)
    });

    function fecthChartApi(startDate, endDate, prodi, selectedDosen) {
        return fetch(`http://localhost:8080/user/chart-detail?section=<?= $detail_page; ?>&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&dosen=${encodeURIComponent(selectedDosen)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null; // Mengembalikan null jika ada error
            });
    }
    fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, "Sistem Informasi", selectedDosen).then(data => {
        renderChart(data);
    });
</script>
<script>
    for (let year = startYear; year <= currentYear; year++) {
        // Start Year Options
        const optionStart = document.createElement("option");
        optionStart.value = year;
        optionStart.textContent = year;
        selectStartYear.appendChild(optionStart);

        // End Year Options
        const optionEnd = document.createElement("option");
        optionEnd.value = year;
        optionEnd.textContent = year;
        selectEndYear.appendChild(optionEnd);
    }

    selectStartYear.value = startYear;
    selectEndYear.value = currentYear;

    function updateEndYearOptions() {
        const startYearValue = parseInt(selectStartYear.value, 10);

        // Enable all options in selectEndYear first
        Array.from(selectEndYear.options).forEach(option => {
            option.disabled = false;
        });

        // Disable options less than the selected startYear
        Array.from(selectEndYear.options).forEach(option => {
            if (parseInt(option.value, 10) < startYearValue) {
                option.disabled = true;
            }
        });

        // If the current end year is less than the selected start year, update it
        if (parseInt(selectEndYear.value, 10) < startYearValue) {
            selectEndYear.value = startYearValue;
        }
    }
    selectStartYear.addEventListener("change", () => {
        updateEndYearOptions();
        handleYearChange();
    });

    selectEndYear.addEventListener("change", handleYearChange);

    document.getElementById('prodiSelect').addEventListener('change', (event) => {
        selectedProdi = event.target.value;

        fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            bebanKerjaChart(data)
            publikasiChart(data)
            populateTable(data)
        });
        fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            renderChart(data);
        });
    });
    document.getElementById('dosenSelect').addEventListener('change', (event) => {
        selectedDosen = event.target.value;

        fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            bebanKerjaChart(data)
            publikasiChart(data)
            populateTable(data)
        });
        fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            renderChart(data);
        });
    });

    function handleYearChange() {
        startYear = selectStartYear.value;
        currentYear = selectEndYear.value;
        fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            bebanKerjaChart(data)
            publikasiChart(data)
            populateTable(data)
        });
        fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            renderChart(data);
        });
    }

    // Initialize end year options on page load
    updateEndYearOptions();
</script>
<script>
    const tableBody = document.getElementById("table-kegiatan");

    function bebanKerjaChart(data) {
        // Filter data untuk mengecek apakah semuanya kosong atau tidak valid
        const validData = data.filter(item => item.perihal !== null && item.jumlah_surat !== "0");

        let chartData;

        if (validData.length === 0) {
            // Jika tidak ada data valid, tampilkan "No Data"
            chartData = [{
                name: "No Data",
                y: 0
            }];
        } else {
            // Konversi data API ke format yang sesuai untuk Highcharts
            chartData = validData.map(item => ({
                name: item.perihal,
                y: parseInt(item.jumlah_surat)
            }));
        }

        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                custom: {},
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            title: {
                text: 'Beban Kerja'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.percentage:.0f}%',
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: "Total",
                colorByPoint: true,
                innerSize: '75%',
                data: chartData // Data dari API yang sudah diolah
            }]
        });
    }

    function publikasiChart(data) {
        // Filter data untuk mengecek apakah semuanya kosong atau tidak valid
        const validData = data.filter(item => item.perihal !== null && item.jumlah_surat !== "0");

        let groupedData = {};

        if (validData.length === 0) {
            // Jika tidak ada data valid, tampilkan "No Data"
            groupedData = {
                "No Data": 0
            };
        } else {
            groupedData = validData.reduce((acc, item) => {
                const {
                    perihal,
                    jumlah_surat
                } = item;
                let groupName = "Lainnya"; // Default group jika tidak ada kata "Internasional" atau "Nasional"

                if (perihal.toLowerCase().includes("internasional")) {
                    groupName = "Internasional";
                } else if (perihal.toLowerCase().includes("nasional")) {
                    groupName = "Nasional";
                }

                // Tambahkan jumlah surat ke dalam kelompok yang sesuai
                if (!acc[groupName]) {
                    acc[groupName] = 0;
                }
                acc[groupName] += parseInt(jumlah_surat, 10);

                return acc;
            }, {});
        }

        // Konversi groupedData ke format yang sesuai untuk Highcharts
        const chartData = Object.keys(groupedData).map(groupName => ({
            name: groupName,
            y: groupedData[groupName]
        }));

        Highcharts.chart('public-container', {
            chart: {
                type: 'pie',
                custom: {},
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            title: {
                text: 'Publikasi <?= $detail_page; ?> Dosen'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.percentage:.0f}%',
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: "Total",
                colorByPoint: true,
                innerSize: '75%',
                data: chartData // Data yang sudah dikelompokkan
            }]
        });
    }


    function populateTable(data) {
        // Bersihkan isi tabel terlebih dahulu untuk menghindari duplikasi
        tableBody.innerHTML = '';

        // Filter data untuk mengecek apakah semuanya kosong atau tidak valid
        const validData = data.filter(item => item.kegiatan_keperluan !== null && item.periode_awal !== null && item.periode_akhir !== null);

        if (validData.length === 0) {
            // Jika tidak ada data valid, tampilkan "No Data"
            const row = document.createElement('tr');
            row.innerHTML = `
            <td colspan="4" style="text-align: center;">No Data</td>
        `;
            tableBody.appendChild(row);
        } else {
            validData.forEach((item, index) => {
                const row = document.createElement('tr');

                // Tambahkan data ke dalam row
                row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${item.kegiatan_keperluan || 'No Data'}</td>
                <td>${formatDate(item.periode_awal) || 'No Data'}</td>
                <td>${formatDate(item.periode_akhir) || 'No Data'}</td>
            `;

                // Tambahkan row ke dalam tbody
                tableBody.appendChild(row);
            });
        }
    }

    // Line Chart

    function renderChart(data) {
        Highcharts.chart('line-container', {
            title: {
                text: 'Jenis <?= $detail_page; ?> Berdasarkan Periode',
                align: 'left'
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Jumlah'
                }
            },

            xAxis: {
                categories: data.categories, // Menggunakan categories dari PHP
                labels: {
                    useHTML: true,
                    style: {
                        fontWeight: 'bold', // Membuat teks bold
                        textAlign: 'center' // Memusatkan teks
                    }
                },
                accessibility: {
                    rangeDescription: `Range: ${data.categories[0]} to ${data.categories[data.categories.length - 1]}`
                }
            },

            legend: {
                enabled: false,
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    },
                    marker: {
                        enabled: true,
                        symbol: 'circle'
                    }
                }
            },

            series: data.series, // Menggunakan series dari PHP

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
    }
</script>
<?= $this->endSection(); ?>