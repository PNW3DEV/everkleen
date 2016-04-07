<?php
/**
 * Utility functions
 */

function bw_get_preloaders_list() {
	return '{
     "color-switch" : {
       "html" : "<div class=\"cssload-container\"><div class=\"cssload-circle\"></div><div class=\"cssload-circle\"></div></div>",
       "css" : ".cssload-container{display:block;margin:0 auto;width:75px}.cssload-container *,.cssload-container :after,.cssload-container :before{box-sizing:border-box;-o-box-sizing:border-box;-ms-box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}.cssload-circle{position:absolute;top:50%;left:50%;width:0;height:0;border-radius:50%;z-index:1;transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);transition:all 320ms ease;-o-transition:all 320ms ease;-ms-transition:all 320ms ease;-webkit-transition:all 320ms ease;-moz-transition:all 320ms ease}.cssload-circle:nth-child(1){z-index:2;background:#000;animation-name:cssload-explode;-o-animation-name:cssload-explode;-ms-animation-name:cssload-explode;-webkit-animation-name:cssload-explode;-moz-animation-name:cssload-explode;animation-duration:1.6s;-o-animation-duration:1.6s;-ms-animation-duration:1.6s;-webkit-animation-duration:1.6s;-moz-animation-duration:1.6s;animation-timing-function:ease;-o-animation-timing-function:ease;-ms-animation-timing-function:ease;-webkit-animation-timing-function:ease;-moz-animation-timing-function:ease;animation-delay:0;-o-animation-delay:0;-ms-animation-delay:0;-webkit-animation-delay:0;-moz-animation-delay:0;animation-iteration-count:infinite;-o-animation-iteration-count:infinite;-ms-animation-iteration-count:infinite;-webkit-animation-iteration-count:infinite;-moz-animation-iteration-count:infinite}.cssload-circle:nth-child(2){background:rgba(201,201,201,.51);animation-name:cssload-explode;-o-animation-name:cssload-explode;-ms-animation-name:cssload-explode;-webkit-animation-name:cssload-explode;-moz-animation-name:cssload-explode;animation-duration:1.6s;-o-animation-duration:1.6s;-ms-animation-duration:1.6s;-webkit-animation-duration:1.6s;-moz-animation-duration:1.6s;animation-timing-function:ease;-o-animation-timing-function:ease;-ms-animation-timing-function:ease;-webkit-animation-timing-function:ease;-moz-animation-timing-function:ease;animation-delay:.8s;-o-animation-delay:.8s;-ms-animation-delay:.8s;-webkit-animation-delay:.8s;-moz-animation-delay:.8s;animation-iteration-count:infinite;-o-animation-iteration-count:infinite;-ms-animation-iteration-count:infinite;-webkit-animation-iteration-count:infinite;-moz-animation-iteration-count:infinite}@keyframes cssload-explode{0%{width:0;height:0;z-index:1}50%{width:7em;height:7em;z-index:1}100%{display:none}}@-o-keyframes cssload-explode{0%{width:0;height:0;z-index:1}50%{width:7em;height:7em;z-index:1}100%{display:none}}@-ms-keyframes cssload-explode{0%,50%{z-index:1}0%{width:0;height:0}50%{width:7em;height:7em}100%{display:none}}@-webkit-keyframes cssload-explode{0%{width:0;height:0;z-index:1}50%{width:7em;height:7em;z-index:1}100%{display:none}}@-moz-keyframes cssload-explode{0%{width:0;height:0;z-index:1}50%{width:7em;height:7em;z-index:1}100%{display:none}}"
     },
     "piano" : {
       "html" : "<div class=\"cssload-piano\"><div class=\"cssload-rect1\"></div><div class=\"cssload-rect2\"></div><div class=\"cssload-rect3\"></div></div>",
       "css" : ".cssload-piano{margin:auto;width:40px;height:10px;font-size:10px}.cssload-piano>div{height:100%;width:100%;display:block;margin-bottom:.6em;animation:stretchdelay 1.2s infinite ease-in-out;-o-animation:stretchdelay 1.2s infinite ease-in-out;-ms-animation:stretchdelay 1.2s infinite ease-in-out;-webkit-animation:stretchdelay 1.2s infinite ease-in-out;-moz-animation:stretchdelay 1.2s infinite ease-in-out}.cssload-piano .cssload-rect2{animation-delay:-1s;-o-animation-delay:-1s;-ms-animation-delay:-1s;-webkit-animation-delay:-1s;-moz-animation-delay:-1s}.cssload-piano .cssload-rect3{animation-delay:-.8s;-o-animation-delay:-.8s;-ms-animation-delay:-.8s;-webkit-animation-delay:-.8s;-moz-animation-delay:-.8s}@keyframes stretchdelay{0%,100%,40%{transform:scaleX(.8);background-color:#2e5865;box-shadow:0 0 0 rgba(10,10,10,.1)}20%{transform:scaleX(1);background-color:#00b192;box-shadow:0 5px 6px rgba(10,10,10,.4)}}@-o-keyframes stretchdelay{0%,100%,40%{-o-transform:scaleX(.8);background-color:#2e5865;box-shadow:0 0 0 rgba(10,10,10,.1)}20%{-o-transform:scaleX(1);background-color:#00b192;box-shadow:0 5px 6px rgba(10,10,10,.4)}}@-ms-keyframes stretchdelay{0%,100%,40%{-ms-transform:scaleX(.8);background-color:#2e5865;box-shadow:0 0 0 rgba(10,10,10,.1)}20%{-ms-transform:scaleX(1);background-color:#00b192;box-shadow:0 5px 6px rgba(10,10,10,.4)}}@-webkit-keyframes stretchdelay{0%,100%,40%{-webkit-transform:scaleX(.8);background-color:#2e5865;box-shadow:0 0 0 rgba(10,10,10,.1)}20%{-webkit-transform:scaleX(1);background-color:#00b192;box-shadow:0 5px 6px rgba(10,10,10,.4)}}@-moz-keyframes stretchdelay{0%,100%,40%{-moz-transform:scaleX(.8);background-color:#2e5865;box-shadow:0 0 0 rgba(10,10,10,.1)}20%{-moz-transform:scaleX(1);background-color:#00b192;box-shadow:0 5px 6px rgba(10,10,10,.4)}}"
     },
     "equalizer": {
       "html": "<div id=\"cssload-loader\"><ul><li></li><li></li><li></li><li></li><li></li><li></li></ul></div>",
       "css": "#cssload-loader{position:absolute;margin:auto;left:0;right:0;width:90px}#cssload-loader ul{margin:0;list-style:none;width:90px;position:relative;padding:0;height:10px}#cssload-loader ul li{position:absolute;width:2px;height:0;background-color:#000;bottom:0}#cssload-loader li:nth-child(1){left:0;animation:cssload-sequence1 1s ease infinite 0;-o-animation:cssload-sequence1 1s ease infinite 0;-ms-animation:cssload-sequence1 1s ease infinite 0;-webkit-animation:cssload-sequence1 1s ease infinite 0;-moz-animation:cssload-sequence1 1s ease infinite 0}#cssload-loader li:nth-child(2){left:15px;animation:cssload-sequence2 1s ease infinite .1s;-o-animation:cssload-sequence2 1s ease infinite .1s;-ms-animation:cssload-sequence2 1s ease infinite .1s;-webkit-animation:cssload-sequence2 1s ease infinite .1s;-moz-animation:cssload-sequence2 1s ease infinite .1s}#cssload-loader li:nth-child(3){left:30px;animation:cssload-sequence1 1s ease-in-out infinite .2s;-o-animation:cssload-sequence1 1s ease-in-out infinite .2s;-ms-animation:cssload-sequence1 1s ease-in-out infinite .2s;-webkit-animation:cssload-sequence1 1s ease-in-out infinite .2s;-moz-animation:cssload-sequence1 1s ease-in-out infinite .2s}#cssload-loader li:nth-child(4){left:45px;animation:cssload-sequence2 1s ease-in infinite .3s;-o-animation:cssload-sequence2 1s ease-in infinite .3s;-ms-animation:cssload-sequence2 1s ease-in infinite .3s;-webkit-animation:cssload-sequence2 1s ease-in infinite .3s;-moz-animation:cssload-sequence2 1s ease-in infinite .3s}#cssload-loader li:nth-child(5){left:60px;animation:cssload-sequence1 1s ease-in-out infinite .4s;-o-animation:cssload-sequence1 1s ease-in-out infinite .4s;-ms-animation:cssload-sequence1 1s ease-in-out infinite .4s;-webkit-animation:cssload-sequence1 1s ease-in-out infinite .4s;-moz-animation:cssload-sequence1 1s ease-in-out infinite .4s}#cssload-loader li:nth-child(6){left:75px;animation:cssload-sequence2 1s ease infinite .5s;-o-animation:cssload-sequence2 1s ease infinite .5s;-ms-animation:cssload-sequence2 1s ease infinite .5s;-webkit-animation:cssload-sequence2 1s ease infinite .5s;-moz-animation:cssload-sequence2 1s ease infinite .5s}@keyframes cssload-sequence1{0%,100%{height:10px}50%{height:50px}}@-o-keyframes cssload-sequence1{0%,100%{height:10px}50%{height:50px}}@-ms-keyframes cssload-sequence1{0%,100%{height:10px}50%{height:50px}}@-webkit-keyframes cssload-sequence1{0%,100%{height:10px}50%{height:50px}}@-moz-keyframes cssload-sequence1{0%,100%{height:10px}50%{height:50px}}@keyframes cssload-sequence2{0%,100%{height:20px}50%{height:65px}}@-o-keyframes cssload-sequence2{0%,100%{height:20px}50%{height:65px}}@-ms-keyframes cssload-sequence2{0%,100%{height:20px}50%{height:65px}}@-webkit-keyframes cssload-sequence2{0%,100%{height:20px}50%{height:65px}}@-moz-keyframes cssload-sequence2{0%,100%{height:20px}50%{height:65px}}"
     },
     "tube-tunnel": {
       "html": "<div class=\"cssload-container\"><div class=\"cssload-tube-tunnel\"></div></div>",
       "css": ".cssload-container{width:100%;height:50px;text-align:center}.cssload-tube-tunnel{width:50px;height:50px;margin:0 auto;border:4px solid #000;border-radius:50%;animation:cssload-scale .9s infinite linear;-o-animation:cssload-scale .9s infinite linear;-ms-animation:cssload-scale .9s infinite linear;-webkit-animation:cssload-scale .9s infinite linear;-moz-animation:cssload-scale .9s infinite linear}@keyframes cssload-scale{0%{transform:scale(0)}90%{transform:scale(.7)}100%{transform:scale(1)}}@-o-keyframes cssload-scale{0%{-o-transform:scale(0);transform:scale(0)}90%{-o-transform:scale(.7);transform:scale(.7)}100%{-o-transform:scale(1);transform:scale(1)}}@-ms-keyframes cssload-scale{0%{-ms-transform:scale(0);transform:scale(0)}90%{-ms-transform:scale(.7);transform:scale(.7)}100%{-ms-transform:scale(1);transform:scale(1)}}@-webkit-keyframes cssload-scale{0%{-webkit-transform:scale(0);transform:scale(0)}90%{-webkit-transform:scale(.7);transform:scale(.7)}100%{-webkit-transform:scale(1);transform:scale(1)}}@-moz-keyframes cssload-scale{0%{-moz-transform:scale(0);transform:scale(0)}90%{-moz-transform:scale(.7);transform:scale(.7)}100%{-moz-transform:scale(1);transform:scale(1)}}"
     },
     "snake-shadowed": {
       "html": "<div class=\"cssload-container\"><div class=\"cssload-progress cssload-float cssload-shadow\"><div class=\"cssload-progress-item\"></div></div></div>",
       "css": ".cssload-container{position:absolute;top:0;left:0;width:100%;height:100%}.cssload-container:after,.cssload-container:before{left:0;width:100%;height:50%;z-index:-1;content:\'\';position:absolute}.cssload-container:before{top:0;transition:top 1.2s linear 3.1s;-o-transition:top 1.2s linear 3.1s;-ms-transition:top 1.2s linear 3.1s;-webkit-transition:top 1.2s linear 3.1s;-moz-transition:top 1.2s linear 3.1s}.cssload-container:after{bottom:0;transition:bottom 1.2s linear 3.1s;-o-transition:bottom 1.2s linear 3.1s;-ms-transition:bottom 1.2s linear 3.1s;-webkit-transition:bottom 1.2s linear 3.1s;-moz-transition:bottom 1.2s linear 3.1s}.cssload-container.done:before{top:-50%}.cssload-container.done:after{bottom:-50%}.cssload-progress{position:absolute;top:50%;left:50%;transform:translateX(-50%) translateY(-50%);-o-transform:translateX(-50%) translateY(-50%);-ms-transform:translateX(-50%) translateY(-50%);-webkit-transform:translateX(-50%) translateY(-50%);-moz-transform:translateX(-50%) translateY(-50%);transform-origin:center;-o-transform-origin:center;-ms-transform-origin:center;-webkit-transform-origin:center;-moz-transform-origin:center}.cssload-progress .cssload-progress-item{text-align:center;width:100px;height:100px;line-height:100px;border:2px solid #000;border-radius:50%}.cssload-progress .cssload-progress-item:before{content:\'\';position:absolute;top:0;left:50%;margin-top:-3px;margin-left:0;width:45px;height:45px;border-top:solid 10px #000;border-right:solid 10px #000;border-top-right-radius:100%;transform-origin:left bottom;-o-transform-origin:left bottom;-ms-transform-origin:left bottom;-webkit-transform-origin:left bottom;-moz-transform-origin:left bottom;animation:spin 3s linear infinite;-o-animation:spin 3s linear infinite;-ms-animation:spin 3s linear infinite;-webkit-animation:spin 3s linear infinite;-moz-animation:spin 3s linear infinite}.cssload-progress.cssload-shadow:after,.cssload-progress.cssload-shadow:before{content:\'\';position:absolute;top:50%;left:50%;z-index:-1}.cssload-progress.cssload-float .cssload-progress-item:before{border-top-width:2px;margin-top:0;height:50px}.cssload-progress.cssload-float.cssload-shadow:before{border-top-width:2px;margin-top:-41px;height:50px}.cssload-progress.cssload-shadow:before{margin:-43px 0 0 12px;width:45px;height:45px;border-top:solid 10px #DDD;border-right:solid 10px #DDD;border-top-right-radius:100%;transform-origin:left bottom;-o-transform-origin:left bottom;-ms-transform-origin:left bottom;-webkit-transform-origin:left bottom;-moz-transform-origin:left bottom;animation:spin 3s linear infinite;-o-animation:spin 3s linear infinite;-ms-animation:spin 3s linear infinite;-webkit-animation:spin 3s linear infinite;-moz-animation:spin 3s linear infinite}.cssload-progress.cssload-shadow:after{width:100px;height:100px;color:#DDD;text-align:center;line-height:100px;border:2px solid #DDD;margin:-40px 0 0 -40px;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;transform-origin:center;-o-transform-origin:center;-ms-transform-origin:center;-webkit-transform-origin:center;-moz-transform-origin:center}@keyframes spin{100%{transform:rotate(360deg)}}@-o-keyframes spin{100%{-o-transform:rotate(360deg)}}@-ms-keyframes spin{100%{-ms-transform:rotate(360deg)}}@-webkit-keyframes spin{100%{-webkit-transform:rotate(360deg)}}@-moz-keyframes spin{100%{-moz-transform:rotate(360deg)}}"
     },
     "atom": {
       "html": "<div class=\"cssload-loader\"><div class=\"cssload-inner cssload-one\"></div><div class=\"cssload-inner cssload-two\"></div><div class=\"cssload-inner cssload-three\"></div></div>",
       "css": ".cssload-loader{position:relative;left:calc(50% - 32px);width:64px;height:64px;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%;perspective:800px}.cssload-inner{position:absolute;width:100%;height:100%;box-sizing:border-box;-o-box-sizing:border-box;-ms-box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;border-radius:50%;-o-border-radius:50%;-ms-border-radius:50%;-webkit-border-radius:50%;-moz-border-radius:50%}.cssload-inner.cssload-one{left:0;top:0;animation:cssload-rotate-one 1s linear infinite;-o-animation:cssload-rotate-one 1s linear infinite;-ms-animation:cssload-rotate-one 1s linear infinite;-webkit-animation:cssload-rotate-one 1s linear infinite;-moz-animation:cssload-rotate-one 1s linear infinite;border-bottom:3px solid #000}.cssload-inner.cssload-two{right:0;top:0;animation:cssload-rotate-two 1s linear infinite;-o-animation:cssload-rotate-two 1s linear infinite;-ms-animation:cssload-rotate-two 1s linear infinite;-webkit-animation:cssload-rotate-two 1s linear infinite;-moz-animation:cssload-rotate-two 1s linear infinite;border-right:3px solid #000}.cssload-inner.cssload-three{right:0;bottom:0;animation:cssload-rotate-three 1s linear infinite;-o-animation:cssload-rotate-three 1s linear infinite;-ms-animation:cssload-rotate-three 1s linear infinite;-webkit-animation:cssload-rotate-three 1s linear infinite;-moz-animation:cssload-rotate-three 1s linear infinite;border-top:3px solid #000}@keyframes cssload-rotate-one{0%{transform:rotateX(35deg) rotateY(-45deg) rotateZ(0)}100%{transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}@-o-keyframes cssload-rotate-one{0%{-o-transform:rotateX(35deg) rotateY(-45deg) rotateZ(0)}100%{-o-transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}@-ms-keyframes cssload-rotate-one{0%{-ms-transform:rotateX(35deg) rotateY(-45deg) rotateZ(0)}100%{-ms-transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}@-webkit-keyframes cssload-rotate-one{0%{-webkit-transform:rotateX(35deg) rotateY(-45deg) rotateZ(0)}100%{-webkit-transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}@-moz-keyframes cssload-rotate-one{0%{-moz-transform:rotateX(35deg) rotateY(-45deg) rotateZ(0)}100%{-moz-transform:rotateX(35deg) rotateY(-45deg) rotateZ(360deg)}}@keyframes cssload-rotate-two{0%{transform:rotateX(50deg) rotateY(10deg) rotateZ(0)}100%{transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}@-o-keyframes cssload-rotate-two{0%{-o-transform:rotateX(50deg) rotateY(10deg) rotateZ(0)}100%{-o-transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}@-ms-keyframes cssload-rotate-two{0%{-ms-transform:rotateX(50deg) rotateY(10deg) rotateZ(0)}100%{-ms-transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}@-webkit-keyframes cssload-rotate-two{0%{-webkit-transform:rotateX(50deg) rotateY(10deg) rotateZ(0)}100%{-webkit-transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}@-moz-keyframes cssload-rotate-two{0%{-moz-transform:rotateX(50deg) rotateY(10deg) rotateZ(0)}100%{-moz-transform:rotateX(50deg) rotateY(10deg) rotateZ(360deg)}}@keyframes cssload-rotate-three{0%{transform:rotateX(35deg) rotateY(55deg) rotateZ(0)}100%{transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}@-o-keyframes cssload-rotate-three{0%{-o-transform:rotateX(35deg) rotateY(55deg) rotateZ(0)}100%{-o-transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}@-ms-keyframes cssload-rotate-three{0%{-ms-transform:rotateX(35deg) rotateY(55deg) rotateZ(0)}100%{-ms-transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}@-webkit-keyframes cssload-rotate-three{0%{-webkit-transform:rotateX(35deg) rotateY(55deg) rotateZ(0)}100%{-webkit-transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}@-moz-keyframes cssload-rotate-three{0%{-moz-transform:rotateX(35deg) rotateY(55deg) rotateZ(0)}100%{-moz-transform:rotateX(35deg) rotateY(55deg) rotateZ(360deg)}}"
     },
     "windows8": {
       "html": "<div class=\"windows8\"><div class=\"wBall\" id=\"wBall_1\"><div class=\"wInnerBall\"></div></div><div class=\"wBall\" id=\"wBall_2\"><div class=\"wInnerBall\"></div></div><div class=\"wBall\" id=\"wBall_3\"><div class=\"wInnerBall\"></div></div><div class=\"wBall\" id=\"wBall_4\"><div class=\"wInnerBall\"></div></div><div class=\"wBall\" id=\"wBall_5\"><div class=\"wInnerBall\"></div></div></div>",
       "css": ".windows8{position:relative;width:80px;height:80px;margin:auto}.windows8 .wBall{position:absolute;width:76px;height:76px;opacity:0;transform:rotate(225deg);-o-transform:rotate(225deg);-ms-transform:rotate(225deg);-webkit-transform:rotate(225deg);-moz-transform:rotate(225deg);animation:orbit 6.050000000000001s infinite;-o-animation:orbit 6.050000000000001s infinite;-ms-animation:orbit 6.050000000000001s infinite;-webkit-animation:orbit 6.050000000000001s infinite;-moz-animation:orbit 6.050000000000001s infinite}.windows8 .wBall .wInnerBall{position:absolute;width:10px;height:10px;background:#000;left:0;top:0;border-radius:10px}.windows8 #wBall_1{animation-delay:1.32s;-o-animation-delay:1.32s;-ms-animation-delay:1.32s;-webkit-animation-delay:1.32s;-moz-animation-delay:1.32s}.windows8 #wBall_2{animation-delay:.26s;-o-animation-delay:.26s;-ms-animation-delay:.26s;-webkit-animation-delay:.26s;-moz-animation-delay:.26s}.windows8 #wBall_3{animation-delay:.53s;-o-animation-delay:.53s;-ms-animation-delay:.53s;-webkit-animation-delay:.53s;-moz-animation-delay:.53s}.windows8 #wBall_4{animation-delay:.79s;-o-animation-delay:.79s;-ms-animation-delay:.79s;-webkit-animation-delay:.79s;-moz-animation-delay:.79s}.windows8 #wBall_5{animation-delay:1.06s;-o-animation-delay:1.06s;-ms-animation-delay:1.06s;-webkit-animation-delay:1.06s;-moz-animation-delay:1.06s}@keyframes orbit{0%{opacity:1;z-index:99;transform:rotate(180deg);animation-timing-function:ease-out}7%{opacity:1;transform:rotate(300deg);animation-timing-function:linear;origin:0}30%{opacity:1;transform:rotate(410deg);animation-timing-function:ease-in-out;origin:7%}39%{opacity:1;transform:rotate(645deg);animation-timing-function:linear;origin:30%}70%{opacity:1;transform:rotate(770deg);animation-timing-function:ease-out;origin:39%}75%{opacity:1;transform:rotate(900deg);animation-timing-function:ease-out;origin:70%}100%,76%{opacity:0;transform:rotate(900deg)}}@-o-keyframes orbit{0%{opacity:1;z-index:99;-o-transform:rotate(180deg);-o-animation-timing-function:ease-out}7%{opacity:1;-o-transform:rotate(300deg);-o-animation-timing-function:linear;-o-origin:0}30%{opacity:1;-o-transform:rotate(410deg);-o-animation-timing-function:ease-in-out;-o-origin:7%}39%{opacity:1;-o-transform:rotate(645deg);-o-animation-timing-function:linear;-o-origin:30%}70%{opacity:1;-o-transform:rotate(770deg);-o-animation-timing-function:ease-out;-o-origin:39%}75%{opacity:1;-o-transform:rotate(900deg);-o-animation-timing-function:ease-out;-o-origin:70%}100%,76%{opacity:0;-o-transform:rotate(900deg)}}@-ms-keyframes orbit{39%,7%{-ms-animation-timing-function:linear}0%,70%,75%{opacity:1;-ms-animation-timing-function:ease-out}100%,75%,76%{-ms-transform:rotate(900deg)}0%{z-index:99;-ms-transform:rotate(180deg)}7%{opacity:1;-ms-transform:rotate(300deg);-ms-origin:0}30%{opacity:1;-ms-transform:rotate(410deg);-ms-animation-timing-function:ease-in-out;-ms-origin:7%}39%{opacity:1;-ms-transform:rotate(645deg);-ms-origin:30%}70%{-ms-transform:rotate(770deg);-ms-origin:39%}75%{-ms-origin:70%}100%,76%{opacity:0}}@-webkit-keyframes orbit{0%{opacity:1;z-index:99;-webkit-transform:rotate(180deg);-webkit-animation-timing-function:ease-out}7%{opacity:1;-webkit-transform:rotate(300deg);-webkit-animation-timing-function:linear;-webkit-origin:0}30%{opacity:1;-webkit-transform:rotate(410deg);-webkit-animation-timing-function:ease-in-out;-webkit-origin:7%}39%{opacity:1;-webkit-transform:rotate(645deg);-webkit-animation-timing-function:linear;-webkit-origin:30%}70%{opacity:1;-webkit-transform:rotate(770deg);-webkit-animation-timing-function:ease-out;-webkit-origin:39%}75%{opacity:1;-webkit-transform:rotate(900deg);-webkit-animation-timing-function:ease-out;-webkit-origin:70%}100%,76%{opacity:0;-webkit-transform:rotate(900deg)}}@-moz-keyframes orbit{0%{opacity:1;z-index:99;-moz-transform:rotate(180deg);-moz-animation-timing-function:ease-out}7%{opacity:1;-moz-transform:rotate(300deg);-moz-animation-timing-function:linear;-moz-origin:0}30%{opacity:1;-moz-transform:rotate(410deg);-moz-animation-timing-function:ease-in-out;-moz-origin:7%}39%{opacity:1;-moz-transform:rotate(645deg);-moz-animation-timing-function:linear;-moz-origin:30%}70%{opacity:1;-moz-transform:rotate(770deg);-moz-animation-timing-function:ease-out;-moz-origin:39%}75%{opacity:1;-moz-transform:rotate(900deg);-moz-animation-timing-function:ease-out;-moz-origin:70%}100%,76%{opacity:0;-moz-transform:rotate(900deg)}}"
     },
     "flying-ribbon": {
       "html": "<div id=\"cssload-global\"><div id=\"cssload-top\" class=\"cssload-mask\"><div class=\"cssload-plane\"></div></div><div id=\"cssload-middle\" class=\"cssload-mask\"><div class=\"cssload-plane\"></div></div><div id=\"cssload-bottom\" class=\"cssload-mask\"><div class=\"cssload-plane\"></div></div></div>",
       "css": "#cssload-global{width:70px;margin:50px auto auto;position:relative;cursor:pointer;height:60px}.cssload-mask{position:absolute;border-radius:2px;overflow:hidden;perspective:1000;-o-perspective:1000;-ms-perspective:1000;-webkit-perspective:1000;-moz-perspective:1000;backface-visibility:hidden;-o-backface-visibility:hidden;-ms-backface-visibility:hidden;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden}.cssload-plane{background:#AAA;width:400%;height:100%;position:absolute;z-index:100;transform:translate3d(0,0,0);-o-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);perspective:1000;-o-perspective:1000;-ms-perspective:1000;-webkit-perspective:1000;-moz-perspective:1000;backface-visibility:hidden;-o-backface-visibility:hidden;-ms-backface-visibility:hidden;-webkit-backface-visibility:hidden;-moz-backface-visibility:hidden}#cssload-top .cssload-plane{z-index:2000;animation:cssload-trans1 1.3s ease-in infinite 0s backwards;-o-animation:cssload-trans1 1.3s ease-in infinite 0s backwards;-ms-animation:cssload-trans1 1.3s ease-in infinite 0s backwards;-webkit-animation:cssload-trans1 1.3s ease-in infinite 0s backwards;-moz-animation:cssload-trans1 1.3s ease-in infinite 0s backwards}#cssload-middle .cssload-plane{background:#000;transform:translate3d(0,0,0);-o-transform:translate3d(0,0,0);-ms-transform:translate3d(0,0,0);-webkit-transform:translate3d(0,0,0);-moz-transform:translate3d(0,0,0);animation:cssload-trans2 1.3s linear infinite .3s backwards;-o-animation:cssload-trans2 1.3s linear infinite .3s backwards;-ms-animation:cssload-trans2 1.3s linear infinite .3s backwards;-webkit-animation:cssload-trans2 1.3s linear infinite .3s backwards;-moz-animation:cssload-trans2 1.3s linear infinite .3s backwards}#cssload-bottom .cssload-plane{z-index:2000;animation:cssload-trans3 1.3s ease-out infinite .7s backwards;-o-animation:cssload-trans3 1.3s ease-out infinite .7s backwards;-ms-animation:cssload-trans3 1.3s ease-out infinite .7s backwards;-webkit-animation:cssload-trans3 1.3s ease-out infinite .7s backwards;-moz-animation:cssload-trans3 1.3s ease-out infinite .7s backwards}#cssload-top{width:53px;height:20px;left:20px;transform:skew(-15deg,0);-o-transform:skew(-15deg,0);-ms-transform:skew(-15deg,0);-webkit-transform:skew(-15deg,0);-moz-transform:skew(-15deg,0);z-index:100}#cssload-middle{width:33px;height:20px;left:20px;top:15px;transform:skew(-15deg,40deg);-o-transform:skew(-15deg,40deg);-ms-transform:skew(-15deg,40deg);-webkit-transform:skew(-15deg,40deg);-moz-transform:skew(-15deg,40deg)}#cssload-bottom{width:53px;height:20px;top:30px;transform:skew(-15deg,0);-o-transform:skew(-15deg,0);-ms-transform:skew(-15deg,0);-webkit-transform:skew(-15deg,0);-moz-transform:skew(-15deg,0)}@keyframes cssload-trans1{from{transform:translate3d(53px,0,0)}to{transform:translate3d(-250px,0,0)}}@-o-keyframes cssload-trans1{from{-o-transform:translate3d(53px,0,0)}to{-o-transform:translate3d(-250px,0,0)}}@-ms-keyframes cssload-trans1{from{-ms-transform:translate3d(53px,0,0)}to{-ms-transform:translate3d(-250px,0,0)}}@-webkit-keyframes cssload-trans1{from{-webkit-transform:translate3d(53px,0,0)}to{-webkit-transform:translate3d(-250px,0,0)}}@-moz-keyframes cssload-trans1{from{-moz-transform:translate3d(53px,0,0)}to{-moz-transform:translate3d(-250px,0,0)}}@keyframes cssload-trans2{from{transform:translate3d(-160px,0,0)}to{transform:translate3d(53px,0,0)}}@-o-keyframes cssload-trans2{from{-o-transform:translate3d(-160px,0,0)}to{-o-transform:translate3d(53px,0,0)}}@-ms-keyframes cssload-trans2{from{-ms-transform:translate3d(-160px,0,0)}to{-ms-transform:translate3d(53px,0,0)}}@-webkit-keyframes cssload-trans2{from{-webkit-transform:translate3d(-160px,0,0)}to{-webkit-transform:translate3d(53px,0,0)}}@-moz-keyframes cssload-trans2{from{-moz-transform:translate3d(-160px,0,0)}to{-moz-transform:translate3d(53px,0,0)}}@keyframes cssload-trans3{from{transform:translate3d(53px,0,0)}to{transform:translate3d(-220px,0,0)}}@-o-keyframes cssload-trans3{from{-o-transform:translate3d(53px,0,0)}to{-o-transform:translate3d(-220px,0,0)}}@-ms-keyframes cssload-trans3{from{-ms-transform:translate3d(53px,0,0)}to{-ms-transform:translate3d(-220px,0,0)}}@-webkit-keyframes cssload-trans3{from{-webkit-transform:translate3d(53px,0,0)}to{-webkit-transform:translate3d(-220px,0,0)}}@-moz-keyframes cssload-trans3{from{-moz-transform:translate3d(53px,0,0)}to{-moz-transform:translate3d(-220px,0,0)}}@keyframes cssload-animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}@-o-keyframes cssload-animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}@-ms-keyframes cssload-animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}@-webkit-keyframes cssload-animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}@-moz-keyframes cssload-animColor{from{background:red}25%{background:#ff0}50%{background:green}75%{background:brown}to{background:#00f}}"
     },
     "flag": {
       "html": "<div class=\"cssload-wrapper\"><div class=\"cssload-square\"></div><div class=\"cssload-square\"></div><div class=\"cssload-square\"></div><div class=\"cssload-square\"></div><div class=\"cssload-square\"></div></div>",
       "css": ".cssload-square{width:15px;height:10px;position:absolute;top:50%;left:50%;background:#73B3FF;animation:cssload-grow 3s infinite cubic-bezier(.53,.68,.53,.41);-o-animation:cssload-grow 3s infinite cubic-bezier(.53,.68,.53,.41);-ms-animation:cssload-grow 3s infinite cubic-bezier(.53,.68,.53,.41);-webkit-animation:cssload-grow 3s infinite cubic-bezier(.53,.68,.53,.41);-moz-animation:cssload-grow 3s infinite cubic-bezier(.53,.68,.53,.41)}.cssload-square:nth-of-type(2){margin-top:12px;animation-delay:.1s;-o-animation-delay:.1s;-ms-animation-delay:.1s;-webkit-animation-delay:.1s;-moz-animation-delay:.1s}.cssload-square:nth-of-type(3){margin-top:24px;animation-delay:.2s;-o-animation-delay:.2s;-ms-animation-delay:.2s;-webkit-animation-delay:.2s;-moz-animation-delay:.2s}.cssload-square:nth-of-type(4){margin-top:36px;animation-delay:.3s;-o-animation-delay:.3s;-ms-animation-delay:.3s;-webkit-animation-delay:.3s;-moz-animation-delay:.3s}.cssload-square:nth-of-type(5){margin-top:48px;animation-delay:.4s;-o-animation-delay:.4s;-ms-animation-delay:.4s;-webkit-animation-delay:.4s;-moz-animation-delay:.4s}.cssload-wrapper{width:50px;height:98px;position:absolute;left:50%;transform-style:preserve-3d;-o-transform-style:preserve-3d;-ms-transform-style:preserve-3d;-webkit-transform-style:preserve-3d;-moz-transform-style:preserve-3d;animation:2s cssload-global infinite;-o-animation:2s cssload-global infinite;-ms-animation:2s cssload-global infinite;-webkit-animation:2s cssload-global infinite;-moz-animation:2s cssload-global infinite}@keyframes cssload-grow{0%,100%{transform:translateX(-25px) scaleX(.5);background:#73B3FF}25%,75%{transform:translateX(0) scaleY(1) scaleX(5) rotateY(180deg);background:#F0C078}50%{transform:translateX(25px) scaleX(.5);background:#73B3FF}}@-o-keyframes cssload-grow{0%,100%{-o-transform:translateX(-25px) scaleX(.5);background:#73B3FF}25%,75%{-o-transform:translateX(0) scaleY(1) scaleX(5) rotateY(180deg);background:#F0C078}50%{-o-transform:translateX(25px) scaleX(.5);background:#73B3FF}}@-ms-keyframes cssload-grow{0%,100%,50%{background:#73B3FF}0%,100%{-ms-transform:translateX(-25px) scaleX(.5)}25%,75%{-ms-transform:translateX(0) scaleY(1) scaleX(5) rotateY(180deg);background:#F0C078}50%{-ms-transform:translateX(25px) scaleX(.5)}}@-webkit-keyframes cssload-grow{0%,100%{-webkit-transform:translateX(-25px) scaleX(.5);background:#73B3FF}25%,75%{-webkit-transform:translateX(0) scaleY(1) scaleX(5) rotateY(180deg);background:#F0C078}50%{-webkit-transform:translateX(25px) scaleX(.5);background:#73B3FF}}@-moz-keyframes cssload-grow{0%,100%{-moz-transform:translateX(-25px) scaleX(.5);background:#73B3FF}25%,75%{-moz-transform:translateX(0) scaleY(1) scaleX(5) rotateY(180deg);background:#F0C078}50%{-moz-transform:translateX(25px) scaleX(.5);background:#73B3FF}}@keyframes cssload-global{0%,100%{transform:rotateY(0)}50%{transform:rotateY(360deg)}}@-o-keyframes cssload-global{0%,100%{-o-transform:rotateY(0)}50%{-o-transform:rotateY(360deg)}}@-ms-keyframes cssload-global{0%,100%{-ms-transform:rotateY(0)}50%{-ms-transform:rotateY(360deg)}}@-webkit-keyframes cssload-global{0%,100%{-webkit-transform:rotateY(0)}50%{-webkit-transform:rotateY(360deg)}}@-moz-keyframes cssload-global{0%,100%{-moz-transform:rotateY(0)}50%{-moz-transform:rotateY(360deg)}}"
     },
     "rhombus": {
       "html": "<div class=\"cssload-loading\"><div class=\"cssload-loading-circle cssload-loading-row1 cssload-loading-col3\"></div><div class=\"cssload-loading-circle cssload-loading-row2 cssload-loading-col2\"></div><div class=\"cssload-loading-circle cssload-loading-row2 cssload-loading-col3\"></div><div class=\"cssload-loading-circle cssload-loading-row2 cssload-loading-col4\"></div><div class=\"cssload-loading-circle cssload-loading-row3 cssload-loading-col1\"></div><div class=\"cssload-loading-circle cssload-loading-row3 cssload-loading-col2\"></div><div class=\"cssload-loading-circle cssload-loading-row3 cssload-loading-col3\"></div><div class=\"cssload-loading-circle cssload-loading-row3 cssload-loading-col4\"></div><div class=\"cssload-loading-circle cssload-loading-row3 cssload-loading-col5\"></div><div class=\"cssload-loading-circle cssload-loading-row4 cssload-loading-col2\"></div><div class=\"cssload-loading-circle cssload-loading-row4 cssload-loading-col3\"></div><div class=\"cssload-loading-circle cssload-loading-row4 cssload-loading-col4\"></div><div class=\"cssload-loading-circle cssload-loading-row5 cssload-loading-col3\"></div></div>",
       "css": ".cssload-loading{height:85px;left:50%;position:absolute;width:85px;transform:translateZ(0);-o-transform:translateZ(0);-ms-transform:translateZ(0);-webkit-transform:translateZ(0);-moz-transform:translateZ(0)}.cssload-loading-circle{background-color:#000;border-radius:50%;height:14px;position:absolute;width:14px;animation:2291ms cssload-loading infinite;-o-animation:2291ms cssload-loading infinite;-ms-animation:2291ms cssload-loading infinite;-webkit-animation:2291ms cssload-loading infinite;-moz-animation:2291ms cssload-loading infinite;transform:scale(0);-o-transform:scale(0);-ms-transform:scale(0);-webkit-transform:scale(0);-moz-transform:scale(0)}.cssload-loading-circle:nth-child(1){animation-delay:42ms;-o-animation-delay:42ms;-ms-animation-delay:42ms;-webkit-animation-delay:42ms;-moz-animation-delay:42ms}.cssload-loading-circle:nth-child(2){animation-delay:84ms;-o-animation-delay:84ms;-ms-animation-delay:84ms;-webkit-animation-delay:84ms;-moz-animation-delay:84ms}.cssload-loading-circle:nth-child(3){animation-delay:126ms;-o-animation-delay:126ms;-ms-animation-delay:126ms;-webkit-animation-delay:126ms;-moz-animation-delay:126ms}.cssload-loading-circle:nth-child(4){animation-delay:168ms;-o-animation-delay:168ms;-ms-animation-delay:168ms;-webkit-animation-delay:168ms;-moz-animation-delay:168ms}.cssload-loading-circle:nth-child(5){animation-delay:210ms;-o-animation-delay:210ms;-ms-animation-delay:210ms;-webkit-animation-delay:210ms;-moz-animation-delay:210ms}.cssload-loading-circle:nth-child(6){animation-delay:252ms;-o-animation-delay:252ms;-ms-animation-delay:252ms;-webkit-animation-delay:252ms;-moz-animation-delay:252ms}.cssload-loading-circle:nth-child(7){animation-delay:294ms;-o-animation-delay:294ms;-ms-animation-delay:294ms;-webkit-animation-delay:294ms;-moz-animation-delay:294ms}.cssload-loading-circle:nth-child(8){animation-delay:336ms;-o-animation-delay:336ms;-ms-animation-delay:336ms;-webkit-animation-delay:336ms;-moz-animation-delay:336ms}.cssload-loading-circle:nth-child(9){animation-delay:378ms;-o-animation-delay:378ms;-ms-animation-delay:378ms;-webkit-animation-delay:378ms;-moz-animation-delay:378ms}.cssload-loading-circle:nth-child(10){animation-delay:420ms;-o-animation-delay:420ms;-ms-animation-delay:420ms;-webkit-animation-delay:420ms;-moz-animation-delay:420ms}.cssload-loading-circle:nth-child(11){animation-delay:462ms;-o-animation-delay:462ms;-ms-animation-delay:462ms;-webkit-animation-delay:462ms;-moz-animation-delay:462ms}.cssload-loading-circle:nth-child(12){animation-delay:504ms;-o-animation-delay:504ms;-ms-animation-delay:504ms;-webkit-animation-delay:504ms;-moz-animation-delay:504ms}.cssload-loading-circle:nth-child(13){animation-delay:546ms;-o-animation-delay:546ms;-ms-animation-delay:546ms;-webkit-animation-delay:546ms;-moz-animation-delay:546ms}.cssload-loading-row1{top:1.3px}.cssload-loading-row2{top:18.95px}.cssload-loading-row3{top:36.55px}.cssload-loading-row4{top:54.2px}.cssload-loading-row5{top:71.85px}.cssload-loading-col1{left:1.25px}.cssload-loading-col2{left:18.85px}.cssload-loading-col3{left:36.5px}.cssload-loading-col4{left:54.15px}.cssload-loading-col5{left:71.8px}@keyframes cssload-loading{0%{transform:scale(0)}27.28%{transform:scale(1)}36.36%,54.55%{transform:scale(.857)}100%,63.64%{transform:scale(0)}}@-o-keyframes cssload-loading{0%{-o-transform:scale(0)}27.28%{-o-transform:scale(1)}36.36%,54.55%{-o-transform:scale(.857)}100%,63.64%{-o-transform:scale(0)}}@-ms-keyframes cssload-loading{0%{-ms-transform:scale(0)}27.28%{-ms-transform:scale(1)}36.36%,54.55%{-ms-transform:scale(.857)}100%,63.64%{-ms-transform:scale(0)}}@-webkit-keyframes cssload-loading{0%{-webkit-transform:scale(0)}27.28%{-webkit-transform:scale(1)}36.36%,54.55%{-webkit-transform:scale(.857)}100%,63.64%{-webkit-transform:scale(0)}}@-moz-keyframes cssload-loading{0%{-moz-transform:scale(0)}27.28%{-moz-transform:scale(1)}36.36%,54.55%{-moz-transform:scale(.857)}100%,63.64%{-moz-transform:scale(0)}}"
     },
     "pyramid": {
       "html": "<div class=\"cssload-triangles\"><div class=\"cssload-tri cssload-invert\"></div><div class=\"cssload-tri cssload-invert\"></div><div class=\"cssload-tri\"></div><div class=\"cssload-tri cssload-invert\"></div><div class=\"cssload-tri cssload-invert\"></div><div class=\"cssload-tri\"></div><div class=\"cssload-tri cssload-invert\"></div><div class=\"cssload-tri\"></div><div class=\"cssload-tri cssload-invert\"></div></div>",
       "css": ".cssload-tri,.cssload-tri.cssload-invert{border-left:15px solid transparent;border-right:15px solid transparent}.cssload-triangles{transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);height:81px;width:90px;position:absolute;left:50%}.cssload-tri{position:absolute;animation:cssload-pulse 750ms ease-in infinite;-o-animation:cssload-pulse 750ms ease-in infinite;-ms-animation:cssload-pulse 750ms ease-in infinite;-webkit-animation:cssload-pulse 750ms ease-in infinite;-moz-animation:cssload-pulse 750ms ease-in infinite;border-top:27px solid #215A6D;border-bottom:0}.cssload-tri.cssload-invert{border-top:0;border-bottom:27px solid #215A6D}.cssload-tri:nth-child(1){left:30px}.cssload-tri:nth-child(2){left:15px;top:27px;animation-delay:-125ms;-o-animation-delay:-125ms;-ms-animation-delay:-125ms;-webkit-animation-delay:-125ms;-moz-animation-delay:-125ms}.cssload-tri:nth-child(3){left:30px;top:27px}.cssload-tri:nth-child(4){left:45px;top:27px;animation-delay:-625ms;-o-animation-delay:-625ms;-ms-animation-delay:-625ms;-webkit-animation-delay:-625ms;-moz-animation-delay:-625ms}.cssload-tri:nth-child(5){top:54px;animation-delay:-250ms;-o-animation-delay:-250ms;-ms-animation-delay:-250ms;-webkit-animation-delay:-250ms;-moz-animation-delay:-250ms}.cssload-tri:nth-child(6){top:54px;left:15px;animation-delay:-250ms;-o-animation-delay:-250ms;-ms-animation-delay:-250ms;-webkit-animation-delay:-250ms;-moz-animation-delay:-250ms}.cssload-tri:nth-child(7){top:54px;left:30px;animation-delay:-375ms;-o-animation-delay:-375ms;-ms-animation-delay:-375ms;-webkit-animation-delay:-375ms;-moz-animation-delay:-375ms}.cssload-tri:nth-child(8){top:54px;left:45px;animation-delay:-.5s;-o-animation-delay:-.5s;-ms-animation-delay:-.5s;-webkit-animation-delay:-.5s;-moz-animation-delay:-.5s}.cssload-tri:nth-child(9){top:54px;left:60px;animation-delay:-.5s;-o-animation-delay:-.5s;-ms-animation-delay:-.5s;-webkit-animation-delay:-.5s;-moz-animation-delay:-.5s}@keyframes cssload-pulse{0%,16.666%{opacity:1}100%{opacity:0}}@-o-keyframes cssload-pulse{0%,16.666%{opacity:1}100%{opacity:0}}@-ms-keyframes cssload-pulse{0%,16.666%{opacity:1}100%{opacity:0}}@-webkit-keyframes cssload-pulse{0%,16.666%{opacity:1}100%{opacity:0}}@-moz-keyframes cssload-pulse{0%,16.666%{opacity:1}100%{opacity:0}}"
     }
   }';

}

