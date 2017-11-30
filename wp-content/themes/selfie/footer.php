<?php

?>
	<footer>
		<div class="selfie-footer-bottom">
			<div class="homepage-container-design-inner">
        <div class="vc_col-sm-6 selfie-copyrights item_left">
					<a href="#">Politicas de privaciadad</a> / <a href="#">From ADV P2art</a>
				</div>
				<div class="vc_col-sm-5 selfie-copyrights item_right">
				<?php if(selfie_get_option_value('select_copyrights_columns') == 'On') { ?>
					<?php
						$allowed_html = array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'br' => array(),
							'strong' => array(),
						);

						$footerText = wp_kses(selfie_get_option_value('footer_text'), $allowed_html);
					?>
					<?php echo $footerText; ?>
				<?php } ?>
				</div>
				<div class="vc_col-sm-1 selfie-copyrights item_left" style="border-left: 2px solid #999;">
				<a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href="#"><i style="font-size: 22px;margin: 0px 5px;" class="fa fa-twitter" aria-hidden="true"></i></a>
				</div>

			</div>
		</div>
	</footer>

	<?php if(selfie_get_option_value('select_backtotop') == 'On') { ?>
		<a id="back-top" href="#" style="display: none;"><i class="fa fa-angle-up fa-2x"></i></a>
	<?php } ?>


	<!-- Footer End
	================================================== -->

<?php wp_footer(); ?>
</body>
<style>
.btn-login a {
    color: transparent;
}
.btn-login a:hover {
    color: transparent !important;
}
.nav {
	bottom: 12%;
	right: 35px;
	position: absolute;
	text-align: right;
}
.nav>li>a {
    position: relative;
    display: block;
    padding: 0px 15px;
}
.btn-login {
	background: url(http://localhost/alkanza/wp-content/uploads/2017/11/login.png);
	background-size: contain;
	background-repeat: no-repeat;
	height: 25px;
	background-position: 90%;
	margin-top: 25px;
}
.sidenav .closebtn {
  position: absolute;
  top: 20px;
  right: 20px;
  color: #21cfc9;
  font-size: 80px;
  margin-right: 0px;
  font-weight: 100;
	transition: 0.3s;
}
#icono {
	-webkit-transition: width 0.5s; /* Safari */
  transition: width 0.5s;
	width: 50px;
	left: -60px;
	top: 33px;
	position: relative;

}
#letra-menu {
	-webkit-transition: width 0.5s; /* Safari */
  transition: width 0.5s;
	position: fixed;
	cursor: pointer;
	font-size: 15px;
	margin-left: -67px;
	top: 10px;

}

/* Let's get this party started */
::-webkit-scrollbar {
    width: 3px;
}

/* Track */
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: rgba(56, 207, 192,0.8);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
}
::-webkit-scrollbar-thumb:window-inactive {
	background: rgba(56, 207, 192,0.4);
}
</style>
<script>
function openNav() {
		document.getElementById("letra-menu").style.fontSize = "47px";
		document.getElementById("letra-menu").style.top = "30px";
		document.getElementById("letra-menu").style.marginLeft = "-40px";
		document.getElementById("icono").style.width = "150px";
		document.getElementById("icono").style.left = "-25px";
		document.getElementById("icono").style.top = "25px";
    document.getElementById("mySidenav").style.width = "500px";
    document.getElementById("page-template").style.marginRight = "500px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.8)";
}

function closeNav() {
		document.getElementById("letra-menu").style.fontSize = "15px";
		document.getElementById("letra-menu").style.top = "20px";
		document.getElementById("letra-menu").style.marginLeft = "-67px";
		document.getElementById("icono").style.width = "50px";
		document.getElementById("icono").style.left = "-60px";
		document.getElementById("icono").style.top = "25px";
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("page-template").style.marginRight= "0";
    document.body.style.backgroundColor = "white";
}
</script>
</html>
