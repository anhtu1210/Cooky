<?php
include('../global.php');
?>
<div class="main-content">
    <div class="row ">
        <div class="col-lg-7 col-md-12">
            <div class="card" style="min-height: 485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">
                        <strong class="text-primary"><i class="fa-solid fa-cart-shopping"></i> Thống kê sản phẩm</strong>
                    </h4>
                    <p class="category">Thống kê sản phẩm theo danh mục</p>
                    <a href="index.php?act=chart-category"><input class="btn btn-primary btn-sm" value="Xem biểu đồ" /></a>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Giá thấp nhất</th>
                                <th>Giá cao nhất</th>
                                <th>Giá trung bình</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_statistics_product as $statistics_product) {
                                extract($statistics_product);
                                echo '<tr class="text-center">
                                    <td>' . $id_category . '</td>
                                    <td>' . $name_category . '</td>
                                    <td>' . $count_product . '</td>
                                    <td>' . formatCurrency($min_price) . '</td>
                                    <td>' . formatCurrency($max_price) . '</td>
                                    <td>' . formatCurrency($avg_price) . '</td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12">
            <div class="card" style="min-height: 485px">
                <div class="card-header card-header-text">
                    <h4 class="card-title">
                        <strong class="text-primary"><i class="fa-regular fa-comment-dots"></i> Thống kê bình luận</strong>
                    </h4>
                    <p class="category">Thống kê bình luận người dùng</p>
                    <a href="index.php?act=chart-comment"><input class="btn btn-primary btn-sm" value="Xem biểu đồ" /></a>
                </div>
                <div class="card-content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Lượt</th>
                                <th>Cũ nhất</th>
                                <th>Mới nhất</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($list_statistics_comment as $statistics_comment) {
                                extract($statistics_comment);
                                echo '<tr class="text-center">
                                    <td>' . $id . '</td>
                                    <td>' . $product_name . '</td>
                                    <td>' . $count_comment . '</td>
                                    <td>' . $comment_old . '</td>
                                    <td>' . $comment_new . '</td>
                                </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>