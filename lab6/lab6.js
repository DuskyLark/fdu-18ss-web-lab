var timer=null;

function startMove(tar,obj,alpha) {
    clearInterval(timer);
    timer = setInterval(function () {
        var ispeed= alpha<tar?0.8:-0.8;
        if(alpha==tar){
            clearInterval(timer)
        }
        else{
            alpha+=ispeed;
            obj.style.opacity=alpha/100;
        }
    }, 10)
}

window.onload=function showFeatured() {
    var thumbnails = document.getElementById("thumbnails").getElementsByTagName('img');//获得缩略图
    var featuredImg = document.getElementById("featured").getElementsByTagName("img");
    var featuredCaption = document.getElementById("featured").getElementsByTagName("figcaption");
    for (var i = 0; i < thumbnails.length; i++) {
        thumbnails[i].onclick = function () {
            featuredImg[0].src = (this.src).replace("small", "medium");//替换图片
            featuredCaption[0].innerText = this.title;//替换文字
            featuredImg[0].title = this.title;
        }
    }
    document.getElementById("featured").onmouseover = function () {
        // changeOpacity(featuredCaption[0], 0.8, 1000);
        startMove(80,featuredCaption[0],0)
    };
    document.getElementById("featured").onmouseout = function () {
        // changeOpacity(featuredCaption[0], 0, 1000);
        startMove(0,featuredCaption[0],80)
    };
};