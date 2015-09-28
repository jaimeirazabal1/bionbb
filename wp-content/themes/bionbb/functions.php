<?php
/**
 * BionBB functions and definitions
 *
 * @package BionBB
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bionbb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bionbb_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on BionBB, use a find and replace
	 * to change 'bionbb' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bionbb', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bionbb' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bionbb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // bionbb_setup
add_action( 'after_setup_theme', 'bionbb_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bionbb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bionbb' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bionbb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bionbb_scripts() {
	wp_enqueue_style( 'bionbb-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bionbb-animate', get_template_directory_uri() . '/animate.css' );
	wp_enqueue_style( 'bionbb-hoverpack', get_template_directory_uri() . '/hover_pack.css' );
	wp_enqueue_style( 'bionbb-hoveracerca', get_template_directory_uri() . '/hover-Acerca.css' );
	wp_enqueue_style( 'bionbb-mediaqueries', get_template_directory_uri() . '/mediaqueries.css' );
	wp_enqueue_script( 'bionbb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'bionbb-graphics', get_template_directory_uri() . '/js/canvasjs.min.js', array(), '20120207', true );

	wp_enqueue_script( 'bionbb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bionbb_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Enqueue fonts.
 */
function load_fonts() {
        wp_register_style('google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic');
        wp_enqueue_style( 'google-fonts');
        }
add_action('wp_print_styles', 'load_fonts');

/**
 * Largo del excerpt personalizado
 */
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}

function link_excerpt() {
       global $post;
	return '... <a href="'. get_permalink($post->ID) . '">Sigue leyendo aquí</a>';
}
add_filter('excerpt_more', 'link_excerpt');

add_shortcode('shortcode_resultado_hijos','shortcode_resultado_hijos_function');



