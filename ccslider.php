<?php
//&& isset($CURUSER)){
if(isset($_GET['what']) && $_GET['what']==='neUw'){
	echo '<html>
	<head>
	<script type="text/javascript" src="jscript/jquery-1.11.3.min.js"></script>
	<script src="jscript/jquery.ccslider-3.0.2.min.js"></script>
	<script src="jscript/jquery.easing-1.3.min.js"></script>
	<link type="text/css" href="css/ccslider.css" rel="stylesheet"></link>
	<link type="text/css" href="css/btccslider.css" rel="stylesheet"></link>

	<style type="text/css">
	body {
		width: 100%;
		max-width: 700px;
	}

	#slider {
		width: 900px;
		height: 350px;
		margin: 10px auto 140px auto;
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.7);
	}

	#img1 p,#img2 p,#img3 p,#img4 p, #img5 p,#img6 p {
		font: 20px \'PT Sans\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;
		color: #fff;
		text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
		width: 280px;
		margin: 23% 0 1.5% 4.5%;  /* 0 0 10px 40px */
	}

	#img1 a,#img2 a,#img3 a,#img4 a, #img5 a,#img6 a {
		display: block;
		width: 120px;
		height: 30px;
		border: 1px solid #aaa;
		background-color: #444444;
		background-image: -webkit-gradient(linear, left top, left bottom, from(#444444), to(#141414)); /* Saf4+, Chrome */
		background-image: -webkit-linear-gradient(top, #646464, #141414); /* Chrome 10+, Saf5.1+, iOS 5+ */
		background-image:    -moz-linear-gradient(top, #646464, #141414); /* FF3.6 */
		background-image:     -ms-linear-gradient(top, #646464, #141414); /* IE10 */
		background-image:      -o-linear-gradient(top, #646464, #141414); /* Opera 11.10+ */
		background-image:         linear-gradient(top, #646464, #141414);
		color: #fff;
		font: 16px/30px \'Helvetica Neue\', Helvetica, Arial, sans-serif;;
		text-align: center;
		text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.7);
		margin: 2% 0 0 4.5%;  /* 20px 0 0 40px */
		cursor: pointer;
		-moz-border-radius: 20px;
		-webkit-border-radius: 20px;
		border-radius: 20px;
		-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
		-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
	}
	</style>
	</head>
	<body>

	<div id="slider">
	<img src="gallery/demo1/mos.jpg" alt="" data-htmlelem="#img1" />
	<img src="gallery/demo1/jack-the-giant-slayer.jpg" alt="" data-htmlelem="#img2"/>
	<img src="gallery/demo1/tron-legacy.jpg" alt="" data-htmlelem="#img1" />
	<img src="gallery/demo1/mos.jpg" alt="" data-htmlelem="#img1" />
	<img src="gallery/demo1/tron-legacy.jpg" alt="" data-htmlelem="#img1" />
	<img src="gallery/demo1/jack-the-giant-slayer.jpg" alt="" data-htmlelem="#img1" />
	</div>

	<div id="img1" class="cc-html"><a href="test">Name1</a><p>Content details</p></div>
	<div id="img2" class="cc-html"><a href="test">Name2</a><p>Content details</p></div>
	<div id="img3" class="cc-html"><a href="test">Name3</a><p>Content details</p></div>
	<div id="img4" class="cc-html"><a href="test">Name4</a><p>Content details</p></div>
	<div id="img5" class="cc-html"><a href="test">Name5</a><p>Content details</p></div>
	<div id="img6" class="cc-html"><a href="test">Name6</a><p>Content details</p></div>

	<script>
	var c=jQuery.noConflict();
	c(window).load(function(){
		c(\'#slider\').ccslider({effectType:\'3d\',effect:\'cubeUp\',_3dOptions:{imageWidth: 850,imageHeight: 300}});
	});
	</script>
	</body></html>';
}else{
	echo "Access restricted!";
}
?>