//Preloader
function build_preloader() {
	global $brainwave;
	$spinner_type = ( ! empty( $brainwave['spinner-type'] ) ) ? $brainwave['spinner-type'] : 'default';
	$preloader    = '';
	switch ( $spinner_type ) {
		case 'default':
			$preloader = '<div class="preloader loading">'
			             . '<span class="slice"></span>'
			             . '<span class="slice"></span>'
			             . '<span class="slice"></span>'
			             . '<span class="slice"></span>'
			             . '<span class="slice"></span>'
			             . '<span class="slice"></span>'
			             . '</div>';
			break;
		case 'image':
			$preloader = '<div class="preloader image"><img src="' . $brainwave['image-spinner']['url'] . '"/></div>';
			break;
		case 'predefined':
			$spinners  = bw_get_preloaders_list();
			$spinners  = json_decode( $spinners );
			$preloader = '<div class="preloader image">' . $spinners->{$brainwave['spinner_predefined']}->html . '</div>';
			break;
		case 'custom':
			$preloader = ( ! empty( $brainwave['custom_spinner_html'] ) ) ? $brainwave['custom_spinner_html'] : '';
			break;
		case 'none':
			break;
		default:
			# code...
			break;
	}
	echo $preloader;
}

// function for creative header get
function bw_get_creative_header( $id ) {

	$creative_enable = get_post_meta( $id, 'creative_enable', true );
	$creative_header = get_post_meta( $id, 'creative_header', true );
	$creative_header = trim( $creative_header );
	if ( $creative_enable === 'true' ) :
		if ( ! empty( $creative_header ) && ( $creative_header != '{}' ) ) :
			ob_start();
			?>
			<div class="container">
				<div class="owl-carousel default-carousel mt-100">
					<?php
					$creative_header = (array) json_decode( $creative_header );
					foreach ( $creative_header as $slide ) :
						?>
						<div><a href="#"><img src="<?php echo esc_url( $slide->url ); ?>" alt="" width="1200"
						                      height="600"></a></div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		endif;
	endif;
	echo ob_get_clean();
}

