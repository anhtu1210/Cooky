<div id="myChart" style="width:100%; max-width:900px; height:700px; margin: 0 auto;"></div>

<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ["Danh mục", "Số lượng sản phẩm"],
            <?php
            $total_category = count($list_statistics_product);
            $index = 1;
            foreach ($list_statistics_product as $statistics_product) {
                extract($statistics_product);
                if ($index == $total_category) $dauphay = "";
                else $dauphay = ",";
                echo "['" . $statistics_product['name_category'] . "', " . $statistics_product['count_product'] . "]" . $dauphay;
                $index += 1;
            }
            ?>
        ]);

        const options = {
            title: 'Biểu đồ thống kê sản phẩm theo danh mục',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>