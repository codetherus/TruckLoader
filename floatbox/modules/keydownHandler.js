/* Floatbox v3.52.2 */
Floatbox.prototype.keydownHandler=function(G){G=G||window.event;var B=fb.lastChild,F=G.keyCode||G.which,D=G.ctrlKey||G.metaKey,E=G.altKey,A=G.shiftKey,C=D||E||A;switch(F){case 37:case 39:if(E||A){return }if(B.itemCount>1){B[F===37?"fbPrev":"fbNext"].onclick(D?B.ctrlJump:1);if(B.showHints==="once"){B.fbPrev.title=B.fbNext.title="";if(B.overlayNav){B.fbOverlayPrev.title=B.fbOverlayNext.title=""}}}return B.stopEvent(G);case 32:if(C){return }if(B.isSlideshow){B.setPause(!B.isPaused);if(B.showHints==="once"){B.fbPlay.title=B.fbPause.title=""}}return B.stopEvent(G);case 9:if(C){return }if(B.fbResizer.onclick){B.fbResizer.onclick();if(B.showHints==="once"){B.fbResizer.title=""}}return B.stopEvent(G);case 27:if(C){return }if(B.showHints==="once"){B.fbClose.title=""}B.end();return B.stopEvent(G);case 13:if(!C){return B.stopEvent(G)}}};if(fb.enableKeyboardNav&&fb.fbBox&&!fb.keydownHandlerSet){fb.addEvent(fb.doc,"keydown",fb.keydownHandler);fb.keydownHandlerSet=true};