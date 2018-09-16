</article>
</section>

<footer>
  <div id="wrap-footer">
    <?php
   	if($_SESSION['USER_AUTHORIZED']):
	?>
    <div id="header-adm">
      <div id="bem-vindo"><span class="bem">BEM</span> <span class="vindo">VINDO <?php echo $_SESSION[ 'MM_Username' ]?></span></div>
      <div id="sair"><a href="<?php echo $_SESSION["URL_ADM_BASE"];?>/logoff.php">Sair</a></div>
      <nav id="admin"> </nav>
      <div class="wrap">
        <div id="title-top">ÁREA DE MANUTENÇÃO DO SITE</div>
      </div>
    </div>
    <?php
   	endif;
	?>
    <div class="wrap">
      <section id="block">
        <div id="block-st" class="block"> </div>
        <div id="block-nd" class="block">Copyright © <?php echo date("Y")?> <span class="NexaBold">Observatório do tabaco</span>, todos direitos reservados  </div>
        <div id="block-rd" class="block"></div>
      </section>
    </div>
  </div>
</footer>
</div>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1411309372451325',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/pt_BR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body></html>