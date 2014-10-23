<?php function getDirList($dir)
  {
    // array to hold return value
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // open pointer to directory and read list of files
    $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
      // skip hidden files
      if($entry[0] == ".") continue;
      if(is_dir("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry/",
          "type" => filetype("$dir$entry"),
          "size" => 0,
          "lastmod" => filemtime("$dir$entry")
        );
      }
    }
    $d->close();

    return $retval;
  }


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="vinnovera-index/css/normalize.min.css">
        <link rel="stylesheet" href="vinnovera-index/css/jquery.remodal.css">
        <link rel="stylesheet" href="vinnovera-index/css/main.css">

        <script src="vinnovera-index/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-container remodal-bg">
            <div class="main wrapper clearfix">

                <article>
                    <section>
                        <h2>My Directories</h2>
                        <?php
                        $dirlist = getDirList("./");

                        echo '<ul>';
                        foreach ($dirlist as $dir => $value) {
                           $name = $value[name];
                           $name = substr($name,2,-1);
                           if ($name !== 'vinnovera-index') {
                              echo '<li><a href="/'.$name.'">/'.$name.'/</a></li>';
                           }
                        }
                        echo '</ul>';

                         ?>
                    </section>
                </article>

                <aside class="hide">
                    <h3>FYI</h3>
                    <p><a href="#php-info"><strong>phpinfo</strong>
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px">
                                          <path d="M5,6H4v11h11v-1H5V6z M6,5v10h10V5H6z"/>
                                          <polygon fill="#F7931E" points="10,7 10,8 12.293,8 7.793,12.5 8.5,13.207 13,8.707 13,11 14,11 14,7 "/>
                                          </svg></a></p>
                    <?php
                    // Usage without mysql_list_dbs()
                    $link = mysql_connect($db_host, $db_user, $db_pass);
                    $res = mysql_query("SHOW DATABASES");
                    echo '<h3>Databases</h3><ul>';
                    while ($row = mysql_fetch_assoc($res)) {
                        $r = $row['Database'];
                        if ($r !== 'mysql' && $r !== 'information_schema' && $r !== 'performance_schema' ) {
                            echo '<li>'.$r. "\n".'</li>';
                        }

                    }
                    echo '</ul>';
                    ?>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
        <div id="php-info" class="remodal" data-remodal-id="php-info">
                <?php 
                ob_start();
                phpinfo();
                $pinfo = ob_get_contents();
                ob_end_clean();
                 
                $pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
                echo $pinfo;

                ?>
    <a class="remodal-confirm" href="#">OK</a>
        </div><!-- /.modal -->
          <div class="shrimpContainer">
              <div class="shrimpBox">
                  <div class="shrimp">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                  </div>
                </div>
            </div>
        <div class="footer-container">

            <footer class="wrapper">
                <p><?php date_default_timezone_set("America/New_York");echo date("Y.m.d"); ?></p>
            </footer>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="index/js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="vinnovera-index/js/vendor/jquery.remodal.js"></script>

        <script src="vinnovera-index/js/main.js"></script>
    </body>
</html>
