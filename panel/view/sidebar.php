<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="view/assets/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="view/assets/images/logo-dark.png" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="view/assets/logo.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="view/assets/logo.png" alt="" height="90">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" data-simplebar="init" class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                         aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <div class="container-fluid">

                                <div id="two-column-menu">
                                </div>
                                <ul class="navbar-nav" id="navbar-nav" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                     aria-label="scrollable content"
                                                     style="height: auto; overflow: hidden;">
                                                    <div class="simplebar-content" style="padding: 0px;">


														<?php



														$menuType = $_SESSION['UserType'];


                                                        foreach ( $menu[ $menuType ] as $item ) {


	                                                        if($_SESSION['UserType'] == 'firma'){
		                                                        if(loginUserMeta('aboneFirma') == 0 AND !$item['ortak']){
			                                                        continue;
		                                                        }

                                                                if(count(listTaseronAnaFirma( $_SESSION['UserID'], 'taseron' )) < 1 AND ($item['name'] == 'Personeller' OR $item['name'] == 'Ekipmanlar')){
	                                                                continue;
                                                                }


	                                                        }


															if ( $item['dropdown'] ) {

																$out = '';
																foreach ( $item['SUB'] as $sub ) {

																	$out .= ' <li class="nav-item">
                                                                                <a href="' . $sub['URL'] . '"
                                                                                   class="nav-link"
                                                                                   data-key="t-utilities">' . $sub['name'] . '</a>
                                                                            </li>';

																}

																echo ' <li class="nav-item">';
																echo '<a class="nav-link menu-link collapsed"
                                                               href="#' . str_replace( ' ', '', $item['name'] ) . '" data-bs-toggle="collapse"
                                                               role="button" aria-expanded="false"
                                                               aria-controls="sidebarUI">
                                                                ' . $item['icon'] . '
                                                                <span data-key="t-base-ui">' . $item['name'] . '</span>
                                                            </a>';
																echo '<div class="collapse menu-dropdown mega-dropdown-menu"
                                                                 id="' . str_replace( ' ', '', $item['name'] ) . '">';
																echo '<div class="row">
                                                                    <div class="col-lg-4">
                                                                        <ul class="nav nav-sm flex-column">';
																echo $out;
																echo '</ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>';


															} else {

																echo '<li class="nav-item">
                                                            <a class="nav-link menu-link" href="' . $item['URL'] . '">
                                                            ' . $item['icon'] . '
                                                                <span data-key="t-widgets">' . $item['name'] . '</span>
                                                            </a>
                                                        </li>';
															}


															?>

														<?php } ?>

														<?php

														if ( isset( $_SESSION['admin'] ) and $_SESSION['UserType'] != 'admin' ) {
															if ( $_SESSION['admin'] == 1 ) {
																?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link menu-link"  href="autologin?proses=turnadmin">
                                                                        <i data-feather="log-out"></i>
                                                                        <span data-key="t-widgets">KENDİ PANELİNE DÖN</span>
                                                                    </a>
                                                                </li>
																<?php

															}
														}

														?>
                                                        <li class="nav-item">
                                                            <a class="nav-link menu-link" href="/panel/?logout">
                                                                <i data-feather="log-out"></i>
                                                                <span data-key="t-widgets">ÇIKIŞ</span>
                                                            </a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder"
                                             style="width: 249px; height: 1209px;">
                                        </div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                    </div>
                                </ul>
                            </div>
                            <!-- Sidebar -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1209px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                 style="height: 491px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
