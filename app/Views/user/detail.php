<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<style>
    .link-card {
        transition: background-color 0.3s ease;
    }

    .link-card.active {
        background-color: #e0e0e0;
        /* Warna sedikit lebih gelap */
    }
</style>
<?php
// Membuat array kosong untuk menampung kelompok
$grouped = array();

// Memproses data
foreach ($beban_group as $item) {
    if (strpos($item['perihal'], 'Pengajaran') !== false) {
        $grouped['Pengajaran'] = 'Pengajaran';
    } elseif (strpos($item['perihal'], 'Pengabdian') !== false) {
        $grouped['Pengabdian'] = 'Pengabdian';
    } elseif (strpos($item['perihal'], 'Penelitian') !== false) {
        $grouped['Penelitian'] = 'Penelitian';
    } elseif (strpos($item['perihal'], 'Penunjang') !== false) {
        $grouped['Penunjang'] = 'Penunjang';
    }
}
?>
<div class="row mt-5">
    <h2 class="fw-bold">Detail <?= $detail_page ?> Dosen</h2>
    <div class="d-flex gap-5">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-5 fw-bold">Unit</div>
            <div>
                <select id="prodiSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option value="" <?= ($prodi == '') ? 'selected' : '' ?>>Fakultas Teknologi Informasi</option>
                    <option value="Sistem Informasi" <?= ($prodi == 'Sistem Informasi') ? 'selected' : '' ?>>Sistem Informasi</option>
                    <option value="Informatika" <?= ($prodi == 'Informatika') ? 'selected' : '' ?>>Informatika</option>
                </select>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 my-4">
            <div class="fs-5 fw-bold">Nama</div>
            <div>
                <select id="dosenSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <!-- Options akan dirender dengan JavaScript -->
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
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="fs-5 fw-bold">Jenis Beban</div>
    <?php foreach ($grouped as $key => $value) : ?>
        <a href="#"
            style="font-size: 14px;"
            class="card px-2 py-0 link-card <?= ($value === $detail_page) ? 'active' : ''; ?>"
            data-value="<?= $value; ?>">
            <?= $value; ?>
        </a>
    <?php endforeach; ?>
</div>



<div class="row row-cols-3">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <figure class="highcharts-figure">
        <div id="public-container"></div>
    </figure>

</div>
</div>
<div class="">
    <div class="fw-bold fs-5 mb-3">Daftar Kegiatan <?= $detail_page; ?> Dosen</div>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kegiatan</th>
                <th <?= ($detail_page !== 'Pengajaran') ? 'hidden' : ''; ?> scope="col">Jumlah Mata Kuliah</th>
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
    var currentYear = new Date().getFullYear();
    var startYear = 2016;
    var maxEndYear = currentYear + 2;
    const selectStartYear = document.getElementById('selectStartYear');
    const selectEndYear = document.getElementById('selectEndYear');


    function fecthDataYear() {
        return fetch(`http://localhost:8080/user/year-detail`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }
    fecthDataYear().then(data => {
        if (data) {
            startYear = data.startYear;
            maxEndYear = data.endYear;

            populateYearOptions(startYear, maxEndYear);
        }
    });



    function populateYearOptions(startYear, maxEndYear) {
        // Kosongkan isi dropdown sebelumnya
        selectStartYear.innerHTML = '';
        selectEndYear.innerHTML = '';

        // Loop dari startYear ke maxEndYear
        for (let year = startYear; year <= maxEndYear; year++) {
            // Buat opsi untuk start year
            const optionStart = document.createElement("option");
            optionStart.value = year;
            optionStart.textContent = year;
            selectStartYear.appendChild(optionStart);

            // Buat opsi untuk end year
            const optionEnd = document.createElement("option");
            optionEnd.value = year;
            optionEnd.textContent = year;
            selectEndYear.appendChild(optionEnd);
        }

        // Set nilai default: startYear untuk dropdown kiri, maxEndYear untuk dropdown kanan
        selectStartYear.value = startYear;
        selectEndYear.value = maxEndYear; // Default dropdown end year diatur ke tahun terbesar

        fecthApi(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            if (`<?= $detail_page ?>` == "Pengabdian" || `<?= $detail_page ?>` == "Penelitian") {
                bebanKerjaChart(data)
            }
        });
        fetchKegiatan(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            populateTable(data)
        });

        fetchPublikasiApi(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            if (`<?= $detail_page ?>` == "Pengabdian" || `<?= $detail_page ?>` == "Penelitian") {
                publikasiChart(data)
            }
        });
        fecthChartApi(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            renderChart(data);
        });
    }


    var selectedProdi = "<?= $prodi; ?>"
    var selectedDosen = "<?= isset($dosen_prodi[0]) ? $dosen_prodi[0] : ''; ?>";

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const section = urlParams.get('section');

        // Menandai link yang aktif berdasarkan URL parameter
        if (section) {
            const activeCard = document.querySelector(`.link-card[data-value="${section}"]`);
            if (activeCard) {
                activeCard.classList.add('active');
            }
        }

        // Menambahkan event listener untuk mengubah background saat kartu diklik
        document.querySelectorAll('.link-card').forEach(function(card) {
            card.addEventListener('click', function(event) {
                event.preventDefault(); // Menghentikan perilaku link default

                // Menghapus kelas aktif dari semua kartu
                document.querySelectorAll('.link-card').forEach(function(c) {
                    c.classList.remove('active');
                });

                // Menandai kartu yang dipilih
                const selectedSection = this.getAttribute('data-value');
                this.classList.add('active');

                // Arahkan ke halaman baru
                window.location.href = `http://localhost:8080/user/detail?section=${selectedSection}&prodi=${selectedProdi}`;
            });
        });
    });
