<!DOCTYPE html>
  <html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <title>Muslimatrimonials</title>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/frontend/lib/img/avata.ico" type="image/x-icon" />

		<!-- Style -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/responsive.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/animations.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/lightbox.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="<?php echo base_url();?>assets/frontend/lib/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

        <!-- custom -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/custom/css/landing.css">

        <?php echo '<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>'; ?>

    </head>
    <body>

        <!-- Header -->
			<header id="header">

					<nav id="head-nav" class="navbar topnavbar navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="200">
						<div class="container">
							<div class="navbar-header">
								<a href="#header" class="navbar-brand header"><img src="<?php echo base_url();?>assets/frontend/lib/images/logo.png" alt=""></a>
							</div> <!-- /#navbar-header -->
                            <div class="l_login">
                                 <span id="l_lang_btn">
                                     <i class="material-icons">keyboard_arrow_down</i>
                                    <img src="<?php echo base_url();?>assets/frontend/lib/img/flgs/e.png" />
                                </span>
                                <span id="l_login_btn">LOGIN</span>
                            </div>
                            <div class="l_sel_lan">
                                <div><img src="<?php echo base_url();?>assets/frontend/lib/img/flgs/e.png" /> English</div>
                                <div><img src="<?php echo base_url();?>assets/frontend/lib/img/flgs/a.png" /> Arabic</div>
                            </div>
						</div>
					</nav> <!-- /#navbar -->

				<!-- Slider -->
				<section id="slider">
					<div class="container-full">
						<div class="slider">
							<div id="main-slider" class="carousel slide">
                                <!--
								<ol class="carousel-indicators">
									<li data-target="#main-slider" data-slide-to="0" class="active"></li>
									<li data-target="#main-slider" data-slide-to="1"></li>
									<li data-target="#main-slider" data-slide-to="2"></li>
									<li data-target="#main-slider" data-slide-to="3"></li>
									<li data-target="#main-slider" data-slide-to="4"></li>
								</ol>
                                -->
								<!-- Carousel items -->
								<div class="carousel-inner">
									<div class="active item">
										<div class="container slide-element">
											<div class="l_signup">
                                                <div class="l_signup_tlt">IT'S FREE TO JOIN</div>
                                                <div class="l_signup_enter">
                                                    First Name <br>
                                                    <input type="text" id="l_signup_firstname" />
                                                </div>
                                                <div class="l_signup_enter">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">I'm a</div>
                                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">Age</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                                            <select id="c_signup_sex">
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                                            <select id="c_signup_age">
                                                                <?php
                                                                for ( $i = 18; $i < 99; $i ++ )
                                                                {
                                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                                }
                                                                ?>
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="l_signup_enter">
                                                    Your Email Address <br>
                                                    <input type="text" id="l_signup_email" />
                                                </div>
                                                <div class="l_signup_enter">
                                                    Choose Password <br>
                                                    <input type="password" id="l_signup_password" />
                                                </div>
                                                <div class="l_signup_btn">view singles now</div>
                                                <div class="l_bot_bor"></div>
                                                <div class="l_signup_facebook_btn" id="facebook_login_btn">Join with Facebook</div>
                                                <div class="l_signup_terms">
                                                    We will never post or share any information to your Facebook page.<br>
                                                    <a herf="#">Terms and Conditions</a>
                                                </div>
                                            </div>
										</div>
									</div>
								</div> <!-- /#carousel-inner -->

								<!-- Controls -->
                                <!--
								<a class="carousel-control left" href="#main-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
								<a class="carousel-control right" href="#main-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                -->
							</div>
						</div>
					</div>
				</section> <!-- /#slider -->
			</header> <!-- /#header -->

            <section id="submenu">
                <div class="l_txt_c">
                    <a href="<?php echo base_url();?>front/l_women"><span>Muslim Women</span></a>
                    <a href="<?php echo base_url();?>front/l_men"><span>Muslim Men</span></a>
                    <a href="<?php echo base_url();?>front/l_signup"><span class="l_no_b_r">Join Free</span></a>
                </div>
            </section>

			<!-- about  -->
			<section id="about">
				<div class="container-full">
					<div class="container">
						<div class="row bm-remove animate" data-anim-type="zoomInUp">
							<div class="about_content">
								<div class="col-md-6">
									<div class="imac">
										<img src="<?php echo base_url();?>assets/frontend/lib/img/imac.png" alt="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="web_content">
										<h3>Why Choose Muslimatrimonials?</h3>
										<div class="g_s_cnt">Muslimatrimonials has helped thousands of Muslim singles find their match.
                                            As one of the leading Islamic matrimonial sites,
                                            we are one of the largest and most trusted sites around.
                                            Not many other sites can offer you a membership database of over 4.5 million members with
                                            the promise of introducing you to single Muslim men and women across the world.</div>
                                        <h3>International Muslim Matrimonials</h3>
                                        <div class="g_s_cnt">Muslimatrimonials is part of the well-established Cupid Media network that
                                            operates over 30 reputable niche dating sites. Unlike other online dating sites
                                            our site is purely for those seeking Muslim singles for marriage in a manner that
                                            adheres to the Islamic rules on courtship.

                                            Our membership base is made up of over 4.5 million singles from USA,
                                            Europe, Asia, the Middle East and many other countries. We are committed to
                                            helping you find the perfect Islamic match, no matter where in the world they may be.</div>
