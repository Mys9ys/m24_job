$(document).ready(function () {
    if (window.location.pathname == '/' && screen.width > 1233) {
        $('#oxxy-block').addClass('animated_start');
        var animated_start = true;
        $(document).on('scroll', function () {
            if ($(this).scrollTop() > $('.animated_start').offset().top - $(this).height() / 4) {
                if (animated_start == true) {
                    arcFillM24('arc1', 3.14 * 2.52, 'rgb(156, 194, 24)');
                    arcFillM24('arc2', 3.14 * 3.28, 'rgb(234, 182, 41)');
                    arcFillM24('arc3', 3.14 * 3.4, 'rgb(255, 78, 51)');
                    animated_start = false;
                }
            }
        });
    }
});

function arcFillM24(id, end, color) {
    var canvas = document.getElementById(id);
    var context = canvas.getContext("2d");
    var start = 4.71;
    var stepArc = 3.14/100;
    var endArc = start;
    context.lineWidth = 5;
    var arc1 = setInterval(function(){
        if(endArc<end){
            var max = 3.14*2;
            endArc = endArc + stepArc;
            var persent = Math.floor((endArc-start)/max*100);
            context.clearRect(0, 0, 250, 250);
            context.beginPath();
            context.strokeStyle  = 'rgb(235, 235, 235)';
            context.arc(125,125,100, 0, 3.14*2 ,false);
            context.stroke();
            context.beginPath();
            context.strokeStyle  = color;
            context.arc(125,125,100, start, endArc ,false);
            context.font = "18px Sans";
            context.fillStyle = color;
            context.textAlign  = 'center';
            context.textBaseline  = 'middle';
            context.fillText(persent+'%', 125, 125);
            context.stroke();
            // console.log('end', persent);
        } else {
            clearInterval(arc1);
        }
    }, 5);
}