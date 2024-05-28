<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <!-- Product List by search -->
            <div class="group-product-content">
                <div class="title">✨ Sản phẩm theo từ khóa ✨&nbsp;<small class="total-product">(Tìm thấy <b><?= count($productList) ?></b> kết quả với từ khóa '<span class="font-weight-bold"><?= $searchKeyword ?></span>')</small></div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <?php
                        $productListLength = count($productList);
                        if ($productListLength == 0) {
                            echo '<div class="no-data-image">
                            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
                            </div>';
                        } else {
                            foreach ($productList as $product) {
                                extract($product);
                                $linkProduct = "index.php?act=product-detail&id=" . $id;
                                $showImage = !empty($img) ? $imagePath . $img : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                                $formatCurrencyPrice = formatCurrency($price);
                                $formatCurrencyDiscount = formatCurrency($discount);

                                $displayPrice = ($discount == 0) ? $formatCurrencyPrice : $formatCurrencyDiscount;
                                echo '
                                    <div class="product-basic-info">
                                        <a class="link-absolute" title="' . $name . '" href="' . $linkProduct . '"></a>
                                        <div class="cover-box">
                                            <div class="promotion-photo">
                                                <div class="package-default">
                                                    <img src="' . $showImage . '" alt="' . $name . '" loading="lazy" class="img-fit">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="promotion-name two-lines">' . $name . '</div>
                                        <div class="d-flex-center-middle">
                                            <div class="price-action">
                                                <div class="product-weight">' . $weight . 'g</div>
                                                <div class="d-flex-align-items-baseline">
                                                <div class="sale-price">' . $displayPrice . '</div>';
                                echo ($discount == 0)
                                    ? ''
                                    : '<div class="unti-price">' . $formatCurrencyPrice . '</div>';
                                echo '
                                                </div>
                                            </div>
                                            <div class="button-add-to-cart" title="Thêm vào giỏ hàng">
                                                <div>
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
            document.getElementById('search-input').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    var searchValue = this.value;
                    window.location.href = 'index.php?act=search&keyword=' + encodeURIComponent(searchValue);
                }
            });
        </script>