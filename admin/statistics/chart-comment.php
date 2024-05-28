<div id="myChart" style="width:100%; max-width:900px; height:700px; margin: 0 auto;"></div>

<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ["Sản phẩm", "Lượt bình luận"],
            <?php
            $total_product = count($list_statistics_comment);
            $index = 1;
            foreach ($list_statistics_comment as $statistics_comment) {
                extract($statistics_comment);
                if ($index == $total_product) $dauphay = "";
                else $dauphay = ",";
                echo "['" . $statistics_comment['product_name'] . "', " . $statistics_comment['count_comment'] . "]" . $dauphay;
                $index += 1;
            }
            ?>
        ]);

        const options = {
            title: 'Biểu đồ thống kê bình luận theo sản phẩm',
            is3D: true
        };

        const chart = new google.visualization.PieChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>