-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 13, 2022 lúc 07:33 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ngaoduvietnam`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provide` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `people` int(11) DEFAULT 1,
  `price` int(11) NOT NULL,
  `start_at` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `statuspayment` tinyint(1) DEFAULT NULL COMMENT '1: creditCast, 2: Paypal, 3: Payincash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookings`
--

INSERT INTO `bookings` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `provide`, `code`, `country`, `note`, `people`, `price`, `start_at`, `status`, `tour_id`, `statuspayment`, `created_at`, `updated_at`) VALUES
(1, 'Tien', 'Manh', 'tien1208xx@gmail.com', '0335786322', 'cash', '54', 'rtdryftugihojl', 'retrytu', 'wrteyrfugikhlj;', 'ftrytuyiklk;/', NULL, 7000000, '2021-02-25', 1, 3, 3, '2022-01-13 11:14:00', '2022-01-13 11:14:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `destinations`
--

CREATE TABLE `destinations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `destinations`
--

INSERT INTO `destinations` (`id`, `title`, `slug`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Hà Nội - Đà Lạt', 'ha-noi-da-lat', 1, '1642082214.jpg', '2022-01-13 06:56:54', '2022-01-13 06:59:36'),
(2, 'Hà Nội - Nha Trang', 'ha-noi-nha-trang', 1, '1642094431.jpg', '2022-01-13 10:20:31', '2022-01-13 10:20:31'),
(3, 'Hà Nội - Phú Quốc', 'ha-noi-phu-quoc', 1, '1642096085.jpg', '2022-01-13 10:48:05', '2022-01-13 10:48:05'),
(4, 'Hà Nội -HCM', 'ha-noi-hcm', 1, '1642096133.jpg', '2022-01-13 10:48:53', '2022-01-13 10:48:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tour_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `faqs`
--

INSERT INTO `faqs` (`id`, `tour_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 2, 'Số người tối đa là bao nhiêu?', 'Mỗi chuyến đi theo nhóm tối đa là 20 người.', '2022-01-13 10:30:19', '2022-01-13 10:30:19'),
(2, 2, 'Có trẻ em thì tính như thế nào?', 'Trẻ em dưới 5 tuổi sẽ không tính phí, từ 5 đến 14 tuổi sẽ là 50% còn trên 14 tuổi tính theo giá người lớn. Vui lòng ghi chú để được giảm giá.', '2022-01-13 10:32:02', '2022-01-13 10:32:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `galleries`
--

INSERT INTO `galleries` (`id`, `tour_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, '1642084376.jpg', '2022-01-13 07:32:56', '2022-01-13 07:32:56'),
(2, 1, '1642084377.jpg', '2022-01-13 07:32:56', '2022-01-13 07:32:56'),
(3, 1, '1642084378.jpg', '2022-01-13 07:32:56', '2022-01-13 07:32:56'),
(4, 1, '1642084379.jpg', '2022-01-13 07:32:56', '2022-01-13 07:32:56'),
(5, 3, '1642096251.jpg', '2022-01-13 10:50:51', '2022-01-13 10:50:51'),
(6, 3, '1642096252.jpg', '2022-01-13 10:50:51', '2022-01-13 10:50:51'),
(8, 3, '1642096254.jpg', '2022-01-13 10:50:51', '2022-01-13 10:50:51'),
(9, 3, '1642096255.jpg', '2022-01-13 10:50:51', '2022-01-13 10:50:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `itineraries`
--

CREATE TABLE `itineraries` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `itineraries`
--

INSERT INTO `itineraries` (`id`, `tour_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dágdfhgjkh', '2022-01-13 07:33:11', '2022-01-13 07:33:11'),
(2, 2, 'NGÀY 01: TP. HỒ CHÍ MINH - LÂU ĐÀI RƯỢU VANG - NHA TRANG', '2022-01-13 10:34:47', '2022-01-13 10:34:47'),
(3, 2, 'Ngày 02: NHA TRANG - DỐC LẾT', '2022-01-13 10:38:31', '2022-01-13 10:38:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_11_21_073710_create_destinations_table', 1),
(5, '2021_11_22_005533_create_type_of_tours_table', 1),
(6, '2021_11_23_145347_create_tours_table', 1),
(7, '2021_11_24_020404_create_bookings_table', 1),
(8, '2021_11_24_020404_create_contacts_table', 1),
(9, '2021_11_24_020404_create_faqs_table', 1),
(10, '2021_11_24_020404_create_galleries_table', 1),
(11, '2021_11_24_020404_create_itineraries_table', 1),
(12, '2021_11_24_020404_create_place_itineraries_table', 1),
(13, '2021_11_24_020404_create_reviews_table', 1),
(14, '2021_11_24_020404_create_types_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `place_itineraries`
--

CREATE TABLE `place_itineraries` (
  `id` int(11) NOT NULL,
  `itinerary_id` int(11) NOT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `place_itineraries`
--

INSERT INTO `place_itineraries` (`id`, `itinerary_id`, `location`, `duration`, `description`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thung lũng hoa', 3, 'Thung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoaThung lũng hoa', '', '2022-01-13 08:38:10', '2022-01-13 08:38:10'),
(3, 2, 'TP. HỒ CHÍ MINH - LÂU ĐÀI RƯỢU VANG', 180, 'Đón du khách tại văn phòng Lữ hành Saigontourist, khởi hành đi Nha Trang. Dừng chân tham quan Lâu Đài Rượu Vang - tham quan 2 hầm chứa rượu cùng quy trình và mô hình sản xuất rượu khép kín được thiết kế nằm sâu dưới lòng đất.', '', '2022-01-13 10:37:42', '2022-01-13 10:37:42'),
(4, 2, 'LÂU ĐÀI RƯỢU VANG - NHA TRANG', 120, 'Trên đường đi du khách sẽ được chiêm ngưỡng vẻ đẹp của bãi biển cát trắng Cà Ná - một trong những bãi biển đẹp nổi tiếng của khu vực miền Trung. Đến Cam Ranh, xe đưa du khách vào Nha Trang theo cung đường Sông Lô Hòn Rớ - cung đường được xây dựng chạy dọc theo bờ biển Cam Ranh - Nha Trang thơ mộng. Đến Nha Trang, du khách nhận phòng. Nghỉ đêm tại Nha Trang.', '', '2022-01-13 10:38:07', '2022-01-13 10:38:07'),
(5, 3, 'NHA TRANG - DỐC LẾT', 120, 'Khởi hành đi Dốc Lết - một trong những bãi biển êm, đẹp, nổi tiếng của tỉnh Khánh Hòa và khu vực miền Trung. Quý khách tự do tham quan và tắm biển thỏa thích trong làn nước xanh trong.', '', '2022-01-13 10:39:06', '2022-01-13 10:39:06'),
(6, 3, 'DỐC LẾT -NHA TRANG', 100, 'Trở về lại Nha Trang, du khách tham quan Khu du lịch Hòn Chồng. Xe đưa đoàn về khách sạn nghỉ ngơi. Du khách tự do khám phá thành phố biển về đêm và thưởng thức ẩm thực địa phương (chi phí tự túc). Nghỉ đêm tại Nha Trang.', '', '2022-01-13 10:39:37', '2022-01-13 10:39:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `content` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `destination_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `overview` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `include` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depature` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addtional` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_360` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tours`
--

INSERT INTO `tours` (`id`, `title`, `slug`, `status`, `priority`, `destination_id`, `type_id`, `photo`, `duration`, `price`, `overview`, `include`, `depature`, `addtional`, `map`, `video`, `image_360`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Thung lũng hoa Đà Lạt', 'thung-lung-hoa-da-lat', 1, 1, 1, 1, '1642083737.jpg', 3, 6700000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'DalatTour', 'DalatTourDalatTourDalatTourDalatTour', '2022-01-13 07:22:17', '2022-01-13 10:22:06', NULL),
(2, 'Du lịch Nha Trang - Dốc Lết - Viện Hải Dương - Làng Yến Mai Xanh', 'du-lich-nha-trang-doc-let-vien-hai-duong-lang-yen-mai-xanh', 1, 1, 2, 2, '1642094504.jpg', 4, 5000000, '<p>Loại tour: Trong nước</p>\r\n\r\n<p>&nbsp;Nơi đi :&nbsp;TP. H&agrave; Nội</p>\r\n\r\n<p>&nbsp;Nơi đến : Nha Trang</p>\r\n\r\n<p>&nbsp;Phương tiện : &Ocirc; t&ocirc;</p>\r\n\r\n<p>&nbsp;Số người tối đa :&nbsp;20 người</p>', '<p><strong>NG&Agrave;Y&nbsp;01: TP. HỒ CH&Iacute; MINH - L&Acirc;U Đ&Agrave;I RƯỢU VANG&nbsp;- NHA TRANG&nbsp;(Ăn s&aacute;ng, trưa, chiều)</strong></p>\r\n\r\n<p><strong>Ng&agrave;y&nbsp;02: NHA TRANG - DỐC LẾT&nbsp;(Ăn s&aacute;ng, trưa)</strong></p>\r\n\r\n<p><strong>Ng&agrave;y&nbsp;03: NHA TRANG &ndash; VIỆN HẢI DƯƠNG -&nbsp;L&Agrave;NG YẾN MAI SINH&nbsp;(Ăn s&aacute;ng, trưa, chiều)</strong></p>\r\n\r\n<p><strong>Ng&agrave;y&nbsp;04: NHA TRANG - TP. HỒ CH&Iacute;&nbsp; MINH&nbsp;(Ăn s&aacute;ng, trưa)</strong></p>', NULL, '<p>Confirmation will be received at time of booking&nbsp;<br />\r\nNot recommended for travelers with back problems&nbsp;<br />\r\nNot recommended for pregnant travelers Infant seats available&nbsp;<br />\r\nNot wheelchair accessible&nbsp;<br />\r\nChildren must be accompanied by an adult&nbsp;<br />\r\nVegetarian option is available, please advise at time of booking if required Minimum numbers apply.&nbsp;<br />\r\nThere is a possibility of cancellation after confirmation if the meteorological conditions do not allow it&nbsp;<br />\r\nStroller accessible&nbsp;<br />\r\nService animals allowed&nbsp;<br />\r\nNear public transportation&nbsp;<br />\r\nMost travelers can participate&nbsp;<br />\r\nThis tour/activity will have a maximum of 17 travelers<br />\r\n&nbsp;</p>', NULL, NULL, NULL, 'Du lịch Nha Trang - Dốc Lết - Viện Hải Dương - Làng Yến Mai Xanh', 'Du lịch Nha Trang - Dốc Lết - Viện Hải Dương - Làng Yến Mai Xanh', '2022-01-13 10:21:44', '2022-01-13 10:28:12', NULL),
(3, 'Du lịch Phú Quốc', 'du-lich-phu-quoc', 1, 1, 3, 2, '1642096226.jpg', 5, 7000000, NULL, NULL, NULL, NULL, '', NULL, NULL, 'Du lịch Phú Quốc', 'Du lịch Phú QuốcDu lịch Phú QuốcDu lịch Phú QuốcDu lịch Phú QuốcDu lịch Phú QuốcDu lịch Phú Quốc', '2022-01-13 10:50:26', '2022-01-13 10:50:26', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL COMMENT '1: active, 2: inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type_of_tours`
--

CREATE TABLE `type_of_tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `type_of_tours`
--

INSERT INTO `type_of_tours` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mùa đông', 1, '2022-01-13 06:52:13', '2022-01-13 06:52:19'),
(2, 'Bãi Biển', 1, '2022-01-13 06:52:28', '2022-01-13 06:52:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tien', 'tien1208xx@gmail.com', 0, NULL, '$2y$10$iWhdzcBcj8bsn6icRPH72ebhX0eeyTOwIcMok8UmU0ynQAdDF.iAS', '8UaMK6X6KVKOENtwzBZhreqeQ06iYDT4Ol71YBGv4cThMS9SQuLr4DYQt7Ov', '0000-00-00 00:00:00', '2022-01-13 06:20:43');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `place_itineraries`
--
ALTER TABLE `place_itineraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itinerary_id` (`itinerary_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Chỉ mục cho bảng `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `type_of_tours`
--
ALTER TABLE `type_of_tours`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `place_itineraries`
--
ALTER TABLE `place_itineraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `type_of_tours`
--
ALTER TABLE `type_of_tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
