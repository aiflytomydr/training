<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webroot; ?>img/wallet.png"/>

        <?php
//        echo $this->Html->meta('icon');

        echo $this->Html->css('style');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>                        
                        </button>
<!--                        <a class="navbar-brand" href="<?php echo Router::fullBaseUrl(); ?>">Money Lover</a>-->
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar" data-url="<?php echo Router::fullBaseUrl(); ?>"
                         data-user="<?php echo AuthComponent::user('id'); ?>">
                        <ul class="nav navbar-nav">
                            <?php if (!AuthComponent::user('id')) : ?>
                                <li class="active"><a href="<?php echo Router::fullBaseUrl() . '/login'; ?>">Home</a></li>
                            <?php else : ?>
                                <li class="dropdown">
                                    <?php if (!empty(AuthComponent::user('current_wallet'))): ?>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img class="u-ava" src="<?php
                                            if (!empty(AuthComponent::user('current_wallet_info')['icon'])) {
                                                echo AuthComponent::user('current_wallet_info')['icon'];
                                            } else {
                                                echo '/img/wallet.png';
                                            }
                                            ?>" />
                                            <?php echo AuthComponent::user('current_wallet_info')['name']; ?> <span class="caret"></span></a>
                                        <?php else: ?>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Wallet <span class="caret"></span></a>
                                    <?php endif; ?>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/wallets/add' ?>">New wallet</a></li>
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/wallets/listWallet' ?>">List wallet</a></li>
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/wallets/edit/' . AuthComponent::user('current_wallet'); ?>">Edit</a></li>
                                    </ul>
                                </li>
                                <?php if (!empty(AuthComponent::user('current_wallet'))): ?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Router::fullBaseUrl() . '/categories/add' ?>">New Category</a></li>
                                            <li><a href="<?php echo Router::fullBaseUrl() . '/categories/listCategories' ?>">List Categories</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaction <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo Router::fullBaseUrl() . '/transactions/add' ?>">New Transaction</a></li>
                                            <li><a href="<?php echo Router::fullBaseUrl() . '/transactions/view/sortDate' ?>">List Transaction</a></li>
                                        </ul>
                                    </li>
                                    <?php
                                endif;
                            endif;
                            ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if (!AuthComponent::user('id')) : ?>
                                <li><a href="<?php echo Router::fullBaseUrl() . '/users/register'; ?>"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <?php else : ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><img class="u-ava" src="<?php
                                        if (!empty(AuthComponent::user('avatar'))) {
                                            echo AuthComponent::user('avatar');
                                        } else {
                                            echo '/img/ava_default.jpeg';
                                        }
                                        ?>" />
                                        <?php echo 'Hello, ' . AuthComponent::user('name'); ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/users/changePwd'; ?>"><span class="glyphicon glyphicon-repeat"></span> Change password</a></li>
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/users/edit'; ?>"><span class="glyphicon glyphicon-user"></span> Change my profile</a></li>
                                        <li><a href="<?php echo Router::fullBaseUrl() . '/users/logOut'; ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="main container">
            <div class="mainContent">
                <div class="content">
                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>
        </div>
        <footer id="footer">
            <?php echo 'Copyright by Aiflytomydr'; ?>
        </footer>
    </body>
</html>
