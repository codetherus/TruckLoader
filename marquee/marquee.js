
;(function($){
    //jQuery proxy method fail, when bind an event to a proxy object
    var proxy = function(__method){
        var  args = Array.prototype.slice.call(arguments, 1), object = args.shift();
        return function(event) {
            return __method.apply(object, args.concat(Array.prototype.slice.call(arguments,0)));
        }
    };

    function Marquee(element, config){

        //save html element
        this.element = element;
        this.content = element.children();

        //merge the configuration
        $.extend(this, config);

        //init css element
        this.element.css({
             'overflow' : 'hidden',
            'position' : 'relative'
        });
	this.content.css('position', 'relative');
        
        //direction
        this.inverseDirc = this.speed < 0;
        this.dirc = this.vertical ? 'top' : 'left';
        var offset = 'offset' + (this.vertical ? 'Height' : 'Width');

        //dimension variables
        var cookieStep;
        if(this.enableCookie && this.element.attr('id')){
            cookieStep = this.getCookie();
            $(window).bind('unload', proxy(this.saveCookie, this));
        }
        if($.browser.webkit){
            //fixe webkit bug, dimensions change strangely when the position change (and when there is lots of content)
            this.startStep = this.maxStep = 0;
            this.__defineGetter__('maxStep', function() {
                return this.inverseDirc ? this.element.attr(offset) : -this.content.attr(offset);
            });
            this.__defineGetter__('startStep', function() {
                return !this.inverseDirc ? this.element.attr(offset) : -this.content.attr(offset);
            });
            //!!! another solution fails.
            if(cookieStep){
                this.currentStep = cookieStep;
            }else if(this.inverseDirc){
                this.content.css(this.dirc, this.maxStep);
                this.currentStep = this.maxStep
            }else this.currentStep = this.startStep
        }else{
            var elementDim = this.element.attr(offset);
            var contentDim = this.content.attr(offset);
            this.maxStep = this.inverseDirc ? elementDim : -contentDim;
            this.startStep = this.inverseDirc ? -contentDim : elementDim;
            this.currentStep = cookieStep || this.startStep;
        }


        //init acceleration event listener
        if(this.speedUp || this.speedDown){
            this.eventAcc = this.eventAcc == 'over' ? ['mouseenter', 'mouseleave'] : ['mousedown', 'mouseup'];
            this.oriSpeed = this.speed;
            
            if(this.speedUp){
                this.speedUp = $(this.speedUp);
                this.speedUp[this.eventAcc[0]](proxy(this.enableAcc, this, this.inverseDirc));
                if(this.eventAcc != 'over'){
                    this.disableSelection($(this.speedUp)[0]);
                }
            }
            if(this.speedDown){
                this.speedDown = $(this.speedDown);
                this.speedDown[this.eventAcc[0]](proxy(this.enableAcc, this, !this.inverseDirc));
                if(this.eventAcc != 'over'){
                    this.disableSelection($(this.speedDown)[0]);
                }
            }
        }

        //init drag event listener
        if(this.draggable){
            this.element.bind('mousedown', null, proxy(this.enableDrag, this));
            this.disableSelection(this.element[0]);
        }

        if(this.enableScroll){
            this.element.mousewheel(proxy(this.scroll, this));
        }

        //init event for enable/disable timer
        if(this.stopOnOver){
            this.element.mouseenter(proxy(this.enter, this));
            this.element.mouseleave(proxy(this.leave, this));
        }

        //enable timer
        this.enableTimer();
    }

    Marquee.prototype = {

        speed : 0.5,
        coefAcc : 3,
        vertical : true,
        stopOnOver : true,
        eventAcc : 'over',
        stepScroll : 20,
        animateScrollDuration : 100,
        animateScrollEasing : 'easeOut',

        scroll : function(event, delta){
            var step, inverse;
            if (delta < 0) {
                step = -this.stepScroll;
                if(!this.inverseDirc){
                    inverse = true;
                    this.toogleDirc();
                }
            }else if (delta > 0){
                step = this.stepScroll;
                if(this.inverseDirc){
                    inverse = true;
                    this.toogleDirc();
                }
            }
            this.run(step, this.enableAnimateScroll);
            if(inverse)
                this.toogleDirc();
        },

        disableSelection : function (target){
            target.onmousedown = target.onselectstart = target.ondragstart = function(){return false;};
        },

        enableDrag : function(event){
            if(!this.stopOnOver)
                disableTimer();
            this.onDrag = true;
            this.lastDragCoor = this.vertical ? event.pageY : event.pageX;
            this.dragHandler = proxy(this.drag, this);
            $(document).bind('mousemove', this.dragHandler);
            this.toogleDragHandler = proxy(this.disableDrag, this);
            $(document).mouseup(this.toogleDragHandler );
            if(this.clsDrag){
                $(document.body).addClass(this.clsDrag);
                this.element.addClass(this.clsDrag);
            }
        },

        disableDrag : function(){
            this.onDrag = false;
            if(this.inverseDirc != this.speed < 0)
                this.toogleDirc();
            this.inverseDirc = this.speed < 0;
            $(document).unbind('mousemove', this.dragHandler);
            $(document).unbind('mouseup', this.toogleDragHandler);
            if(!this.isOver)
                this.enableTimer();
            if(this.clsDrag){
                $(document.body).removeClass(this.clsDrag);
                this.element.removeClass(this.clsDrag);
            }
        },

        drag : function(event){
            var coor = this.vertical ? event.pageY : event.pageX;
            if((this.inverseDirc && this.lastDragCoor > coor)
                || (!this.inverseDirc && this.lastDragCoor < coor)){
                this.toogleDirc();
            }
            this.run(this.lastDragCoor - coor);
            this.lastDragCoor = coor;
        },

        enableAcc : function(inverse){
            this.speed *= inverse ? -this.coefAcc : this.coefAcc;
            if(inverse)
                this.toogleDirc();
            this.toogleClsSpeed(inverse, false);
            this.disableAccHandler = proxy(this.disableAcc, this, inverse);
            (this.eventAcc[1] == 'mouseleave' ? $(this['speed' + (inverse ? 'Down' : 'Up')]) : $(document))
                [this.eventAcc[1]](this.disableAccHandler);
        },

        disableAcc : function(inverse){
            this.speed = this.oriSpeed;
            if(inverse)
                this.toogleDirc();
            this.toogleClsSpeed(inverse, true);
             (this.eventAcc[1] == 'mouseleave' ? $(this['speed' + (inverse ? 'Down' : 'Up')]) : $(document))
                .unbind(this.eventAcc[1], this.disableAccHandler);
        },

        toogleDirc : function(){
            this.inverseDirc = !this.inverseDirc;
            if(!$.browser.webkit){
                var tmp = this.startStep;
                this.startStep = this.maxStep;
                this.maxStep = tmp;
            }
        },

        toogleClsSpeed : function(inverse, remove){
            var cls = this[inverse ? 'clsSpeedDown' : 'clsSpeedUp'];
            if(cls)
                this[inverse ? 'speedDown' : 'speedUp'][remove ? 'removeClass' : 'addClass'](cls);
        },

        enter : function(){
            this.isOver = true;
            this.disableTimer();
        },

        leave : function(){
            this.isOver = false;
            if(!this.onDrag)
                this.enableTimer();
        },

        run : function(step, animate){
            step = step != undefined ? step : this.speed;
            this.currentStep -= step;
            if(animate){
                this.content.stop();
                var ani = {};
                ani[this.dirc] = this.currentStep;
                this.content.animate(ani, 250);
            }else this.content.css(this.dirc, this.currentStep + 'px');
            if((this.inverseDirc && this.currentStep >= this.maxStep)
                || (!this.inverseDirc && this.currentStep <= this.maxStep)){
                this.currentStep = this.startStep;
            }
        },

        disableTimer : function(){
            clearInterval(this.timer);
            this.timer = null;
        },

        enableTimer : function(){
            this.timer = setInterval(proxy(this.run, this, null, null), 35);
        },

        pause : function(){
            if(this.timer) return;
            this.enableTimer();
        },

        resume : function(){
            if(this.timer) return;
            this.enableTimer();
        },

        getCookie : function(){
            var n = 'marquee_' + this.element.attr('id');
            var i = document.cookie.indexOf(n + "=");
            if (i > -1) {
                i += n.length + 1
                var j = document.cookie.indexOf(';', i);
                if (j < 0)
                    j = document.cookie.length;
                return unescape(document.cookie.substring(i, j));
            }
            return '';
        },
        saveCookie : function(){           
            document.cookie = 'marquee_' + this.element.attr('id') + "=" + this.currentStep + ';';
        }
    };


    $.fn.marquee = function(options){
        this.marquee = new Marquee(this, options);
        return this;
    };

})(jQuery);
