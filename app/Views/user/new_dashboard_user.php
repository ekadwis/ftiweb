<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<div class="row mt-5">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-5 fw-bold">Program Studi</div>
            <div>
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <?php foreach ($prodi as $index => $data): ?>
                        <option value="<?= $index; ?>" <?= $index == 0 ? 'selected' : ''; ?>><?= $data; ?></option>
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
    <div class="row row-cols-4 my-4 gap-3">
        <?php foreach ($perihal_dosen as $data): ?>
            <div class="card col">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class=""><?= $data['perihal']; ?></div>
                        <a href="/user/detail?section=<?= $data['perihal']; ?>" type="button" class="btn btn-dark btn-sm">Detail</a>
                    </div>
                    <div class="text-center">
                        <p class="card-text fs-3 fw-bold"><?= $data['jumlah_perihal']; ?></p>
                        <p class="card-text fw-normal fs-5"><?= $data['jumlah_dosen']; ?> Dosen</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Line Chart -->
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>

    <div class="d-flex justify-content-between">
        <!-- Bar Chart Most Lecture -->
        <figure class="highcharts-figure">
            <div id="bar-container"></div>
        </figure>
        <figure class="highcharts-figure">
            <div id="bar-container-2"></div>
        </figure>
    </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    const currentYear = new Date().getFullYear();
    const startYear = 2020;

    // Populate both selects (2020 to current year)
    const selectStartYear = document.getElementById("selectStartYear");
    const selectEndYear = document.getElementById("selectEndYear");

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

    // Set default selected values
    selectStartYear.value = startYear;
    selectEndYear.value = currentYear;
</script>

<script>
    var mostSurat = <?= json_encode($surat_terbanyak) ?>;
    var lessSurat = <?= json_encode($surat_tersedikit) ?>;

    var data = <?= json_encode($perihal_dosen) ?>;

    // Fungsi untuk membuat kategori berdasarkan tahun saat ini
    function createCategories() {
        const currentYear = new Date().getFullYear();
        const startYear = currentYear - 2; // Dua tahun sebelum tahun sekarang
        const categories = [];

        for (let year = startYear; year <= currentYear; year++) {
            categories.push(`${year}/${year + 1} <br> Gasal`);
            categories.push(`${year}/${year + 1} <br> Genap`);
        }

        return categories;
    }

    // Buat kategori dinamis
    const categories = createCategories();

    // Menyiapkan object untuk series data
    const seriesData = {};

    data.forEach(item => {
        const periodeAwalBulan = new Date(item.periode_awal).getMonth() + 1; // Bulan dari 1 - 12
        const periodeAkhirBulan = new Date(item.periode_akhir).getMonth() + 1;
        const periodeTahun = new Date(item.periode_awal).getFullYear();

        let category;

        // Tentukan kategori berdasarkan bulan (Gasal atau Genap)
        if (periodeAwalBulan <= 6 && periodeAkhirBulan <= 6) {
            category = `${periodeTahun - 1}/${periodeTahun} <br> Gasal`;
        } else {
            category = `${periodeTahun - 1}/${periodeTahun} <br> Genap`;
        }

        // Jika series dengan nama perihal belum ada, buat baru
        if (!seriesData[item.perihal]) {
            seriesData[item.perihal] = Array(categories.length).fill(0);
        }

        // Temukan index kategori di categories dan tambahkan jumlah_perihal ke series
        const categoryIndex = categories.indexOf(category);
        if (categoryIndex !== -1) {
            seriesData[item.perihal][categoryIndex] += parseInt(item.jumlah_perihal);
        }
    });

    // Konversi seriesData menjadi array untuk highcharts
    const series = Object.keys(seriesData).map(key => ({
        name: key,
        data: seriesData[key]
    }));

    // Konfigurasi Highcharts
    Highcharts.chart('container', {
        title: {
            text: 'Jenis - Jenis Beban Kerja Dosen Berdasarkan Periode',
            align: 'left'
        },

        yAxis: {
            title: {
                text: 'Jumlah'
            }
        },

        xAxis: {
            categories: categories,
            labels: {
                useHTML: true,
                style: {
                    fontWeight: 'bold',
                    textAlign: 'center'
                }
            },
            accessibility: {
                rangeDescription: `Range: ${categories[0]} to ${categories[categories.length - 1]}`
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

        series: series,

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
    // Most Lecture
    Highcharts.chart('bar-container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Dosen Dengan Kegiatan Terbanyak'
        },
        xAxis: {
            categories: mostSurat.map((v, i) => {
                return v.nama_dosen
            }),
            plotLines: [{
                color: '#000000',
                width: 1,
                value: 4.5 // Garis berada di atas kategori pertama
            }]
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: ''
            }

        },
        legend: {
            enabled: false,
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    style: {
                        color: '#FFFFFF'
                    }
                }
            }
        },
        series: [{
            name: 'Kegiatan',
            data: mostSurat.map((v, i) => {
                return parseInt(v.jumlah_surat)
            }),
        }]
    });
    Highcharts.chart('bar-container-2', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Dosen Dengan Kegiatan Sedikit'
        },
        xAxis: {
            categories: lessSurat.map((v, i) => {
                return v.nama_dosen
            }),
            plotLines: [{
                color: '#000000',
                width: 1,
                value: 4.5 // Garis berada di atas kategori pertama
            }]
        },
        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: ''
            }

        },
        legend: {
            enabled: false,
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    style: {
                        color: '#FFFFFF'
                    }
                }
            }
        },
        series: [{
            name: 'Kegiatan',
            data: lessSurat.map((v, i) => {
                return {
                    y: parseInt(v.jumlah_surat),
                    color: '#d62728'
                }
            }),
        }]
    });
</script>






<?= $this->endSection(); ?>