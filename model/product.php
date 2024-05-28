<?php
require_once 'pdo.php';

function product_insert($productName, $price, $discount, $image, $weight, $description, $category_id)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO sanpham(name, price, discount, image, weight, description, iddm, created_at) VALUES ('$productName', '$price', '$discount', '$image', '$weight', '$description', '$category_id', '$created_at')";
    pdo_execute($sql);
}
function product_exist($name)
{
    $sql = "SELECT count(*) FROM sanpham WHERE name=?";
    return pdo_query_value($sql, $name) > 0;
}
function product_update($id, $productName, $price, $discount, $image, $weight, $description, $category_id)
{
    $updated_at = date('Y-m-d H:i:s');
    if ($image != "") {
        $sql = "UPDATE sanpham SET name='" . $productName . "', price='" . $price . "', discount='" . $discount . "', image='" . $image . "', weight='" . $weight . "', description='" . $description . "', iddm='" . $category_id . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE sanpham SET name='" . $productName . "', price='" . $price . "', discount='" . $discount . "', weight='" . $weight . "', description='" . $description . "', iddm='" . $category_id . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    }
    pdo_execute($sql);
}
function product_delete($id)
{
    $sql = "DELETE FROM sanpham WHERE id =" . $id;
    pdo_execute($sql);
}
function product_select_all($keyword, $category_id)
{
    $sql = "SELECT * FROM sanpham WHERE 1";
    if ($keyword != "") {
        $sql .= " AND name LIKE '%" . $keyword . "%'";
    }
    if ($category_id > 0) {
        $sql .= " AND iddm = '" . $category_id . "'";
    }
    $sql .= " ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_select_by_id($id)
{
    $sql = "SELECT * FROM sanpham WHERE id =" . $id;
    $product = pdo_query_one($sql);
    return $product;
}
// Sản phẩm liên quan
function related_products($id, $iddm)
{
    $sql = "SELECT * FROM sanpham WHERE iddm = " . $iddm . " AND id <>" . $id . " LIMIT 0,6";
    $list_product_related = pdo_query($sql);
    return $list_product_related;
}
function select_products_by_param($orderBy, $limit)
{
    $sql = "SELECT * FROM sanpham WHERE 1 ORDER BY $orderBy DESC LIMIT 0,$limit";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_select_all_no_param()
{
    $sql = "SELECT * FROM sanpham ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_search_by_keyword($keyword)
{
    $sql = "SELECT * FROM sanpham WHERE 1";
    if ($keyword != "") {
        $sql .= " AND name LIKE '%" . $keyword . "%'";
    }
    $sql .= " ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
