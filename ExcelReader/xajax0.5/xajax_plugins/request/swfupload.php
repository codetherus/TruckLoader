<?
	if (isset($_POST['PHPSESSID'])) {
		session_id($_POST['PHPSESSID']);
	}
	session_start(); 

	ini_set("display_errors",1);
	error_reporting(E_ALL ^E_NOTICE);
	
	if (!isset($_SESSION['foo'])) $_SESSION['foo'] = 0;
	
	$core = './xajax/xajax_core';
	require_once $core . '/xajax.inc.php';
	
	$xajax = new xajax();
	require_once './xajax/xajax_plugins/request/swfupload/swfupload.inc.php';
	$xajax->configure("javascript URI","xajax/");
	
	$xajax->register(XAJAX_FUNCTION,"uploader",array("mode" => "'SWFupload'","SWFform" => "'upload_form'"));
	$xajax->register(XAJAX_FUNCTION,"transform");
	$xajax->register(XAJAX_FUNCTION,"destroyform");
	
	$_SESSION['foo']++;
	$xajax->processRequest();
	
	function transform() {
	
		$objResponse = new xajaxResponse();
		$objResponse->clsSwfUpload->transForm('upload_form'
																					,array(
																						"file_types" => "*.jpg;*.gif;*.png;"
																						,"file_types_description" => "Image Files or mp3"
																						,"file_size_limit" => "5 MB"
																						,"upload_complete_handler" => "function () {
																																						}"
																						,"post_params" => array(
																							"PHPSESSID" => session_id()
																						)																				
																					
																					)
																					, true
																					);
	
	
		return $objResponse;
	}
	
	function destroyform() {
	
		$objResponse = new xajaxResponse();
		$objResponse->clsSwfUpload->destroyForm('upload_form');
	
		return $objResponse;
	}

	function uploader($aFormValues) {
		$objResponse = new xajaxResponse();
		$html="";
		foreach ($_FILES as $key => $file) {
			$html .="
				<div style=\"border:1px solid #f0f0f0;background:#fff;padding:4px;margin-bottom:4px;\">
					<div style=\"float:left;width:100px;\">Filename:</div>
					<div style=\"float:left;\">".$_FILES[$key]['name']."</div>
					<br style=\"clear:both;\" />
					<div style=\"float:left;width:100px;\">Size:</div>
					<div style=\"float:left;\">".$_FILES[$key]['size']."</div>
					<br style=\"clear:both;\" />
					<div style=\"float:left;\">\$_SESSION request counter: ".$_SESSION['foo']."</div>
					<br style=\"clear:both;\" />
				</div>
				"	;
		}
		if ("" == $html) $html="empty queue";
		$objResponse->append("results","innerHTML",$html);
	
		return $objResponse;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>XAJAX UploadProgress Plugin</title>
	<?php $xajax->printJavaScript();?>
	<link rel="stylesheet" type="text/css" href="demo.css" />

	<style type="text/css">
		/* <![CDATA[ */
		
.swf_queued_file {
	background:#f0f0f0;
	margin-bottom:2px;
	border:1px solid #c0c0c0;
	padding:4px;
	clear:both;
}

.swf_queued_file_removed {
	background:#FFDFDF;
	margin-bottom:2px;
	border:1px solid #c0c0c0;
	padding:4px;
	clear:both;
}

.swf_queued_file_finished {
	background:#DFFFE6;
	margin-bottom:2px;
	border:1px solid #c0c0c0;
	padding:4px;
	clear:both;
}


.swf_queued_file_remove {
	font-size:11px;
	float:left;
	width:20px;
	height:20px;
	background:url(img/bin_closed.png) no-repeat top left;	
	overflow:hidden;
}
.swf_queued_filename{
	font-size:11px;
	display:inline;
	float:left;
	width:180px;
	overflow:hidden;
}

.swf_queued_file_progress_container {
	float:left;
	display:inline;
	background:#d0d0d0;
	margin-top:4px;
	height:10px;
	width:220px;
	margin-right:8px;
}
.swf_queued_file_progress_bar {
	height:8px;
	background:#333;	
	width:1px;
}

.swf_queued_filesize{
	font-size:11px;
	float:left;
	overflow:hidden;
}
		 /* ]]> */
	</style>
</head>
<body onload="xajax_transform();">

	<h1>XAJAX SWFupload Plugin</h1>

	<div id="example">
		<h2>demo</h2>
		<form enctype="multipart/form-data" id="upload_form" action="upload.php" onsubmit="return false;" method="post" >


			<div style="font-size:11px;">
				The file size is limited to 5MB. Don't even think about hijacking the form, all your uploads will safely be stored in /dev/null. :)
			</div>
			
			<div class="formLabel">test field:</div>
			<div class="formField">
				<input type="text" id="foofield" name="foo" value="bar" />
			</div>
			<div style="clear:both;" ></div>

			<div class="formLabel">Normal field 1:</div>
			<div class="formField">
				<input type="file" id="upFile_standard" name="upFile_standard" value="" />			</div>
			<div style="clear:both;" ></div>

			<div class="formLabel">Normal field 2:</div>
			<div class="formField">
					<input type="file" id="upFile_standard2" name="upFile_standard2" value="" />
			</div>
			<div style="clear:both;" ></div>
			<div class="formLabel">&nbsp;</div>
			<div class="formField"><input id="uploadBtn" type="button" onclick="xajax_uploader(xajax.getFormValues('upload_form'));" value="upload file"/></div>
			<div style="clear:both;" ></div>


			<div style="clear:both;" ></div>
			<div class="formLabel">&nbsp;</div>
			<div class="formField"><input id="uploadBtn" type="button" onclick="xajax_destroyform('upload_form');" value="destroy form"/></div>
			<div style="clear:both;" ></div>


		</form>
	</div>

	<div id="response">
		<h2>response</h2>
		<div id="results">
		</div>
	</div>
	<div style="clear:both;" ></div>

	<div id="docs">
	<h2>XAJAX SWFupload Plugin 0.2.2</h2>
	<br />
		<p>
			This plugin allows uploading files using the <a href="http://swfupload.org">SWFUpload JavaScript/Flash library</a>. You can easily convert your existing input fields into 'swf upload fields'.
			SWFUpload offers many configuration settings to limit all kind of file parameters (size,type,number,..) and leaves the UI to the browser.<br />
			<br />
			Please note this plugin is not yet compatible with FLASH 10. Adobe made a few changes to make it more 'secure', but these changes broke SWFupload completety.<br />
			I'm going to update this plugin as soon as SWFupload.org has a stable release online. The next version will (due to the changes in flash10) consume more memory. At the moment
			a single instance of the flash file handles all uploads, regardless how many upload fields you have. The next version will create one instance of the flash movie per upload field. This cannot be changed! Unfortunately :(<br /><br />
			If you'r not comfortable with this change please blame Adobe.<br />
		</p>
		
		<h3>changelog</h3>

		<div>2008-10-28 vers 0.2.2</div>
		<ul>
			<li>compatibility fix for xajax 0.5 rc2</li>
		</ul>

		<div>2008-04-11 vers 0.2.1</div>
		<ul>
			<li>fixed bug were response wasn't processed in IE</li>
		</ul>

		<div>2008-04-10 vers 0.2</div>
		<ul>
			<li>changed base class to xajaxResponsePlugin</li>
			<li>added response function to transform forms/fields via xajax</li>
			<li>added destroy function to unload swf movie and containers</li>
			<li>added response functions for destroying fields/forms</li>
			<li>added callback events</li>
			<li>added config parameter 'multiple'</li>
			<li>added compressed JS files</li>
			<li>fixed bug in upload rate</li>
			<li>fixed bug where xajax request wasn't send when queue was empty</li>
		</ul>
		<div>2008-04-07 vers 0.1</div>
		<ul>
			<li>first release</li>
		</ul>
		<h3>supported configurations</h3>
		<ul>
			<li>PHP 5.x</li>
			<li>any webserver</li>
			<li>Flash 9</li>
			<li>Xajax 0.5</li>
		</ul>
		<h3>install</h3>
		<p>
			Just copy the "swfupload" folder into your xajax install below /xajax/xajax_plugins/request/.<br />
			If you have downloaded the full package just replace your old xajax install with the provided xajax folder. Do not copy the new folder into the old one!<br />
			<strong>This plugin is not compatible with xajax 0.5beta4 or lower, please use the latest xajax vers from the <a href="http://xajaxproject.org">xajax website</a> or SVN instead.</strong>
			
		</p>
		<h3>usage</h3>
		
		<p><a href="#config">configuration</a></p>
		<p><a href="#register">function registration</a></p>
		<p><a href="#js_api">JavaScript functions</a></p>
		<p><a href="#response_functions">response functions</a></p>
		
		<p>
			include the plugin right after the xajax object instantiation and before configuring xajax. 
		</p>
		<a name="config"></a>
<pre>$xajax = new xajax();
require_once './xajax/xajax_plugins/request/swfupload/swfupload.inc.php';
$xajax->configure("javascript URI","/swfupload/xajax/");</pre>

		<a name="register"></a>
		<h3>function registration</h3>
		<p>
			You can turn any xajax enabled function into an upload function by setting the mode to 'SWFupload':
		</p>
<pre>
$xajax->register(
	XAJAX_FUNCTION,
	"my_upload_function",
	array("mode" => "'SWFupload'", "SWFfield" => 'my_field_id',"SWFform" => 'my_form_id')
);</pre>
		<p>
			The "mode" is required to enable file uploading via SWF. Both other parameters are optional.
			When setting for instance "SWFfield" => 'field_id' it will only upload the file queue of the given field. 
			The same applies for "SWFform" => 'my_form_id', with the exception that it will upload all queues from all file inputs inside the given form.<br />
			<br />
			You can only set either SWFform or SWFfield. Without setting one of these values the function will upload all files from all queues!
		</p>
		<p>To trigger the upload you only have to call the generated xajax function stub (xajax_ + function name). You can even pass additional values:
<pre>
&lt;input type="submit" value="upload" onclick"xajax_my_upload_function(xajax.getFormValues('my_form'),'foo','bar');" &gt;
</pre>
		<a name="js_api"></a>
		<h3>Javascript functions</h3>
		<p>The plugin provides two helper functions that will turn any file input fields into 'flash upload fields'.<br /></p>
		<ul>
			<li>xajax.ext.SWFupload.tools.transForm(form_id [String], config [optional Object], multiple [bool optional])</li>
			<li>xajax.ext.SWFupload.tools.transField(element_id [String], config [optional Object]), multiple [bool optional])</li>
		</ul>
		<h4>xajax.ext.SWFupload.tools.transForm</h4>
		<p>This function parses the given form and replaces all file input fields inside the form.</p>

<pre>
 xajax.ext.SWFupload.tools.transForm('upload_form',{
		file_types : "*.jpg;*.gif", 
		file_types_description: "Web Image Files",
		file_size_limit : "3 MB"
 		},
 	true
 	);</pre>


		<h4>xajax.ext.SWFupload.tools.transField</h4>
		<p>This function replaces the given input field.</p>

<pre>
 xajax.ext.SWFupload.tools.transField('upload_field_id',{
		file_types : "*.jpg;*.gif", 
		file_types_description: "Web Image Files",
		file_size_limit : "3 MB"
		},
	false
 	);</pre>
		<p>Both functions support passing an optional config object and the 'multiple' option.</p>
		<p>Setting the multiple option to <i>true</i> enables selecting multiple files at once</p>
		<p>The full	reference for all configuration parameters can be found here: <a href="http://demo.swfupload.org/Documentation/#settingsobject">SWFUpload docs</a></p>
		<br />

		<h4>xajax.ext.SWFupload.tools.destroyField</h4>
		<p>This function destroys the given input field and its associated objects.</p>
		<pre>xajax.ext.SWFupload.tools.destroyField(field_id);</pre>
		<br />		
		<h4>xajax.ext.SWFupload.tools.destroyForm</h4>
		<p>This function destroys the all fields and its associated objects of the given form.</p>
		<pre>xajax.ext.SWFupload.tools.destroyForm(form_id);</pre>
		<br />		
		
		
		<a name="response_functions"></a>
		<h3>response functions</h3>
		<p>
		All JavaScript functions are also available via xajax response commands.
		</p>
		<ul>
			<li>$objResponse->clsSwfUpload->transForm($form_id,$config,$multiple)</li>
			<li>$objResponse->clsSwfUpload->transField($input_id,$config,$multiple)</li>
			<li>$objResponse->clsSwfUpload->destroyField($field_id)</li>
			<li>$objResponse->clsSwfUpload->destroyForm($form_id)</li>
		

<pre>
$objResponse->clsSwfUpload->transForm('upload_form'
	,array(
		"file_types" => "*.jpg;*.gif;*.png;"
		,"file_types_description" => "Image Files or mp3"
		,"file_size_limit" => "5 MB"
		,"upload_complete_handler" => "function () {
		}"
		,"post_params" => array(
			"PHPSESSID" => session_id()
		)
	)
	, true
	);	
</pre>						
		
		

	</div>


	<div id="copyright">
	Copyright (c) 2008 by Steffen Konerow <br />
	</div>
	

</body>
</html>

