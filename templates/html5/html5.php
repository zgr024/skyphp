<?php

global $dev, $jquery_version, $google_analytics_account;

if ( $template_area == 'top' ) {

    $this->template_js = array_merge($this->template_js, array(
        '/lib/history.js-090911-edge/history.js',
        '/lib/history.js-090911-edge/history.html4.js',
        '/lib/history.js-090911-edge/history.adapter.jquery.js',
        '/lib/js/jquery.livequery.min.js',
        '/lib/js/sky.utils.js'
    ));

    $attrs = $this->getHTMLAttrString();

?>
<!doctype html>
<!--[if lt IE 7 ]> <html <?=$attrs?> lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?=$attrs?> lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?=$attrs?> lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?=$attrs?> lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?=$attrs?> lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=<?=$this->charset?$this->charset:'UTF-8'?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title><?=$this->title?></title>
    <meta name="viewport" content="<?=$this->viewport?$this->viewport:'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'?>" />
<?php

    $meta_content = $this->seoMetaContent();

    foreach ($meta_content as $name => $content) {

?>
    <meta name="<?=$name?>" content="<?=$content?>" />
<?php

    }

    if ( true ) echo $this->stylesheet();
    else echo $this->consolidated_stylesheet();

?>
    <link rel="shortcut icon" href="<?=$this->favicon?>" />
    <link rel="apple-touch-icon" href="<?=$this->apple_touch_icon?>" />
<?
	if ($jquery_version) {
?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/<?=$jquery_version?>/jquery.min.js"></script>
    <script>!window.jQuery && document.write(unescape('%3Cscript src="/lib/js/jquery-<?=$jquery_version?>.min.js"%3E%3C/script%3E'))</script>
<? } ?>
    <!--[if (lt IE 9) & (!IEMobile)]>
        <script src="/lib/js/jquery-extended-selectors.js"></script>
        <script src="/lib/js/selectivizr-min.js"></script>
    <![endif]-->
<?php
    // echo the items in the $head_arr
	if (is_array($this->head)) {
        foreach ($this->head as $head_item) {
            echo $head_item . "\n";
        }
	} else if ( $this->head ) {
        echo $this->head . "\n";
    }

    /**
     *  MODERNIZER IS CUSTOMIZED BY ADDING 'uploader' to the list of new tags,
     *  when updating it, iff updating the file, add it to the string of tag names.
     */
?>
    <script src="/lib/js/modernizr-1.7.min.js"></script>
</head>
<body>
<div id="skybox" style="display:none;position:absolute;z-index:9999;"></div>
<div id="overlay" style="display:none;position:absolute;z-index:5000"></div>
<div id="body">

<?php

} else if ( $template_area == 'bottom' ) {

?>

</div>

<script>if ( typeof window.JSON === 'undefined' ) { document.write('<script src="/lib/history.js-1.5/json2.min.js"><\/script>'); }</script>
<?php

    $css = array_diff($this->css, $this->css_added);

    foreach ($css as $file) {
        if (in_array($file, $this->css_added)) continue;
        $this->css_added[] = $file;
        if (file_exists_incpath($file)) {
            $this->output_css($file);
        }
    }

    if (true) echo $this->javascript();
    else echo $this->consolidated_javascript();
?>
<!--[if lt IE 7 ]>
<script src="/lib/js/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->
<?php
	if ($google_analytics_account && !$this->google_analytics_account) {
		$this->google_analytics_account = $google_analytics_account;
	}
    if ( $this->google_analytics_account ) {
		if ($_GET['debug_gaa']) echo $this->google_analytics_account;
/*
?>
<script>
   	var _gaq=[['_setAccount','<?=$this->google_analytics_account?>'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<?php
*/

?>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	ga('create', '<?=$this->google_analytics_account?>', 'auto');
	ga('require', 'displayfeatures');
	ga('send', 'pageview');
</script>
<?
    }//google analytics

    global $db, $dbw, $db_host, $dbw_host;

?>
<!-- web: <?=$_SERVER['SERVER_ADDR']?> -->
<!-- db:  <?=substr($db->host,0,strpos($db->host,'.'))?> -->
<!-- dbw: <?=substr($dbw->host,0,strpos($dbw->host,'.'))?> -->
</body>
</html>
<?php

}//bottom
