<head>
<?php if(isset($isFromHomePage) && $isFromHomePage){ ?>
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="<?=$webName;?>">
	<meta itemprop="description" content="<?=$webDescription;?>">
	<meta itemprop="image" content="<?=$webImage?>">

	<!-- Facebook Meta Tags -->
	<meta property="og:url" content="<?=$webUrl;?>">
	<meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=$_app_name?>">
	<meta property="og:title" content="<?=$webName;?>">
	<meta property="og:description" content="<?=$webDescription;?>">
	<meta property="og:image" content="<?=$webImage;?>">

	<!-- Twitter Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:domain" content="webapptemplate.hssoftvn.com">
	<meta name="twitter:title" itemprop="name"  property="og:title" content="<?=$webName;?>">
	<meta name="twitter:description" itemprop="description" property="og:description" content="<?=$webDescription;?>">
	<meta name="twitter:image" itemprop="image" property="og:image" content="<?=$webImage;?>">
<?php } ?>
    <!-- Meta Tags Generated via http://heymeta.com -->
</head>