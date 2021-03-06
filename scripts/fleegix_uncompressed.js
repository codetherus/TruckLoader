/*
 * Copyright 2006 Matthew Eernisse (mde@fleegix.org)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
*/
if (typeof fleegix == 'undefined') { var fleegix = {}; }

if (typeof $ == 'undefined') {
  var $ = function (s) { return document.getElementById(s); }
}

var $elem = function (s, o) {
  var opts = o || {};
  var elem = document.createElement(s);
  for (var p in opts) {
    elem[p] = opts[p];
  }
  return elem;
};

var $text = function (s) {
  return document.createTextNode(s);
};

fleegix.extend = function (/* Super-class constructor function */ superClass,
  /* Sub-class constructor function */ subClass) {
  return function () {
    superClass.apply(this, arguments);
    superClass.prototype.constructor.apply(this, arguments);
    subClass.apply(this, arguments);
    this.superClass = superClass;
    this.subClass = subClass
  };
};

fleegix.mixin = function (/* Target obj */ target,
  /* Obj of props or constructor */ mixin) {
  // Create an instance if we get a constructor
  var m;
  if (typeof mixin == 'function') {
    m = new mixin();
  }
  else {
    m = mixin;
  }
  var baseObj = {};
  for (var p in m) {
    // Don't copy anything from Object.prototype
		if (typeof baseObj[p] == 'undefined' || baseObjj[p] != m[p]) {
      target[p] = m[p];
    }
  }
  return target;
};

// Note this doesn't check for cyclical references
fleegix.clone = function (o) {
  if (typeof o == 'object') {
    var ret;
    if (typeof o.constructor == 'function') {
      ret = new o.constructor();
    }
    else {
      ret = {};
    }
    for (var p in o) {
      if (typeof o[p] == 'object' && o[p] != null) {
        ret[p] = fleegix.clone(o[p]);
      }
      else {
        ret[p] = o[p];
      }
    }
  }
  else {
    ret = o;
  }
  return ret;
};

// This stuff gets run inline below, props added to 
// base 'fleegix' obj -- namespaced to avoid global refs
// Some code taken from the Dojo loader
fleegix.agentSniffing = new function () {
  var f = fleegix; // Alias the base 'fleegix' obj
  var n = navigator;
  var ua = n.userAgent;
  var av = n.appVersion;
  f.isOpera = (ua.indexOf("Opera") > -1);
  f.isKhtml = (av.indexOf("Konqueror") > -1) ||
    (av.indexOf("Safari") > -1);
  f.isSafari = (av.indexOf("Safari") > -1);
  f.isMoz = ((ua.indexOf('Gecko') > -1) && (!f.isKhtml));
  f.isFF = false;
  f.isIE = false;
  try {
    if (f.isMoz) {
      f.isFF = (ua.indexOf('Firefox') > -1);
    }
    if ((document.all) && (!f.isOpera)) {
      f.isIE = (ua.indexOf('MSIE ') > -1);
    }
  } 
  // Squelch
  catch(e) {}
  f.isMac = (ua.indexOf('Mac') > -1);
  f.isUnix = (ua.indexOf('Linux') > -1) ||
    (ua.indexOf('BSD') > -1) || (ua.indexOf('SunOS') > -1);
  f.isLinux = (ua.indexOf('Linux') > -1);
  f.isWindows = (ua.indexOf('Windows') > -1);
};



