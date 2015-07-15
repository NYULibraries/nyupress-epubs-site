<!doctype html>
<html>
<head>
  <title>NYU Press: About</title>
 <!-- head -->
 <meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="//cloud.typography.com/7436432/628284/css/fonts.css" />
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta property="og:type" content="book">
 <meta property="og:url" content="<?php echo $url ?>">
 <meta property="og:title" content="<?php echo $bookData["title"] ?>">
 <meta property="og:description" content="<?php echo $bookData["description"] ?>">
 <meta property="og:image" content="<?php echo "http://openaccessbooks.nyupress.org/NYUPressOA/" . $bookData["thumbHref"] ?>">
 <meta property="og:image:width" content="200">
 
 <link rel="stylesheet" href="http://43cc2f68.ngrok.io/nyupress-epubs-site/css/bootstrap.css"> 
 <link rel="stylesheet" href="http://43cc2f68.ngrok.io/nyupress-epubs-site/css/dlts.css">
 <script src="http://yui.yahooapis.com/3.15.0/build/yui/yui-min.js"></script>
 <script>
 YUI().use('node', function(Y) {
     body = Y.one('body');
 
     function onSubmit(e) {
         e.preventDefault();
 
         var currentTarget = e.currentTarget,
             value = Y.one('.pure-input');
         location.href = currentTarget.get('action') + '/' + value.get('value');
     }
 
     var onClick = function(e) {
         e.preventDefault();
 
         var node = Y.one('.searchform'),
             nodeToggle = Y.one('#search-toggle'),
             nodeInput = Y.one('.searchbox'),
             isHidden = node.getStyle('display') == 'none';
 
         if (isHidden) {
 
             node.addClass('open');
             nodeToggle.addClass('open');
             nodeInput.focus();
         } else {
             node.removeClass('open');
             nodeToggle.removeClass('open');
 
         }
     };
 
     Y.one('#search-toggle').on('click', onClick);
     body.delegate('submit', onSubmit, 'form');
 });
 </script>
</head>
<body class="about page">

  <div class="header">
    <nav class="navbar" role="navigation" id="navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <header role="banner">
            <h2 id="logo-replace"><a href="http://43cc2f68.ngrok.io/nyupress-epubs-site" class="brand">NYU Press</a></h2>
            <h1 id="site-title"><a href="http://43cc2f68.ngrok.io/nyupress-epubs-site">Open Access Books</a></h1>
            <div class="n-utils">
              <button id="search-toggle" style="display:none">X</button>
              <form role="search" class="pure-form searchform" value="" method="get" action="http://43cc2f68.ngrok.io/nyupress-epubs-site/search" name="searchform" >
                <input class="searchbox pure-input" name="searchbox" id="searchbox"  type="text" placeholder="Search for books..." value="" size="30" maxlength="300">
                  <!-- <button type="submit" class="pure-button">Search</button> -->
              </form>
            </div>
          </header>
        </div>
      </div>
    </nav>
  </div>
  <div class="breadcrumb">
      <span class="page-title"><a href="http://43cc2f68.ngrok.io/nyupress-epubs-site">Home</a> &gt; About</span>
  </div>

  <div class="data-container main">
  
      <h2 class="page-title">About this Project</h2>
      <p>NYU Press is pleased to offer these books in an open access platform for reading on desktop and mobile devices. We will continue to contribute new titles each year. </p>
      <p>If you are interested in purchasing the print edition of any of these books, we encourage you to order it at your local independent bookstore, or click on the “buy this book” link in each title’s detail page.</p>
      <p>For a brief description of Open Access, see <a href="http://legacy.earlham.edu/~peters/fos/brief.htm" target="_blank">http://legacy.earlham.edu/~peters/fos/brief.htm</a></p>
      <p>The site was developed by our colleagues in the NYU Libraries Digital Library Technology Services department: Laura Henze, Carol Kassel, Alberto Ortiz Flores, Joseph Pawletko, and Rasan Rasch.</p>
      <p>From NYU Press: Monica McCormick and Miguel Sandoval. </p>
      <p>Project Sponsors: Stephen Maikowski (NYU Press) and David Millman (NYU Libraries DLTS)</p>
      <p>This site uses <a href="http://readium.github.io/" target="_blank">Readium</a>, an open source library for handling EPUB documents.</p>
  </div>
  <footer id ="pagefooter">
    <div class="footer-inner">
      <ul>
        <li><span><a href="http://43cc2f68.ngrok.io/nyupress-epubs-site/about">About</a></span></li>
        <li><span><a href="http://43cc2f68.ngrok.io/nyupress-epubs-site/rights">Rights Information</a></span></li>
        <li id="nyup-link"><span><a href="http://nyupress.org/" target="_blank">NYU Press</a></span></li>
        <li id="dlts-link"><span>Powered by <a href="http://dlib.nyu.edu/dlts/"  target="_blank">NYU DLTS</a></span></li>
      </ul>
    </div>
  </footer>
</body>
</html>