// function for sections background get
function bw_get_section_bg( $id ) {

	$section_bg_col     = get_post_meta( $id, 'section_bg_col', true ); // get post meta
	$section_bg         = get_post_meta( $id, 'section_bg', true ); // get post meta
	$bg_overlay_opacity = get_post_meta( $id, 'overlay-opacity', true );
	$bg_overlay_color   = get_post_meta( $id, 'overlay-color', true );

	if ( empty( $bg_overlay_opacity ) ) : $bg_overlay_opacity = '1'; endif;
	if ( empty( $bg_overlay_color ) ) : $bg_overlay_color = '#ffffff'; endif;
	if ( empty( $section_bg ) ) : unset( $section_bg ); endif;

	if ( ! empty( $section_bg ) && ( trim( $section_bg ) != '{}' ) ) {
		$col        = ( (int) $section_bg_col !== 0 ) ? (int) $section_bg_col : 12;
		$section_bg = json_decode( $section_bg );

		for ( $i = 0; $i < 12 / $col; $i ++ ) {

			if ( ! empty( $section_bg->$i->url ) ) {
				$fixed = '';
				if ( ! empty( $section_bg->$i->fixed ) ) {
					if ( $section_bg->$i->fixed == "true" ) {
						$fixed = 'background-fixed';
					}
				}
				echo '<div class="col-sm-' . $col . ' col-sm-offset-' . $col * $i . ' bg-section bg-container-left '
				     . $fixed
				     . '" data-overlay-opacity="' . esc_attr( $bg_overlay_opacity )
				     . '" data-overlay-color="' . esc_attr( $bg_overlay_color )
				     . '" data-background="' . esc_url( $section_bg->$i->url )
				     . '"></div>';
			} else {
				echo '<div class="col-sm-' . $col . ' col-sm-offset-' . $col * $i . ' bg-section bg-container-left '
				     . '" data-overlay-opacity="' . esc_attr( $bg_overlay_opacity )
				     . '" data-overlay-color="' . esc_attr( $bg_overlay_color )
				     . '"></div>';
			}
		}
	} else {
		echo '<div class="col-sm-12 bg-section bg-container-left" data-background-opacity="' . esc_attr( $bg_overlay_opacity ) . '" data-background-color="' . esc_attr( $bg_overlay_color ) . '"></div>';
	}

}

