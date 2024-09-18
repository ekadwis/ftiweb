<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<div class="row mt-5">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-5 fw-bold">Program Studi</div>
            <div>
                <select id="prodiSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <?php if (empty($prodi)): ?>
                        <option value=""><?= 'Tidak ada data'; ?></option>
                    <?php else: ?>
                        <?php foreach ($prodi as $index => $data): ?>
                            <option value="<?= $data; ?>" <?= $data == 0 ? 'selected' : ''; ?>><?= $data; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
    <div class="row row-cols-5 gap-2 my-4 card-surat mx-2">
        <!-- Card elements will be dynamically inserted here by renderSuratCards function -->
    </div>

    <!-- Line Chart -->
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>

    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="fs-5 fw-bold">Beban Kerja</div>
        <div>
            <select id="bebanSelect" class="form-select form-select-sm" aria-label="Default select example">
                <option value="">Semua Kegiatan</option>
                <option value="Pengabdian">Pengabdian</option>
                <option value="Penelitian">Penelitian</option>
                <option value="Penunjang">Penunjang</option>
                <option value="Pengajaran">Pengajaran</option>
            </select>

        </div>
    </div>

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

        selectStartYear.value = startYear;
        selectEndYear.value = maxEndYear;

        fetchDataMostSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderMostChart(data);
        });
        fetchDataLessSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderLessChart(data);
        });
        fetchDataFromBackend(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderChart(data);
        });
        fecthSuratData(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderSuratCards(data);
        });
    }
    var selectedProdi = "Sistem Informasi"
    var selectedBeban = ""

    document.getElementById('prodiSelect').addEventListener('change', (event) => {
        selectedProdi = event.target.value;

        fetchDataFromBackend(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderChart(data);
        });
        fecthSuratData(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderSuratCards(data);
        });
        fetchDataMostSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderMostChart(data);
        });
        fetchDataLessSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderLessChart(data);
        });
    });
    document.getElementById('bebanSelect').addEventListener('change', (event) => {
        selectedBeban = event.target.value;

        fetchDataMostSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderMostChart(data);
        });
        fetchDataLessSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderLessChart(data);
        });
    });

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

    function handleYearChange() {
        startYear = selectStartYear.value;
        maxEndYear = selectEndYear.value;
        fetchDataFromBackend(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderChart(data);
        });
        fecthSuratData(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi).then(data => {
            renderSuratCards(data);
        });
        fetchDataMostSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderMostChart(data);
        });
        fetchDataLessSuratDosen(`${startYear}-01-01`, `${maxEndYear}-12-31`, selectedProdi, selectedBeban).then(data => {
            renderLessChart(data);
        });
    }

    selectStartYear.addEventListener("change", () => {
        updateEndYearOptions();
        handleYearChange();
    });

    selectEndYear.addEventListener("change", handleYearChange);

    updateEndYearOptions();
</script>

