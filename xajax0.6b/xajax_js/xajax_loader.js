
if('undefined'==typeof xajax)
xajax={};if('undefined'==typeof xajax.config){console.log('xajax_loader config create');xajax.config={};}
xajax.default_config={commonHeaders:{'If-Modified-Since':'Sat, 1 Jan 2000 00:00:00 GMT'}
,postHeaders:{}
,getHeaders:{}
,waitCursor:false
,statusMessages:false
,'baseDocument':document
,'requestURI':document.URL
,defaultMode:'asynchronous'
,defaultHttpVersion:'HTTP/1.1'
,defaultContentType:'application/x-www-form-urlencoded'
,defaultResponseDelayTime:1000
,defaultExpirationTime:10000
,defaultMethod:'POST'
,defaultRetry:5
,defaultReturnValue:false
,maxObjectDepth:20
,maxObjectSize:2000
,responseQueueSize:1000
};xajax.config.setDefaults=function(){for(a in xajax.default_config){if('undefined'==typeof xajax.config[a]){xajax.config[a]=xajax.default_config[a];}
else{console.log('defined '+a);}
}
}
xajax.config.setDefault=function(option,defaultValue){if('undefined'==typeof xajax.config[option])
xajax.config[option]=defaultValue;}
xajax.isLoaded=true;xajax.config.setDefaults();xajax.loadCore=function(){console.log(this.callee.toString());var ownName=arguments.callee.toString();ownName=ownName.substr('function '.length);ownName=ownName.substr(0,ownName.indexOf('('));console.log(ownName);var oDoc=xajax.config.baseDocument;var objHead=oDoc.getElementsByTagName('head');var objScript=oDoc.createElement('script');objScript.src=xajax.config.JavaScriptURI+"xajax_js/xajax_core.js";objScript.type='text/javascript';objHead[0].appendChild(objScript);xajax.isLoaded=false;var args=arguments;}
function foo(){console.log(this);var ownName=arguments.callee.toString();ownName=ownName.substr('function '.length);ownName=ownName.substr(0,ownName.indexOf('('));console.log(ownName);var args=arguments;window.setTimeout(function(){console.log(args.callee.toString());});}
xajax.request=foo;function x(){foo();}
x();