// function for show featured carousel get
function bw_show_gallery( $post ) {
	$new_featured_img = get_post_meta( $post->ID, 'new_featured_img', true ); // get post meta
	if ( isset( $new_featured_img ) && ! empty( $new_featured_img ) && ( $new_featured_img != ' ' ) ) :
		?>
		<div class='thumbnail owl-carousel default-carousel'>
			<?php
			$new_featured_img = json_decode( $new_featured_img );
			foreach ( get_object_vars( $new_featured_img ) as $key => $value ) {
				echo '<div class="item">' . wp_get_attachment_image( $new_featured_img->$key->{'id'}, 'full' ) . '</div>';
			}
			?>
		</div>
		<?php
	endif;
}

// function for shortcode from content get
function bw_get_shortcode( $shortcode = '', $page_content ) {
	$shortcode_full = '';
	if ( strpos( $page_content, '[' . $shortcode . ' ' ) ) :
		// start shortcode
		$shortcode_full .= substr( $page_content, strpos( $page_content, '[' . $shortcode . ' ' ), ( strpos( $page_content, ']', strpos( $page_content, '[' . $shortcode . ' ' ) ) - strpos( $page_content, '[' . $shortcode . ' ' ) ) + 1 );
		$content_start = '';
		$content_start = strpos( $page_content, ']', strpos( $page_content, '[' . $shortcode . ' ' ) ) + 1;
	endif;
	if ( strpos( $page_content, '[' . $shortcode . ']' ) ) :
		// start shortcode
		$shortcode_full .= substr( $page_content, strpos( $page_content, '[' . $shortcode . ']' ), ( strpos( $page_content, ']', strpos( $page_content, '[' . $shortcode . ']' ) ) - strpos( $page_content, '[' . $shortcode . ']' ) ) + 1 );
		$content_start = '';
		$content_start = strpos( $page_content, ']', strpos( $page_content, '[' . $shortcode . ']' ) ) + 1;
	endif;
	if ( strpos( $page_content, '[/' . $shortcode . ']' ) ) :
		$content_end = '';
		$content_end = strpos( $page_content, '[/' . $shortcode . ']' );
		// content of shortcode
		$shortcode_full .= substr( $page_content, $content_start, $content_end - $content_start );
		//end of shortcode
		$shortcode_full .= substr( $page_content, strpos( $page_content, '[/' . $shortcode . ']' ), ( strpos( $page_content, ']', strpos( $page_content, '[/' . $shortcode . ']' ) ) - strpos( $page_content, '[/' . $shortcode . ']' ) ) + 1 );
	endif;

	return $shortcode_full;
}

