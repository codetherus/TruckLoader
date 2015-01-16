<?php
$content = $smarty->fetch('oplogin.tpl');
$smarty->assign('pagecontent',$content);
GenerateSmartyPage();