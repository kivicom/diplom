<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <base href="/">
    <?=$this->getMeta();?>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!----webfonts---->
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
    <!----//webfonts---->

</head>
<body>
<!---header---->
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="<?=PATH;?>"><img src="images/logo.jpg" title="" /></a>
        </div>
        <!---start-top-nav---->
        <div class="top-menu">
            <div class="search">
                <form action="search" method="get" autocomplete="off">
                        <input type="text" class="typeahead" id="typeahead" name="s">
                        <input type="submit" value="">
                    </form>
            </div>
            <span class="menu"> </span>
            <!--ul>
                <li class="active"><a href="index.html">HOME</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="contact.html">CONTACT</a></li>
                <div class="clearfix"> </div>
            </ul-->
            <div class="btn-group">
                <ul>
                    <li class="active"><a href="index.html">Главная</a></li>
                    <li><a href="about.html">О нас</a></li>
                    <li><a href="contact.html">Контакты</a></li>
                    <li><a href="comment/review">Отзывы</a></li>
                    <li><a class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php if(!empty($_SESSION['user'])): ?>
                            <li><a href="#">Добро пожаловать, <?=h($_SESSION['user']['name']);?></a></li>
                            <li><a href="user/logout">Выход</a></li>
                        <?php else: ?>
                            <li><a href="user/login">Вход</a></li>
                            <li><a href="user/signup">Регистрация</a></li>
                        <?php endif; ?>
                    </ul></li>
                    <div class="clearfix"> </div>
                </ul>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <!---//End-top-nav---->
    </div>
</div>
<!--/header-->
<div class="content">
    <!--banner-starts-->
    <?php if (HOMEPAGE):?>
    <div class="bnr" id="home">
        <div  id="top" class="callbacks_container">
            <ul class="rslides" id="slider4">
                <?php foreach ($sliders as $i => $slider):?>
                    <li>
                        <img src="images/slider/bnr-<?=++$i;?>.jpg" alt=""/>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <?php endif;?>
    <!--banner-ends-->

    <div class="container">
        <div class="content-grids">
            <div class="col-md-8 content-main">
                <div class="col-md-12">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?=$content;?>
            </div>
            <div class="col-md-4 content-right">
                    <div class="categories">
                        <h3>КАТЕГОРИИ:</h3>
                            <?php new \app\widgets\categ\Categories([
                            'tpl' => WWW . '/categ/categ.php',
                        ]); ?>
                    </div>
                    <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="footer">
    <div class="container">
        <p>Copyrights © 2015 Blog All rights reserved | Template by <a href="http://w3layouts.com/">W3layouts</a></p>
    </div>
</div>

<div class="preloader"><img src="images/ring.svg" alt=""></div>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.js"></script>
<!--end slider -->
<script>
    var path = '<?=PATH;?>';
</script>
<!--script-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript" src="js/typeahead.bundle.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--/script-->

<!--Ajax pagination-->
<!--<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("body").on('click','.pagination a.nav-link',function (event) {
            event.preventDefault();
            var currentPage = $(this).text();
            if((<?/*=$pagination->countPages;*/?>) > 1){
                $.ajax({
                    url: "/category/<?/*=$this->route['alias'];*/?>",
                    type: 'GET',
                    data: "page=" + currentPage,
                    success: function (html) {
                        console.log(path);
                        $(".content-main").html(html).hide().fadeIn(300);
                    }
                })
            }
        });
    });
</script>-->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>
<!---->
<script>
    $("span.menu").click(function(){
        $(".top-menu ul").slideToggle("slow" , function(){
        });
    });
</script>

<!--Slider-Starts-Here-->
<script src="js/responsiveslides.min.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
</script>

<script defer src="js/jquery.flexslider.js"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
    });
</script>

<!-- Debug -->
<?php
$logs = \R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();

debug( $logs->grep( 'SELECT' ) );
?>
</body>
</html>