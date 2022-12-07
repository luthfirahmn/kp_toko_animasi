<style>
html {
    scroll-behavior: smooth;
}
</style>
<!-- Slide1 -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">

            <?php foreach ($slider as $row) { ?>
            <div class="item-slick1 item1-slick1" style="background-image: url(<?= FOLDER_SRC . $row->gambar ?>);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">

                    <h2 class="caption2-slide1 tit1 t-center animated visible-false m-b-37 mt-4" data-appear="fadeInUp">
                        <?= $row->judul ?>
                    </h2>

                    <div class="wrap-btn-slide1 animated visible-false" data-appear="zoomIn">
                        <!-- Button1 -->
                        <a href="#product" class="btn1 flex-c-m size1 txt3 trans-0-4">
                            ANIMATION LIST
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

        <div class="wrap-slick1-dots"></div>
    </div>
</section>


<!-- Our menu -->
<section class="section-ourmenu bg2-pattern p-t-115 p-b-120">
    <div class="container">
        <div class="title-section-ourmenu t-center m-b-22">
            <span class="tit2 t-center">
                Category
            </span>

            <h6 class="tit9 t-center m-t-2">
                ALL LIST
            </h6>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <?php foreach ($kategori as $row) { ?>
                    <div class="col-4">
                        <!-- Item our menu -->
                        <div class="item-ourmenu bo-rad-10 hov-img-zoom pos-relative m-t-30" style="max-height:205px;">
                            <img src="<?= FOLDER_SRC . $row->gambar ?>" alt="IMG-MENU">

                            <!-- Button2 -->
                            <a href="<?= FRONTEND_URL . 'lists/index/' . $row->id ?>" class="btn2 flex-c-m txt5 ab-c-m size7">
                                <?= $row->kategori ?>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- Lunch -->
<section class="section-lunch bgwhite" id="product">
    <div class="header-lunch parallax0 parallax100"
        style="background-image: url(<?= FRONT_ASSET ?>images/header-menu-01.jpg);">
        <div class="bg1-overlay t-center p-t-170 p-b-165">
            <h2 class="tit4 t-center">
                ANIMATION LIST
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row p-t-108 p-b-70">
            <div class="col-md-8 col-lg-6 m-l-r-auto">

                <?php foreach ($product_left as $row) { ?>
                <div class="blo3 flex-w flex-col-l-sm m-b-30">
                    <div class="pic-blo3 size20 bo-rad-10 hov-img-zoom m-r-28">
                        <a href="<?= FRONTEND_URL . 'ProductDetail/index/' . $row->id ?>"><img
                                src="<?= FOLDER_SRC . $row->gambar ?>" alt="IMG-MENU"></a>
                    </div>

                    <div class="text-blo3 size21 flex-col-l-m">
                        <a href="#" class="txt21 m-b-3">
                            <?= $row->nama ?>
                        </a>

                        <span class="txt23">
                            <?= limit_text($row->desc, 5); ?>
                        </span>

                        <span class="txt22 m-t-20">
                            Rp. <?= $row->harga ?>
                        </span>
                    </div>
                </div>
                <?php } ?>
            </div>

            <div class="col-md-8 col-lg-6 m-l-r-auto">
                <?php foreach ($product_right as $row) { ?>
                <div class="blo3 flex-w flex-col-l-sm m-b-30">
                    <div class="pic-blo3 size20 bo-rad-10 hov-img-zoom m-r-28">
                        <a href="<?= FRONTEND_URL . 'ProductDetail/index/' . $row->id ?>"><img
                                src="<?= FOLDER_SRC . $row->gambar ?>" alt="IMG-MENU"></a>
                    </div>

                    <div class="text-blo3 size21 flex-col-l-m">
                        <a href="#" class="txt21 m-b-3">
                            <?= $row->nama ?>
                        </a>

                        <span class="txt23">
                            <?= limit_text($row->desc, 5); ?>
                        </span>

                        <span class="txt22 m-t-20">
                            Rp. <?= $row->harga ?>
                        </span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>




















</section>n>
