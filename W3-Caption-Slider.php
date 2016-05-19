<?php
/**
 * @package W3 Caption Slider
 * @version 0.01
 */
/*
Plugin Name: W3 Caption Slider
Plugin URI: http://wordpress.org/plugins/w3-caption-slider/
Description: This is w3 caption slider.
Author: Firoze
Version: 0.01
Author URI: http://firoze.uphero.com/smof/
*/

function w3_caption_slider() {
  register_post_type( 'wp_caption',
    array(
      'labels' => array(
        'name' => __( 'caption' ),
        'singular_name' => __( 'Caption' )
      ),
      'public' => true,
      'has_archive' => true,
	  'supports' => array('title','thumbnail' )
    )
  );
}

add_action( 'init', 'w3_caption_slider' );


add_theme_support( 'post-thumbnails',array('wp_caption') );
add_image_size( 'w3_gallary_crop', 643, 225, true );














function style_script(){
	?>
	<style type="text/css">
/* Slideshow container */
.slideshow-container {
  max-width: 100%;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 0;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: #4B8CF5;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor:pointer;
  height: 13px;
  width: 13px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}
</style>


<script type="text/javascript">
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length} ;
  for (i = 0; i < slides.length; i++) {
      slides[i].style.cssText = "display:none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.cssText = "display:block"; 
  dots[slideIndex-1].className += " active";
}
</script>
	<?php
}

add_action('wp_footer','style_script');




function wp_caption_Sliders($atts , $content = null){
	?>
	<div class="slideshow-container">

	<?php
	$loop = 0;
	global $post;
    $args = array( 'posts_per_page' =>-1, 'post_type'=> 'wp_caption','order'=>'ASC');
	$myposts = get_posts( $args );
	foreach( $myposts as $post ) : setup_postdata($post); 
	
	?>
	<?php
	$loop++;
	$gallary_thum = wp_get_attachment_image_src( get_post_thumbnail_id( $post_ID), 'w3_gallary_crop');
	?>
	  <div class="mySlides fade">
		<div class="numbertext"><?php echo $loop;?> / <?php echo count($myposts);?>
		</div>
		<img class="gallar_Image" src="<?php echo $gallary_thum[0];?>">
		<div class="text">
			<?php the_title();?>
		</div>
	  </div>	
	<?php endforeach;?>


  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div style="text-align:center">
	<?php
	$loops = range(1,count($myposts));
	foreach($loops as $loop){
		echo '<span class="dot" onclick="currentSlide('.$loop.')"></span>';
	}
	?>
</div>
	<?php
	
	
	return;
}
add_shortcode('wp-caption-slider','wp_caption_Sliders');