// Export Subscribers From Database
add_action( 'wp_ajax_bw_export_list', 'bw_export_list' );
add_action( 'wp_ajax_nopriv_bw_export_list', 'bw_export_list' );
function bw_export_list() {
	global $wpdb, $wp_filesystem;
	ob_clean();
	$table_name = esc_sql( $wpdb->prefix . 'bw_subscribers' );
	$is_table   = $wpdb->query( "SHOW TABLES LIKE '$table_name'" );
	if ( ! empty( $is_table ) ) {
		$result = $wpdb->get_results( "SELECT * FROM `$table_name` " );
		$csv    = "\"Email Address\"\n";
		foreach ( $result as $key => $value ) {
			$mail = get_object_vars( $value );
			$csv .= $mail['subscriber_email'] . ', ' . "\n";
		}

		$upload_dir = wp_upload_dir();
		$filename   = trailingslashit( $upload_dir['path'] ) . 'list.csv';

		if ( ! $wp_filesystem->put_contents( $filename, $csv, 0644 ) ) {
			echo 'Can\'t export subscribers';
		}

		echo esc_html( $csv );
	} else {
		echo 'Error: List is empty';
	}

	echo ob_get_clean();
	wp_die();
}

// Menu Fallback
function bw_page_menu() {
	global $brainwave;
	$menu  = '';
	$pages = get_pages();
	foreach ( $pages as $page ) {
		if ( get_the_ID() == $page->ID ) {
			$active = 'active';
		} else {
			$active = '';
		}
		if ( ( $brainwave['menu-scroll'] == '1' )
		     && ( is_front_page() && ( ( get_option( 'page_for_posts' ) != 0 ) || ( get_option( 'page_on_front' ) != 0 ) ) )
		     && ( $brainwave['onepage'] )
		     && ( get_option( 'show_on_front' ) !== 'posts' )
		     && ( $page->ID != get_option( 'page_for_posts' ) )
		     && ( $page->ID != get_option( 'page_on_front' ) )
		     && ( get_post_meta( $page->ID, 'show_in_onepage', true ) != '' )
		) {
			$menu .= '<li  class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-' . esc_attr( $page->ID ) . ' current_page_item ' . esc_attr( $active ) . '"><a title="' . esc_attr( $page->post_title ) . '" href="#' . get_post( $page->ID )->post_name . '">' . $page->post_title . '</a></li>';
		} else {
			$menu .= '<li  class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-' . esc_attr( $page->ID ) . ' current_page_item ' . esc_attr( $active ) . '"><a class="single-page-load" data-title="' . esc_attr( get_bloginfo( 'name' ) . ' | ' . $page->post_title ) . '"  title="' . esc_attr( $page->post_title ) . '" href="' . esc_url( get_page_link( $page->ID ) ) . '">' . $page->post_title . '</a></li>';
		}
	}

	$menu = '<ul class="clearfix">' . $menu . '</ul>';

	echo $menu;
}