</script>

<script>
    function renderSelectProdi(prodiList) {
        const selectElement = document.getElementById('dosenSelect');
        selectElement.innerHTML = ''; // Hapus opsi lama

        // Mendapatkan nilai dari PHP
        var selectedDosen = "<?= isset($dosen_prodi[0]) ? $dosen_prodi[0] : ''; ?>";

        if (prodiList.length === 0) {
            // Jika tidak ada data
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Tidak ada data';
            selectElement.appendChild(option);
        } else {
            // Jika ada data, loop dan tambahkan opsi
            prodiList.forEach((data) => {
                const option = document.createElement('option');
                option.value = data.nama_dosen;
                option.textContent = data.nama_dosen;
                if (data.nama_dosen === selectedDosen) {
                    option.selected = true; // Set opsi yang sesuai dengan selectedDosen sebagai selected
                }
                selectElement.appendChild(option);
            });
        }
    }


    // Fungsi untuk fetch data dosen berdasarkan prodi
    function fetchDataDosen(prodi) {
        return fetch(`http://localhost:8080/user/dosen-detail?section=<?= $detail_page; ?>&prodi=${encodeURIComponent(prodi)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }

    // Render select dengan data prodi dari server
    fetchDataDosen(selectedProdi).then(data => {
        if (data) {
            renderSelectProdi(data);
        }
    });
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
                return null;
            });
    }

    function fetchKegiatan(startDate, endDate, prodi, selectedDosen) {
        return fetch(`http://localhost:8080/user/kegiatan-detail?section=<?= $detail_page; ?>&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&dosen=${encodeURIComponent(selectedDosen)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }

    function fetchPublikasiApi(startDate, endDate, prodi, selectedDosen) {
        return fetch(`http://localhost:8080/user/publikasi-detail?section=<?= $detail_page; ?>&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&dosen=${encodeURIComponent(selectedDosen)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }


    function fecthChartApi(startDate, endDate, prodi, selectedDosen) {
        return fetch(`http://localhost:8080/user/chart-detail?section=<?= $detail_page; ?>&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&dosen=${encodeURIComponent(selectedDosen)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }
</script>
<script>
    function updateEndYearOptions() {
        const startYearValue = parseInt(selectStartYear.value, 10);

        Array.from(selectEndYear.options).forEach(option => {
            option.disabled = false;
        });

        Array.from(selectEndYear.options).forEach(option => {
            if (parseInt(option.value, 10) < startYearValue) {
                option.disabled = true;
            }
        });

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

        // Fetch data dosen terlebih dahulu dan update selectedDosen
        fetchDataDosen(selectedProdi).then(data => {
            renderSelectProdi(data);
            if (data.length > 0) {
                selectedDosen = data[0].nama_dosen;
            }

            // Setelah selectedDosen diperbarui, lakukan fetch ke API lain
            fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
                bebanKerjaChart(data);
            });
            fetchPublikasiApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
                publikasiChart(data)
            });

            fetchKegiatan(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
                populateTable(data)
            });

            fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
                renderChart(data);
            });
        });
    });
    document.getElementById('dosenSelect').addEventListener('change', (event) => {
        selectedDosen = event.target.value;

        fecthApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            bebanKerjaChart(data)
        });
        fetchPublikasiApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            publikasiChart(data)
        });

        fetchKegiatan(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
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
        });
        fetchPublikasiApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            publikasiChart(data)
        });
        fetchKegiatan(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            populateTable(data)
        });
        fecthChartApi(`${startYear}-01-01`, `${currentYear}-12-31`, selectedProdi, selectedDosen).then(data => {
            renderChart(data);
        });
    }

    updateEndYearOptions();
