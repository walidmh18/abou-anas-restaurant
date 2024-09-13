<!DOCTYPE html>
<html lang="en">

<head>


    <?php

    session_start();
    include '../connection.php';
    ?>
    <title>Menu</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include '../head.php'; ?>

</head>

<body>


    <h1 class="pageTitle">Menu</h1>




    <div class="category packs">
        <div class="categoryTitle">
            <h2 class="fr">Packs</h2>
            <div class="midHiphen"></div>
            <h2 class="ar">العروض</h2>

        </div>
        <div class="swiper-container">

            <div class="swiper-wrapper">

                <div class="pack swiper-slide">
                    <img src="../images/pack.png" alt="pack">
                    <div class="content">
                        <div class="name">
                            <p class="fr">2 Personnes</p>
                            <p class="ar">شخصين</p>

                        </div>
                        <ul class="plats">
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                        </ul>

                        <div class="bottom">
                            <h2 class="price">300DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                            <div class="quantity">

                                <button onclick="redu(this.nextElementSibling)">
                                    <i class="fa-regular fa-minus"></i>

                                </button>
                                <input type="number" value="0" min="0" onblur="corr(this)">

                                <button onclick="incr(this.previousElementSibling)">
                                    <i class="fa-regular fa-plus"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="pack swiper-slide">
                    <img src="../images/pack.png" alt="pack">
                    <div class="content">
                        <div class="name">
                            <p class="fr">2 Personnes</p>
                            <p class="ar">شخصين</p>

                        </div>
                        <ul class="plats">
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                        </ul>

                        <div class="bottom">
                            <h2 class="price">200DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="pack swiper-slide">
                    <img src="../images/pack.png" alt="pack">
                    <div class="content">
                        <div class="name">
                            <p class="fr">2 Personnes</p>
                            <p class="ar">شخصين</p>

                        </div>
                        <ul class="plats">
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                        </ul>

                        <div class="bottom">
                            <h2 class="price">200DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="pack swiper-slide">
                    <img src="../images/pack.png" alt="pack">
                    <div class="content">
                        <div class="name">
                            <p class="fr">2 Personnes</p>
                            <p class="ar">شخصين</p>

                        </div>
                        <ul class="plats">
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                        </ul>

                        <div class="bottom">
                            <h2 class="price">200DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="pack swiper-slide">
                    <img src="../images/pack.png" alt="pack">
                    <div class="content">
                        <div class="name">
                            <p class="fr">2 Personnes</p>
                            <p class="ar">شخصين</p>

                        </div>
                        <ul class="plats">
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                            <li>2* chorba</li>
                        </ul>

                        <div class="bottom">
                            <h2 class="price">200DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    <?php

    $sql = "SELECT * 
    FROM `categories`
    ORDER BY tartib asc";
    $result = mysqli_query($con, $sql);
    // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);



    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        // echo 'asd';
        echo '<pre>';
        print_r($row);
        echo '</pre>';

        echo $row['id'];

        $id = $row['id'];
        $fr = $row['name_fr'];
        $ar = $row['name_ar'];

    ?>
        <div class="category name">
            <div class="categoryTitle">
                <h2 class="fr"><?= $fr; ?></h2>
                <div class="midHiphen"></div>
                <h2 class="ar"><?= $ar; ?></h2>
            </div>

            <div class="itemsContainer">

                <?php

                $sql2 = "SELECT * 
        FROM `plats` 
        WHERE category='$id'";

                $result2 = mysqli_query($con, $sql2);

                while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

                    $plat_id = $row2['id'];
                    $plat_fr = $row2['name_fr'];
                    $plat_ar = $row2['name_ar'];
                    $price = $row2['price'];
                    $img = $row2['image_address'];

                    // echo '<pre>';
                    // print_r($row2);
                    // echo '</pre>';
                ?>


                    <div class="plat">
                        <div class="img">
                            <img src="<?= $img; ?>" alt="">

                        </div>
                        <div class="platName">
                            <p class="fr"><?= $plat_fr; ?></p>
                            <p class="ar"><?= $plat_ar; ?></p>

                        </div>

                        <div class="bottom">
                            <h2 class="price"><?= $price; ?> DA</h2>
                            <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                            <div class="quantity">

                                <button onclick="redu(this.nextElementSibling)">
                                    <i class="fa-regular fa-minus"></i>

                                </button>
                                <input type="number" value="0" min="0" onblur="corr(this)">

                                <button onclick="incr(this.previousElementSibling)">
                                    <i class="fa-regular fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>

    <?php } ?>


    <!-- <div class="category name">
        <div class="categoryTitle">
            <h2 class="fr">Entres</h2>
            <div class="midHiphen"></div>
            <h2 class="ar">أطباق</h2>
        </div>

        <div class="itemsContainer">

            <div class="plat">
                <div class="img">
                    <img src="../images/plat1.png" alt="">

                </div>
                <div class="platName">
                    <p class="fr">Soupe de Poisson</p>
                    <p class="ar">حساء السمك</p>

                </div>

                <div class="bottom">
                    <h2 class="price">300DA</h2>
                    <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                    <div class="quantity">

                        <button onclick="redu(this.nextElementSibling)">
                            <i class="fa-regular fa-minus"></i>

                        </button>
                        <input type="number" value="0" min="0" onblur="corr(this)">

                        <button onclick="incr(this.previousElementSibling)">
                            <i class="fa-regular fa-plus"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="plat">
                <div class="img">
                    <img src="../images/plat1.png" alt="">

                </div>
                <div class="platName">
                    <p class="fr">Soupe de Poisson</p>
                    <p class="ar">حساء السمك</p>

                </div>

                <div class="bottom">
                    <h2 class="price">300DA</h2>
                    <button class="addtocart"><i class="fa-solid fa-cart-plus"></i></button>
                    <div class="quantity">

                        <button onclick="redu(this.nextElementSibling)">
                            <i class="fa-regular fa-minus"></i>

                        </button>
                        <input type="number" value="0" min="0" onblur="corr(this)">

                        <button onclick="incr(this.previousElementSibling)">
                            <i class="fa-regular fa-plus"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div> -->


    <div class="category sandwiches">
        <div class="categoryTitle">
            <h2 class="fr">Sandwich</h2>
            <div class="midhiphen"></div>
            <h2 class="ar">سندويش</h2>
        </div>

        <div class="sandwich plat addSandwich" onclick="addSandwich()">
            <div class="left platName">
                <h2 class="fr">Ajouter Sandwich</h2>
                <h2 class="ar">اضافة سندويش</h2>
            </div>

            <div class="right">
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>
        <div class="itemsContainer">
            <!-- <div class="sandwich ">
                <div class="top">
                    <div class="platName">
                        <h2 class="fr">
                            Sandwich <span>1</span>
                        </h2>
                        <h2 class="ar">
                            سندويش <span>1</span>
                        </h2>
                    </div>
                    <i class="fa-solid fa-minus" onclick="delSandwich(this.parentElement.parentElement)"></i>
                </div>

                <div class="contents">
                    <div class="header">
                        <p class="fr">Brochettes</p>
                        <p class="ar">أسياخ</p>

                    </div>

                    <div class="ingredient">
                        <div class="name">
                            <p class="fr">Viande</p>
                            <p class="ar">لحم</p>
                        </div>
                        <div class="price">
                            <p class="unitPrice">60DA *</p>
                            <div class="quantity">

                                <button onclick="redu(this.nextElementSibling)">
                                    <i class="fa-regular fa-minus"></i>

                                </button>
                                <input type="number" value="0" min="0" onblur="corr(this)">

                                <button onclick="incr(this.previousElementSibling)">
                                    <i class="fa-regular fa-plus"></i>
                                </button>
                            </div>
                            <p class="totalPrice">120DA</p>
                        </div>


                    </div>

                    <div class="ingredient">
                        <div class="name">
                            <p class="fr">Viande</p>
                            <p class="ar">لحم</p>
                        </div>
                        <div class="price">
                            <p class="unitPrice">60DA *</p>
                            <div class="quantity">

                                <button onclick="redu(this.nextElementSibling)">
                                    <i class="fa-regular fa-minus"></i>

                                </button>
                                <input type="number" value="0" min="0" onblur="corr(this)">

                                <button onclick="incr(this.previousElementSibling)">
                                    <i class="fa-regular fa-plus"></i>
                                </button>
                            </div>
                            <p class="totalPrice">120DA</p>
                        </div>


                    </div>

                    
                    


                    <div class="header">
                        <p class="fr">Garnitures</p>
                        <p class="ar">اضافات</p>

                    </div>

                    <div class="ingredient">
                        <div class="name">
                            <div class="fr">Frittes</div>
                            <div class="ar">بطاطا</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="sidePanel cart">
        <div>
            <h1 class="pageTitle">Panier</h1>
        </div>
        <div class="topRow">
            <p>Plat</p>
            <div class="right">
                <p>Prix/u</p>
                <p>Qty</p>
            </div>
        </div>
        <div class="itemsContainer">
            <div class="plat">
                <div class="left">
                    <button class="del" onclick="delCartItem(this.parentElement.parentElement)">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <img src="../images/plat1.png" alt="">

                    <div class="platName">
                        <p class="fr">Soupe de poisson</p>
                        <p class="ar">حساء السمك</p>
                    </div>
                </div>

                <div class="right">
                    <p class="uprice">300</p>
                    <p>x<span class="qty">1</span></p>
                    <div class="qtyControls">
                        <button onclick="this.parentElement.parentElement.querySelector('span.qty').innerHTML ++"><i class="fa-solid fa-chevron-up"></i></button>
                        <button onclick="reduceQty(this.parentElement.parentElement)"><i class="fa-solid fa-chevron-down"></i></button>
                    </div>
                </div>

            </div>

            <div class="pack">
                <div class="header">
                    <div class="left">
                        <button class="del" onclick="delCartItem(this.parentElement.parentElement)">
                            <i class="fa-solid fa-trash"></i>
                        </button>

                        <img src="../images/plat1.png" alt="">

                        <div class="platName">
                            <p class="fr">Soupe de poisson</p>
                            <p class="ar">حساء السمك</p>
                        </div>
                    </div>

                    <div class="right">
                        <p class="uprice">300</p>
                        <p>x<span class="qty">1</span></p>
                        <div class="qtyControls">
                            <button onclick="this.parentElement.parentElement.querySelector('span.qty').innerHTML ++"><i class="fa-solid fa-chevron-up"></i></button>
                            <button onclick="reduceQty(this.parentElement.parentElement)"><i class="fa-solid fa-chevron-down"></i></button>
                        </div>
                    </div>
                </div>
                <div class="contents">
                    <div class="con">2x chorba</div>
                    <div class="con">2x chorba</div>
                    <div class="con">2x chorba</div>
                    <div class="con">2x chorba</div>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice1">1200DA</span></h2>
        </div>
    </div>

    <div class="sidePanel info">
        <div class="">
            <h1 class="pageTitle">Infos</h1>
        </div>

        <div class="itemsContainer">
            <div class="orderType splace" onclick="fixOrderType('sp')">
                <img src="../assets/sur-place-icon.svg" alt="">
                <div class="platName">
                    <h2 class="fr">Sur Place</h2>
                    <h2 class="ar">في المطعم</h2>
                </div>
            </div>

            <div class="orderType emporter" onclick="fixOrderType('emp')">
                <img src="../assets/a-emporter.svg" alt="">
                <div class="platName">
                    <h2 class="fr">À emporter</h2>
                    <h2 class="ar">طعام جاهز</h2>
                </div>
            </div>

            <div class="orderType livraison" onclick="fixOrderType('liv')">
                <img src="../assets/livraison.svg" alt="">
                <div class="platName">
                    <h2 class="fr">Livraison</h2>
                    <h2 class="ar">توصيل</h2>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice">1200DA</span></h2>
        </div>
    </div>

    <div class="sidePanel table">
        <div class="">
            <h1 class="pageTitle">Table</h1>
        </div>
        <div class="itemsContainer">
            <div class="container">
                <div class="name">
                    <h2 class="fr">Numéro de table</h2>
                    <h2 class="ar">رقم الطاولة</h2>
                </div>

                <div class="input">

                    <button onclick="redu(this.nextElementSibling)"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" name="" id="" value="0">
                    <button onclick="incr(this.previousElementSibling)"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice1">1200DA</span></h2>
        </div>
    </div>

    <div class="sidePanel emporter active">
        <div class="">
            <h1 class="pageTitle">Emporter</h1>
        </div>
        <div class="itemsContainer">
            <div class="container">
                <div class="name">
                    <h2 class="fr">Numéro de table</h2>
                    <h2 class="ar">رقم الطاولة</h2>
                </div>

                <div class="input">

                    <button onclick="redu(this.nextElementSibling)"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" name="" id="" value="0">
                    <button onclick="incr(this.previousElementSibling)"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice2">1200DA</span></h2>
        </div>
    </div>
    <div class="sidePanel livraison">
        <div class="">
            <h1 class="pageTitle">Livraison</h1>
        </div>
        <div class="itemsContainer">
            <div class="container">
                <div class="name">
                    <h2 class="fr">Numéro de table</h2>
                    <h2 class="ar">رقم الطاولة</h2>
                </div>

                <div class="input">

                    <button onclick="redu(this.nextElementSibling)"><i class="fa-solid fa-minus"></i></button>
                    <input type="number" name="" id="" value="0">
                    <button onclick="incr(this.previousElementSibling)"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice3">1200DA</span></h2>
        </div>
    </div>

    <div class="actionBtns">
        <button class="backBtn"><i class="fa-regular fa-arrow-left"></i></button>
        <div class="midBtns">
            <button class="commander y-button">Commander</button>
            <button class="modifier y-button">Modifier</button>
            <button class="confirmer y-button">Confirmer</button>
            <button class="plcommande y-button">Passer la commande</button>
        </div>
        <button class="checkBtn g-btn"><i class="fa-regular fa-check"></i></button>
        <button class="checkCartBtn g-btn"><i class="fa-regular fa-cart-circle-check"></i></button>
    </div>
</body>

</html>