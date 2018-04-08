<div class="leftpanel">
    <div class="leftpanelinner">
        <!-- ################## LEFT PANEL PROFILE ################## -->
        <div class="media leftpanel-profile">
            <div class="media-left">
                <a href="#">
                    <img src="/assets/images/photos/loggeduser.png" alt="" class="media-object img-circle">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading" id="usuario_nome"></h4>
                <span id="usuario_tipo"></span>
            </div>
        </div>
        <!-- leftpanel-profile -->

        <div class="tab-content">
            <!-- ################# MAIN MENU ################### -->
            <div class="tab-pane active" id="mainmenu">
                <h5 class="sidebar-title">Menu Principal</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk">
                    {{--<li class="active">--}}
                    {{--<a href="/dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="/clientes"><i class="fa fa-group"></i> <span>Clientes</span></a>
                    </li>
                    <li>
                        <a href="/pedidos"><i class="fa fa-clipboard"></i> <span>Pedidos</span></a>
                    </li>
                    <li>
                        <a href="/produtos"><i class="fa fa-archive"></i> <span>Produtos</span></a>
                    </li>
                </ul>
                <h5 class="sidebar-title">Menu Administrativo</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk">
                    <li>
                        <a href="/usuarios"><i class="fa fa-user-secret"></i> <span>Usuários</span></a>
                    </li>
                </ul>
            </div>
            <!-- ######################## EMAIL MENU ##################### -->
            <div class="tab-pane" id="emailmenu">
                <div class="sidebar-btn-wrapper">
                    <a href="compose.html" class="btn btn-danger btn-block">Compose</a>
                </div>
                <h5 class="sidebar-title">Mailboxes</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk nav-mail">
                    <li><a href="email.html"><i class="fa fa-inbox"></i> <span>Inbox (3)</span></a></li>
                    <li><a href="email.html"><i class="fa fa-pencil"></i> <span>Draft (2)</span></a></li>
                    <li><a href="email.html"><i class="fa fa-paper-plane"></i> <span>Sent</span></a></li>
                </ul>
                <h5 class="sidebar-title">Tags</h5>
                <ul class="nav nav-pills nav-stacked nav-quirk nav-label">
                    <li><a href="#"><i class="fa fa-tags primary"></i> <span>Communication</span></a></li>
                    <li><a href="#"><i class="fa fa-tags success"></i> <span>Updates</span></a></li>
                    <li><a href="#"><i class="fa fa-tags warning"></i> <span>Promotions</span></a></li>
                    <li><a href="#"><i class="fa fa-tags danger"></i> <span>Social</span></a></li>
                </ul>
            </div>
            <!-- tab-pane -->
            <!-- ################### CONTACT LIST ################### -->
            <div class="tab-pane" id="contactmenu">
                <div class="input-group input-search-contact">
                    <input type="text" class="form-control" placeholder="Search contact">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <h5 class="sidebar-title">My Contacts</h5>
                <ul class="media-list media-list-contacts">
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user1.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Christina R. Hill</h4>
                                <span><i class="fa fa-phone"></i> 386-752-1860</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user2.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Floyd M. Romero</h4>
                                <span><i class="fa fa-mobile"></i> +1614-650-8281</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user3.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Jennie S. Gray</h4>
                                <span><i class="fa fa-phone"></i> 310-757-8444</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user4.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Alia J. Locher</h4>
                                <span><i class="fa fa-mobile"></i> +1517-386-0059</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user5.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Nicholas T. Hinkle</h4>
                                <span><i class="fa fa-skype"></i> nicholas.hinkle</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user6.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Jamie W. Bradford</h4>
                                <span><i class="fa fa-phone"></i> 225-270-2425</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user7.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Pamela J. Stump</h4>
                                <span><i class="fa fa-mobile"></i> +1773-879-2491</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user8.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Refugio C. Burgess</h4>
                                <span><i class="fa fa-mobile"></i> +1660-627-7184</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user9.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Ashley T. Brewington</h4>
                                <span><i class="fa fa-skype"></i> ashley.brewington</span>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="#">
                            <div class="media-left">
                                <img class="media-object img-circle" src="/assets/images/photos/user10.png" alt="">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">Roberta F. Horn</h4>
                                <span><i class="fa fa-phone"></i> 716-630-0132</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- tab-pane -->
            <!-- #################### SETTINGS ################### -->
            <div class="tab-pane" id="settings">
                <h5 class="sidebar-title">General Settings</h5>
                <ul class="list-group list-group-settings">
                    <li class="list-group-item">
                        <h5>Daily Newsletter</h5>
                        <small>Get notified when someone else is trying to access your account.</small>
                        <div class="toggle-wrapper">
                            <div class="leftpanel-toggle toggle-light success"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h5>Call Phones</h5>
                        <small>Make calls to friends and family right from your account.</small>
                        <div class="toggle-wrapper">
                            <div class="leftpanel-toggle-off toggle-light success"></div>
                        </div>
                    </li>
                </ul>
                <h5 class="sidebar-title">Security Settings</h5>
                <ul class="list-group list-group-settings">
                    <li class="list-group-item">
                        <h5>Login Notifications</h5>
                        <small>Get notified when someone else is trying to access your account.</small>
                        <div class="toggle-wrapper">
                            <div class="leftpanel-toggle toggle-light success"></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h5>Phone Approvals</h5>
                        <small>Use your phone when login as an extra layer of security.</small>
                        <div class="toggle-wrapper">
                            <div class="leftpanel-toggle toggle-light success"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- tab-pane -->
        </div>
        <!-- tab-content -->
    </div>
    <!-- leftpanelinner -->
</div><!-- leftpanel -->
