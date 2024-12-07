<?php
echo '
</div>
</div>
</div>
</div>
</div>
<!--[if lt IE 10]>
<div class="ie-warning">
   <h1>Warning!!</h1>
   <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
      to access this website.
   </p>
   <div class="iew-container">
      <ul class="iew-download">
         <li>
            <a href="http://www.google.com/chrome/">
               <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
               <div>Chrome</div>
            </a>
         </li>
         <li>
            <a href="https://www.mozilla.org/en-US/firefox/new/">
               <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
               <div>Firefox</div>
            </a>
         </li>
         <li>
            <a href="http://www.opera.com">
               <img src="../files/assets/images/browser/opera.png" alt="Opera">
               <div>Opera</div>
            </a>
         </li>
         <li>
            <a href="https://www.apple.com/safari/">
               <img src="../files/assets/images/browser/safari.png" alt="Safari">
               <div>Safari</div>
            </a>
         </li>
         <li>
            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
               <img src="../files/assets/images/browser/ie.png" alt="">
               <div>IE (9 & above)</div>
            </a>
         </li>
      </ul>
   </div>
   <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<script type="text/javascript" src="../assets/lib/jquery/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/lib/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="../assets/lib/jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript" src="../assets/lib/moment/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../assets/lib/select2/js/select2.full.min.js"></script>
<script type="text/javascript" src="../assets/lib/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript" src="../assets/lib/waves/dist/waves.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../assets/js/modernizr.js"></script>
<script type="text/javascript" src="../assets/js/css-scrollbars.js"></script>
<script type="text/javascript" src="../assets/js/custom-prism.js"></script>
<script type="text/javascript" src="../assets/js/i18next.min.js"></script>
<script type="text/javascript" src="../assets/js/i18nextxhrbackend.min.js"></script>
<script type="text/javascript" src="../assets/js/i18nextbrowserlanguagedetector.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery-i18next.min.js"></script>
<script type="text/javascript" src="../assets/js/pcoded.min.js"></script>
<script type="text/javascript" src="../assets/js/menu-hori-fixed.js"></script>
<script type="text/javascript" src="../assets/js/jquery.mcustomscrollbar.concat.min.js"></script>

<script type="text/javascript" src="../assets/js/script.js"></script>
<script type="text/javascript" src="../assets/js/sys.func.js"></script>
<script type="text/javascript" src="../assets/js/rocket-loader.min.js"></script>';
if (isset($pgJs) && is_string($pgJs)) {
    echo $pgJs;
}
echo '</body>
</html>';