<script>
    function renderSuratCards(data) {
        const groupedSurat = [];

        data.forEach(item => {
            let key;

            if (item.perihal.includes('Penelitian')) {
                key = 'Penelitian';
            } else if (item.perihal.includes('Pengabdian')) {
                key = 'Pengabdian';
            } else if (item.perihal.includes('Pengajaran')) {
                key = 'Pengajaran';
            } else if (item.perihal.includes('Penunjang')) {
                key = 'Penunjang';
            } else {
                key = 'Lainnya';
            }

            let found = groupedSurat.find(group => group.perihal === key);

            if (!found) {
                // Menggunakan Set untuk memastikan nama dosen tidak terduplikat
                const uniqueDosen = new Set([item.nama_dosen]);

                groupedSurat.push({
                    perihal: key,
                    jumlah_surat: parseInt(item.jumlah_surat),
                    dosen: uniqueDosen
                });
            } else {
                // Tambahkan jumlah surat
                found.jumlah_surat += parseInt(item.jumlah_surat);
                // Tambahkan nama dosen ke dalam Set (untuk menghindari duplikasi)
                found.dosen.add(item.nama_dosen);
            }
        });

        // Setelah semua item di proses, ubah Set dosen menjadi jumlah_dosen
        groupedSurat.forEach(group => {
            group.jumlah_dosen = group.dosen.size; // hitung jumlah dosen unik
            delete group.dosen; // hapus Set dosen setelah selesai
        });

        const container = document.querySelector('.card-surat');
        container.innerHTML = "";

        if (groupedSurat.length > 0) {
            groupedSurat.forEach(data => {
                const card = document.createElement('div');
                card.className = 'col border p-3 rounded';

                const cardBody = document.createElement('div');
                cardBody.className = 'card-body d-flex flex-column justify-content-between';

                const headerDiv = document.createElement('div');
                headerDiv.className = 'd-flex justify-content-between align-items-start';

                const title = document.createElement('div');
                title.className = 'fs-5';
                title.textContent = data.perihal;

                const detailButton = document.createElement('a');
                detailButton.href = `/user/detail?section=${data.perihal}&prodi=${selectedProdi}`;
                detailButton.className = 'btn btn-dark btn-sm';
                detailButton.textContent = 'Detail';

                const textCenterDiv = document.createElement('div');
                textCenterDiv.className = 'text-center';

                const jumlahSurat = document.createElement('p');
                jumlahSurat.className = 'card-text fs-3 fw-bold';
                jumlahSurat.textContent = data.jumlah_surat;

                const jumlahDosen = document.createElement('p');
                jumlahDosen.className = 'card-text fw-normal fs-5';
                jumlahDosen.textContent = `${data.jumlah_dosen} Dosen`;

                headerDiv.appendChild(title);
                headerDiv.appendChild(detailButton);
                cardBody.appendChild(headerDiv);
                textCenterDiv.appendChild(jumlahSurat);
                textCenterDiv.appendChild(jumlahDosen);
                cardBody.appendChild(textCenterDiv);
                card.appendChild(cardBody);

                container.appendChild(card);
            });
        } else {
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'text-center col-12 py-4';
            emptyMessage.textContent = 'Data Tidak ada';
            container.appendChild(emptyMessage);
        }

    }

    function fecthSuratData(startDate, endDate, prodi) {
        return fetch(`http://localhost:8080/user/surat-data?startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }

    function fetchDataFromBackend(startDate, endDate, prodi) {
        return fetch(`http://localhost:8080/user/chart-data?startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }


    function renderChart(data) {

        if (!data) {
            console.error('No data available for chart rendering');
            return;
        }

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

            series: data.series,

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

    var mostSurat = []
    var lessSurat = []

    function fetchDataMostSuratDosen(startDate, endDate, prodi, beban) {
        return fetch(`http://localhost:8080/user/surat-dosen?type=most&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&beban=${encodeURIComponent(beban)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }

    function fetchDataLessSuratDosen(startDate, endDate, prodi, beban) {
        return fetch(`http://localhost:8080/user/surat-dosen?type=less&startDate=${encodeURIComponent(startDate)}&endDate=${encodeURIComponent(endDate)}&prodi=${encodeURIComponent(prodi)}&beban=${encodeURIComponent(beban)}`)
            .then(response => response.json())
            .catch(error => {
                console.error('Error fetching data:', error);
                return null;
            });
    }

    function renderMostChart(data) {
        Highcharts.chart('bar-container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Dosen Dengan Kegiatan Terbanyak'
            },
            xAxis: {
                categories: data.map(v => v.nama_dosen),
                plotLines: [{
                    color: '#000000',
                    width: 1,
                    value: 4.5
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
                data: data.map((v, i) => {
                    return parseInt(v.jumlah_matkul)
                }),
            }]
        });
    }

    function renderLessChart(data) {
        Highcharts.chart('bar-container-2', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Dosen Dengan Kegiatan Sedikit'
            },
            xAxis: {
                categories: data.map((v, i) => {
                    return v.nama_dosen
                }),
                plotLines: [{
                    color: '#000000',
                    width: 1,
                    value: 4.5
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
                data: data.map((v, i) => {
                    return {
                        y: parseInt(v.jumlah_matkul),
                        color: '#d62728'
                    }
                }),
            }]
        });
    }
</script>

<?= $this->endSection(); ?>