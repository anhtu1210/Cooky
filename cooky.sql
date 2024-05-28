-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 10, 2024 lúc 10:47 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT 0,
  `bill_name` varchar(255) NOT NULL,
  `bill_address` varchar(255) NOT NULL,
  `bill_phone` varchar(50) NOT NULL,
  `bill_note` varchar(255) DEFAULT NULL,
  `bill_email` varchar(100) NOT NULL,
  `bill_pay_method` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1. Thanh toán khi nhận hàng\r\n2. Thanh toán online',
  `order_date` datetime NOT NULL,
  `total` int(10) NOT NULL DEFAULT 0,
  `bill_status` tinyint(1) DEFAULT 0 COMMENT '0. Chờ xác nhận 1. Đang xử lý 2. Đang giao hàng 3. Đã giao hàng 4. Đã hủy 5. Bị hủy bỏ',
  `receive_name` varchar(255) NOT NULL,
  `receive_address` varchar(255) NOT NULL,
  `receive_phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`id`, `id_user`, `bill_name`, `bill_address`, `bill_phone`, `bill_note`, `bill_email`, `bill_pay_method`, `order_date`, `total`, `bill_status`, `receive_name`, `receive_address`, `receive_phone`) VALUES
(79, 7, 'cidii_dev202', 'Tứ kỳ, Hải Dương', '0358009111', '', 'dongcongdinh2018@gmail.com', 1, '2023-10-15 00:00:01', 177900, 0, '', '', ''),
(80, 13, 'Phương Anh', 'Hải Dương', '0358009387', '', 'anhptpph44915@fpt.edu.vn', 1, '2023-10-15 16:04:56', 177900, 0, '', '', ''),
(81, 7, 'cidii_dev202', 'Tứ kỳ, Hải Dương', '0358009111', '', 'dongcongdinh2018@gmail.com', 1, '2023-10-15 16:44:12', 45600, 0, '', '', ''),
(82, 13, 'Phương Anh', 'Hải Dương', '0358009387', '', 'anhptpph44915@fpt.edu.vn', 1, '2023-10-15 21:57:02', 77700, 0, '', '', ''),
(83, 0, 'congmd0404', 'Hung Yen', '0464664646', '', 'congmd@gmail.com', 1, '2024-03-18 13:05:30', 105500, 0, '', '', ''),
(84, 0, 'congmd0404', 'Hung Yen', '0464664646', '', 'congmd@gmail.com', 1, '2024-03-18 13:07:14', 105500, 0, '', '', ''),
(85, 0, 'congmd0404', 'Hung Yen', '0464664646', 'ư', 'congmd@gmail.com', 2, '2024-03-18 13:07:19', 105500, 0, '', '', ''),
(86, 0, 'congmd0404', 'Hung Yen', '0464664646', 'ư', 'congmd@gmail.com', 2, '2024-03-18 13:09:19', 105500, 0, '', '', ''),
(87, 0, 'congmd0404', 'Hung Yen', '0464664646', 'ư', 'congmd@gmail.com', 2, '2024-03-18 13:09:21', 105500, 0, '', '', ''),
(88, 0, 'congmd0404', 'Hung Yen', '0464664646', 'ư', 'congmd@gmail.com', 2, '2024-03-18 13:09:23', 105500, 0, '', '', ''),
(89, 16, 'congmd0404', 'Hung Yen', '0464664646', '', 'congmd@gmail.com', 1, '2024-03-19 23:39:08', 53400, 0, '', '', ''),
(90, 0, 'admin', '111', '111', '11', 'congmd@gmail.com', 1, '2024-04-01 22:21:19', 0, 0, '', '', ''),
(91, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:19:15', 485200, 0, '', '', ''),
(92, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:20:28', 485200, 0, '', '', ''),
(93, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:20:57', 485200, 0, '', '', ''),
(94, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:21:13', 485200, 0, '', '', ''),
(95, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:22:52', 0, 0, '', '', ''),
(96, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:24:43', 0, 0, '', '', ''),
(97, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:25:04', 15700, 1, '', '', ''),
(98, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:43:52', 15700, 0, '', '', ''),
(99, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-02 14:47:54', 53400, 0, '', '', ''),
(100, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:02:35', 94100, 0, '', '', ''),
(101, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:05:33', 94100, 0, '', '', ''),
(102, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:05:42', 0, 0, '', '', ''),
(103, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:06:04', 15700, 0, '', '', ''),
(104, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:06:13', 0, 0, '', '', ''),
(105, 6, 'cong', 'Hưng Yên', '088864545', '', 'cong@gmail.com', 1, '2024-04-04 12:13:37', 15700, 0, '', '', ''),
(106, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-05 12:33:17', 106800, 4, '', '', ''),
(107, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-05 13:01:48', 34500, 2, '', '', ''),
(108, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-05 13:02:59', 113000, 4, '', '', ''),
(109, 7, 'admin', '', '', '', 'admin@gmail.com', 1, '2024-04-10 15:42:40', 115700, 0, '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`id`, `content`, `id_user`, `id_product`, `created_at`) VALUES
(57, 'Trứng ngon', 7, 44, '2024-04-01 22:09:44'),
(58, 'hi', 7, 43, '2024-04-01 23:03:55'),
(59, 'hahaa', 7, 43, '2024-04-02 14:01:59'),
(61, 'ngon dey\r\n', 6, 44, '2024-04-05 12:13:09'),
(62, 'ngon dey\r\n', 6, 36, '2024-04-05 12:24:29'),
(63, 'adu', 6, 36, '2024-04-05 12:25:54'),
(64, 'haha', 7, 39, '2024-04-05 12:32:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `into_money` int(10) NOT NULL,
  `id_bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_product`, `image`, `name`, `price`, `quantity`, `into_money`, `id_bill`) VALUES
(65, 7, 133, 'lau-3.jpeg', 'Lẩu Thái Hải Sản - Lẩu Nhỏ (Gồm Nước Cốt Lẩu)', 177900, 1, 177900, 79),
(66, 13, 133, 'lau-3.jpeg', 'Lẩu Thái Hải Sản - Lẩu Nhỏ (Gồm Nước Cốt Lẩu)', 177900, 1, 177900, 80),
(67, 7, 34, 'new-8.jpeg', 'Lòng Gà Xào Đậu Que - Xốt Healthy', 45600, 1, 45600, 81),
(68, 13, 51, 'hais-1.jpeg', 'Cá Hú Tươi Làm Sạch Cắt Khúc Đồng Nai', 50100, 1, 50100, 82),
(69, 13, 46, 'heo-8.jpeg', 'Óc Heo Đồng Nai', 27600, 1, 27600, 82),
(76, 16, 50, 'heo-12.jpeg', 'Bao Tử Heo Làm Sạch Đồng Nai', 53400, 1, 53400, 89),
(77, 7, 37, 'heo-3.jpeg', 'Sườn Non Heo', 145000, 3, 459000, 94),
(78, 7, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 94),
(79, 7, 43, 'lau-1.jpeg', 'Thanh Cua Hàn Quốc Sajo', 34500, 1, 34500, 94),
(80, 7, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 97),
(81, 7, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 98),
(82, 7, 42, 'hais-1.jpeg', 'Cá Rô Phi Lê', 53400, 1, 53400, 99),
(83, 6, 43, 'lau-1.jpeg', 'Thanh Cua Hàn Quốc Sajo', 34500, 1, 34500, 101),
(84, 6, 44, 'trung-1.jpeg', 'Bánh Chocopie Hộp 6', 29800, 2, 60000, 101),
(85, 6, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 103),
(86, 6, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 105),
(87, 7, 42, 'hais-1.jpeg', 'Cá Rô Phi Lê', 53400, 2, 110000, 106),
(88, 7, 43, 'lau-1.jpeg', 'Thanh Cua Hàn Quốc Sajo', 34500, 1, 34500, 107),
(89, 7, 42, 'hais-1.jpeg', 'Cá Rô Phi Lê', 53400, 1, 53400, 108),
(90, 7, 44, 'trung-1.jpeg', 'Bánh Chocopie Hộp 6', 29800, 2, 60000, 108),
(91, 7, 39, 'heo-6.jpeg', 'Khoanh Giò Heo Nhập', 100000, 1, 100000, 109),
(92, 7, 41, 'rau-12.jpeg', 'Măng nứa tươi', 15700, 1, 15700, 109);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Tất cả', 'groceries.png', '2024-03-20 07:48:44', '0000-00-00 00:00:00'),
(32, 'Thịt Heo', 'thit_heo.png', '2024-03-20 02:02:10', '0000-00-00 00:00:00'),
(33, 'Hải Sản', 'hai_san.gif', '2024-03-20 02:06:01', '0000-00-00 00:00:00'),
(34, 'Thịt Bò', 'thit_bo.png', '2024-03-20 02:06:28', '0000-00-00 00:00:00'),
(35, 'Rau Củ', 'rau_cu.png', '2024-03-20 02:07:03', '0000-00-00 00:00:00'),
(36, 'Gà & Vịt', 'ga&vit.png', '2024-03-20 02:07:20', '0000-00-00 00:00:00'),
(37, 'Trứng & Đậu', 'trung&dau.png', '2024-03-20 02:08:19', '0000-00-00 00:00:00'),
(38, 'Trái Cây', 'trai_cay.png', '2024-03-20 02:09:11', '0000-00-00 00:00:00'),
(39, 'Lẩu', 'lau.png', '2024-03-20 02:09:54', '0000-00-00 00:00:00'),
(40, 'Món Chay', 'mon_chay.png', '2024-03-20 02:10:56', '0000-00-00 00:00:00'),
(41, 'Đồ Uống', 'do_uong.png', '2024-03-20 02:11:38', '0000-00-00 00:00:00'),
(43, 'Ăn Vặt', 'anvat.png', '2024-03-20 03:21:19', '2024-03-20 07:25:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double(10,2) DEFAULT 0.00,
  `img` varchar(255) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `luotxem` int(11) DEFAULT 0,
  `iddm` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `price`, `img`, `mota`, `luotxem`, `iddm`, `discount`, `weight`, `created_at`, `updated_at`) VALUES
(36, 'Combo Nạc Vai Heo', 140000.00, 'heo-11.png', 'Rất ngon', 10, 32, 120000, 1000, '2024-03-20 06:46:18', '0000-00-00 00:00:00'),
(37, 'Sườn Non Heo', 153000.00, 'heo-3.jpeg', 'Sườn non heo 1kg', 0, 32, 145000, 1000, '2024-03-20 06:47:58', '0000-00-00 00:00:00'),
(38, 'Cá Ngừ Làm Sạch', 60000.00, 'hais-4.jpeg', 'Cá ngừ làm sạch 500g', 0, 33, 55000, 500, '2024-03-20 06:49:41', '0000-00-00 00:00:00'),
(39, 'Khoanh Giò Heo Nhập', 110000.00, 'heo-6.jpeg', 'Khoanh giò heo nhập khẩu 1kg', 0, 32, 100000, 1000, '2024-03-20 06:50:50', '0000-00-00 00:00:00'),
(40, 'Lòng Gà', 23000.00, 'ga-6.jpeg', 'Lòng gà 200g', 0, 36, 21600, 200, '2024-03-20 06:51:54', '0000-00-00 00:00:00'),
(41, 'Măng nứa tươi', 17000.00, 'rau-12.jpeg', 'Măng nứa tươi 300g', 0, 35, 15700, 300, '2024-03-20 06:53:02', '0000-00-00 00:00:00'),
(42, 'Cá Rô Phi Lê', 55000.00, 'hais-1.jpeg', 'Cá rô phi lê 300g', 0, 33, 53400, 300, '2024-03-20 06:54:20', '2024-03-20 07:12:46'),
(43, 'Thanh Cua Hàn Quốc Sajo', 35000.00, 'lau-1.jpeg', 'Thanh cua Hàn Quốc Sajo thả lẩu 150g', 0, 39, 34500, 150, '2024-03-20 06:55:37', '0000-00-00 00:00:00'),
(44, 'Bánh Chocopie Hộp 6', 30000.00, 'trung-1.jpeg', 'Bánh Chocopie 6 cái/ hộp', 5, 37, 29800, 100, '2024-03-20 06:57:06', '2024-03-28 01:24:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `reset_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `user`, `pass`, `email`, `adress`, `tel`, `role`, `image`, `reset_code`) VALUES
(1, 'congmd', '111', 'devcg0504@gmail.com', 'hưng yên', '5675675', 1, '', ''),
(6, 'cong', '12345', 'cong@gmail.com', 'Hưng Yên', '088864545', 1, 'snapedit_1712219542913.jpeg', ''),
(7, 'admin', '123456', 'admin@gmail.com', NULL, NULL, 1, '', ''),
(8, 'phuonganh', '1234567', 'phamphuonganh5112002@gmail.com', NULL, NULL, 0, '', ''),
(10, 'aa', 'congmd0504', 'congmd@gmail.com', NULL, NULL, 0, '', 'ac41685146'),
(11, 'congggg', 'congmmm', 'congmd0504@gmail.com', NULL, NULL, 0, '', '0'),
(12, 'admin2', '123456', 'congmd0504@gmail.com', NULL, NULL, 0, '', ''),
(13, 'anhnd120', '1111111', 'congmd0504@gmail.com', NULL, NULL, 0, '', ''),
(14, 'anhnd120111', '1111111', 'congmd0504@gmail.com', NULL, NULL, 0, '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_cart_product` (`id_product`),
  ADD KEY `lk_cart_account` (`id_user`),
  ADD KEY `lk_cart_bill` (`id_bill`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lk_iddm_dạnhmuc` (`iddm`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `lk_iddm_dạnhmuc` FOREIGN KEY (`iddm`) REFERENCES `danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
