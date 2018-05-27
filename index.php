<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Ludovico Venturi">

        <title>Tesina Ludovico Venturi</title>
        <link rel="icon" href="assets/img/favicon.png">
        
        <link rel="stylesheet" href="lib/materialize-v1b/css/materialize.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/homepage.css">
        
        <script src="lib/jquery.js"></script>
        <script src="lib/scrollReveal/scrollreveal.min.js"></script>
        <script src="lib/materialize-v1b/materialize.min.js"></script>
    </head>
    <body>

    <div class="my-cont">
        <div class="fullscreen-video-wrap">
            <video src="assets/vid/vid_talk.mp4" loop="true" autoplay="true"></video>
        </div>
        <div class="header-overlay"></div>
        <div class="header-content">
            <div id="start-tab">
                <div class="row">
                    <div id="main-title"><h1>Tesina<span class="my-white"> 5°anno</span> Maturità<br><br>Limiti</h1></div>
                    <p><span class="waves-effect waves-light">Ludovico Venturi <span class="my-white">5°AIA</span></span></p>
                </div>
                <div class="enter-btn waves-effect waves-light" id='btn-log'><a href="#login-tab">ENTRA</a></div>
            </div>

            <div id="login-tab" class="hide-tab">
                <div class="row">
                    <div id="main-title"><h1>autenticazione<br></h1></div>
                </div>
                <div class="row">
                    <!-- LOGIN UTENTE -->
                    <form id="login_ut" action="server/_loginUt.php" enctype="multipart/form-data" autocomplete="off" method="POST">
                        <div id="wrap-login" class="col s7">
                            <div class="row">
                                <div class="input-field col s12">
                                  <input id="utente" name="utente" type="text" class="validate">
                                  <label for="utente">Nome Utente</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="psw" type="password" name="psw" class="validate">
                                    <label for="psw">Password</label>
                                </div>
                            </div>
                            <div align="right">
                                <button class="waves-effect waves-green btn btn-flat btn-submit-aut" action="submit" name="action">LOG IN</button>
                            </div>
                        </div>
                    </form>
                    <div class="col s1"></div>
                    <!-- LOGIN OSPITE -->
                    <form method="post" action="server/_loginOsp.php" enctype="multipart/form-data" autocomplete="off" id="login_osp" method="GET">
                        <div id="wrap-ospite" class="col s4">
                            <div class="row" align="center">
                                <div align="center"><button class="waves-effect waves-green btn btn-flat btn-submit-aut" action="submit" name="action">OSPITE</button></div>
                            </div>
                            <br>
                            <div align="right">
                                <a class="tooltipped tooltip-text-view" data-position="bottom" data-delay="50" data-tooltip="<ul>
                                    <li>Visualizzare le <b>aziende</b> che ospitano gli stage</li><br>
                                    <li>Visualizzare la <b>Mappa</b> delle aziende</li>
                                </ul>">Cosa posso fare?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- login-tab -->
        </div> <!-- header-content -->
    </div>  <!-- my-cont -->   
    <div class="progress_cont dn">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
    </div>   

    <script src="assets/js/home_js.js"></script>
    <script src="server/ajax/home_login.js"></script>
    </body>
</html>