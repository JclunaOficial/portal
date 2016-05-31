<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex, nofollow" />
        
        <title><?=PORTAL_TITLE;?><?=(isset($pageTitle) ? ' &mdash; ' . $pageTitle : '');?></title>
        
        <link type="text/css" rel="stylesheet" href="<?=Request::resolveUrl('theme/bs/css/bootstrap-default.min.css');?>"/>
        <link type="text/css" rel="stylesheet" href="<?=Request::resolveUrl('theme/fa/css/font-awesome.min.css');?>"/>
        <link type="text/css" rel="stylesheet" href="<?=Request::resolveUrl('theme/css/portal.css');?>"/>

        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?=Request::resolveUrl('theme/js/html5shiv.min.js');?>"></script>
        <script type="text/javascript" src="<?=Request::resolveUrl('theme/js/respond.min.js');?>"></script>
        <![endif]-->
    </head>
    <body role="document">
        <div id="page-wrapper">
            