function shortcode_resultado_hijos_function(){
   $template = get_template_directory_uri();
 	?>
		<?php if (isset($_POST['hijo'])): ?>
			<?php $hijo = $_POST['hijo'] ?>
			<table style="margin-left:50px">
				<tr>
					<td><label>Sexo:</label></td>
					<td><?php if($hijo['sexo'] == 'f') : echo "Femenino"; else: echo 'Masculino'; endif; ?></td>
				</tr>
				<tr>
					<td><label>Edad:</label></td>
					<td><?php echo $hijo['edad'] ?> meses</td>
				</tr>
				<tr>
					<td><label>Peso:</label></td>
					<td><?php echo $hijo['peso'] ?> kilos</td>
				</tr>
				<tr>
					<td><label>Estatura:</label></td>
					<td><?php echo $hijo['estatura'] ?> cm</td>
				</tr>
			</table>
			<br>
<script type="text/javascript">
window.onload = function () {
	

	<?php if ($hijo['sexo'] == 'f' and $hijo['edad'] > 0 and $hijo['edad'] <= 24): ?>
	<?php $grafico[] =  '{ "clarito" : [{ "x": 0, "y": [2.4, 4.2] }, { "x": 3, "y": [4.4, 7.4] }, { "x": 6, "y": [5.6, 9.4] }, { "x": 9, "y": [6.4, 10.6] }, { "x": 12, "y": [7, 11.4] }, { "x": 15, "y": [7.6, 12.4] }, { "x": 18, "y": [8, 13.2] }, { "x": 21, "y": [8.6, 14] }, { "x": 24, "y": [9, 14.8] } ], "oscuro": [{ "x": 0, "y": [2.8, 3.8] }, { "x": 3, "y": [5.2, 6.6] }, { "x": 6, "y": [6.4, 8.2] }, { "x": 9, "y": [7.2, 9.2] }, { "x": 12, "y": [7.8, 10.2] }, { "x": 15, "y": [8.6, 10.8] }, { "x": 18, "y": [9, 11.6] }, { "x": 21, "y": [9.6, 12.6] }, { "x": 24, "y": [10.2, 13] } ] }'; ?>
	var chart = new CanvasJS.Chart("chartContainerPeso",
	{
		title: {
			text: "Peso por edad NIÑAS de 0 a 24 meses. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 1,
			minimum: 0,
			title:'Edad',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 2,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 0, y: [2.4, 4.2] },
				{ x: 3, y: [4.4, 7.4] },
				{ x: 6, y: [5.6, 9.4] },
				{ x: 9, y: [6.4, 10.6] },
				{ x: 12, y: [7, 11.4] },
				{ x: 15, y: [7.6, 12.4] },
				{ x: 18, y: [8, 13.2] },
				{ x: 21, y: [8.6, 14] },
				{ x: 24, y: [9, 14.8] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [2.8, 3.8] },
				{ x: 3, y: [5.2, 6.6] },
				{ x: 6, y: [6.4, 8.2] },
				{ x: 9, y: [7.2, 9.2] },
				{ x: 12, y: [7.8, 10.2] },
				{ x: 15, y: [8.6, 10.8] },
				{ x: 18, y: [9, 11.6] },
				{ x: 21, y: [9.6, 12.6] },
				{ x: 24, y: [10.2, 13] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [3.2, 3.2] },
				{ x: 3, y: [5.8, 5.8] },
				{ x: 6, y: [7.2, 7.2] },
				{ x: 9, y: [8.2, 8.2] },
				{ x: 12, y: [8.8, 8.8] },
				{ x: 15, y: [9.6, 9.6] },
				{ x: 18, y: [10.2, 10.2] },
				{ x: 21, y: [10.8, 10.8] },
				{ x: 24, y: [11.4, 11.4] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>
		
		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};

	<?php $grafico[] = '{ "clarito": [{ "x": 0, "y": [45, 53] }, { "x": 3, "y": [56, 64] }, { "x": 6, "y": [61, 70] }, { "x": 9, "y": [65, 75] }, { "x": 12, "y": [69, 79] }, { "x": 15, "y": [72, 83] }, { "x": 18, "y": [75, 87] }, { "x": 21, "y": [77, 90] }, { "x": 24, "y": [80, 93] } ], "oscuro" : [{ "x": 0, "y": [47, 51] }, { "x": 3, "y": [57.5, 62] }, { "x": 6, "y": [63, 68] }, { "x": 9, "y": [68, 73] }, { "x": 12, "y": [71, 77] }, { "x": 15, "y": [75, 80] }, { "x": 18, "y": [78, 84] }, { "x": 21, "y": [81, 87] }, { "x": 24, "y": [83, 90] } ] }'; ?>
		var chart = new CanvasJS.Chart("chartContainerLongitud",
	{
		title: {
			text: "Longitud por edad NIÑAS de 0 a 24 meses. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 1,
			tickLength: 10,
			minimum: 0,
			title:'Edad',
			labelFontSize:8
		},
		axisY: {
			interval: 5,
			minimum: 45,
			title:'Longitud (cm)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 0, y: [45, 53] },
				{ x: 3, y: [56, 64] },
				{ x: 6, y: [61, 70] },
				{ x: 9, y: [65, 75] },
				{ x: 12, y: [69, 79] },
				{ x: 15, y: [72, 83] },
				{ x: 18, y: [75, 87] },
				{ x: 21, y: [77, 90] },
				{ x: 24, y: [80, 93] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [47, 51] },
				{ x: 3, y: [57.5, 62] },
				{ x: 6, y: [63, 68] },
				{ x: 9, y: [68, 73] },
				{ x: 12, y: [71, 77] },
				{ x: 15, y: [75, 80] },
				{ x: 18, y: [78, 84] },
				{ x: 21, y: [81, 87] },
				{ x: 24, y: [83, 90] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [49, 49] },
				{ x: 3, y: [60, 60] },
				{ x: 6, y: [66, 66] },
				{ x: 9, y: [70, 70] },
				{ x: 12, y: [74, 74] },
				{ x: 15, y: [77, 77] },
				{ x: 18, y: [81, 81] },
				{ x: 21, y: [84, 84] },
				{ x: 24, y: [86, 86] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['estatura'] ?>, <?php echo $hijo['estatura'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart={};
	// if para mostrar script
	<?php endif; ?>
	<?php if ($hijo['sexo'] == 'f' and $hijo['edad'] > 24 and $hijo['edad'] <= 72): ?>
	<?php $grafico[] = '{"clarito" :[{ "x": 24, "y": [9, 14.8] }, { "x": 30, "y": [10, 16.5] }, { "x": 36, "y": [10.8, 18.2] }, { "x": 42, "y": [11.6, 19.8] }, { "x": 48, "y": [12.3, 21.5] }, { "x": 54, "y": [13, 23.2] }, { "x": 60, "y": [13.6, 25] }, { "x": 61, "y": [13.8, 23] }, { "x": 66, "y": [14.4, 24.6] }, { "x": 72, "y": [15, 26.2] } ], "oscuro" : [{ "x": 24, "y": [10.2, 13] }, { "x": 30, "y": [11.2, 14.4] }, { "x": 36, "y": [12.2, 15.8] }, { "x": 42, "y": [13.2, 17.2] }, { "x": 48, "y": [14, 18.5] }, { "x": 54, "y": [14.9, 19.9] }, { "x": 60, "y": [15.8, 21.2] }, { "x": 61, "y": [15.7, 20.4] }, { "x": 66, "y": [16.5, 21.6] }, { "x": 72, "y": [17.2, 23] } ]}'; ?>
	var chart = new CanvasJS.Chart("chartContainerPeso2a6",
	{
		title: {
			text: "Peso por edad NIÑAS 2 a 6 años. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 6,
			tickLength: 10,
			minimum: 24,
			title:'Edad (Meses y años cumplidos)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 7,
			tickLength: 10,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 24, y: [9, 14.8] },
				{ x: 30, y: [10, 16.5] },
				{ x: 36, y: [10.8, 18.2] },
				{ x: 42, y: [11.6, 19.8] },
				{ x: 48, y: [12.3, 21.5] },
				{ x: 54, y: [13, 23.2] },
				{ x: 60, y: [13.6, 25] },
				{ x: 61, y: [13.8, 23] },
				{ x: 66, y: [14.4, 24.6] },
				{ x: 72, y: [15, 26.2] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [10.2, 13] },
				{ x: 30, y: [11.2, 14.4] },
				{ x: 36, y: [12.2, 15.8] },
				{ x: 42, y: [13.2, 17.2] },
				{ x: 48, y: [14, 18.5] },
				{ x: 54, y: [14.9, 19.9] },
				{ x: 60, y: [15.8, 21.2] },
				{ x: 61, y: [15.7, 20.4] },
				{ x: 66, y: [16.5, 21.6] },
				{ x: 72, y: [17.2, 23] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [11.5, 11.5] },
				{ x: 30, y: [12.6, 12.6] },
				{ x: 36, y: [13.9, 13.9] },
				{ x: 42, y: [15, 15] },
				{ x: 48, y: [16, 16] },
				{ x: 54, y: [17.1, 17.1] },
				{ x: 60, y: [18.1, 18.1] },
				{ x: 61, y: [17.6, 17.6] },
				{ x: 66, y: [18.6, 18.6] },
				{ x: 72, y: [19.4, 19.4] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
	<?php $grafico[] = '{"clarito" : [{ "x": 24, "y": [79, 92] }, { "x": 30, "y": [84.5, 98] }, { "x": 36, "y": [87.5, 102.5] }, { "x": 42, "y": [91, 107] }, { "x": 48, "y": [94, 111.5] }, { "x": 54, "y": [97, 115] }, { "x": 60, "y": [100, 119] }, { "x": 61, "y": [99.5, 117] }, { "x": 66, "y": [102, 121] }, { "x": 72, "y": [105, 125] } ], "oscuro":[{ "x": 24, "y": [82.5, 89] }, { "x": 30, "y": [87, 94] }, { "x": 36, "y": [91, 99] }, { "x": 42, "y": [95, 103] }, { "x": 48, "y": [98.5, 107] }, { "x": 54, "y": [101.5, 111] }, { "x": 60, "y": [105, 114] }, { "x": 61, "y": [104, 113] }, { "x": 66, "y": [107, 116] }, { "x": 72, "y": [110, 119.5] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerLongitud2a6",
	{
		title: {
			text: "Estatura por edad NIÑAS 2 a 6 años. (mediana y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 6,
			tickLength: 10,
			minimum: 24,
			labelFontSize:8,
			title:'Edad (Meses y años cumplidos)'
		},
		axisY: {
			interval: 5,
			minimum: 75,
			tickLength: 10,
			labelFontSize:8,
			title:'Estatura (cm)'
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 24, y: [79, 92] },
				{ x: 30, y: [84.5, 98] },
				{ x: 36, y: [87.5, 102.5] },
				{ x: 42, y: [91, 107] },
				{ x: 48, y: [94, 111.5] },
				{ x: 54, y: [97, 115] },
				{ x: 60, y: [100, 119] },
				{ x: 61, y: [99.5, 117] },
				{ x: 66, y: [102, 121] },
				{ x: 72, y: [105, 125] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [82.5, 89] },
				{ x: 30, y: [87, 94] },
				{ x: 36, y: [91, 99] },
				{ x: 42, y: [95, 103] },
				{ x: 48, y: [98.5, 107] },
				{ x: 54, y: [101.5, 111] },
				{ x: 60, y: [105, 114] },
				{ x: 61, y: [104, 113] },
				{ x: 66, y: [107, 116] },
				{ x: 72, y: [110, 119.5] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [86, 86] },
				{ x: 30, y: [90.5, 90.5] },
				{ x: 36, y: [95, 95] },
				{ x: 42, y: [99, 99] },
				{ x: 48, y: [103, 103] },
				{ x: 54, y: [106, 106] },
				{ x: 60, y: [109.5, 109.5] },
				{ x: 61, y: [108.5, 108.5] },
				{ x: 66, y: [111.5, 111.5] },
				{ x: 72, y: [115, 115] }
			]
		}
		<?php if (isset($hijo['estatura']) and !empty($hijo['estatura']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['estatura'] ?>, <?php echo $hijo['estatura'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};

		// if para mostrar script
	<?php endif; ?>

	<?php if ($hijo['sexo'] == 'm' and $hijo['edad'] > 0 and $hijo['edad'] <= 24): ?>
	<?php $grafico[] = '{"clarito" : [{ "x": 0, "y": [2.4, 4.2] }, { "x": 3, "y": [5, 8] }, { "x": 6, "y": [6.4, 9.8] }, { "x": 9, "y": [7.2, 11] }, { "x": 12, "y": [7.7, 12] }, { "x": 15, "y": [8.2, 12.8] }, { "x": 18, "y": [8.8, 13.6] }, { "x": 21, "y": [9.2, 14.5] }, { "x": 24, "y": [9.7, 15.3] } ], "oscuro": [{ "x": 0, "y": [3, 4] }, { "x": 3, "y": [5.7, 7.2] }, { "x": 6, "y": [7.2, 8.8] }, { "x": 9, "y": [8, 9.9] }, { "x": 12, "y": [8.6, 10.8] }, { "x": 15, "y": [9.2, 11.6] }, { "x": 18, "y": [9.8, 12.2] }, { "x": 21, "y": [10.4, 12.9] }, { "x": 24, "y": [10.8, 13.6] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerPesoNino",
	{
		title: {
			text: "Peso por edad NIÑOS de 0 a 24 meses. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 1,
			minimum: 0,
			title:'Edad',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 2,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 0, y: [2.4, 4.2] },
				{ x: 3, y: [5, 8] },
				{ x: 6, y: [6.4, 9.8] },
				{ x: 9, y: [7.2, 11] },
				{ x: 12, y: [7.7, 12] },
				{ x: 15, y: [8.2, 12.8] },
				{ x: 18, y: [8.8, 13.6] },
				{ x: 21, y: [9.2, 14.5] },
				{ x: 24, y: [9.7, 15.3] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [3, 4] },
				{ x: 3, y: [5.7, 7.2] },
				{ x: 6, y: [7.2, 8.8] },
				{ x: 9, y: [8, 9.9] },
				{ x: 12, y: [8.6, 10.8] },
				{ x: 15, y: [9.2, 11.6] },
				{ x: 18, y: [9.8, 12.2] },
				{ x: 21, y: [10.4, 12.9] },
				{ x: 24, y: [10.8, 13.6] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [3.2, 3.2] },
				{ x: 3, y: [6.3, 6.3] },
				{ x: 6, y: [7.8, 7.8] },
				{ x: 9, y: [8.9, 8.9] },
				{ x: 12, y: [9.6, 9.6] },
				{ x: 15, y: [10.3, 10.3] },
				{ x: 18, y: [10.9, 10.9] },
				{ x: 21, y: [11.5, 11.5] },
				{ x: 24, y: [12.2, 12.2] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
	<?php $grafico[]='{"clarito":[{ "x": 0, "y": [46, 54] }, { "x": 3, "y": [57, 65.5] }, { "x": 6, "y": [63, 72] }, { "x": 9, "y": [67.5, 76.5] }, { "x": 12, "y": [71, 80.5] }, { "x": 15, "y": [74, 84] }, { "x": 18, "y": [77, 88] }, { "x": 21, "y": [79.5, 91] }, { "x": 24, "y": [81.5, 94] } ], "oscuro":[{ "x": 0, "y": [48, 52] }, { "x": 3, "y": [59, 63.5] }, { "x": 6, "y": [65.5, 70] }, { "x": 9, "y": [69.5, 74] }, { "x": 12, "y": [73, 78] }, { "x": 15, "y": [76.5, 82] }, { "x": 18, "y": [79.5, 85] }, { "x": 21, "y": [82.5, 88] }, { "x": 24, "y": [85, 91] } ]}' ?>
			var chart = new CanvasJS.Chart("chartContainerLongitudNino",
	{
		title: {
			text: "Longitud por edad NIÑOS de 0 a 24 meses. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 1,
			tickLength: 10,
			minimum: 0,
			title:'Edad',
			labelFontSize:8
		},
		axisY: {
			interval: 5,
			minimum: 45,
			title:'Longitud (cm)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 0, y: [46, 54] },
				{ x: 3, y: [57, 65.5] },
				{ x: 6, y: [63, 72] },
				{ x: 9, y: [67.5, 76.5] },
				{ x: 12, y: [71, 80.5] },
				{ x: 15, y: [74, 84] },
				{ x: 18, y: [77, 88] },
				{ x: 21, y: [79.5, 91] },
				{ x: 24, y: [81.5, 94] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [48, 52] },
				{ x: 3, y: [59, 63.5] },
				{ x: 6, y: [65.5, 70] },
				{ x: 9, y: [69.5, 74] },
				{ x: 12, y: [73, 78] },
				{ x: 15, y: [76.5, 82] },
				{ x: 18, y: [79.5, 85] },
				{ x: 21, y: [82.5, 88] },
				{ x: 24, y: [85, 91] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 0, y: [50, 50] },
				{ x: 3, y: [61, 61] },
				{ x: 6, y: [67.5, 67.5] },
				{ x: 9, y: [72, 72] },
				{ x: 12, y: [75.5, 75.5] },
				{ x: 15, y: [79, 79] },
				{ x: 18, y: [82, 82] },
				{ x: 21, y: [85, 85] },
				{ x: 24, y: [88, 88] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['estatura'] ?>, <?php echo $hijo['estatura'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart={};
	// termino de if para mostrar script
	<?php endif; ?>
	<?php if ($hijo['sexo'] == 'm' and $hijo['edad'] > 24 and $hijo['edad'] <= 72): ?>
	<?php $grafico[]='{"clarito":[{ "x": 24, "y": [9.7, 15.4] }, { "x": 30, "y": [10.5, 16.8] }, { "x": 36, "y": [11.3, 18.3] }, { "x": 42, "y": [12, 19.7] }, { "x": 48, "y": [12.7, 21.2] }, { "x": 54, "y": [13.4, 22.6] }, { "x": 60, "y": [14.1, 24.2] }, { "x": 61, "y": [14.4, 23.5] }, { "x": 66, "y": [15.2, 25] }, { "x": 72, "y": [16, 26.6] } ],"oscuro":[{ "x": 24, "y": [10.8, 13.6] }, { "x": 30, "y": [11.8, 15] }, { "x": 36, "y": [12.7, 16.2] }, { "x": 42, "y": [13.5, 17.4] }, { "x": 48, "y": [14.4, 18.6] }, { "x": 54, "y": [15.2, 19.8] }, { "x": 60, "y": [16, 21] }, { "x": 61, "y": [16.6, 21.2] }, { "x": 66, "y": [17.4, 22.4] }, { "x": 72, "y": [18.4, 23.6] } ]}' ?>
		var chart = new CanvasJS.Chart("chartContainerPeso2a6Nino",
	{
		title: {
			text: "Peso por edad NIÑOS 2 a 6 años. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 6,
			tickLength: 10,
			minimum: 24,
			title:'Edad (Meses y años cumplidos)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 9,
			tickLengt: 10,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 24, y: [9.7, 15.4] },
				{ x: 30, y: [10.5, 16.8] },
				{ x: 36, y: [11.3, 18.3] },
				{ x: 42, y: [12, 19.7] },
				{ x: 48, y: [12.7, 21.2] },
				{ x: 54, y: [13.4, 22.6] },
				{ x: 60, y: [14.1, 24.2] },
				{ x: 61, y: [14.4, 23.5] },
				{ x: 66, y: [15.2, 25] },
				{ x: 72, y: [16, 26.6] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [10.8, 13.6] },
				{ x: 30, y: [11.8, 15] },
				{ x: 36, y: [12.7, 16.2] },
				{ x: 42, y: [13.5, 17.4] },
				{ x: 48, y: [14.4, 18.6] },
				{ x: 54, y: [15.2, 19.8] },
				{ x: 60, y: [16, 21] },
				{ x: 61, y: [16.6, 21.2] },
				{ x: 66, y: [17.4, 22.4] },
				{ x: 72, y: [18.4, 23.6] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [12.2, 12.2] },
				{ x: 30, y: [13.2, 13.2] },
				{ x: 36, y: [14.3, 14.3] },
				{ x: 42, y: [15.3, 15.3] },
				{ x: 48, y: [16.3, 16.3] },
				{ x: 54, y: [17.3, 17.3] },
				{ x: 60, y: [18.2, 18.2] },
				{ x: 61, y: [18.7, 18.7] },
				{ x: 66, y: [19.7, 19.7] },
				{ x: 72, y: [20.7, 20.7] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};

	<?php $grafico[]='{"clarito":[{ "x": 24, "y": [82, 93] }, { "x": 30, "y": [85, 98.5] }, { "x": 36, "y": [88.5, 103.5] }, { "x": 42, "y": [92, 108] }, { "x": 48, "y": [95, 112] }, { "x": 54, "y": [98, 115.5] }, { "x": 60, "y": [101, 119] }, { "x": 61, "y": [101, 119] }, { "x": 66, "y": [103.5, 122.5] }, { "x": 72, "y": [106, 126] } ],"oscuro":[{ "x": 24, "y": [84, 90] }, { "x": 30, "y": [88.5, 95.5] }, { "x": 36, "y": [92.5, 100] }, { "x": 42, "y": [96, 104] }, { "x": 48, "y": [99, 107.5] }, { "x": 54, "y": [102.5, 111] }, { "x": 60, "y": [105, 114.5] }, { "x": 61, "y": [105, 114.5] }, { "x": 66, "y": [108, 118] }, { "x": 72, "y": [111, 121] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerLongitud2a6Nino",
	{
		title: {
			text: "Estatura por edad NIÑOS 2 a 6 años. (mediana y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 6,
			tickLength: 10,
			minimum: 24,
			labelFontSize:8,
			title:'Edad (Meses y años cumplidos)'
		},
		axisY: {
			interval: 5,
			minimum: 80,
			tickLength: 10,
			labelFontSize:8,
			title:'Estatura (cm)'
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 24, y: [82, 93] },
				{ x: 30, y: [85, 98.5] },
				{ x: 36, y: [88.5, 103.5] },
				{ x: 42, y: [92, 108] },
				{ x: 48, y: [95, 112] },
				{ x: 54, y: [98, 115.5] },
				{ x: 60, y: [101, 119] },
				{ x: 61, y: [101, 119] },
				{ x: 66, y: [103.5, 122.5] },
				{ x: 72, y: [106, 126] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [84, 90] },
				{ x: 30, y: [88.5, 95.5] },
				{ x: 36, y: [92.5, 100] },
				{ x: 42, y: [96, 104] },
				{ x: 48, y: [99, 107.5] },
				{ x: 54, y: [102.5, 111] },
				{ x: 60, y: [105, 114.5] },
				{ x: 61, y: [105, 114.5] },
				{ x: 66, y: [108, 118] },
				{ x: 72, y: [111, 121] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 24, y: [87, 87] },
				{ x: 30, y: [92, 92] },
				{ x: 36, y: [96, 96] },
				{ x: 42, y: [100, 100] },
				{ x: 48, y: [103, 103] },
				{ x: 54, y: [107, 107] },
				{ x: 60, y: [110, 110] },
				{ x: 61, y: [110, 110] },
				{ x: 66, y: [113, 113] },
				{ x: 72, y: [116, 116] }
			]
		}
		<?php if (isset($hijo['estatura']) and !empty($hijo['estatura']) and isset($hijo['edad']) and !empty($hijo['edad']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['edad'] ?>, y: [<?php echo $hijo['estatura'] ?>, <?php echo $hijo['estatura'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
		// termino de if para mostrar script
	<?php endif; ?>
<?php if ($hijo['sexo'] == 'f' and $hijo['estatura'] >= 50 and $hijo['estatura'] <= 75): ?>
<?php $grafico[]='{"clarito":[{ "x": 50, "y": [2.8, 4] }, { "x": 55, "y": [3.8, 5.5] }, { "x": 60, "y": [4.9, 7.1] }, { "x": 65, "y": [5.9, 8.6] }, { "x": 70, "y": [6.9, 9.8] }, { "x": 75, "y": [7.7, 11] } ],"oscuro":[{ "x": 50, "y": [3.1, 3.7] }, { "x": 55, "y": [4.2, 5] }, { "x": 60, "y": [5.4, 6.4] }, { "x": 65, "y": [6.5, 7.8] }, { "x": 70, "y": [7.6 , 9] }, { "x": 75, "y": [8.4, 10] } ]}' ?>
		var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud",
	{
		title: {
			text: "Peso por longitud NIÑAS de 50 a 75 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 50,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 2,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 50, y: [2.8, 4] },
				{ x: 55, y: [3.8, 5.5] },
				{ x: 60, y: [4.9, 7.1] },
				{ x: 65, y: [5.9, 8.6] },
				{ x: 70, y: [6.9, 9.8] },
				{ x: 75, y: [7.7, 11] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 50, y: [3.1, 3.7] },
				{ x: 55, y: [4.2, 5] },
				{ x: 60, y: [5.4, 6.4] },
				{ x: 65, y: [6.5, 7.8] },
				{ x: 70, y: [7.6 , 9] },
				{ x: 75, y: [8.4, 10] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 50, y: [3.4, 3.4] },
				{ x: 55, y: [4.5, 4.5] },
				{ x: 60, y: [5.9, 5.9] },
				{ x: 65, y: [7.1, 7.1] },
				{ x: 70, y: [8.2, 8.2] },
				{ x: 75, y: [9.1, 9.1] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
<?php endif; ?>
<?php if ($hijo['sexo'] == 'f' and $hijo['estatura'] > 75 and $hijo['estatura'] <= 100): ?>
<?php $grafico[]='{"clarito":[{ "x": 75, "y": [7.7,11] }, { "x": 80, "y": [8.5, 12.1] }, { "x": 85, "y": [9.4, 13.5] }, { "x": 90, "y": [10.5, 15] }, { "x": 95, "y": [11.5, 16.5] }, { "x": 100, "y": [12.6, 18.1] } ],"oscuro":[{ "x": 75, "y": [8.4, 10] }, { "x": 80, "y": [9.2, 11] }, { "x": 85, "y": [10.3, 12.3] }, { "x": 90, "y": [11.4, 13.4] }, { "x": 95, "y": [12.3, 15] }, { "x": 100, "y": [13.7, 16.5] } ]}' ?>
			var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud75a100",
	{
		title: {
			text: "Peso por longitud NIÑAS de 75 a 100 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 75,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 7,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 75, y: [7.7,11] },
				{ x: 80, y: [8.5, 12.1] },
				{ x: 85, y: [9.4, 13.5] },
				{ x: 90, y: [10.5, 15] },
				{ x: 95, y: [11.5, 16.5] },
				{ x: 100, y: [12.6, 18.1] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 75, y: [8.4, 10] },
				{ x: 80, y: [9.2, 11] },
				{ x: 85, y: [10.3, 12.3] },
				{ x: 90, y: [11.4, 13.4] },
				{ x: 95, y: [12.3, 15] },
				{ x: 100, y: [13.7, 16.5] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 75, y: [9.1, 9.1] },
				{ x: 80, y: [10.1, 10.1] },
				{ x: 85, y: [11.2, 11.2] },
				{ x: 90, y: [12.5, 12.5] },
				{ x: 95, y: [13.7, 13.7] },
				{ x: 100, y: [15, 15] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};

	<?php endif; ?>
<?php if ($hijo['sexo'] == 'f' and $hijo['edad'] > 85 and $hijo['edad'] <= 130): ?>
<?php $grafico[]='{"clarito":[{ "x": 85, "y": [9.6,13.7] }, { "x": 90, "y": [10.6, 15.2] }, { "x": 95, "y": [11.7, 16.8] }, { "x": 100, "y": [12.8, 18.4] }, { "x": 105, "y": [14, 20.4] }, { "x": 110, "y": [15.5, 22.5] }, { "x": 115, "y": [17.2, 25.2] }, { "x": 120, "y": [19, 28] }, { "x": 121, "y": [18.1, 27] }, { "x": 125, "y": [19.8, 30.6] }, { "x": 130, "y": [21.9, 35] } ],"oscuro":[{ "x": 85, "y": [10.4,12.6] }, { "x": 90, "y": [11.6, 13.8] }, { "x": 95, "y": [12.7, 15.2] }, { "x": 100, "y": [14, 16.7] }, { "x": 105, "y": [15.2, 18.4] }, { "x": 110, "y": [17, 20.5] }, { "x": 115, "y": [18.8, 22.8] }, { "x": 120, "y": [20.6, 25.2] }, { "x": 121, "y": [19.9, 24.4] }, { "x": 125, "y": [22, 27.4] }, { "x": 130, "y": [24.2, 31] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud85a130",
	{
		title: {
			text: "Peso por estatura NIÑAS de 85 a 130 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 85,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 2,
			minimum: 8,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#B36491",
			dataPoints: [
				{ x: 85, y: [9.6,13.7] },
				{ x: 90, y: [10.6, 15.2] },
				{ x: 95, y: [11.7, 16.8] },
				{ x: 100, y: [12.8, 18.4] },
				{ x: 105, y: [14, 20.4] },
				{ x: 110, y: [15.5, 22.5] },
				{ x: 115, y: [17.2, 25.2] },
				{ x: 120, y: [19, 28] },
				{ x: 121, y: [18.1, 27] },
				{ x: 125, y: [19.8, 30.6] },
				{ x: 130, y: [21.9, 35] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#6DCFF6",
			fillOpacity: .3,
			dataPoints: [
				{ x: 85, y: [10.4,12.6] },
				{ x: 90, y: [11.6, 13.8] },
				{ x: 95, y: [12.7, 15.2] },
				{ x: 100, y: [14, 16.7] },
				{ x: 105, y: [15.2, 18.4] },
				{ x: 110, y: [17, 20.5] },
				{ x: 115, y: [18.8, 22.8] },
				{ x: 120, y: [20.6, 25.2] },
				{ x: 121, y: [19.9, 24.4] },
				{ x: 125, y: [22, 27.4] },
				{ x: 130, y: [24.2, 31] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#818181",
			fillOpacity: .3,
			dataPoints: [
				{ x: 85, y: [11.4,11.4] },
				{ x: 90, y: [12.7, 12.7] },
				{ x: 95, y: [13.8, 13.8] },
				{ x: 100, y: [15.2, 15.2] },
				{ x: 105, y: [16.8, 16.8] },
				{ x: 110, y: [18.6, 18.6] },
				{ x: 115, y: [20.6, 20.6] },
				{ x: 120, y: [22.8, 22.8] },
				{ x: 121, y: [21.8, 21.8] },
				{ x: 125, y: [24, 24] },
				{ x: 130, y: [26.8, 26.8] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
<?php endif; ?>
<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] >= 50 and $hijo['estatura'] <= 75): ?>
<?php $grafico[]='{"clarito":[{ "x": 50, "y": [2.8, 4] }, { "x": 55, "y": [3.8, 5.4] }, { "x": 60, "y": [5.1, 7.1] }, { "x": 65, "y": [6.2, 8.6] }, { "x": 70, "y": [7.2, 10] }, { "x": 75, "y": [8.1, 11.3] } ],"oscuro":[{ "x": 50, "y": [3, 3.8] }, { "x": 55, "y": [4.2, 5] }, { "x": 60, "y": [5.5, 6.5] }, { "x": 65, "y": [6.7, 7.9] }, { "x": 70, "y": [7.9 , 9.2] }, { "x": 75, "y": [8.8, 10.3] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud50a75Nino",
	{
		title: {
			text: "Peso por longitud NIÑOS de 50 a 75 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 50,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 2,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 50, y: [2.8, 4] },
				{ x: 55, y: [3.8, 5.4] },
				{ x: 60, y: [5.1, 7.1] },
				{ x: 65, y: [6.2, 8.6] },
				{ x: 70, y: [7.2, 10] },
				{ x: 75, y: [8.1, 11.3] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 50, y: [3, 3.8] },
				{ x: 55, y: [4.2, 5] },
				{ x: 60, y: [5.5, 6.5] },
				{ x: 65, y: [6.7, 7.9] },
				{ x: 70, y: [7.9 , 9.2] },
				{ x: 75, y: [8.8, 10.3] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 50, y: [3.3, 3.3] },
				{ x: 55, y: [4.5, 4.5] },
				{ x: 60, y: [6, 6] },
				{ x: 65, y: [7.2, 7.2] },
				{ x: 70, y: [8.4, 8.4] },
				{ x: 75, y: [9.5, 9.5] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
<?php endif; ?>
<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] > 75 and $hijo['estatura'] <= 100): ?>
<?php $grafico[]='{"clarito":[{ "x": 75, "y": [8.1,11.3] }, { "x": 80, "y": [8.9, 12.4] }, { "x": 85, "y": [9.8, 13.6] }, { "x": 90, "y": [10.9, 15] }, { "x": 95, "y": [11.9, 16.4] }, { "x": 100, "y": [12.6, 18] } ],"oscuro":[{ "x": 75, "y": [8.8, 10.3] }, { "x": 80, "y": [9.6, 11.4] }, { "x": 85, "y": [10.6, 12.5] }, { "x": 90, "y": [11.8, 13.8] }, { "x": 95, "y": [12.8, 15.1] }, { "x": 100, "y": [14, 16.5] } ]}' ?>
	var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud75a100Nino",
	{
		title: {
			text: "Peso por longitud NIÑOS de 75 a 100 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 75,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 1,
			minimum: 8,
			title:'Longitud (cms)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 75, y: [8.1,11.3] },
				{ x: 80, y: [8.9, 12.4] },
				{ x: 85, y: [9.8, 13.6] },
				{ x: 90, y: [10.9, 15] },
				{ x: 95, y: [11.9, 16.4] },
				{ x: 100, y: [12.6, 18] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 75, y: [8.8, 10.3] },
				{ x: 80, y: [9.6, 11.4] },
				{ x: 85, y: [10.6, 12.5] },
				{ x: 90, y: [11.8, 13.8] },
				{ x: 95, y: [12.8, 15.1] },
				{ x: 100, y: [14, 16.5] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 75, y: [9.5, 9.5] },
				{ x: 80, y: [10.4, 10.4] },
				{ x: 85, y: [11.5, 11.5] },
				{ x: 90, y: [12.7, 12.7] },
				{ x: 95, y: [13.9, 13.9] },
				{ x: 100, y: [15.2, 15.2] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
<?php endif; ?>
<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] > 85 and $hijo['estatura'] <= 130): ?>
<?php $grafico[]='{"clarito":[{ "x": 85, "y": [10,13.8] }, { "x": 90, "y": [11, 15.2] }, { "x": 95, "y": [12, 16.6] }, { "x": 100, "y": [13.2, 18.2] }, { "x": 105, "y": [14.3, 20.2] }, { "x": 110, "y": [15.7, 22.2] }, { "x": 115, "y": [17.2, 24.7] }, { "x": 120, "y": [18.6, 27.2] }, { "x": 121, "y": [18.6, 26.9] }, { "x": 125, "y": [20.2, 30.1] }, { "x": 130, "y": [22.2, 34] } ],"oscuro":[{ "x": 85, "y": [10.8,12.8] }, { "x": 90, "y": [12, 14] }, { "x": 95, "y": [13, 15.3] }, { "x": 100, "y": [14.2, 16.7] }, { "x": 105, "y": [15.5, 18.4] }, { "x": 110, "y": [17, 20.3] }, { "x": 115, "y": [18.7, 22.4] }, { "x": 120, "y": [20.4, 24.6] }, { "x": 121, "y": [20.4, 24.6] }, { "x": 125, "y": [22.3, 27.2] }, { "x": 130, "y": [24.4, 30.2] } ]}' ?>
					var chart = new CanvasJS.Chart("chartContainerPesoPorLongitud85a130Nino",
	{
		title: {
			text: "Peso por estatura NIÑOS de 85 a 130 cms. (mediada y desviaciones estandar)",
			fontSize:10
		},
		axisX: {
			interval: 5,
			minimum: 85,
			title:'Talla (cms)',
			labelFontSize:8
		},
		axisY: {
			interval: 2,
			minimum: 10,
			title:'Peso (kg)',
			labelFontSize:8
		},
		data: [
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			dataPoints: [
				{ x: 85, y: [10,13.8] },
				{ x: 90, y: [11, 15.2] },
				{ x: 95, y: [12, 16.6] },
				{ x: 100, y: [13.2, 18.2] },
				{ x: 105, y: [14.3, 20.2] },
				{ x: 110, y: [15.7, 22.2] },
				{ x: 115, y: [17.2, 24.7] },
				{ x: 120, y: [18.6, 27.2] },
				{ x: 121, y: [18.6, 26.9] },
				{ x: 125, y: [20.2, 30.1] },
				{ x: 130, y: [22.2, 34] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#0049F1",
			fillOpacity: .3,
			dataPoints: [
				{ x: 85, y: [10.8,12.8] },
				{ x: 90, y: [12, 14] },
				{ x: 95, y: [13, 15.3] },
				{ x: 100, y: [14.2, 16.7] },
				{ x: 105, y: [15.5, 18.4] },
				{ x: 110, y: [17, 20.3] },
				{ x: 115, y: [18.7, 22.4] },
				{ x: 120, y: [20.4, 24.6] },
				{ x: 121, y: [20.4, 24.6] },
				{ x: 125, y: [22.3, 27.2] },
				{ x: 130, y: [24.4, 30.2] }
			]
		},
		{
			type: "rangeSplineArea",
			color: "#61ADEF",
			fillOpacity: .3,
			dataPoints: [
				{ x: 85, y: [11.8,11.8] },
				{ x: 90, y: [13, 13] },
				{ x: 95, y: [14, 14] },
				{ x: 100, y: [15.4, 15.4] },
				{ x: 105, y: [16.8, 16.8] },
				{ x: 110, y: [18.5, 18.5] },
				{ x: 115, y: [20.5, 20.5] },
				{ x: 120, y: [22.4, 22.4] },
				{ x: 121, y: [22.2, 22.2] },
				{ x: 125, y: [24.3, 24.3] },
				{ x: 130, y: [26.8, 26.8] }
			]
		}
		<?php if (isset($hijo['peso']) and !empty($hijo['peso']) and isset($hijo['estatura']) and !empty($hijo['estatura']) ): ?>

		,{
			type: "rangeSplineArea",
			color: "#FB1414",
			fillOpacity: .3,
			dataPoints: [
				{ x: <?php echo $hijo['estatura'] ?>, y: [<?php echo $hijo['peso'] ?>, <?php echo $hijo['peso'] ?>] ,
				markerType: "circle", markerColor: "brown", markerSize: 5 }
			]
		}
		<?php endif; ?>
		]
	});
	chart.render();
	chart = {};
<?php endif; ?>

}
		
		</script>
		<?php for ($i=0; $i < count($grafico) ; $i++) { 
			
				// $grafico[$i] = json_encode($grafico[$i]); 
				
				$grafico[$i] = json_decode( $grafico[$i] );
			} ?>
			
			<?php if ($hijo['sexo'] == 'f' and $hijo['edad'] >= 0 and $hijo['edad'] <= 24): ?>
				
			<div id="chartContainerPeso" style="height: 300px; width: 100%;"></div>
			<?php for ($i=0; $i <count($grafico[0]->clarito[$i]) ; $i++) { 
				if (isset($grafico[0]->clarito[$i+1])) {
					if ($grafico[0]->clarito[$i]->x >= $hijo['edad'] and $grafico[0]->clarito[$i+1]->x <= $hijo['edad']) {
						$r = $grafico[0]->clarito[$i]->x - $hijo['edad'];
						$r2 = $hijo['edad'] - $grafico[0]->clarito[$i]->x;
					}
				}else{

				}
			} ?>
			<div id="chartContainerLongitud" style="height: 300px; width: 100%;"></div>
			<pre>
				<?php var_dump($grafico[1]->oscuro) ?>
			</pre>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'f' and $hijo['edad'] > 24 and $hijo['edad'] <= 72): ?>
			<div id="chartContainerPeso2a6" style="height: 300px; width: 100%;"></div>
			<div id="chartContainerLongitud2a6" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'm' and $hijo['edad'] >= 0 and $hijo['edad'] <= 24): ?>
			<div id="chartContainerPesoNino" style="height: 300px; width: 100%;"></div>
			<div id="chartContainerLongitudNino" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'm' and $hijo['edad'] > 24 and $hijo['edad'] <= 72): ?>
			<div id="chartContainerPeso2a6Nino" style="height: 300px; width: 100%;"></div>
			<div id="chartContainerLongitud2a6Nino" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'f' and $hijo['estatura'] >= 50 and $hijo['estatura'] <= 75): ?>
			<div id="chartContainerPesoPorLongitud" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'f' and $hijo['estatura'] > 75 and $hijo['estatura'] <= 100): ?>
			<div id="chartContainerPesoPorLongitud75a100" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'f' and $hijo['estatura'] >= 85 and $hijo['estatura'] <= 130): ?>
			<div id="chartContainerPesoPorLongitud85a130" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] >= 50 and $hijo['estatura'] <= 75): ?>
			<div id="chartContainerPesoPorLongitud50a75Nino" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] > 75 and $hijo['estatura'] <= 100): ?>
			<div id="chartContainerPesoPorLongitud75a100Nino" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			<?php if ($hijo['sexo'] == 'm' and $hijo['estatura'] >= 85 and $hijo['estatura'] <= 130): ?>			
			<div id="chartContainerPesoPorLongitud85a130Nino" style="height: 300px; width: 100%;"></div>
			<?php endif ?>
			
			
			
		<?php endif ?>
 	<?php
}
