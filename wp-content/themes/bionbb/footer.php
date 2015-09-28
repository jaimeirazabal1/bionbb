<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package BionBB
 */
?>

</div>
</div>

<footer>		
<div class="footer">
<img class="barco" src="<?php echo get_template_directory_uri(); ?>/img/barco.png">
<img class="footer-1" src="<?php echo get_template_directory_uri(); ?>/img/footer.png">

<section class="contenido-footer">
<a href="#"><img id="logo-footer" src="<?php echo get_template_directory_uri(); ?>/img/logo-footer.png"></a>
<div class="footer-content">
<h2>BION BB</h2>

<ul>
<a class="footer-lista" href="http://www.bionbb.cl/que-es-bion-bb/"><li>¿Qué es Bion BB?</li></a>
<a class="footer-lista" href="http://www.bionbb.cl/seccion/consejos/"><li>Consejos para ti </li></a>
<a class="footer-lista" href="http://www.bionbb.cl/seccion/recetas/"><li>Recetas para tu hij@</li></a>
<a class="footer-lista" href="#"><li>Preguntas frecuentes</li></a>
</ul>

</div>
<div class="footer-content">
<h2>FAMILIA BION </h2>

<ul>
<a class="footer-lista" href="http://www.bion3.cl/home/" target="_blank"><li>Bion&reg; 3 </li></a>
<a class="footer-lista" href="http://www.bion3.cl/home/bion3-mini/" target="_blank"><li>Bion&reg; 3 Mini</li></a>
<a class="footer-lista" href="http://www.bionallergo.cl/" target="_blank"><li>Bion&reg; Allergo</li></a>
<a class="footer-lista" href="http://www.bionintime.cl/" target="_blank"><li>Bion&reg; Intime </li></a>
<a class="footer-lista" href="http://www.biontransit.cl/" target="_blank"><li>Bion&reg; Transit </li></a>
</ul>

</div>
<div class="footer-content">
<h2>CONTACTO</h2>

<ul>
<a class="footer-lista" href="http://www.bionbb.cl/contacto/"><li>Contacto</li></a>
<a class="footer-lista" href="http://www.bionbb.cl/donde-comprar/"><li>&iquest;D&oacute;nde comprar?</li></a>
</ul>

</div>
</section>
</div>
<div id="footer-2">
<img class="imagen-footer-2" src="<?php echo get_template_directory_uri(); ?>/img/footer-2-amarillo.png">
<section class="contenido-footer1">
<p class="derechos"><a href="#">Fransisco de Paula Tafor&oacute; 1981 </a><br><a href="#"> &Ntilde;u&Ntilde;oa - Santiago - Chile </a><br><a href="#"> FONO: <a href="tel:800340300 ">800 340 300</a> / <a href="tel:0223400222">( 02 ) 2 2340 02 22</a> </a><br><a href="#"> Merck 2012. Todos los derechos reservados.</a></p>
<span class="aviso"><a href="http://www.bionbb.cl/aviso-legal/">Aviso Legal</a> - <a href="http://www.bionbb.cl/terminos-de-uso/">T&eacute;rminos de Uso</a> - <a href="http://www.bionbb.cl/politica-de-privacidad/">Politica de Privacidad &copy; Merck S.A</a></span>
</section>
</div>
</footer>

<!--/// Menu mobile -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
	    $(function() {

	        var btn_movil = $('#nav-mobile'),
	            menu = $('#menu').find('ul');

	        // Al dar click agregar/quitar clases que permiten el despliegue del menú
	        btn_movil.on('click', function (e) {
	            e.preventDefault();

	            var el = $(this);

	            el.toggleClass('nav-active');
	            menu.toggleClass('open-menu');
	        })

	    });
	</script>
<!--/// Menu mobile -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40742346-30', 'auto');
  ga('send', 'pageview');

</script>

<?php wp_footer(); ?>

</body>
</html>