// Build Header For Page or Post
function bw_build_header( $id ) {
	global $brainwave;

	$header_size            = ( get_post_meta( $id, 'header_size', true ) ) ? get_post_meta( $id, 'header_size', true ) : 'Normal';
	$header_bg_color        = ( get_post_meta( $id, 'header_bg_color', true ) ) ? get_post_meta( $id, 'header_bg_color', true ) : '#000000';
	$bg_fixed               = ( get_post_meta( $id, 'bg_fixed', true ) ) ? get_post_meta( $id, 'bg_fixed', true ) : '';
	$header_overlay_color   = ( get_post_meta( $id, 'header_overlay_color', true ) ) ? get_post_meta( $id, 'header_overlay_color', true ) : '';
	$header_overlay_opacity = ( get_post_meta( $id, 'header_overlay_opacity', true ) ) ? get_post_meta( $id, 'header_overlay_opacity', true ) : '0.9';
	$title_text_align       = ( get_post_meta( $id, 'title_text_align', true ) ) ? get_post_meta( $id, 'title_text_align', true ) : 'Center';
	$breadcrumb_show        = ( get_post_meta( $id, 'breadcrumb_show', true ) ) ? get_post_meta( $id, 'breadcrumb_show', true ) : '';
	$breadcrumb_pos         = ( get_post_meta( $id, 'breadcrumb_pos', true ) ) ? get_post_meta( $id, 'breadcrumb_pos', true ) : 'Bottom';
	$breadcrumb_style       = ( get_post_meta( $id, 'breadcrumb_style', true ) ) ? get_post_meta( $id, 'breadcrumb_style', true ) : 'Light';
	$breadcrumb_bg          = ( get_post_meta( $id, 'breadcrumb_bg', true ) ) ? get_post_meta( $id, 'breadcrumb_bg', true ) : '';
	$title_text_color       = ( get_post_meta( $id, 'title_text_color', true ) ) ? get_post_meta( $id, 'title_text_color', true ) : '#ffffff';
	$title_font_weight      = ( get_post_meta( $id, 'title_font_weight', true ) ) ? get_post_meta( $id, 'title_font_weight', true ) : '100';
	$title_letter_spacing   = ( get_post_meta( $id, 'title_letter_spacing', true ) ) ? get_post_meta( $id, 'title_letter_spacing', true ) : '0.3';
	$title_border           = ( get_post_meta( $id, 'title_border', true ) ) ? get_post_meta( $id, 'title_border', true ) : '';
	$title_border_color     = ( get_post_meta( $id, 'title_border_color', true ) ) ? get_post_meta( $id, 'title_border_color', true ) : '';
	$header_subtitle        = ( get_post_meta( $id, 'header_subtitle', true ) ) ? esc_html( get_post_meta( $id, 'header_subtitle', true ) ) : '';

	$title = '<h1 class="text-uppercase ';                                    // Title tag start
	if ( ! empty( $title_letter_spacing ) ) {
		$title_letter_spacing = (float) $title_letter_spacing / 0.01;
		$title .= esc_attr( 'ls-0' . $title_letter_spacing ) . ' ';                    // Title Letter Spacing
	}
	if ( ! empty( $title_font_weight ) ) {
		$title .= esc_attr( 'fw-' . $title_font_weight ) . ' ';                             // Font Weight
	}
	if ( ! empty( $title_border ) ) {
		$title .= esc_attr( 'title-border display-ib' );                                    //Title border
	}
	$title .= '" ';                                                           // Classes end
	if ( ! empty( $title_text_color ) ) {
		$title .= 'data-color="' . esc_attr( $title_text_color ) . '" ';                    // Title text color
	}
	$title .= 'data-border-color="' . esc_attr( $title_border_color ) . '" ';             // Title border color
	$title .= '>';                                                            // Title start
	$title .= bw_title();                                           // Gets page title
	$title .= '</h1>';                                                        // Title end and tag closed

	$title_letter_spacing = ( get_post_meta( $id, 'title_letter_spacing', true ) ) ? get_post_meta( $id, 'title_letter_spacing', true ) : '0.3';
	$subtitle             = '<p class="text-uppercase ';                                  // SubTitle tag start
	if ( ! empty( $title_letter_spacing ) ) {
		$title_letter_spacing = (float) $title_letter_spacing / 0.01;
		$subtitle .= esc_attr( 'ls-0' . $title_letter_spacing ) . ' ';                       // SubTitle Letter Spacing
	}
	$subtitle .= '" ';                                                        // Classes end
	if ( ! empty( $title_text_color ) ) {
		$subtitle .= 'data-color="' . esc_attr( $title_text_color ) . '" ';                 // SubTitle text color
	}
	$subtitle .= '>';                                                         // SubTitle start
	$subtitle .= $header_subtitle;                                            // Gets page subtitle
	$subtitle .= '</p>';                                                      // SubTitle end and tag closed

	$header = '<div ';                                                      // Header start
	$header .= 'class="page-header';                                         // Classes start
	switch ( $header_size ) {
		case 'Small':
			$header .= '-small ';                                                 // small header section
			break;
		case 'Large':
			$header .= '-large ';                                                 // large header section
			break;
		default:
			break;                                                                // normal header section
	}
	if ( ! empty( $bg_fixed ) ) {
		$header .= ' background-fixed ';                                        // Fixed BG Image
	}
	$header .= '" ';                                                          // Classes end
	$header .= ' data-background-color="' . esc_attr( $header_bg_color ) . '" ';          // BG color
	if ( has_post_thumbnail( $id ) ) {
		$header_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail_name' );
		$header .= ' data-background="' . esc_attr( $header_bg_image[0] ) . '" ';           // BG image
	}

	if ( ! empty( $header_overlay_color ) ) {
		$header .= ' data-overlay-color="' . esc_attr( $header_overlay_color ) . '" ';      // Overlay color
	} else {
		$header .= ' data-overlay-color="' . esc_attr( $brainwave['bg-color'] ) . '" ';     // Overlay color
	}
	if ( ! empty( $header_overlay_opacity ) ) {
		$header .= ' data-overlay-opacity="' . esc_attr( $header_overlay_opacity ) . '" ';  // Overlay opacity
	} else {
		$header .= ' data-overlay-opacity="' . esc_attr( $brainwave['bg-opacity'] ) . '" '; // Overlay opacity
	}

	$header .= '>';                                                           // Classes end
	$header .= '<div class="container">';                                     // Container start

	switch ( $title_text_align ) {
		case 'Left':
			$title_text_align = '<div class="text-left">';
			break;
		case 'Right':
			$title_text_align = '<div class="text-right">';
			break;
		default:
			$title_text_align = '<div class="text-center">';
			break;
	}


	if ( ! empty( $breadcrumb_show ) ) {
		switch ( $breadcrumb_pos ) {
			case 'Left':
				$header .= '<div class="col-sm-5">';
				$header .= '<div class="text-left">';
				$header .= bw_breadcrumbs( $id );
				$header .= '</div>';
				$header .= '</div>';

				$header .= '<div class="col-sm-7">';
				$header .= $title_text_align;
				$header .= $title;
				$header .= $subtitle;
				$header .= '</div>';
				$header .= '</div>';

				break;
			case 'Right':
				$header .= '<div class="col-sm-7">';
				$header .= $title_text_align;
				$header .= $title;
				$header .= $subtitle;
				$header .= '</div>';
				$header .= '</div>';

				$header .= '<div class="col-sm-5">';
				$header .= '<div class="text-right">';
				$header .= bw_breadcrumbs( $id );
				$header .= '</div>';
				$header .= '</div>';

				break;
			case 'Top':
				$header .= '<div class="col-sm-12">';
				$header .= '<div class="text-center">';
				$header .= bw_breadcrumbs( $id );
				$header .= '</div>';
				$header .= '</div>';

				$header .= '<div class="col-sm-12">';
				$header .= $title_text_align;
				$header .= $title;
				$header .= $subtitle;
				$header .= '</div>';
				$header .= '</div>';

				break;
			case 'Bottom':
				$header .= '<div class="col-sm-12">';
				$header .= '<div class="text-center">';
				$header .= $title;
				$header .= $subtitle;
				$header .= '</div>';
				$header .= '</div>';

				$header .= '<div class="col-sm-12">';
				$header .= $title_text_align;
				$header .= bw_breadcrumbs( $id );
				$header .= '</div>';
				$header .= '</div>';
				break;
			default:
				break;
		}
	} else {
		$header .= '<div class="col-sm-12">';
		$header .= $title_text_align;
		$header .= $title;
		$header .= $subtitle;
		$header .= '</div>';
		$header .= '</div>';
	}
	$header .= '</div>';                                                    // Container end
	$header .= '</div>';

	return $header;
}

