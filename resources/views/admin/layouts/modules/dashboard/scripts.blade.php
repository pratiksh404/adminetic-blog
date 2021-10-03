<script>
    $(function() {
        $(document).ready(function() {
            $.get('{{ route('get_monthly_post_total_view') }}',
                function(data) {
                    var monthly_counts = data.monthly_counts;
                    var months = [];
                    var counts = [];

                    $.each(monthly_counts, function(index, count) {
                        months.push(index);
                        counts.push(count);
                    });

                    var $primary = "#00b5b8",
                        $secondary = "#2c3648",
                        $success = "#0f8e67",
                        $info = "#179bad",
                        $warning = "#ffb997",
                        $danger = "#ff8f9e"

                    var $themeColor = [$primary, $success, $warning, $info, $danger, $secondary]

                    /* Line Chart Initialization */
                    var lineBasicChart = {
                        chart: {
                            height: 350,
                            type: 'line',
                            zoom: {
                                enabled: false
                            }
                        },
                        series: [{
                            name: "Monthly Counts",
                            data: counts,
                        }],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight',
                            colors: $themeColor
                        },
                        title: {
                            text: 'All Post Views Count By Month',
                            align: 'left'
                        },
                        grid: {
                            row: {
                                colors: ['#f3f3f3',
                                    'transparent'
                                ], // takes an array which will be repeated on columns
                                opacity: 0.5
                            },
                        },
                        xaxis: {
                            categories: months
                        }
                    }
                    var monthly_post_total_views_line_chart = new ApexCharts(
                        document.querySelector("#monthly-post-total-views-line-chart"),
                        lineBasicChart
                    );
                    monthly_post_total_views_line_chart.render();

                    /* Bar Chart Initialization */
                    var barBasicChart = {
                        chart: {
                            height: 350,
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: [{
                            data: counts
                        }],
                        xaxis: {
                            categories: months
                        },
                        fill: {
                            colors: $themeColor
                        }
                    }
                    // Initializing Bar Basic Chart
                    var monthly_post_total_views_bar_chart = new ApexCharts(
                        document.querySelector("#monthly-post-total-views-bar-chart"),
                        barBasicChart
                    );
                    monthly_post_total_views_bar_chart.render();
                }
            );
        });
    });

</script>