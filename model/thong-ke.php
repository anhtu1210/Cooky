<?php
require_once 'pdo.php';

function thong_ke_binh_luan()
{
    $sql = "SELECT sanpham.id, sanpham.name AS product_name, COUNT(binhluan.id) AS count_comment, MIN(binhluan.created_at) AS comment_old, MAX(binhluan.created_at) AS comment_new FROM sanpham LEFT JOIN binhluan ON sanpham.id = binhluan.id_product  GROUP BY sanpham.id, sanpham.name HAVING count_comment > 0";
    return pdo_query($sql);
}
function thong_ke_hang_hoa()
{
    $sql = "SELECT danhmuc.id AS id_category, danhmuc.name AS name_category, COUNT(sanpham.id) AS count_product, MIN(sanpham.price) AS min_price, MAX(sanpham.price) AS max_price, AVG(sanpham.price) AS avg_price";
    $sql .= " FROM sanpham LEFT JOIN danhmuc ON danhmuc.id = sanpham.iddm";
    $sql .= " GROUP BY danhmuc.id ORDER BY danhmuc.id DESC";
    $list_statistics_product = pdo_query($sql);
    return $list_statistics_product;
}