// Breadcrumbs
function bw_breadcrumbs( $id ) {

	$classes          = 'mt30 mb0';
	$breadcrumb_style = get_post_meta( $id, 'breadcrumb_style', true );
	$breadcrumb_bg    = get_post_meta( $id, 'breadcrumb_bg', true );
	if ( $breadcrumb_style == 'Light' ) {
		$classes .= ' white ';
	}
	if ( empty ( $breadcrumb_bg ) ) {
		$classes .= ' no-bg ';
	}

	// Get the query & post information
	global $post, $wp_query;

	$breadcrumb = '';
	$parents    = '';
	// Do not display on the homepage
	if ( ! is_front_page() ) {
		// Build the breadcrums
		$breadcrumb .= '<ol class="breadcrumb ' . esc_attr( $classes ) . ' ">';

		// Home page
		$breadcrumb .= '<li><a href="' . esc_url( get_home_url() ) . '" title="' . __( 'Home', 'brainwave' ) . '">Home</a></li>';

		if ( is_single() ) {
			// If post is a custom post type
			$post_type = get_post_type();

			// If it is a custom post type display name and link
			if ( $post_type != 'post' ) {
				$post_type_object  = get_post_type_object( $post_type );
				$post_type_archive = get_post_type_archive_link( $post_type );

				$breadcrumb .= '<li><a href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a></li>';
			}

			// Get post category info
			$category = get_the_category();

			// Get last category post is in
			// $last_category = end( array_values( $category ) );
			$last_category = end( $category );

			// Get parent any categories and create array
			$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
			$cat_parents     = explode( ',', $get_cat_parents );

			// Loop through parent categories and store in variable $cat_display
			$cat_display = '';
			foreach ( $cat_parents as $parents ) {
				$cat_display .= '<li>' . $parents . '</li>';
			}

			// Check if the post is in a category
			if ( ! empty( $last_category ) ) {
				$breadcrumb .= $cat_display;
				$breadcrumb .= '<li class="active">' . bw_title() . '</li>';
				// Elseif post is in a custom taxonomy
			} elseif ( ! empty( $cat_id ) ) {
				$breadcrumb .= '<li><a href="' . esc_url( $cat_link ) . '" title="' . esc_attr( $cat_name ) . '">' . $cat_name . '</a></li>';
				$breadcrumb .= '<li class="active">' . bw_title() . '</li>';
			} else {
				$breadcrumb .= '<li class="active">' . bw_title() . '</li>';
			}
		} elseif ( is_category() ) {
			// Category page
			$breadcrumb .= '<li class="active">' . single_cat_title( '', false ) . '</li>';
		} elseif ( is_page() ) {
			// Standard page
			if ( $post->post_parent ) {
				// If child page, get parents
				$anc = get_post_ancestors( $post->ID );

				// Get parents in the right order
				$anc = array_reverse( $anc );

				// Parent page loop
				foreach ( $anc as $ancestor ) {
					$parents .= '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_attr( get_the_title( $ancestor ) ) . '">' . get_the_title( $ancestor ) . '</a></li>';
				}

				// Display parent pages
				$breadcrumb .= $parents;

				// Current page
				$breadcrumb .= '<li class="active">' . bw_title() . '</li>';

			} else {
				// Just display current page if not parents
				$breadcrumb .= '<li class="active">' . bw_title() . '</li>';
			}
		} elseif ( is_tag() ) {
			// Tag page
			// Get tag information
			$term_id  = get_query_var( 'tag_id' );
			$taxonomy = 'post_tag';
			$args     = 'include=' . $term_id;
			$terms    = get_terms( $taxonomy, $args );

			// Display the tag name
			$breadcrumb .= '<li class="active">' . $terms[0]->name . '</li>';
		} elseif ( is_archive() ) {
			if ( is_day() ) {
				// Day archive
				// Year link
				$breadcrumb .= '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . __( 'Archives', 'brainwave' ) . '</a></li>';

				// Month link
				$breadcrumb .= '<li><a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_attr( get_the_time( 'M' ) ) . '">' . get_the_time( 'M' ) . __( 'Archives', 'brainwave' ) . '</a></li>';

				// Day display
				$breadcrumb .= '<li class="active">' . get_the_time( 'jS' ) . ' ' . get_the_time( 'M' ) . __( 'Archives', 'brainwave' ) . '</li>';

			} elseif ( is_month() ) {
				// Month Archive
				// Year link
				$breadcrumb .= '<li><a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_attr( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . __( 'Archives', 'brainwave' ) . '</a></li>';

				// Month display
				$breadcrumb .= '<li class="active">' . get_the_time( 'M' ) . ' Archives</li>';
			} elseif ( is_year() ) {
				// Display year archive
				$breadcrumb .= '<li class="active">' . get_the_time( 'Y' ) . ' Archives</li>';
			} elseif ( is_author() ) {
				// Auhor archive
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );

				// Display author name
				$breadcrumb .= '<li class="active">' . __( 'Author: ', 'brainwave' ) . $userdata->display_name . '</li>';

			} elseif ( get_query_var( 'paged' ) ) {
				// Paginated archives
				$breadcrumb .= '<li class="active">' . __( 'Page', 'brainwave' ) . ' ' . get_query_var( 'paged' ) . '</li>';
			}
		} elseif ( is_search() ) {
			// Search results page
			$breadcrumb .= '<li class="active">' . __( 'Search results for:', 'brainwave' ) . get_search_query() . '</li>';
		} elseif ( is_404() ) {
			// 404 page
			$breadcrumb .= '<li>' . __( 'Error 404', 'brainwave' ) . '</li>';
		}
		$breadcrumb .= '</ol>';
	}

	return $breadcrumb;
}

if ( ! function_exists( 'array_column' ) ) {
	function array_column( array $input, $columnKey, $indexKey = null ) {
		$array = array();
		foreach ( $input as $value ) {
			if ( ! isset( $value[ $columnKey ] ) ) {
				trigger_error( "Key \"$columnKey\" does not exist in array" );

				return false;
			}
			if ( is_null( $indexKey ) ) {
				$array[] = $value[ $columnKey ];
			} else {
				if ( ! isset( $value[ $indexKey ] ) ) {
					trigger_error( "Key \"$indexKey\" does not exist in array" );

					return false;
				}
				if ( ! is_scalar( $value[ $indexKey ] ) ) {
					trigger_error( "Key \"$indexKey\" does not contain scalar value" );

					return false;
				}
				$array[ $value[ $indexKey ] ] = $value[ $columnKey ];
			}
		}

		return $array;
	}
}
