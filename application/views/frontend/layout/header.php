	<!-- Header -->
	<header>
	    <!-- Header desktop -->
	    <div class="wrap-menu-header gradient1 trans-0-4">
	        <div class="container h-full">
	            <div class="wrap_header trans-0-3">
	                <!-- Logo -->
	                <div class="logo">
	                    <p class="text-white">ANIMATION STORE</p>
	                </div>

	                <!-- Menu -->
	                <div class="wrap_menu p-l-45 p-l-0-xl">
	                    <nav class="menu">
	                        <ul class="main_menu">
	                            <li>
	                                <a href="<?= FRONTEND_URL . 'home' ?>">Home</a>
	                            </li>

	                            <li>
	                                <a href="<?= FRONTEND_URL . 'lists' ?>">Animation</a>
	                            </li>

	                            <!-- <li>
	                                <a href="about.html">About</a>
	                            </li> -->

	                            <li>
	                                <a href="<?= FRONTEND_URL . 'contact' ?>">Contact</a>
	                            </li>
	                        </ul>
	                    </nav>
	                </div>

	                <!-- Social -->
	                <div class="social flex-w flex-l-m p-r-20">
	                    <?php
						$session = $this->session->userdata();
						$id = isset($session['id_customer']) ? $session['id_customer'] : 0;
						$query = $this->db->query("SELECT * FROM ms_customer WHERE id = '{$id}'");
						$result = $query->row();
						if ($result) {
							echo '<a href="' . BACKEND_URL . 'login/logout_customer' . '" type="submit" class="btn btn-outline-light" style="font-size:12px">
	                    	Logout
	                    	</a>';
						} else {
							echo '<a href="' . BACKEND_URL . 'login/login_page_customer' . '" class="btn btn-outline-light" style="font-size:12px">
	                    	Login/Register
	                    </a>';
						}
						?>

	                    <button class="btn-show-sidebar m-l-33 trans-0-4"></button>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
