<?php
include_once("xajax/xajax_core/xajax.inc.php");
$xajax = new xajax();
$xajax->configure('javascript URI', 'xajax/');

function test()
{
  $resp = new xajaxResponse();
  $resp->alert('It Works...');
  return $resp;
}

$xajax->register(XAJAX_FUNCTION,'test');
$xajax->processRequest();
?>
<!DOCTYPE html>
<html>
<head>
<?php $xajax->printJavascript(); ?>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
      $("a[rel]").overlay({
        mask: {
          color: '#fff',
          loadSpeed: 200,
          opacity: 0.5
        },
        closeOnClick: true,
        onBeforeLoad: function() {
          var wrap = this.getOverlay().find(".contentWrap");
          wrap.load(this.getTrigger().attr("href"));
        }
      });
    });
</script>
</head>
<body>
<a href="upload.html" rel="#ovr" href="#">Overlay</a><br/>
<input type="button" value="Click" onclick="xajax_test()" /><br/>
<div id="ovr">
<div class="contentWrap"></div>
</div>
</body>
</html>
		