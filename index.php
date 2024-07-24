<?php
$base = "app/";

include("header.php");
?>
	<div class="hero">
		<!-- <div align="center" style="margin-top: 10px;margin-bottom: -35px;padding-top: 10px;border: 1px solid #666; background-color: #ffffcc; width: 500px;font-size: 10px; padding: 5px; margin-left: auto; margin-right: auto;"><span style="font-weight: bold; color: #FF0000">Attention MyComingle Users:</span> We will be performing scheduled maintenance on Thursday (10/25/12) from 7:30 AM EDT - 9:30 AM EDT</div> -->
		<div class="hero-content" style="width: 1024px">
			<div class="hero-text">
				<div class="hero-statement">Simplify your<br /> digital life</div>
				<div class="hero-statement-subtext">Combine all your online activities<br /> into one smart dashboard.</div>
				<div class="hero-statement-action">
					<div style="float: left">
						<img src="app/images/general/sign-up.png" align="absmiddle" style="cursor: pointer" onClick="showJoin('bottom', '<?=$base?>');">
						<div style="position: relative">
						<div class="join-callouts" id="join-configure-calloutbottom" style="margin: 11px -135px 0px">
							<div class="join-callout join-border-callout" style="margin: 0 18px 18px 2px; width: 400px">
								<div class="join-callout-contentbottom" style="padding: 10px"></div>
								<b class="join-border-notch join-notch" style="margin-left: -25px"></b>
								<b class="join-notch" style="margin-left: -25px"></b>
							</div>						
						</div>
					</div>										
					</div>
					<div style="float: left;padding-top: 15px"><!-- &nbsp; or <span style="font-weight: bold">take a tour </span> --></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="hero-image">
				<!--<img src="app/images/general/hero-image.png">--><iframe width="575" height="323" src="http<?php echo (!empty($_SERVER["HTTP_HTTPS_X_FORWARDED_FOR"]) ? "s" : "");?>://www.youtube.com/embed/G7rF1f5kQtQ?version=3&wmode=opaque&loop=1" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
	<div class="features"> 
		<div class="feature-content">
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/secure.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">Your Security</div>
					<div class="feature-subheading">We protect your password with bank-grade security, never share your data with anyone, and don't store user identifiable passwords.</div>
				</div>
			</div>
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/password.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">One Password</div>
					<div class="feature-subheading">That's all it takes and you're connected to everything. Multiple sign-ins are over.</div>
				</div>
			</div>
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/free.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">Free</div>
					<div class="feature-subheading">MyComingle is completely free to everyone. That's all.</div>
				</div>
			</div>
			<div class="clear" style="height: 50px"></div>
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/organized.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">Always organized</div>
					<div class="feature-subheading">Relax - we'll make sure you stay on top of alerts, messages and appointments.</div>
				</div>
			</div>
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/here.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">It's all here</div>
					<div class="feature-subheading">Facebook, Google, Twitter, Yahoo!, LinkedIn and more. MyComingle brings your favorite sites together.</div>
				</div>
			</div>
			<div class="feature-item">
				<div class="feature-image">
					<img src="app/images/general/features/easy.png">
				</div>
				<div class="feature-text">
					<div class="feature-headline">Easy to use</div>
					<div class="feature-subheading">We got rid of the clutter and we've made the internet simple again.</div>
				</div>
			</div>
		</div>
	</div>
	<div class="screenshots">
		<div class="screenshot-content">
			<div class="screenshot-item"><a class="fancybox" href="app/images/general/1_b.jpg" data-fancybox-group="gallery" title="One smart dashboard gives you access to everything you need"><img src="app/images/general/1_s.jpg" alt="" border="0"/></a></div>
			<div class="screenshot-item"><a class="fancybox" href="app/images/general/2_b.jpg" data-fancybox-group="gallery" title="You can setup whichever services you use"><img src="app/images/general/2_s.jpg" alt="" border="0" /></a></div>
			<div class="screenshot-item"><a class="fancybox" href="app/images/general/3_b.jpg" data-fancybox-group="gallery" title="Emails can be triggered from your new alert sidebar"><img src="app/images/general/3_s.jpg" alt="" border="0" /></a></div>
			<div class="screenshot-item"><a class="fancybox" href="app/images/general/4_b.jpg" data-fancybox-group="gallery" title="With the social view, you can access all of your social networks in 1 screen"><img src="app/images/general/4_s.jpg" alt="" border="0" /></a></div>
		</div>
	</div>
	<div class="lower">
		<div class="lower-content">
			<div class="lower-services-container">
				<div class="lower-services-headline">All of your favorite services</div>
				<div class="lower-services-list">
					<div class="lower-services-item"><img src="app/images/general/service_icons/facebook.png" class="tipsy_hover_n" title="Facebook"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/twitter.png" class="tipsy_hover_n" title="Twitter"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/linkedin.png" class="tipsy_hover_n" title="LinkedIn"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/flickr.png" class="tipsy_hover_n" title="Flickr"></div>
					<div class="clear"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/gmail.png" class="tipsy_hover_n" title="Gmail"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/yahoo.png" class="tipsy_hover_n" title="Yahoo"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/aol.png" class="tipsy_hover_n" title="AOL"></div>
					<div class="lower-services-item"><img src="app/images/general/service_icons/dropbox.png" class="tipsy_hover_n" title="Dropbox"></div>
					<div class="clear"></div>
					<div class="lower-services-item" style="height: 40px"><img src="app/images/general/service_icons/evernote.png" class="tipsy_hover_n" title="Evernote"></div>
					<div class="lower-services-item" style="height: 40px"><img src="app/images/general/service_icons/youtube.png" class="tipsy_hover_n" title="Youtube"></div>
					<div class="lower-services-item" style="height: 40px"><img src="app/images/general/service_icons/rss.png" class="tipsy_hover_n" title="RSS Feeds"></div>
					<div class="lower-services-item" style="height: 40px"><img src="app/images/general/service_icons/weather.png" class="tipsy_hover_n" title="Weather"></div>
					<div class="clear"></div>
				</div>
				<div class="lower-services-statement-shadow"></div>
				<div class="lower-services-statement-text"><!-- View our full list of supported networks » --></div>
			</div>
			<div class="lower-testimonials-container">
				<div class="lower-testimoial-person">
					<div class="lower-testimonial-photo"><img src="app/images/general/testimonials/donb_small.png" id="testimonial-photo" style="border: 1px solid #00547B"></div>
					<div class="lower-testimonial-info" id="testimonial-person">Don Berman<br />Someplace, UT</div>
					<div class="clear"></div>
				</div>
				<div class="lower-testimonials-quote"><span id="testimonial-quote">I really think MyComingle has hit a home run for simplicity and convenience of use.</span></div>
			</div>
		</div>
	</div>
<?php
include("footer.php");
?>