fleegix.fx = new function () {
  // Private functions
  function doBlind(elem, opts, dir) {
    var o = {};
    var s = 0;
    var e = 0;
    // Just clip
    if (opts.blindType == 'clip') {
      s = dir == 'down' ? 0 : elem.offsetHeight;
      e = dir == 'down' ? elem.offsetHeight : 0;
      s = [0, elem.offsetWidth, s, 0];
      e = [0, elem.offsetWidth, e, 0];
      o.props = { clip: [s, e] };
    }
    // Change actual height -- requires ending
    // height for down direction
    else {
      if (dir == 'down') {
        // Allow an explicit target height to be passed
        // to avoid touching DOM, and for speed
        if (opts.endHeight) {
            e = opts.endHeight;
        }
        // If no explicit height is passed, temporarily
        // remove any height set and temp append to the
        // DOM to measure end height
        else {
            // Remove the style
            elem.style.height = '';
            // Dummy DOM node
            var d = document.createElement('div');
            d.position = 'absolute';
            d.style.top = '-9999999999px';
            d.style.left = '-9999999999px';
            // Remove from parent node, append to dummy node
            var par = elem.parentNode;
            var ch = par.removeChild(elem);
            d.appendChild(ch);
            document.body.appendChild(d);
            // This is how high it will be
            e = ch.offsetHeight;
            // Remove from dummy node, set height to zero,
            // and put it back where it was
            elem = d.removeChild(ch);
            var x = document.body.removeChild(d);
            elem.style.height = '0px';
            par.appendChild(elem);
        }
        s = 0;
      }
      else {
        s = elem.offsetHeight;
        e = 0;
      }
      o.props = { height: [s, e] };
    }
    for (var p in opts) {
      o[p] = opts[p];
    }
    o.trans = 'lightEaseIn';
    return new fleegix.fx.Effecter(elem, o);
  }
  function doFade(elem, opts, dir) {
    var s = dir == 'in' ? 0 : 100;
    var e = dir == 'in' ? 100 : 0;
    var o = {
      props: { opacity: [s, e] },
      trans: 'lightEaseIn' };
    for (var p in opts) {
      o[p] = opts[p];
    }
    return new fleegix.fx.Effecter(elem, o);
  }
  // Public (interface) methods
  this.fadeOut = function (elem, opts) {
    return doFade(elem, opts, 'out');
    elem.style.visibility = 'hidden';
    var sync = this.setCssProp(elem, 'opacity', 100);
  };
  this.fadeIn = function (elem, opts) {
    var sync = this.setCssProp(elem, 'opacity', 0);
    elem.style.visibility = 'visible';
    return doFade(elem, opts, 'in');
  };
  this.blindUp = function (elem, opts) {
    var o = opts || {};
    o.blindType = o.blindType || 'height';
    return doBlind(elem, o, 'up');
  };
  this.blindDown = function (elem, opts) {
    var o = opts || {};
    o.blindType = o.blindType || 'height';
    return doBlind(elem, o, 'down');
  };
  this.setCSSProp = function (elem, p, v) {
    if (p == 'opacity') {
      // IE uses a whole number as a percent
      if (document.all) {
        elem.style.filter = 'alpha(opacity=' + v + ')';
      }
      // Moz/compat uses a decimal value
      else {
        var d = v / 100;
        elem.style.opacity = d;
      }
    }
    else if (p == 'clip' || p.toLowerCase().indexOf('color') > -1) {
      elem.style[p] = v;
    }
    else {
      elem.style[p] = document.all ?
        parseInt(v, 10) + 'px' : v + 'px';
    }
    return true;
  };
  this.setCssProp = this.setCSSProp; // Alias, I'm a 'tard and can't remember
  this.hexPat = /^[#]{0,1}([\w]{1,2})([\w]{1,2})([\w]{1,2})$/;
  this.hex2rgb = function (str) {
    var rgb = [];
    var h = str.match(this.hexPat);
    if (h) {
      for (var i = 1; i < h.length; i++) {
        var s = h[i];
        s = s.length == 1 ? s + s : s;
        rgb.push(parseInt(s, 16));
      }
      return rgb;
    }
    else {
      throw('"' + str + '" not a valid hex value.');
    }
  };
};

fleegix.fx.Effecter = function (elem, opts) {
  var _this = this;
  this.props = opts.props;
  this.trans = opts.trans || 'lightEaseIn';
  this.duration = opts.duration || 500;
  this.fps = 30;
  this.startTime = new Date().getTime();
  this.timeSpent = 0;
  this.doBeforeStart = opts.doBeforeStart || null;
  this.doAfterFinish = opts.doAfterFinish || null;
  this.autoStart = opts.autoStart === false ? false : true;

  if (typeof this.transitions[this.trans] != 'function') {
    throw('"' + this.trans + '" is not a valid transition.');
  }

  this.start = function () {
    _this.id = setInterval( function () {
      _this.doStep.apply(_this, [elem]); },
      Math.round(1000/_this.fps));
    // Run the pre-execution func if any
    if (typeof opts.doBeforeStart == 'function') {
      _this.doBeforeStart();
    }
  };
  // Fire it up unless auto-start turned off
  if (this.autoStart) {
    this.start();
  }
  return this;
};

fleegix.fx.Effecter.prototype.doStep = function (elem) {
  var t = new Date().getTime();
  var p = this.props;
  // Still going ...
  if (t < (this.startTime + this.duration)) {
    this.timeSpent = t - this.startTime;
    for (var i in p) {
      fleegix.fx.setCSSProp(elem, i, this.calcCurrVal(i));
    }
  }
  // All done, ya-hoo
  else {
    // Make sure to end up on the final values
    for (var i in p) {
      if (i == 'clip') {
        fleegix.fx.setCSSProp(elem, i, 'rect(' + p[i][1].join('px,') + 'px)');
      }
      else {
        fleegix.fx.setCSSProp(elem, i, p[i][1]);
      }
    }
    clearInterval(this.id);
    // Run the post-execution func if any
    if (typeof this.doAfterFinish == 'function') {
      this.doAfterFinish();
    }
  }
};

fleegix.fx.Effecter.prototype.calcCurrVal = function (key) {
  var startVal = this.props[key][0];
  var endVal = this.props[key][1];
  var trans = this.transitions[this.trans];
  var arrStart;
  var arrEnd;
  var arrCurr;
  var s; var e;
  if (key.toLowerCase().indexOf('color') > -1) {
    arrStart = fleegix.fx.hex2rgb(startVal);
    arrEnd = fleegix.fx.hex2rgb(endVal);
    arrCurr = [];
    for (var i = 0; i < arrStart.length; i++) {
      s = arrStart[i];
      e = arrEnd[i];
      arrCurr.push(parseInt(trans(this.timeSpent, s, (e - s),
        this.duration), 10));
    }
    return 'rgb(' + arrCurr.join() + ')';
  }
  else if (key == 'clip') {
    arrStart = startVal;
    arrEnd = endVal;
    arrCurr = [];
    for (var i = 0; i < arrStart.length; i++) {
      s = arrStart[i];
      e = arrEnd[i];
      arrCurr.push(parseInt(trans(this.timeSpent, s, (e - s), this.duration), 10));
    }
    return 'rect(' + arrCurr.join('px,') + 'px)';
  }
  else {
    return trans(this.timeSpent, startVal, (endVal - startVal),
      this.duration);
  }
};

// Credits: Easing Equations, (c) 2003 Robert Penner (http://www.robertpenner.com/easing/), Open Source BSD License.
fleegix.fx.Effecter.prototype.transitions = {
  // For all, t: current time, b: beginning value, c: change in value, d: duration
  // Simple linear, no easing
  linear: function (t, b, c, d) {
    return c*(t/d)+b;
  },
  // 'Light' is quadratic
  lightEaseIn: function (t, b, c, d) {
    return c*(t/=d)*t + b;
  },
  lightEaseOut: function (t, b, c, d) {
    return -c *(t/=d)*(t-2) + b;
  },
  lightEaseInOut: function (t, b, c, d) {
    if ((t/=d/2) < 1) { return c/2*t*t + b; }
    return -c/2 * ((--t)*(t-2) - 1) + b;
  },
  // 'Heavy' is cubic
  heavyEaseIn: function (t, b, c, d) {
    return c*(t/=d)*t*t + b;
  },
  heavyEaseOut: function (t, b, c, d) {
    return c*((t=t/d-1)*t*t + 1) + b;
  },
  heavyEaseInOut: function (t, b, c, d) {
    if ((t/=d/2) < 1) { return c/2*t*t*t + b; }
    return c/2*((t-=2)*t*t + 2) + b;
  }
};


fleegix.dom = new function() {
  var getViewportMeasure = function (s) {
    // IE
    if (document.all) {
      if (document.documentElement &&
        document.documentElement['client' + s]) {
        return document.documentElement['client' + s];
      }
      else {
        return document.body['client' + s];
      }
    }
    // Moz/compat
    else {
      return window['inner' + s];
    }
  };
  this.getViewportWidth = function () {
    return getViewportMeasure('Width');
  };
  this.getViewportHeight = function () {
    return getViewportMeasure('Height');
  };
  this.center = function (node) {
    var nW = node.offsetWidth;
    var nH = node.offsetHeight;
    var vW = fleegix.dom.getViewportWidth();
    var vH = fleegix.dom.getViewportHeight();
    var calcLeft = parseInt((vW/2)-(nW/2), 10);
    var calcTop = parseInt((vH/2)-(nH/2), 10);
    calcTop += document.documentElement.scrollTop;
    node.style.left = calcLeft + 'px';
    node.style.top = calcTop + 'px';
    return true;
  };
  /* Get absolute XY pos of a DOM node */
  this.getOffset = function(node){
    var _getCoords = function (obj) {
      var curleft = 0;
      var curtop = 0;
      if (obj.offsetParent) {
        do {
          curleft += obj.offsetLeft;
          curtop += obj.offsetTop;
        } while (obj = obj.offsetParent);
      }
      return { left: curleft, top: curtop };
    };
    var nodeCoords = null;
    //in IE and Mozilla we can use the
    // getBoundingClientRect()
    if (fleegix.isIE || fleegix.isMoz) {
      nodeCoords = node.getBoundingClientRect();
    }
    else {
      nodeCoords = _getCoords(node);
    }
    return nodeCoords;
  };
};


fleegix.css = new function() {
    this.addClass = function (elem, s) {
      fleegix.css.removeClass(elem, s); // Don't add twice
      var c = elem.className;
      c += ' ' + s;
      c = fleegix.string.trim(c);
      elem.className = c;
    };
    this.removeClass = function (elem, s) {
      var c = elem.className;
      // Esc backslashes in regex pattern
      var pat = '\\b' + s + '\\b';
      // Do global search -- shouldn't be multiple
      // instances of the selector, but who knows
      pat = new RegExp(pat, 'g');
      c = c.replace(pat, '');
      c = c.replace('  ', ' ');
      c = fleegix.string.trim(c);
      elem.className = c;
    };
    this.replaceClass = function (elem, oldClass, newClass) {
      this.removeClass(elem, oldClass);
      this.addClass(elem, newClass);
    };
};


fleegix.event = new function () {
  // List of handlers for event listeners
  var listenerCache = [];
  // List of channels being published to
  var channels = {};

  // If set to true the listener registry is set on
  // the obj itself instead of being hidden on the
  // handler function. This makes it visible/ennumerable
  // but other toolkits' event systems will be less likely
  // to break stuff if it's turned on
  this.compatibilityMode = false;

  this.listen = function () {
    var obj = arguments[0]; // Target object for the new listener
    var meth = arguments[1]; // Method to listen for
    var compatMode = this.compatibilityMode;

    // Simple function
    var r = {}; // package of info about what to execute
    var o = {}; // options -- stopPropagation or preventDefault
    if (typeof arguments[2] == 'function') {
      r.method = arguments[2];
      o = arguments[3] || {};
    }
    // Object and method
    else {
      r.context = arguments[2];
      r.method = arguments[3];
      o = arguments[4] || {};
    }

    if (!obj) { 
      throw new Error('fleegix.listen called on an object (' +
        obj + ') that does not exist.'); }

    // Add dummy onmousewheel that allows us to fake
    // old-school event registration with Firefox's
    // XUL mousewheel event
    if (meth == 'onmousewheel') {
      if (window.addEventListener &&
        typeof obj.onmousewheel == 'undefined') {
        obj.onmousewheel = null;
      }
    }

    // Look to see if there's already a handler and
    // registry of listeners
    var listenReg;
    if (this.compatibilityMode) {
      if (obj[meth] && obj._fleegixEventListenReg) {
        listenReg = obj._fleegixEventListenReg[meth];
      }
      else {
        listenReg = null;
      }
    }
    else {
      listenReg = obj[meth] ? obj[meth].listenReg : null;
    }
    // Create the registry of handlers if it does not exist
    // It will contain all the info needed to run all the attached
    // handlers -- hanging this property on the actual handler
    // (e.g. onclick, onmousedown, onload) to avoid adding visible
    // properties on the object.
    // -----------------
    if (!listenReg) {
      listenReg = {};
      // The original obj and method name
      listenReg.orig = {};
      listenReg.orig.obj = obj;
      listenReg.orig.methName = meth;
      // Preserve any existing listener
      if (obj[meth]) {
        listenReg.orig.methCode = obj[meth];
      }
      // Array of handlers to execute if the method fires
      listenReg.after = [];
      // Replace the original method with the executor proxy
      obj[meth] = function () {
        var reg = compatMode ? obj._fleegixEventListenReg[meth] : obj[meth].listenReg;
        if (!reg) {
          if (obj['_' + meth + '_suppressErrors']) {
            return false;
          }
          else {
            throw new Error('Cannot execute handlers for ' + obj + '  "' +
              meth + '". Something' +
              ' (likely another JavaScript library) has' +
              ' removed the fleegix.event.listen handler registry.');
          }
        }
        var args = [];
        for (var i = 0; i < arguments.length; i++) {
          args.push(arguments[i]);
        }

        // Try to be a good citizen -- preserve existing listeners
        // Execute with arguments passed, in the right execution context
        if (reg.orig.methCode) {
          reg.orig.methCode.apply(reg.orig.obj, args);
        }
        // DOM events
        // Normalize the different event models
        var ev = null;
        if (obj.attachEvent || obj.nodeType ||
          obj.addEventListener) {
          // Try to find an event if we're not handed one
          if (!args.length) {
            try {
              switch (true) {
                case !!(obj.ownerDocument):
                  ev = obj.ownerDocument.parentWindow.event;
                  break;
                case !!(obj.documentElement):
                  ev = obj.documentElement.ownerDocument.parentWindow.event;
                  break;
                case !!(obj.event):
                  ev = obj.event;
                  break;
                default:
                  ev = window.event;
                  break;
              }
            }
            catch(e) {
              ev = window.event;
            }
          }
          else {
            ev = args[0];
          }
          if (ev) {
            // Set both target and srcElement
            if (typeof ev.target == 'undefined') {
              ev.target = ev.srcElement;
            }
            if (typeof ev.srcElement == 'undefined') {
              ev.srcElement = ev.target;
            }
            // Handle delta differences for mousewheel
            if (ev.type == 'DOMMouseScroll' || ev.type == 'mousewheel') {
              if (ev.wheelDelta) {
                ev.delta = ev.wheelDelta / 120;
              }
              else if (ev.detail) {
                ev.delta = -ev.detail / 3;
              }
            }
            args[0] = ev;
          }
        }
        // Execute all the handler functions registered
        for (var i = 0; i < reg.after.length; i++) {
          var ex = reg.after[i];
          var f = null; // Func to execute
          var c = null; // Execution context
          // Single functions
          if (!ex.context) {
            f = ex.method;
            c = window;
          }
          // Methods of objects
          else {
            f = ex.context[ex.method];
            c = ex.context;
          }
          // Make sure there's something to execute
          if (typeof f != 'function') {
            throw(f + ' is not an executable function.');
          }
          // Pass args and exec in correct scope
          else {
            f.apply(c, args);
          }
          ev = args[0];
          // Stop propagation if needed
          if (ex.stopPropagation) {
            this.stopPropagation(ev);
          }
          // Prevent the default action if needed
          if (ex.preventDefault) {
            this.preventDefault(ev);
          }
        }

      }
      if (this.compatibilityMode) {
        if (!obj._fleegixEventListenReg) { obj._fleegixEventListenReg = {}; }
        obj._fleegixEventListenReg[meth] = listenReg;
      }
      else {
        obj[meth].listenReg = listenReg;
      }
      // Add to global cache -- so we can remove listeners on unload
      listenerCache.push(listenReg);
      // Add XUL event for Firefox mousewheel
      if (meth == 'onmousewheel') {
        if (window.addEventListener) {
          obj.addEventListener('DOMMouseScroll', obj.onmousewheel, false);
        }
      }
    }
    
    // Add the new handler to the listener registry
    listenReg.after.push(r);
    if (this.compatibilityMode) {
      if (!obj._fleegixEventListenReg) { obj._fleegixEventListenReg = {}; }
      obj._fleegixEventListenReg[meth] = listenReg;
    }
    else {
      obj[meth].listenReg = listenReg;
    }
  };
  this.unlisten = function () {
    var obj = arguments[0]; // Obj from which to remove
    var meth = arguments[1]; // Trigger method
    var listenReg;
    if (this.compatibilityMode) {
      if (obj[meth] && obj._fleegixEventListenReg) {
        listenReg = obj._fleegixEventListenReg[meth];
      }
      else {
        listenReg = null;
      }
    }
    else {
      listenReg = obj[meth] ? obj[meth].listenReg : null;
    }
    var remove = null;

    // Bail out if no handlers set
    if (!listenReg) {
      return false;
    }
    // Remove the handler if it's in the list
    for (var i = 0; i < listenReg.after.length; i++) {
      var r = listenReg.after[i];
      // Simple function
      if (typeof arguments[2] == 'function') {
        if (r.method == arguments[2]) {
          listenReg.after.splice(i, 1);
          break; // Only remove one instance per unlisten call
        }
      }
      // Object and method
      else {
        if (r.context == arguments[2] && r.method ==
          arguments[3]) {
          listenReg.after.splice(i, 1);
          break; // Only remove one instance per unlisten call
        }
      }
    }
    if (this.compatibilityMode) {
      obj._fleegixEventListenReg[meth] = listenReg;
    }
    else {
      obj[meth].listenReg = listenReg;
    }
  };
  this.flush = function () {
    // Remove all the registered listeners
    for (var i = 0; i < listenerCache.length; i++) {
      var reg = listenerCache[i];
      removeObj = reg.orig.obj;
      removeMethod = reg.orig.methName;
      removeObj[removeMethod] = null;
    }
  };
  this.subscribe = function(subscr, obj, method) {
    // Make sure there's an obj param
    if (!obj) { return; }
    // Create the channel if it doesn't exist
    if (!channels[subscr]) {
      channels[subscr] = {};
      channels[subscr].audience = [];
    }
    else {
      // Remove any previous listener method for the obj
      this.unsubscribe(subscr, obj);
    }
    // Add the object and its handler to the array
    // for the channel
    channels[subscr].audience.push([obj, method]);
  };
  this.unsubscribe = function(unsubscr, obj) {
    // If not listener obj specified, kill the
    // entire channel
    if (!obj) {
      channels[unsubscr] = null;
    }
    // Otherwise remove the object and its handler
    // from the array for the channel
    else {
      if (channels[unsubscr]) {
        var aud = channels[unsubscr].audience;
        for (var i = 0; i < aud.length; i++) {
          if (aud[i][0] == obj) {
             aud.splice(i, 1);
          }
        }
      }
    }
  };
  this.publish = function(pub, data) {
    // Make sure the channel exists
    if (channels[pub]) {
      var aud = channels[pub].audience;
      // Pass the published data to all the
      // obj/methods listening to the channel
      for (var i = 0; i < aud.length; i++) {
        var listenerObject = aud[i][0];
        var handlerMethod = aud[i][1];
        listenerObject[handlerMethod](data);
      }
    }
  };
  // Convenience method for getting a the source
  // element of an event or its parent based on
  // a particular property
  this.getSrcElementByAttribute = function(e, prop) {
    var node;
    if (e.srcElement) { node = e.srcElement; }
    else if (e.target) { node = e.target; }
    // Avoid trying to use fake obj from IE on disabled
    // form elements
    if (!node || typeof node[prop] == 'undefined') {
      return null;
    }
    // Look up the id of the elem or its parent
    else {
      // Look for something with an id -- not a text node
      while (!node[prop] || node.nodeType == 3) {
        // Bail if we run out of parents
        if (node.parentNode) {
          node = node.parentNode;
        }
        else {
          return null;
        }
      }
    }
    return node;
  };
  this.getSrcElementId = function (e) {
    var node = this.getSrcElementByAttribute(e, 'id') || null;
    return node.id || null;
  };
  this.annihilate = function (e) {
    this.stopPropagation(e);
    this.preventDefault(e);
  };
  this.stopPropagation = function (e) {
    if (e.stopPropagation) {
      e.stopPropagation();
    }
    else {
      e.cancelBubble = true;
    }
    return e;
  };
  this.preventDefault = function (e) {
    if (e.preventDefault) {
      e.preventDefault();
    }
    else {
      e.returnValue = false;
    }
    return e;
  };
  // If there are known problems looking up the listener registry
  // for a particular handler, this will allow the execution to 
  // fail silently instead of throwing errors alerting the user
  // that listening functions are not being triggered correctly.
  // Used in cases where listeners are being addded to windows
  // where document.domain is changed on the fly, which causes
  // lookup of .listenReg to fail
  this.suppressHandlerErrors = function (obj, meth) {
    obj['_' + meth + '_suppressErrors'] = true;
  };
};
// Clean up listeners
fleegix.event.listen(window, 'onunload', fleegix.event, 'flush');


fleegix.uri = new function () {
  var self = this;

  this.params = {};

  this.getParamHash = function (str) {
    var q = str || self.getQuery();
    var d = {};
    if (q) {
      var arr = q.split('&');
      for (var i = 0; i < arr.length; i++) {
        var pair = arr[i].split('=');
        var name = pair[0];
        var val = pair[1];
        if (typeof d[name] == 'undefined') {
          d[name] = val;
        }
        else {
          if (!(d[name] instanceof Array)) {
            var t = d[name];
            d[name] = [];
            d[name].push(t);
          }
          d[name].push(val);
        }
      }
    }
    return d;
  };
  this.getParam = function (name, str) {
    var p = null;
    if (str) {
      var h = this.getParamHash(str);
      p = h[name];
    }
    else {
      p = this.params[name];
    }
    return p;
  };
  this.setParam = function (name, val, str) {
    var ret = null;
    // If there's a query string, set the param
    if (str) {
      var pat = new RegExp('(^|&)(' + name + '=[^\&]*)(&|$)');
      var arr = str.match(pat);
      // If it's there, replace it
      if (arr) {
        ret = str.replace(arr[0], arr[1] + name + '=' + val + arr[3]);
      }
      // Otherwise append it
      else {
        ret = str + '&' + name + '=' + val;
      }
    }
    // Otherwise create a query string with just that param
    else {
      ret = name + '=' + val;
    }
    return ret;
  };
  this.getQuery = function (s) {
    var l = s ? s : location.href;
    return l.split('?')[1];
  };
  this.getBase = function (s) {
    var l = s ? s : location.href;
    return l.split('?')[0];
  };
  this.params = this.getParamHash();
};

fleegix.xhr = new function () {
  // Public vars
  // ================================
  // Maximum number of XHR objects to spawn to handle requests
  // Moz/Safari seem to perform significantly better with XHR
  // re-use, IE -- not so much
  this.maxXhrs = 5;
  // Used to increment request IDs -- these may be used for
  // externally tracking or aborting specific requests
  this.lastReqId = 0;
  // Show exceptions for connection failures
  this.debug = false;
  // Default number of seconds before a request times out
  this.defaultTimeoutSeconds = 300;
  // If set to true, use the default err handler for sync requests
  // If false, failures always hand back the whole request object
  this.useDefaultErrHandlerForSync = true;
  // Possible formats for the XHR response
  this.responseFormats = { TXT: 'text',
   XML: 'xml',
   OBJ: 'object' };

  // Public methods
  // ================================
  this.get = function () {
    var o = {};
    var hand = null;
    var args = Array.prototype.slice.apply(arguments);
    if (typeof args[0] == 'function') {
      o.async = true;
      hand = args.shift();
    }
    else {
      o.async = false;
    }
    var url = args.shift();
    // Passing in keyword/obj after URL
    if (typeof args[0] == 'object') {
      var opts = args.shift();
      for (var p in opts) {
        o[p] = opts[p];
      }
    }
    // Normal order-based params of URL, [responseFormat]
    else {
      o.responseFormat = args.shift() || 'text';
    }
    o.handleSuccess = hand;
    o.url = url;
    return this.doReq(o);
  };
  this.doGet = function () {
    return this.get.apply(this, arguments);
  }
  this.post = function () {
    var o = {};
    var hand = null;
    var args = Array.prototype.slice.apply(arguments);
    if (typeof args[0] == 'function') {
      o.async = true;
      hand = args.shift();
    }
    else {
      o.async = false;
    }
    var url = args.shift();
    var data = args.shift();
    // Passing in keyword/obj after URL
    if (typeof args[0] == 'object') {
      var opts = args.shift();
      for (var p in opts) {
        o[p] = opts[p];
      }
    }
    // Normal order-based params of URL, [responseFormat]
    else {
      o.responseFormat = args.shift() || 'text';
    }
    o.handleSuccess = hand;
    o.url = url;
    o.data = data;
    o.method = 'POST';
    return this.doReq(o);
  };
  this.doPost = function () {
    return this.post.apply(this, arguments);
  }
  this.doReq = function (opts) {
    return this.send(opts);
  }
  this.send = function (o) {
    var opts = o || {};
    var req = new fleegix.xhr.Request();
    var xhrId = null;

    // Override default request opts with any specified
    for (var p in opts) {
      if (opts.hasOwnProperty(p)) {
        req[p] = opts[p];
      }
    }
    // HTTP req method all-caps
    req.method = req.method.toUpperCase();

    req.id = this.lastReqId;
    this.lastReqId++; // Increment req ID

    // Return request ID or response
    // Async -- handle request or queue it up
    // -------
    if (req.async) {
      // If we have an instantiated XHR we can use, let him handle it
      if (_idleXhrs.length) {
        xhrId = _idleXhrs.shift();
      }
      // No available XHRs -- spawn a new one if we're still
      // below the limit
      else if (_xhrs.length < this.maxXhrs) {
        xhrId = _spawnXhr();
      }

      // If we have an XHR xhr to handle the request, do it
      // xhrId should be a number (index of XHR obj in _xhrs)
      if (xhrId !== null) {
        _processReq(req, xhrId);
      }
      // No xhr available to handle the request -- queue it up
      else {
        // Uber-requests step to the front of the line, please
        if (req.uber) {
          _requestQueue.unshift(req);
        }
        // Normal queued requests are FIFO
        else {
          _requestQueue.push(req);
        }
      }
      // Return request ID -- may be used for aborting,
      // external tracking, etc.
      return req.id;
    }
    // Sync -- do request inlne and return actual result
    // -------
    else {
        return _processReq(req);
    }
  };
  this.abort = function (reqId) {
    var r = _processingMap[reqId];
    var t = _xhrs[r.xhrId];
    // Abort the req if it's still processing
    if (t) {
      // onreadystatechange can still fire as abort is executed
      t.onreadystatechange = function () { };
      t.abort();
      r.aborted = true;
      _cleanup(r);
      return true;
    }
    else {
      return false;
    }
  };
  // All the goofy normalization and logic to determine
  // what constitutes 'success'
  this.isReqSuccessful = function (obj) {
    var stat = obj.status;
    if (!stat) { return false; }
    // Handle stupid bogus URLMon "Operation Aborted"
    // code in IE for 204 no-content
    if (document.all && stat == 1223) {
      stat = 204;
    }
    if ((stat > 199 && stat < 300) || stat == 304) {
      return true;
    }
    else {
      return false;
    }
  };

  // Private vars
  // ================================
  var _this = this;
  // Prog ID for specific versions of MSXML -- caches after
  // initial req
  var _msProgId = null;
  // Used in response status test
  var _UNDEFINED_VALUE;
  // Array of XHR obj xhrs, spawned as needed up to
  // maxXhrs ceiling
  var _xhrs = [];
  // Queued-up requests -- appended to when all XHR xhrs
  // are in use -- FIFO list, XHR objs respond to waiting
  // requests immediately as then finish processing the current one
  var _requestQueue = [];
  // List of free XHR objs -- xhrs sit here when not
  // processing requests. If this is empty when a new request comes
  // in, we try to spawn a request -- if we're already at max
  // xhr number, we queue the request
  var _idleXhrs = [];
  // Hash of currently in-flight requests -- each string key is
  // the request id of the request
  // Used to abort processing requests
  var _processingMap = {};
  // Array of in-flight request for the watcher to iterate over
  var _processingArray = [];
  // The single XHR obj used for synchronous requests -- sync
  // requests do not participate in the request pooling
  var _syncXhr = null;
  // The single request obj used for sync requests, same
  // as above
  var _syncRequest = null;
  // The id for the setTimeout used in the the
  // request timeout watcher
  _processingWatcherId = null;

  // Private methods
  // ================================
  // The XHR object factory
  var _spawnXhr = function (isSync) {
    var i = 0;
    var t = [
      'Msxml2.XMLHTTP.6.0',
      'MSXML2.XMLHTTP.3.0',
      'Microsoft.XMLHTTP'
    ];
    var xhrObj = null;
    if (window.XMLHttpRequest) {
      xhrObj = new XMLHttpRequest();
    }
    else if (window.ActiveXObject) {
      if (_msProgId) {
        xhrObj = new ActiveXObject(_msProgId);
      }
      else {
        for (var i = 0; i < t.length; i++) {
          try {
            xhrObj = new ActiveXObject(t[i]);
            // Cache the prog ID, break the loop
            _msProgId = t[i]; break;
          }
          catch(e) {}
        }
      }
    }
    // Instantiate XHR obj
    if (xhrObj) {
      if (isSync) { return xhrObj; }
      else {
        _xhrs.push(xhrObj);
        var xhrId = _xhrs.length - 1;
        return xhrId;
      }
    }
    else {
      throw new Error('Could not create XMLHttpRequest object.');
    }
  };
  // This is the workhorse function that actually
  // sets up and makes the XHR request
  var _processReq = function (req, t) {
    var xhrId = null;
    var xhrObj = null;
    var url = '';
    var resp = null;

    // Async mode -- grab an XHR obj from the pool
    if (req.async) {
      xhrId = t;
      xhrObj = _xhrs[xhrId];
      _processingMap[req.id] = req;
      _processingArray.unshift(req);
      req.xhrId = xhrId;
    }
    // Sync mode -- use single sync XHR
    else {
      if (!_syncXhr) { _syncXhr = _spawnXhr(true); }
      xhrObj = _syncXhr;
      _syncRequest = req;
    }

    // Defeat the evil power of the IE caching mechanism
    if (req.preventCache) {
      var dt = new Date().getTime();
      url = req.url.indexOf('?') > -1 ? req.url + '&preventCache=' + dt :
        req.url + '?preventCache=' + dt;
    }
    else {
      url = req.url;
    }

    // Call 'abort' method in IE to allow reuse of the obj
    if (document.all) {
      xhrObj.abort();
    }

    // Set up the request
    // ==========================
    if (req.username && req.password) {
      xhrObj.open(req.method, url, req.async, req.username, req.password);
    }
    else {
      xhrObj.open(req.method, url, req.async);
    }
    // Override MIME type if necessary for Mozilla/Firefox & Safari
    if (req.mimeType && navigator.userAgent.indexOf('MSIE') == -1) {
      xhrObj.overrideMimeType(req.mimeType);
    }

    // Add any custom headers that are defined
    var headers = req.headers;
    for (var h in headers) {
      if (headers.hasOwnProperty(h)) {
        xhrObj.setRequestHeader(h, headers[h]);
      }
    }
    // Otherwise set correct content-type for POST
    if (req.method == 'POST' || req.method == 'PUT') {
      // Backward-compatibility
      req.data = req.data || req.dataPayload;
      // Firefox throws out the content-length
      // if data isn't present
      if (!req.data) {
        req.data = '';
      }
      // Set content-length for picky servers
      var contentLength = typeof req.data == 'string' ?
        req.data.length : 0;
      xhrObj.setRequestHeader('Content-Length', contentLength);
      // Set content-type to urlencoded if nothing
      // else specified
      if (typeof req.headers['Content-Type'] == 'undefined') {
        xhrObj.setRequestHeader('Content-Type',
          'application/x-www-form-urlencoded');
      }
    }
    // Send the request, along with any POST/PUT data
    // ==========================
    xhrObj.send(req.data);
    // ==========================
    if (_processingWatcherId === null) {
      _processingWatcherId = setTimeout(_watchProcessing, 10);
    }
    // Sync mode -- return actual result inline back to doReq
    if (!req.async) {
      // Blocks here
      var ret = _handleResponse(xhrObj, req);
      _syncRequest = null;
      // Start the watcher loop back up again if need be
      if (_processingArray.length) {
        _processingWatcherId = setTimeout(_watchProcessing, 10);
      }
      // Otherwise stop watching
      else {
        _processingWatcherId = null;
      }
      return ret;
    }
  };
  // Called in a setTimeout loop as long as requests are
  // in-flight, and invokes the handler for each request
  // as it returns
  var _watchProcessing = function () {
    var proc = _processingArray;
    var d = new Date().getTime();

    // Stop looping while processing sync requests
    // after req returns, it will start the loop back up
    if (_syncRequest !== null) {
      return;
    }
    else {
      for (var i = 0; i < proc.length; i++) {
        var req = proc[i];
        var xhrObj = _xhrs[req.xhrId];
        var isTimedOut = ((d - req.startTime) > (req.timeoutSeconds*1000));
        switch (true) {
          // Aborted requests
          case (req.aborted || !xhrObj.readyState):
            _processingArray.splice(i, 1);
            break;
          // Timeouts
          case isTimedOut:
            _processingArray.splice(i, 1);
            _timeout(req);
            break;
          // Actual responses
          case (xhrObj.readyState == 4):
            _processingArray.splice(i, 1);
            _handleResponse.call(_this, xhrObj, req);
            break;
        }
      }
    }
    clearTimeout(_processingWatcherId);
    if (_processingArray.length) {
      _processingWatcherId = setTimeout(_watchProcessing, 10);
    }
    else {
      _processingWatcherId = null;
    }
  };
  var _handleResponse = function (xhrObj, req) {
    // Grab the desired response type
    var resp;
    switch(req.responseFormat) {
      // XML
      case 'xml':
        resp = xhrObj.responseXML;
        break;
      // The object itself
      case 'object':
        resp = xhrObj;
        break;
      // Text
      case 'text':
      default:
        resp = xhrObj.responseText;
        break;
    }
    // If we have a One True Event Handler, use that
    // Best for odd cases such as Safari's 'undefined' status
    // or 0 (zero) status from trying to load local files or chrome
    if (req.handleAll) {
      req.handleAll(resp, req.id);
    }
    // Otherwise hand to either success/failure
    else {
      try {
        switch (true) {
          // Request was successful -- execute response handler
          case _this.isReqSuccessful(xhrObj):
            if (req.async) {
              // Make sure handler is defined
              if (!req.handleSuccess) {
                throw new Error('No response handler defined ' +
                  'for this request');
              }
              else {
                req.handleSuccess(resp, req.id);
              }
            }
            // Blocking requests return the result inline on success
            else {
              return resp;
            }
            break;
          // Status of 0 -- in FF, user may have hit ESC while processing
          case (xhrObj.status == 0):
            if (_this.debug) {
              throw new Error('XMLHttpRequest HTTP status is zero.');
            }
            break;
          // Status of null or undefined -- yes, null == undefined
          case (xhrObj.status == _UNDEFINED_VALUE):
            // Squelch -- if you want to get local files or
            // chrome, use 'handleAll' above
            if (_this.debug) {
              throw new Error('XMLHttpRequest HTTP status not set.');
            }
            break;
          // Request failed -- execute error handler or hand back
          // raw request obj
          default:
            // Blocking requests that want the raw object returned
            // on error, instead of letting the built-in handle it
            if (!req.async && !_this.useDefaultErrHandlerForSync) {
              return  resp;
            }
            else {
              if (req.handleErr) {
                req.handleErr(resp, req.id);
              }
              else {
                _handleErrDefault(xhrObj);
              }
            }
            break;
        }
      }
      // FIXME: Might be nice to try to catch NS_ERROR_NOT_AVAILABLE
      // err in Firefox for broken connections
      catch (e) {
        throw e;
      }
    }
    // Clean up, move immediately to respond to any
    // queued up requests
    if (req.async) {
      _cleanup(req);
    }
    return true;
  };
  var _timeout = function (req) {
    if (_this.abort.apply(_this, [req.id])) {
      if (typeof req.handleTimeout == 'function') {
        req.handleTimeout();
      }
      else {
        alert('XMLHttpRequest to ' + req.url + ' timed out.');
      }
    }
  };
  var _cleanup = function (req) {
    // Remove from list of xhrs currently in use
    // this XHR can't be aborted until it's processing again
    delete _processingMap[req.id];

    // Requests queued up, grab one to respond to
    if (_requestQueue.length) {
      var nextReq = _requestQueue.shift();
      // Reset the start time for the request for timeout purposes
      nextReq.startTime = new Date().getTime();
      _processReq(nextReq, req.xhrId);
    }
    // Otherwise this xhr is idle, waiting to respond
    else {
      _idleXhrs.push(req.xhrId);
    }
  };
  var _handleErrDefault = function (r) {
    var errorWin;
    // Create new window and display error
    try {
      errorWin = window.open('', 'errorWin');
      errorWin.document.body.innerHTML = r.responseText;
    }
    // If pop-up gets blocked, inform user
    catch(e) {
      alert('An error occurred, but the error message cannot be' +
      ' displayed because of your browser\'s pop-up blocker.\n' +
      'Please allow pop-ups from this Web site.');
    }
  };
};

fleegix.xhr.Request = function () {
  this.id = 0;
  this.xhrId = null;
  this.url = null;
  this.status = null;
  this.statusText = '';
  this.method = 'GET';
  this.async = true;
  this.data = null;
  this.readyState = null;
  this.responseText = null;
  this.responseXML = null;
  this.handleSuccess = null;
  this.handleErr = null;
  this.handleAll = null;
  this.handleTimeout = null;
  this.responseFormat = fleegix.xhr.responseFormats.TXT; // TXT, XML, OBJ
  this.mimeType = null;
  this.username = '';
  this.password = '';
  this.headers = [];
  this.preventCache = false;
  this.startTime = new Date().getTime();
  this.timeoutSeconds = fleegix.xhr.defaultTimeoutSeconds; // Default to 30-sec timeout
  this.uber = false;
  this.aborted = false;
};
fleegix.xhr.Request.prototype.setRequestHeader = function (headerName, headerValue) {
  this.headers.push(headerName + ': ' + headerValue);
};


fleegix.json = new function() {
  this.serialize = function(obj) {
    var str = '';
    switch (typeof obj) {
      case 'object':
        // Null
        if (obj === null) {
           return 'null';
        }
        // Arrays
        else if (obj instanceof Array) {
          for (var i = 0; i < obj.length; i++) {
            if (str) { str += ','; }
            str += fleegix.json.serialize(obj[i]);
          }
          return '[' + str + ']';
        }
        // Objects
        else if (typeof obj.toString != 'undefined') {
          for (var i in obj) {
            if (str) { str += ','; }
            str += '"' + i + '":';
            if (typeof obj[i] == 'undefined') {
              str += '"undefined"';
            }
            else {
              str += fleegix.json.serialize(obj[i]);
            }
          }
          return '{' + str + '}';
        }
        return str;
      case 'unknown':
      case 'undefined':
      case 'function':
        return '"undefined"';
      case 'string':
        str += '"' + obj.replace(/(["\\])/g, '\\$1').replace(
          /\r/g, '').replace(/\n/g, '\\n') + '"';
        return str;
      default:
        return String(obj);
    }
  };
};


fleegix.string = new function () {
  var ltr = /^\s+/; var rtr = /\s+$/; var tr = /^\s+|\s+$/g;
  this.toArray = function (str) {
    var arr = [];
    for (var i = 0; i < str.length; i++) {
      arr[i] = str.substr(i, 1);
    }
    return arr;
  };
  this.reverse = function (str) {
    return this.toArray(str).reverse().join('');
  };
  this.ltrim = function (str, chr) {
    var pat = chr ? new RegExp('^' + chr + '+') : ltr;
    return str.replace(pat, '');
  };
  this.rtrim = function (str, chr) {
    var pat = chr ? new RegExp(chr + '+$') : rtr;
    return str.replace(pat, '');
  };
  this.trim = function (str, chr) {
    var pat = chr ? new RegExp('^' + chr + '+|' + chr + '+$', 'g') : tr;
    return str.replace(pat, '');
  };
  // Converts someVariableName to some_variable_name
  this.toLowerCaseWithUnderscores = function (s) {
    return s.replace(/([A-Z]+)/g, '_$1').toLowerCase().
      replace(/^_/, '');
  };
  // Alias for above
  this.deCamelize = function (s) {
    return this.toLowerCaseWithUnderscores(s);
  };
  // Converts some_variable_name to someVariableName
  this.toCamelCase = function (s) {
    return s.replace(/_[a-z]{1}/g, function (s) 
      { return s.replace('_', '').toUpperCase() });
  };
  // Alias for above
  this.camelize = function (s) {
    return this.toCamelCase(s);
  };
  this.capitalize = function (s) {
    return s.substr(0, 1).toUpperCase() + s.substr(1);
  };
  this.escapeXML = function (s) {
    return s.replace(/&/gm, '&amp;').replace(/</gm, '&lt;').
      replace(/>/gm, '&gt;').replace(/"/gm, '&quot;');
  };
  this.unescapeXML = function (s) {
    return s.replace(/&amp;/gm, '&').replace(/&lt;/gm, '<').
      replace(/&gt;/gm, '>').replace(/&quot;/gm, '"');
  };
};


fleegix.cookie = new function() {
  this.set = function(name, value, optParam) {
    var opts = optParam || {};
    var path = '/';
    var days = 0;
    var hours = 0;
    var minutes = 0;
    var exp = '';
    var t = 0;
    if (typeof optParam == 'object') {
      path = opts.path || '/';
      days = opts.days || 0;
      hours = opts.hours || 0;
      minutes = opts.minutes || 0;
    }
    else {
      path = optParam || '/';
    }
    t += days ? days*24*60*60*1000 : 0;
    t += hours ? hours*60*60*1000 : 0;
    t += minutes ? minutes*60*1000 : 0;

    if (t) {
      var dt = new Date();
      dt.setTime(dt.getTime() + t);
      exp = '; expires=' + dt.toGMTString();
    }
    else {
      exp = '';
    }
    document.cookie = name + '=' + value +
      exp + '; path=' + path;
  };
  this.get = function(name) {
    var nameEq = name + '=';
    var arr = document.cookie.split(';');
    for(var i = 0; i < arr.length; i++) {
      var c = arr[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1, c.length);
      }
      if (c.indexOf(nameEq) === 0) {
        return c.substring(nameEq.length, c.length);
      }
    }
    return null;
  };
  this.create = this.set;
  this.destroy = function(name, path) {
    var opts = {};
    opts.minutes = -1;
    if (path) { opts.path = path; }
    this.set(name, '', opts);
  };
};


fleegix.form = {};
/**
 * Serializes the data from all the inputs in a Web form
 * into a query-string style string.
 * @param docForm -- Reference to a DOM node of the form element
 * @param formatOpts -- JS object of options for how to format
 * the return string. Supported options:
 *   collapseMulti: (Boolean) take values from elements that
 *      can return multiple values (multi-select, checkbox groups)
 *      and collapse into a single, comman-delimited value
 *      (e.g., thisVar=asdf,qwer,zxcv)
 *   stripTags: (Boolean) strip markup tags from any values
 *   includeEmpty: (Boolean) include keys in the string for
 *     all elements, even if they have no value set (e.g.,
 *     even if elemB has no value: elemA=foo&elemB=&elemC=bar)
 *   pedantic: (Boolean) include the values of elements like
 *      button or image
 * @returns query-string style String of variable-value pairs
 */
fleegix.form.serialize = function (f, o) {
  var h = fleegix.form.toObject(f, o);
  var opts = o || {};
  var str = '';
  var pat = null;

  if (opts.stripTags) { pat = /<[^>]*>/g; }
  for (var n in h) {
    var s = '';
    var v = h[n];
    if (v) {
      // Single val -- string
      if (typeof v == 'string') {
        s = opts.stripTags ? v.replace(pat, '') : v;
        str += n + '=' + encodeURIComponent(s);
      }
      // Multiple vals -- array
      else {
        var sep = '';
        if (opts.collapseMulti) {
          sep = ',';
          str += n + '=';
        }
        else {
          sep = '&';
        }
        for (var j = 0; j < v.length; j++) {
          s = opts.stripTags ? v[j].replace(pat, '') : v[j];
          s = (!opts.collapseMulti) ? n + '=' + encodeURIComponent(s) :
            encodeURIComponent(s);
          str += s + sep;
        }
        str = str.substr(0, str.length - 1);
      }
      str += '&';
    }
    else {
      if (opts.includeEmpty) { str += n + '=&'; }
    }
  }
  // Convert all the camelCase param names to Ruby/Python style
  // lowercase_with_underscores
  if (opts.deCamelize) {
    if (!fleegix.string) {
      throw new Error(
        'deCamelize option depends on fleegix.string module.');
    }
    var arr = str.split('&');
    var arrItems;
    str = '';
    for (var i = 0; i < arr.length; i++) {
      arrItems = arr[i].split('=');
      if (arrItems[0]) {
        str += fleegix.string.deCamelize(arrItems[0]) +
          '=' + arrItems[1] + '&';
      }
    }
  }
  str = str.substr(0, str.length - 1);
  return str;
};

/**
 * Converts the values in an HTML form into a JS object
 * Elements with multiple values like sets of radio buttons
 * become arrays
 * @param f -- HTML form element to convert into a JS object
 * @param o -- JS Object of options:
 *    pedantic: (Boolean) include the values of elements like
 *      button or image
 *    hierarchical: (Boolean) if the form is using Rails-/PHP-style
 *      name="foo[bar]" inputs, setting this option to
 *      true will create a hierarchy of objects in the
 *      resulting JS object, where some of the properties
 *      of the objects are sub-objects with values pulled
 *      from the form. Note: this only supports one level
 *      of nestedness
 * hierarchical option code by Kevin Faulhaber, kjf@kjfx.net
 * @returns JavaScript object representation of the contents
 * of the form.
 */
fleegix.form.toObject= function (f, o) {
  var opts = o || {};
  var h = {};
  function expandToArr(orig, val) {
    if (orig) {
      var r = null;
      if (typeof orig == 'string') {
        r = [];
        r.push(orig);
      }
      else { r = orig; }
      r.push(val);
      return r;
    }
    else { return val; }
  }

  for (var i = 0; i < f.elements.length; i++) {
    var elem = f.elements[i];
    // Elements should have a name
    if (elem.name) {
      var st = elem.name.indexOf('[');
      var sp = elem.name.indexOf(']');
      var sb = '';
      var en = '';
      var c;
      var n;
      // Using Rails-/PHP-style name="foo[bar]"
      // means you can go hierarchical if you want
      if (opts.hierarchical && (st > 0) && (sp > 2)) {
          sb = elem.name.substring(0, st);
          en = elem.name.substring(st + 1, sp);
          if (typeof h[sb] == 'undefined') { h[sb] = {}; }
          c = h[sb];
          n = en;
      }
      else {
          c = h;
          n = elem.name;
      }
      switch (elem.type) {
        // Text fields, hidden form elements, etc.
        case 'text':
        case 'hidden':
        case 'password':
        case 'textarea':
        case 'select-one':
          c[n] = elem.value;
          break;
        // Multi-option select
        case 'select-multiple':
          for(var j = 0; j < elem.options.length; j++) {
            var e = elem.options[j];
            if(e.selected) {
              c[n] = expandToArr(c[n], e.value);
            }
          }
          break;
        // Radio buttons
        case 'radio':
          if (elem.checked) {
            c[n] = elem.value;
          }
          break;
        // Checkboxes
        case 'checkbox':
          if (elem.checked) {
            c[n] = expandToArr(c[n], elem.value);
          }
          break;
        // Pedantic
        case 'submit':
        case 'reset':
        case 'file':
        case 'image':
        case 'button':
          if (opts.pedantic) { c[n] = elem.value; }
          break;
      }
    }
  }
  return h;
};
// Alias for backward compat
fleegix.form.toHash = fleegix.form.toObject;
