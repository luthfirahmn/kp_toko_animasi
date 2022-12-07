	<!-- Title Page -->
	<section class="bg-title-page flex-c-m p-t-160 p-b-80 p-l-15 p-r-15"
	    style="background-image: url(<?= FRONT_ASSET ?>images/blog-11.jpg);">
	    <h2 class="tit6 t-center">
	        Contact
	    </h2>
	</section>



	<!-- Contact form -->
	<section class="section-contact bg1-pattern p-t-90 p-b-113">
	    <!-- Map -->
	    <div class="container">
	        <div class="map bo8 bo-rad-10 of-hidden">
	            <iframe
	                src="<?= $data->maps ?>"
	                width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"
	                referrerpolicy="no-referrer-when-downgrade"></iframe>
	        </div>
	    </div>

	    <div class="container">

	        <div class="row p-t-135">
	            <div class="col-sm-8 col-md-4 col-lg-4 m-l-r-auto p-t-30">
	                <div class="dis-flex m-l-23">
	                    <div class="p-r-40 p-t-6">
	                        <img src="<?= FRONT_ASSET ?>images/icons/map-icon.png" alt="IMG-ICON">
	                    </div>

	                    <div class="flex-col-l">
	                        <span class="txt5 p-b-10">
	                            Location
	                        </span>

	                        <span class="txt23 size38">
							<?= $data->lokasi ?>
	                        </span>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-8 col-md-3 col-lg-4 m-l-r-auto p-t-30">
	                <div class="dis-flex m-l-23">
	                    <div class="p-r-40 p-t-6">
	                        <img src="<?= FRONT_ASSET ?>images/icons/phone-icon.png" alt="IMG-ICON">
	                    </div>


	                    <div class="flex-col-l">
	                        <span class="txt5 p-b-10">
	                            Call Us
	                        </span>

	                        <span class="txt23 size38">
								0<?= $data->telepon ?>
	                        </span>
	                    </div>
	                </div>
	            </div>


	        </div>
	    </div>
	</section>