</script>
<script>
    const tableBody = document.getElementById("table-kegiatan");

    function bebanKerjaChart(data) {
        const validData = data.filter(item => item.jenis_publikasi !== null && item.jumlah_surat !== "0");

        let chartData;

        if (validData.length === 0) {
            chartData = [{
                name: "No Data",
                y: 0
            }];
        } else {
            chartData = validData.map(item => ({
                name: item.jenis_publikasi,
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
                data: chartData
            }]
        });
    }

    function publikasiChart(data) {
        console.log(data);

        const validData = data.filter(item => item.perihal !== null && item.jumlah_surat !== "0");

        let groupedData = {};

        if (validData.length === 0) {
            groupedData = {
                "No Data": 0
            };
        } else {
            groupedData = validData.reduce((acc, item) => {
                const {
                    perihal,
                    jumlah_surat
                } = item;
                let groupName = "Lainnya";

                if (perihal.toLowerCase().includes("internasional")) {
                    groupName = "Internasional";
                } else if (perihal.toLowerCase().includes("nasional")) {
                    groupName = "Nasional";
                } else if (perihal.toLowerCase().includes("lokal")) {
                    groupName = "Lokal";
                } else if (perihal.toLowerCase().includes("internal")) {
                    groupName = "Internal";
                }
                if (!acc[groupName]) {
                    acc[groupName] = 0;
                }
                acc[groupName] += parseInt(jumlah_surat, 10);

                return acc;
            }, {});
        }

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
                text: 'Tingkat Publikasi <?= $detail_page; ?> Dosen'
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
                data: chartData
            }]
        });
    }


    function populateTable(data) {
        tableBody.innerHTML = '';

        const validData = data.filter(item => item.keputusan !== null && item.periode_awal !== null && item.periode_akhir !== null);

        if (validData.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td colspan="4" style="text-align: center;">No Data</td>
        `;
            tableBody.appendChild(row);
        } else {
            validData.forEach((item, index) => {
                const row = document.createElement('tr');

                row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${item.keputusan || 'No Data'}</td>
                <td ${`<?= $detail_page; ?>` !== 'Pengajaran' ? 'hidden' : ''}>${item.jumlah_matkul || 'No Data'}</td>
                <td>${formatDate(item.periode_awal) || 'No Data'}</td>
                <td>${formatDate(item.periode_akhir) || 'No Data'}</td>
            `;
                tableBody.appendChild(row);
            });
        }
    }


    function renderChart(data) {
        let seriesData;
        if ('<?= $detail_page; ?>' === 'Pengajaran') {
            seriesData = data.series.map(serie => ({
                name: serie.name,
                data: serie.data_jumlah_matkul
            }));
        } else {
            seriesData = data.series.map(serie => ({
                name: serie.name,
                data: serie.data_jumlah_surat
            }));
        }

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
                categories: data.categories,
                labels: {
                    useHTML: true,
                    style: {
                        fontWeight: 'bold',
                        textAlign: 'center'
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
            tooltip: {
                shared: true
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

            series: seriesData,

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