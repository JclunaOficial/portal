
<div class="navbar navbar-default" role="navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Navigate</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=Request::resolveUrl('');?>">
                <strong><?=PORTAL_TITLE;?></strong>
            </a>
        </div>
        
        <div id="main" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <b class="fa fa-user"></b>&nbsp; {usuario} <i class="caret"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=Request::resolveUrl('auth/logout');?>"><b class="fa fa-power-off"></b> Terminar Sesión</a></li>
                    </ul>
                </li>
            </ul>
            
            <?=Bootstrap::getNavbar(MVC_VIEWS . 'layout/navbar.xml');?>
        </div>
    </div>
</div>
