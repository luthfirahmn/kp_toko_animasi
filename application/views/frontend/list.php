	
	<?php if($kategori == ''){ ?>
	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15"
	    style="background-color: #000;">
	    <h2 class="tit6 t-center">
		LIST ANIMATION
	    </h2>
	</section>

	<?php } else { ?>
	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15"
		style="background-image: url(<?= FOLDER_SRC . $kategori->gambar ?>);">
		<h2 class="tit6 t-center">
		<?= $kategori->kategori ?>
		</h2>
	</section>

	<?php } ?>



	<!-- Gallery -->
	<div class="section-gallery p-t-118 p-b-100">
	    <div class="wrap-gallery isotope-grid flex-w p-l-25 p-r-25">
	        
		<?php foreach($product as $row) { ?>
	        <div class="item-gallery isotope-item bo-rad-10 hov-img-zoom events guests" style="max-height: 300px;">
	            <img src="<?= FOLDER_SRC . $row->gambar ?>" alt="IMG-GALLERY" style="height:300px">

	            <div class="overlay-item-gallery trans-0-4 flex-c-m">
	                <a class="btn-show-gallery flex-c-m fa fa-shopping-cart" href="<?= FRONTEND_URL .  'ProductDetail/index/' . $row->id ?>"></a>
				</div>
	        </div>
		<?php } ?>
	    </div>
	</div>