<!--										<a class="btn btn-red" href="#">Download Now</a>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section> <!-- /about  -->

			<!-- Promotional video -->
			<section id="promotion">
				<div class="container-full">
					<div class="container">
						<div class="bm-remove animate" data-anim-type="zoomInUp">
							<div class="col-md-6">
								<div class="promotion_content " data-anim-type="fadeInLeft">
									<h3>Start Your Success Story On Muslimatrimonials</h3>
<!--									<h4>Simple & Elegant User Interface</h4>-->
									<div class="g_s_cnt">As a premier site for Muslim marriages,
                                        we successfully bring together singles from around the world.
                                        Since 2018, thousands of happy men and women have met their soul mates on
                                        Muslimatrimonials and have shared their stories with us. Check out the many success stories here.

                                        Let us help you fulfil your faith and earn your reward from Allah (swt). Join free today.</div>
                                    <br><br><br><br>
									<a class="btn btn-green" href="<?php echo base_url();?>front/l_signup">JOIN FREE NOW</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="ifarem embed-responsive embed-responsive-4by3">
									<iframe class="embed-responsive-item" width="520" height="345"
									src="http://www.youtube.com/embed/XGSy3_Czz8k">
									</iframe>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</section> <!-- /#promotion -->
			

			<!-- Pricing Table -->
			<section id="pricing">
				<div class="container-full">
					<div class="container">
						<div class="row bm-remove animate" data-anim-type="fadeInDownLarge">
							<div class="col-md-12">
								<div class="text">
									<h2 class="section-title">How It Works</h2>
									<h3 class="section-subtitle">Get started on Muslimatrimonials.com today in 3 simple steps:</h3>
								</div>
							</div>

							<ul>
								<li class="col-xs-12 col-sm-4">
									<div class="pri_table text-center">
                                        <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/1.png" />
										<h4>Create A Profile</h4>
										<div class="g_s_cnt">Create a personalised profile, <br>
                                            add photos and describe <br>
                                            your ideal partner</div>
									</div>
								</li>
								<li class="col-xs-12 col-sm-4">
									<div class="pri_table text-center">
                                        <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/2.png" />
										<h4>Browse Photos</h4>
										<div class="g_s_cnt">Find members based on location, <br>
                                            special interests and <br>
                                            lifestyle preferences</div>
									</div>
								</li>
								<li class="col-xs-12 col-sm-4">
									<div class="pri_table text-center">
                                        <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/3.png" />
                                        <h4>Start Communicating</h4>
                                        <div class="g_s_cnt">Show interest in the members <br>
                                            you like and let the  <br>
                                            journey begin</div>
									</div>
								</li>
                                <li class="col-xs-12 col-sm-12">&nbsp;</li>
							</ul>
                            <div class="l_txt_c"><a href="<?php echo base_url();?>front/h_matches" class="btn btn-green">FIND YOUR MATCH</a></div>
						</div>
					</div>
				</div>
			</section> <!-- /#Pricing Table -->

        <!-- Twitter Feed -->
        <section id="contact">
            <div class="container-full">
                <div class="bm-remove animate" data-anim-type="fadeInLeft">

                    <div class="carousel slide" id="tweet-carousel">
                        <div class="carousel-inner">
                            <div class="item active" id="slide1">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-1"></div>
                                        <div class="col-xs-12 col-md-5 l_m_img">
                                            <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/11.png" />
                                        </div>
                                        <div class="col-xs-12 col-md-5 l_m_cnt">
                                            <h3>Alhamdulillah i meet my lovely here</h3>
                                            Firstly I want to thank Muslimatrimonials.com for introducing me to my wife Zahra Griouette.
                                            She is truly the greatest woman ever.
                                            I live in Scunthorpe and she lives in Morocco.
                                            Soon we will live together Inshallah.
                                            I had recently renewed my membership and was chatting with a Muslimatrimonials whom
                                            I got along with but shared different values, so we’d agreed to just be friends and keep looking for an
                                            ideal partner. Months went by our friendship grew stronger
                                        </div>
                                        <div class="col-xs-12 col-md-1"></div>
                                    </div>
                                </div>
                            </div><!-- end item -->

                            <div class="item" id="slide2">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-1"></div>
                                        <div class="col-xs-12 col-md-5 l_m_img">
                                            <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/44.png" />
                                        </div>
                                        <div class="col-xs-12 col-md-5 l_m_cnt">
                                            <h3>The whole experience was so magical something like what you would see in a movie!</h3>
                                            Thanks to Muslimatrimonials.com site... Although I have always been very sceptical of joining
                                            dating/marital sites however through others encouragements I thought of a short trail...
                                            thankfully this has given me a to find my amazing soulmate, his only within 29 days of our communication from the date we connected on this site!!!
                                        </div>
                                        <div class="col-xs-12 col-md-1"></div>
                                    </div>
                                </div>
                            </div><!-- end item -->

                            <div class="item" id="slide3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-1"></div>
                                        <div class="col-xs-12 col-md-5 l_m_img">
                                            <img src="<?php echo base_url();?>assets/frontend/lib/img/lnd/33.png" />
                                        </div>
                                        <div class="col-xs-12 col-md-5 l_m_cnt">
                                            <h3>Muslimatrimonials.com marriage site which is truly a great platform for genuine Muslims seeking marriage</h3>
                                            Allah guided us both half way across the globe to find each other.
                                            Even our birthdays are same day.
                                            May Allah facilitate easy in everyone's path and unite you with best
                                            life partner for you to complete you, to grow together in imaan, love and compassion.
                                        </div>
                                        <div class="col-xs-12 col-md-1"></div>
                                    </div>
                                </div>
                            </div><!-- end item -->
                        </div><!-- carousel-inner -->

                        <!-- Controls -->
                        <a class="left carousel-control" data-slide="prev" href="#tweet-carousel"><span class="icon-prev"></span></a>
                        <a class="right carousel-control" data-slide="next" href="#tweet-carousel"><span class="icon-next"></span></a>

                    </div><!-- /#TwitterCarousel -->

                </div>
            </div>
        </section> <!-- /#Twitter Feed -->

			<!-- Start testimonial-clients section -->
            <!--
			<section id="testimonial-clients">
				<div id="testimonial">
					<div class="container-full">
						<div class="container">
							<div class="row bm-remove animate" data-anim-type="fadeInLeft">
								<div class="col-md-12">
									<h1 class="text-center">“</h1>
									<h2>“Good design is all about making other designers feel like 
									idiots because that idea wasn’t theirs.”</h2>
									<div class="designer text-center">
										<div class="clint">
											<img src="<?php echo base_url();?>assets/frontend/lib/img/frank_clint.jpg" alt="">
										</div>
										<div class="info">
											<h3>Frank Chimero</h3>
											<p>Professional Designer.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				-->

				<!-- Start clients -->
				<div id="clients">
					<div class="container-full">
						<div class="container">
							<div class="row sub_content bm-remove animate" data-anim-type="fadeInUpLarge">
								<div class="col-md-12">
									<div class="dividerHeading text-center">
										<h2 class="section-title">Our Favorite Members</h2>
										<h3 class="section-subtitle">our muslimatrimonials.com best members</h3>
									</div>
								</div>
								<div class="our_clients">
									<ul class="client_items clearfix">
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-themeforest">FaraQueen (31)<span class="clent1"></span></a></li>
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-envato">Jong SongHyok (29)<span class="clent2"></span></a></li>
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-activeden">Rim JinChol (28)<span class="clent3"></span></a></li>
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-audioj">Jong JinSong (31)<span class="clent4"></span></a></li>
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-graphicriver">Kwon SongChol (31)<span class="clent5"></span></a></li>
										<li class="col-xs-6 col-sm-4 col-md-2"><a href="services.html" class="tt-theme">Bak IlJu (30)<span class="clent6"></span></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End clients -->
			</section>
			<!-- End testimonial-clients section -->
			
			<!-- Mobile description -->
			<div id="why">
				<div class="container-full">
					<div class="container">
						<div class="row bm-remove animate" data-anim-type="fadeInRight">
							<div class="col-md-6">
								<div class="modern">
									<h2>Finding your perfect match has never been easier with the Muslimatrimonials Android app.
                                        Available for FREE download now</h2>
									<hr />
									<div class="list_item">
										<ul>
											<li><i class="fa fa-check"></i><a href="#">16Psd Files Easy to Edite</a></li>
											<li><i class="fa fa-check"></i><a href="#">All Font used Link Included</a></li>
											<li><i class="fa fa-check"></i><a href="#">16Psd Files Easy to Edite</a></li>
											<li><i class="fa fa-check"></i><a href="#">All Font used Link Included</a></li>
										</ul>
									</div>
									<h1>Get Now Your Copy <b>FREE</b></h1>
									<a href="#about" class="btn btn-green">Download Now</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="phone">
									<img src="<?php echo base_url();?>assets/frontend/lib/img/phone_2.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- /#Mobile description -->

			<!-- footer top -->
			<footer id="footer-top">
				<div class="container-full">
					<div class="container">
						<div class="row bm-remove animate" data-anim-type="bounceIn">
							<div class="footer-text">
								<h1>SO WHAT YOU THINK ?</h1>
								<div class="g_s_cnt l_txt_white">Are you bored of the usual dating? If you’re not in the mood for online dating at the moment,
                                    don't put up with it. Find thousands of fun-loving and flirty singles to flirt with.
                                    muslimatrimonials.com is an online dating community dedicated to introducing open-minded singles,
                                    who think that an online flirt is much better than a relationship.
                                    View personals, communicate with playful singles, share your experiences, and mingle with people from your area. <br/>
                                    Nothing is as satisfying as flirting online.</div><br/><br/>
								<a href="#contact" class="btn btn-red">Contact Me</a>
							</div>
						</div>
					</div>
				</div>
			</footer> <!-- footer-top -->

			<!-- footer -->
			<footer id="footer">
				<div class="container-full">
					<div class="container">
						<div class="bm-remove animate" data-anim-type="fadeInDownLarge">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<div class="socile">
									<ul>
										<li><a href="graygrids"><i class="fa fa-facebook"></i></a></li>
										<li><a href="graygrids"><i class="fa fa-twitter"></i></a></li>
										<li><a href="musharrof"><i class="fa fa-dribbble"></i></a></li>
										<li><a href="#"><i class="fa fa-rss"></i></a></li>
									</ul>
<!--									<a href="#">/AYOUB ELRED</a>-->
								</div>
								
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="float_right">
								<p><!--© Developed by  --><a href="#">muslimatrimonials.com <i class="fa fa-arrow-right"></i></a></p>
							</div>
								
							</div>
						</div>
						<div class="span1">
							<a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
						</div>
					</div>
				</div>
			</footer> <!-- /#footer -->

		<script src="<?php echo base_url();?>assets/frontend/lib/js/vendor/jquery-1.10.2.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/plugins.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/main.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/animations.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/jquery.scrollUp.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/lightbox.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/smoothscroll.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/visible.min.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/lib/js/jquery.nav.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/custom/js/global.js"></script>
        <script src="<?php echo base_url();?>assets/frontend/custom/js/landing.js"></script>

    </body>
</html>
