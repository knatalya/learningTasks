document.addEventListener('keyup', function(event){
    if (event.key == "1") {c = 40;}
    else if (event.key == "2") {c = 80;}
    else if (event.key == "3") {c = 120;}
    else if (event.key == "4") {c = 160;}
    else if (event.key == "5") {c = 200;}
    else if (event.key == "6") {c = 240;}
    else if (event.key == "7") {c = 280;}
    else if (event.key == "8") {c = 320;}
    else if (event.key == "9") {c = 360;}
    let canvas = document.querySelector('#canvas');
    let ctx = canvas.getContext('2d');
    clearCanvas(ctx, canvas)
    ctx.beginPath();
    ctx.arc(100, 100, 75, 0, draw(c));
    ctx.stroke();
});
function draw(degrees) {
	return (Math.PI / 180) * degrees;
}
function clearCanvas(context, canvas) {
    context.clearRect(0, 0, canvas.width, canvas.height);
    var w = canvas.width;
    canvas.width = 1;
    canvas.width = w;
 }