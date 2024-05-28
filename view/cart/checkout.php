<!-- Thanh toán -->
<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <h1 class="title-user">Thanh toán</h1>
            <form action="index.php?act=complete" method="POST">
            <div class="checkout-page">
                <div class="form-container checkout-page-form">
                    <h2 class="title-user">Thông tin giao hàng</h2>
                    <?php 
                    if(isset($_SESSION['user'])){
                        $name=$_SESSION['user']['user'];
                        $address=$_SESSION['user']['adress'];
                        $email=$_SESSION['user']['email'];
                        $tel=$_SESSION['user']['tel'];
                    }else {
                        $name="";
                        $address="";
                        $email="";
                        $tel="";
                    }
                    ?>
                    <form action="index.php?act=profile-edit" class="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <div class="row">
                            <input class="input" type="text" name="username" id="username" placeholder="Họ tên" value="<?= $name ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="email" name="email" id="email" placeholder="Email" value="<?= $email ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="text" name="address" id="address" placeholder="Địa chỉ chi tiết" value="<?= $address ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="text" name="phone" id="phone" placeholder="Số điện thoại" value="<?= $tel ?>" />
                        </div>
                        <div class="row">
                            <textarea class="input" type="text" name="note" id="note" cols="30" rows="10" placeholder="Ghi chú" ></textarea>
                        </div>
                        <div class="form-group-button">
                            <a class="btn" href="index.php?act=view-cart">Quay lại</a>
                        </div>
                    </form>
                    <h2 class="title-user title-pay-method">Phương thức thanh toán</h2>
                        <div class="radio-list">
                            <div class="radio-item">
                                <input type="radio" name="pay-method" id="pay-method-1" value="1" checked>
                                <label for="pay-method-1">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" name="pay-method" id="pay-method-2" value="2">
                                <label for="pay-method-2">Thanh toán trực tuyến</label>
                            </div>
                        </div>
                </div>
                <div class="order-form">
                    <h2 class="title-user order-title">Đơn hàng của bạn</h2>
                    <div class="grand-total order-content">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title">Tổng số giỏ hàng</h4>
                        </div>
                        <h5>Món ăn của bạn 💝</h5>
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
                            echo '<div class="item-cart-product">';
                            
                            echo '<tr>
                            <td scope="row" item-image-order >
                                <img width="40px" height="40px" src="' . $showImage . '" alt="Ảnh sản phẩm" width="100" height="100">
                            </td>
                            <td class="item-name-order"><p>' . $cart[1] . '</p></td>
                            ';
                            echo '
                            <td class="item-quantity-order">x' . $cart[6] . '</td> 
                        </tr>';
                            echo '<td class="item-price-order">' . $formatDiscount . ' </td> <br> ';
                            $index += 1;
                            echo '</div>';
                        }
                        
                        ?>
                </table>
                        <h5>Giá gốc: <span><?= $formatTotalPayPriceOriginal ?></span></h5>
                        <h4 class="grand-total-title">Tổng cộng: <span><?= $formatTotalAllCart ?></span></h4>
                        <input type="submit" value="Tiến hành đặt hàng" class="order-button" name="agree-to-order" />
                    </div>
                </div>
            </div>
            <div class="radio-list">
            
            </form>
        </div>
    </div>
</main>