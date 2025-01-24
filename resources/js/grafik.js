const getChartOptions = (pemasukan, pengeluaran) => {
    // Fungsi untuk memformat angka menjadi format Rupiah
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(number);
    };

    return {
        series: [pengeluaran, pemasukan],
        colors: ["#DB2777", "#10B981"],
        chart: {
            height: 380,
            width: 380,
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Total Dompet",
                            fontFamily: "Inter, sans-serif",
                            formatter: function (w) {
                                const sum = pemasukan - pengeluaran
                                return formatRupiah(sum);
                            },
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return formatRupiah(value);
                            },
                        },
                    },
                    size: "85%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: ["Pengeluaran", "Pemasukan"],
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return formatRupiah(value);
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return formatRupiah(value);
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    };
};

if (
    document.getElementById("donut-chart") &&
    typeof ApexCharts !== "undefined"
) {
    // Periksa apakah ada transaksi (pemasukan atau pengeluaran lebih besar dari 0)
    if (pemasukan > 0 || pengeluaran > 0) {
        const chart = new ApexCharts(
            document.getElementById("donut-chart"),
            getChartOptions(pemasukan, pengeluaran)
        );
        chart.render();
    } else {
        // Jika tidak ada transaksi, tampilkan pesan atau sembunyikan elemen grafik
        document.getElementById("donut-chart").innerHTML = 
            "<p style='color: #888;'>Belum ada grafik untuk ditampilkan..<br/>Tolong tambah transaksi terlebih dahulu</p>";
    }
}