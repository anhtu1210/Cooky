<?php
require_once 'pdo.php';
function loadall_danhmuc_trangchu()
{
    // Ẩn "Tất cả" ở trang homepage
    $sql = "SELECT * FROM danhmuc order by id asc limit 1,12";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
function insert_danhmuc($tenloai, $image)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO danhmuc(name, image, created_at) values('$tenloai','$image','$created_at')";
    pdo_execute($sql);
}
function delete_danhmuc($id)
{
    $sql = "DELETE FROM danhmuc where id=" . $id;
    pdo_execute($sql);
}
function loadall_danhmuc()
{
    $sql = "SELECT * FROM danhmuc order by id asc";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
function loadone_danhmuc($id)
{
    $sql = "SELECT * FROM danhmuc where id=" . $id;
    $dm = pdo_query_one($sql);
    return $dm;
}
function update_danhmuc($id, $tenloai, $image)
{
    $updated_at = date('Y-m-d H:i:s');
    if ($image != "") {
        $sql = "UPDATE danhmuc SET name='" . $tenloai . "', image='" . $image . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE danhmuc SET name='" . $tenloai . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    }
    pdo_execute($sql);
}
