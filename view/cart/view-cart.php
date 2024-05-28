<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
            <div class="title">🧡 Giỏ hàng của bạn 🧡</div>
            <table class="content-table">
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên món</th>
                            <th>Trọng lượng</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tạm tính</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $totalAllCart = 0;
                        $totalPayPriceOriginal = 0;
                        $index = 0;
                        foreach ($_SESSION['cart'] as $cart) {
                            $showImage = $imagePath . $cart[5];
                            $totalMoney = ($cart[3] == 0) ? ($cart[2] * $cart[6]) : ($cart[3] * $cart[6]);
                            $payPriceOriginal = $cart[2] * $cart[6];
                            // Format money
                            $formatPrice = formatCurrency($cart[2]);
                            $formatDiscount = formatCurrency($cart[3]);
                            $formatTotalMoney = formatCurrency($totalMoney);
                            $totalAllCart += $totalMoney;
                            $totalPayPriceOriginal += $payPriceOriginal;
                            $formatTotalAllCart = formatCurrency($totalAllCart);
                            $formatTotalPayPriceOriginal = formatCurrency($totalPayPriceOriginal);
                            // Remove item cart
                            $deleteItemCart = '<a href="index.php?act=delete-cart&id-cart=' . $index . '"><button class="remove-item-cart" value="Xóa khỏi giỏ hàng"><i class="fa-solid fa-trash-can"></i></button></a>';
                            echo '<tr>
                            <td scope="row">
                                <img src="' . $showImage . '" alt="Ảnh sản phẩm" width="100" height="100">
                            </td>
                            <td class="product-name"><strong>' . $cart[1] . '</strong></td>
                            <td>' . $cart[4] . '(g)</td>
                            ';
                            if ($cart[3] == 0) {
                                echo '<td class="price-product">' . $formatPrice . '</td>';
                            } else {
                                echo '<td class="price-product">' . $formatDiscount . ' <small class="price-origin">' . $formatPrice . '</small></td>';
                            }
                            echo '
                            <td class="quantity-product">' . $cart[6] . '</td>
                            <td>' . $formatTotalMoney . '</td>
                            <td>' . $deleteItemCart . '</td>
                        </tr>';
                            $index += 1;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="shopping-cart-wrapper">
                    <div class="continue-shopping">
                        <a href="index.php?act=home">Tiếp tục mua hàng</a>
                    </div>
                    <div class="clear-cart-all">
                        <a href="index.php?act=delete-cart">Xóa giỏ hàng</a>
                    </div>
                </div>
                <div class="grand-total">
                    <div class="title-wrap">
                        <h4 class="cart-bottom-title">Tổng tiền giỏ hàng</h4>
                    </div>
                    <h5>Giá gốc: <span><?= $formatTotalPayPriceOriginal ?></span></h5>
                    <h4 class="grand-total-title">Tổng cộng: <span><?= $formatTotalAllCart ?></span></h4>
                    <?php 
                    if (isset($_SESSION['user'])) {
                       echo'<a href="index.php?act=checkout">Đặt hàng</a>' ;
                    }else{
                        echo'<a href="index.php?act=login">Đăng nhập để đặt hàng!</a>' ;
                    }
                    ?>
                    
                </div>
                <?php } else { ?>
                <div class="no-cart"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1697029851/jbmsxvpg9wpkte8q5ds9.jpg" alt="Hình ảnh giỏ hàng trống">
                    <div class="title">🖤 Giỏ hàng của bạn đang trống 🖤</div>
                    <p>Quay lại <a href="index.php">trang chủ</a> để lựa chọn món ăn</p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
