<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content') ?>
<div class="row mt-5">
    <h2 class="fw-bold">Detail <?= $section ?> Dosen</h2>
    <div class="d-flex gap-5">
        <div class="d-flex align-items-center gap-2 my-4">
            <div class="fs-5 fw-bold">Program Studi</div>
            <div class="">
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Sistem Informasi</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>

        </div>
        <div class="d-flex align-items-center gap-2 my-4">
            <div class="fs-5 fw-bold">Nama</div>
            <div>
                <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Sistem Informasi</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 my-4">
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
</div>

<div class="d-flex gap-4">
    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>
    <figure class="highcharts-figure">
        <div id="public-container"></div>
    </figure>
    <div>
        <div class="fw-bold fs-5 mb-3">Jenis Bahan</div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
                Pengajaran
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
                Pengabdian
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
            <label class="form-check-label" for="flexRadioDefault3">
                Penelitian
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
            <label class="form-check-label" for="flexRadioDefault4">
                Penunjang
            </label>
        </div>

    </div>
</div>
<div class="d-flex">
    <div class="col-7">
        <div class="fw-bold fs-5 mb-3">Daftar Kegiatan <?= $section; ?> Dosen</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <figure class="highcharts-figure">
            <div id="work-container"></div>
        </figure>
    </div>
</div>
<div>
    <!-- Line Chart -->
    <figure class="highcharts-figure">
        <div id="line-container"></div>
    </figure>
</div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
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
            pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
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
            data: [{
                name: 'Pengajaran',
                y: 23.9
            }, {
                name: 'Pengabdian',
                y: 12.6
            }, {
                name: 'Penelitian',
                y: 37.0
            }, {
                name: 'Penunjang',
                y: 26.4
            }]
        }]
    });
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
            text: 'Publikasi <?= $section; ?> Dosen'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
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
            data: [{
                name: 'Pengajaran',
                y: 23.9
            }, {
                name: 'Pengabdian',
                y: 12.6
            }, {
                name: 'Penelitian',
                y: 37.0
            }, {
                name: 'Penunjang',
                y: 26.4
            }]
        }]
    });
    Highcharts.chart('work-container', {
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
            text: 'Publikasi <?= $section; ?> Dosen'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
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
            data: [{
                name: 'Pengajaran',
                y: 23.9
            }, {
                name: 'Pengabdian',
                y: 12.6
            }, {
                name: 'Penelitian',
                y: 37.0
            }, {
                name: 'Penunjang',
                y: 26.4
            }]
        }]
    });
    // Line Chart
    Highcharts.chart('line-container', {

        title: {
            text: 'Jenis <?= $section; ?> Berdasarkan Periode',
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
</script>
<?= $this->endSection(); ?>