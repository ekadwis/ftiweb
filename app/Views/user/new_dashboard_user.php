<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<div class="row mt-5">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="fs-5 fw-bold">Program Studi</div>
            <div>
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Sistem Informasi</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="fs-5 fw-bold">Tahun:</div>
            <div>
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>2020</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div>s/d</div>
            <div>
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>2024</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row my-4 gap-4">
        <div class="card col">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-5">Pengajaran</div>
                    <a href="/user/detail?section=pengajaran" type="button" class="btn btn-dark btn-sm">Detail</a>
                </div>
                <div class="text-center">
                    <p class="card-text fs-3 fw-bold">25</p>
                    <p class="card-text fw-normal fs-5">30 Dosen</p>
                </div>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-5">Pengabdian</div>
                    <a href="/user/detail?section=pengabdian" type="button" class="btn btn-dark btn-sm">Detail</a>
                </div>
                <div class="text-center">
                    <p class="card-text fs-3 fw-bold">25</p>
                    <p class="card-text fw-normal fs-5">30 Dosen</p>
                </div>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-5">Penelitian</div>
                    <a href="/user/detail?section=penelitian" type="button" class="btn btn-dark btn-sm">Detail</a>
                </div>
                <div class="text-center">
                    <p class="card-text fs-3 fw-bold">25</p>
                    <p class="card-text fw-normal fs-5">30 Dosen</p>
                </div>
            </div>
        </div>
        <div class="card col">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fs-5">Penunjang</div>
                    <a href="/user/detail?section=penunjang" type="button" class="btn btn-dark btn-sm">Detail</a>
                </div>
                <div class="text-center">
                    <p class="card-text fs-3 fw-bold">25</p>
                    <p class="card-text fw-normal fs-5">30 Dosen</p>
                </div>
            </div>
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
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    // Line Chart
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
            categories: [
                '2020/2021 <br> Gasal', '2020/2021 <br> Genap',
                '2021/2022 <br> Gasal', '2021/2022 <br> Genap',
                '2022/2023 <br> Gasal', '2022/2023 <br> Genap',
                '2023/2024 <br> Gasal', '2023/2024 <br> Genap'
            ],
            labels: {
                useHTML: true,
                style: {
                    fontWeight: 'bold', // Membuat teks bold
                    textAlign: 'center' // Memusatkan teks
                }
            },
            accessibility: {
                rangeDescription: 'Range: 2020/2021 Gasal to 2023/2024 Genap'
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

        series: [{
                name: 'Pengajaran',
                data: [
                    21, 22, 24, 25, 21, 24, 24, 25
                ]
            },
            {
                name: 'Pengabdian',
                data: [
                    20, 25, 22, 21, 24, 22, 25, 22
                ]
            },
            {
                name: 'Penelitian',
                data: [
                    12, 14, 11, 14, 24, 12, 21, 14
                ]
            },
            {
                name: 'Penunjang',
                data: [
                    24, 22, 21, 42, 12, 43, 31, 32
                ]
            }
        ],

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
            categories: [
                'Junaidi', 'Saiful', 'Alpa', 'Manu', 'Daya'
            ],
            plotLines: [{
                color: '#000000',
                width: 1,
                value: 4.5 // Garis berada di atas kategori pertama
            }]
        },
        yAxis: {
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
            data: [42, 27, 22, 21, 19],
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
            categories: [
                'Junaidi', 'Saiful', 'Alpa', 'Manu', 'Daya'
            ],
            plotLines: [{
                color: '#000000',
                width: 1,
                value: 4.5 // Garis berada di atas kategori pertama
            }]
        },
        yAxis: {
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
            data: [{
                    y: 19,
                    color: '#d62728'
                },
                {
                    y: 21,
                    color: '#d62728'
                },
                {
                    y: 24,
                    color: '#d62728'
                },
                {
                    y: 27,
                    color: '#d62728'
                },
                {
                    y: 47,
                    color: '#d62728'
                }
            ]
        }]
    });
</script>






<?= $this->endSection(); ?>