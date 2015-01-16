{*
  This is the main template for the ajax'ed one page
  loadsbyjake site.
  The page contains a head, content and footer.
  The head and footer are loaded once and the content
  changes with the served page.
  We will load pageheaderv2.tpl into the header
  
*}
{include file="pageheaderv2.tpl"}
{include file="common_scripts.tpl"}
</head>

{include file="content_header_v2.tpl"}
<div id="floatboxcontent"></div>
<div id="wrapper" class="rc" style="margin-top: 20px;">

<div id="content" name="content">

</div><!-- Main content div -->

</div> <!-- End wrapper -->
{include file="footer.tpl"}