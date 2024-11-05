<!DOCTYPE html><?php session_start();
                include '../connection.php';

                ?>
<html lang="en">

<head>


    <title>Menu</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include '../head.php'; ?>
    <link rel="stylesheet" href="./style.css">

    <link rel="stylesheet" href="./anim.css">
    <script src="./anim.js"></script>

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

                <?php

                $sql = "SELECT * 
    FROM `packs`";
                $result = mysqli_query($con, $sql);



                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {


                    $id = $row['id'];
                    $fr = $row['name_fr'];
                    $ar = $row['name_ar'];
                    $img = $row['image_address'];
                    $price = $row['price'];

                    $contents = json_decode($row['contents']);
                ?>

                    <div class="pack pack<?= $id ?> swiper-slide" data-type="pack" id="<?= $id ?>">
                        <img src="<?= $img; ?>" alt="pack">
                        <div class="content">
                            <div class="name">
                                <p class="fr" data-content = "<?= $fr; ?>"><?= $fr; ?></p>
                                <p class="ar"><?= $ar; ?></p>

                            </div>
                            <ul class="plats">


                                <?php
                                foreach ($contents as $t) {


                                    foreach ($t as $x => $y) {
                                        $query = "SELECT name_fr FROM `plats` WHERE id='$x'";
                                        $res = mysqli_query($con, $query);
                                        while ($el = mysqli_fetch_array($res, MYSQLI_ASSOC)) {



                                ?>
                                            <li><?= $y . '* ' . $el['name_fr']; ?></li>

                                <?php }
                                    }
                                }
                                ?>
                            </ul>

                            <div class="bottom">
                                <h2 class="price"><?= $price ?> DA</h2>
                                <button class="addtocart">Ajouter</button>
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
                <?php } ?>


            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    <?php

    $sql = "SELECT * 
    FROM `categories`
    ORDER BY tartib asc";
    $result = mysqli_query($con, $sql);



    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $id = $row['id'];
        $fr = $row['name_fr'];
        $ar = $row['name_ar'];

    ?>
        <div class="category plats <?= $fr ?>">
            <div class="categoryTitle">
                <h2 class="fr"><?= $fr; ?></h2>
                <div class="midHiphen"></div>
                <h2 class="ar"><?= $ar; ?></h2>
            </div>

            <div class="itemsContainer" data-type="plat">

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

                ?>


                    <div class="plat plat<?= $plat_id ?>" id="<?= $plat_id; ?>">
                        <div class="img">
                            <img src="<?= $img; ?>" alt="">

                        </div>
                        <div class="platName">
                            <p class="fr"  data-content = "<?= $plat_fr; ?>"><?= $plat_fr; ?></p>
                            <p class="ar"><?= $plat_ar; ?></p>

                        </div>

                        <div class="bottom">
                            <h2 class="price"><?= $price; ?> DA</h2>
                            <button class="addtocart">Ajouter</button>
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
        </div>
    </div>

    <div class="sidePanel cart ">
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

        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice1">0DA</span><span class="livPrice"></span></h2>
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
            <h2>Total: <span id="totalPrice">0DA</span><span class="livPrice"></span></h2>
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
            <h2>Total: <span id="totalPrice4">0DA</span><span class="livPrice"></span></h2>
        </div>
    </div>

    <div class="sidePanel emporter">
        <div class="">
            <h1 class="pageTitle">Emporter</h1>
        </div>
        <div class="itemsContainer">
            <div class="container">
                <div>
                    <label for="livName" class="persInfoLabel">
                        <p class="fr">Nom</p>
                        <p class="ar">الاسم</p>
                    </label>

                    <input type="text" name="empNom" id="empNom" placeholder="Nom et prénom">

                </div>
                <div>
                    <label for="livNum" class="persInfoLabel">
                        <p class="fr">Numéro</p>
                        <p class="ar">رقم الهاتف</p>
                    </label>

                    <input type="text" name="empNum" id="empNum" placeholder="0555 55 55 55">

                </div>


            </div>
        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice2">0DA</span><span class="livPrice"></span></h2>
        </div>
    </div>
    <div class="sidePanel livraison "> <!-- delete active -->
        <div class="">
            <h1 class="pageTitle">Livraison</h1>
        </div>
        <div class="itemsContainer">
            <div class="container">
                <div>
                    <label for="livName" class="persInfoLabel">
                        <p class="fr">Nom</p>
                        <p class="ar">الاسم</p>
                    </label>

                    <input type="text" name="livName" id="livName" placeholder="Nom et prénom">

                </div>
                <div>
                    <label for="livNum" class="persInfoLabel">
                        <p class="fr">Numéro</p>
                        <p class="ar">رقم الهاتف</p>
                    </label>

                    <input type="text" name="livNum" id="livNum" placeholder="0555 55 55 55">

                </div>

                <div class="">
                <label for="livLocation" class="persInfoLabel" style="margin-bottom:0;">
                        <p class="fr">Location</p>
                        <p class="ar">الموقع</p>
                    </label>
                </div>

                <div class="radio-input">
                
                    <label class="label">
                        <input
                            type="radio"
                            id="bbhsen-inp"
                            checked=""
                            name="livLocation"
                            value="Baba H'sen" />
                        <div class="textContainer">
                            <p class="text fr">Baba H'sen <span>(+300DA)</span></p>
                            <p class="text ar">بابا حسن</p>
                        </div>

                    </label>
                    <label class="label">
                        <input type="radio" id="drria-inp" name="livLocation" value="Draria" />
                        <div class="textContainer">
                            <p class="text fr">Draria <span>(+400DA)</span></p>
                            <p class="text ar">درارية</p>
                        </div>
                    </label>
                    <label class="label">
                        <input type="radio" id="autres-inp" name="livLocation" value="Autres" />
                        <div class="textContainer">
                            <p class="text fr">Autres Communes <span>(+500DA)</span></p>
                            <p class="text ar">بلديات اخرى</p>
                            <div class="inppContainer">
                    <input type="text" name="livLocation" id="livLocation" placeholder="Entrer la commune">
                            
                            </div>
                        </div>

                    </label>
                </div>

            </div>


        </div>
        <div class="cartTotal">
            <h2>Total: <span id="totalPrice3">0DA</span><span class="livPrice"></span></h2>
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

    <form action="./createOrder.php" method="post" id="CartForm">
        <input type="text" id="cartInp" name="cart">
        <input type="text" name="type" id="typeInp">
        <input type="text" name="total" id="totalInp">
        <input type="text" name="client" id="clientInp">
        <button type="submit">s</button>
    </form>
</body>

</html>