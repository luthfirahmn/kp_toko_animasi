	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15"
	    style="background-image: url(<?= FOLDER_SRC . $product->gambar ?>);">
	    <h2 class="tit6 t-center">
	        Product Detail
	    </h2>
	</section>


	<!-- Content page -->
	<section>
	    <div class="bread-crumb bo5-b p-t-17 p-b-17">
	        <div class="container">
	            <a href="<?= FRONTEND_URL . 'home' ?>" class="txt27">
	                Home
	            </a>

	            <span class="txt29 m-l-10 m-r-10">/</span>

	            <a href="#" class="txt27">
	                Product Detail
	            </a>

	            <span class="txt29 m-l-10 m-r-10">/</span>

	            <span class="txt29">
	                <?= $product->nama ?>
	            </span>
	        </div>
	    </div>

	    <div class="container">
	        <div class="row ">
	            <div class="col-md-8 col-lg-9">
	                <div class="p-t-80 p-b-124 bo5-r p-r-50 h-full p-r-0-md bo-none-md">
	                    <!-- Block4 -->
	                    <div class="blo4 p-b-63">
	                        <!-- - -->
	                        <div class="pic-blo4 hov-img-zoom bo-rad-10 pos-relative">
	                            <a href="#">
	                                <img src="<?= FOLDER_SRC . $product->gambar ?>" alt="IMG-BLOG" style="max-height:20%">
	                            </a>
	                        </div>

	                        <!-- - -->
	                        <div class="text-blo4 p-t-33">
	                            <h4 class="p-b-16">
	                                <a href="#" class="tit9"><?= $product->nama ?></a>
	                            </h4>

	                            <div class="txt32 flex-w p-b-24">

	                                <span>
	                                    <?= date('d F Y', strtotime($product->rbt)); ?>
	                                    <span class="m-r-6 m-l-4">|</span>
	                                </span>

	                                <span>
	                                    <?= $product->kategori ?>
	                                    <span class="m-r-6 m-l-4">|</span>
	                                </span>

	                                <span>
	                                    <span class="m-r-6 m-l-4">
	                                        Rp. <?= $product->harga ?>
	                                    </span>
	                                </span>
	                            </div>

	                            <p>
	                                <?= $product->desc ?>
	                            </p>
	                        </div>
	                    </div>
	                    <!-- Leave a comment -->
	                    <form class="leave-comment p-t-10">
	                        <!-- Button3 -->
							<?php 
								$session = $this->session->userdata();
								$id = isset($session['id_customer']) ? $session['id_customer'] : 0;
								$query = $this->db->query("SELECT * FROM ms_customer WHERE id = '{$id}'");
								$result = $query->row();

								if($result){
									echo '<a href="'.FRONTEND_URL . 'trx/trx_process/'. $product->id .'" class="btn3 flex-c-m size31 txt11 trans-0-4">
									Order Now
								</a>';
								}else{
									echo '<a href="'.BACKEND_URL . 'login/login_page_customer' .'" class="btn3 flex-c-m size31 txt11 trans-0-4">
									Login untuk order
								</a>';
								}
							?>
	                        
	                    </form>
	                </div>
	            </div>

	            <div class="col-md-4 col-lg-3">
	                <div class="sidebar2 p-t-80 p-b-80 p-l-20 p-l-0-md p-t-0-md">

	                    <!-- Categories -->
	                    <div class="categories">
	                        <h4 class="txt33 bo5-b p-b-35 p-t-58">
	                            Kategori
	                        </h4>

	                        <ul>
	                            <?php foreach ($kategori as $kategori) { ?>
	                            <li class="bo5-b p-t-8 p-b-8">
	                                <a href="<?= FRONTEND_URL . 'lists/index/' . $kategori->id ?>" class="txt27">
	                                    <?= $kategori->kategori ?>
	                                </a>
	                            </li>
	                            <?php } ?>
	                        </ul>
	                    </div>

	                    <!-- Most Popular -->
	                    <div class="popular">
	                        <h4 class="txt33 p-b-35 p-t-58">
	                            Most popular
	                        </h4>

	                        <ul>

	                            <?php foreach ($popular as $popular) { ?>
	                            <li class="flex-w m-b-25">
	                                <div class="size16 bo-rad-10 wrap-pic-w of-hidden m-r-18">
	                                    <a href="<?= FRONTEND_URL . 'ProductDetail/index/' . $popular->id ?>">
	                                        <img src="<?= FOLDER_SRC . $popular->gambar ?>" alt="IMG-BLOG">
	                                    </a>
	                                </div>

	                                <div class="size28">
	                                    <a href="#" class="dis-block txt28 m-b-8">
	                                        <?= $popular->nama ?>
	                                    </a>

	                                    <span class="txt14">
	                                        Rp. <?= $popular->harga ?>
	                                    </span>
	                                </div>
	                            </li>
	                            <?php } ?>

	                        </ul>
	                    </div>



	                </div>
	            </div>
	        </div>
	    </div>






































	</section>
