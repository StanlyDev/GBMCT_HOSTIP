document.addEventListener('DOMContentLoaded', function () {
    const checkboxFirmas = document.getElementById('mostrarFirmas');
    const firmaContainer1 = document.getElementById('firmaContainer1');
    const firmaContainer2 = document.getElementById('firmaContainer2');

    checkboxFirmas.addEventListener('change', function () {
        if (checkboxFirmas.checked) {
            firmaContainer1.classList.remove('oculto');
            firmaContainer2.classList.remove('oculto');
        } else {
            firmaContainer1.classList.add('oculto');
            firmaContainer2.classList.add('oculto');
            borrarFirma('lienzoFirma1');
            borrarFirma('lienzoFirma2');
        }
    });

    const canvas1 = document.getElementById("lienzoFirma1");
    const ctx1 = canvas1.getContext("2d");

    const canvas2 = document.getElementById("lienzoFirma2");
    const ctx2 = canvas2.getContext("2d");

    let drawing1 = false;
    let drawing2 = false;

    let lastX1, lastY1;
    let lastX2, lastY2;

    function draw(x, y, isDown, ctx, lastX, lastY) {
        if (isDown) {
            ctx.strokeStyle = '#000'; // Color del trazo
            ctx.lineWidth = 2; // Ancho del trazo
            ctx.lineJoin = 'round';
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(x, y);
            ctx.closePath();
            ctx.stroke();
        }
    }

    function borrarFirma(canvasId) {
        const canvas = document.getElementById(canvasId);
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    canvas1.addEventListener('mousedown', function (e) {
        drawing1 = true;
        lastX1 = e.pageX - this.offsetLeft;
        lastY1 = e.pageY - this.offsetTop;
        draw(lastX1, lastY1, false, ctx1);
    });

    canvas1.addEventListener('mousemove', function (e) {
        if (drawing1) {
            let currentX = e.pageX - this.offsetLeft;
            let currentY = e.pageY - this.offsetTop;
            draw(currentX, currentY, true, ctx1, lastX1, lastY1);
            lastX1 = currentX;
            lastY1 = currentY;
        }
    });

    canvas1.addEventListener('mouseup', function () {
        drawing1 = false;
        ctx1.beginPath();
    });

    canvas2.addEventListener('mousedown', function (e) {
        drawing2 = true;
        lastX2 = e.pageX - this.offsetLeft;
        lastY2 = e.pageY - this.offsetTop;
        draw(lastX2, lastY2, false, ctx2);
    });

    canvas2.addEventListener('mousemove', function (e) {
        if (drawing2) {
            let currentX = e.pageX - this.offsetLeft;
            let currentY = e.pageY - this.offsetTop;
            draw(currentX, currentY, true, ctx2, lastX2, lastY2);
            lastX2 = currentX;
            lastY2 = currentY;
        }
    });

    canvas2.addEventListener('mouseup', function () {
        drawing2 = false;
        ctx2.beginPath();
    });

    canvas1.addEventListener('touchstart', function (e) {
        drawing1 = true;
        lastX1 = e.changedTouches[0].pageX - this.offsetLeft;
        lastY1 = e.changedTouches[0].pageY - this.offsetTop;
        draw(lastX1, lastY1, false, ctx1);
    });

    canvas1.addEventListener('touchmove', function (e) {
        if (drawing1) {
            let currentX = e.changedTouches[0].pageX - this.offsetLeft;
            let currentY = e.changedTouches[0].pageY - this.offsetTop;
            draw(currentX, currentY, true, ctx1, lastX1, lastY1);
            lastX1 = currentX;
            lastY1 = currentY;
        }
    });

    canvas1.addEventListener('touchend', function () {
        drawing1 = false;
        ctx1.beginPath();
    });

    canvas2.addEventListener('touchstart', function (e) {
        drawing2 = true;
        lastX2 = e.changedTouches[0].pageX - this.offsetLeft;
        lastY2 = e.changedTouches[0].pageY - this.offsetTop;
        draw(lastX2, lastY2, false, ctx2);
    });

    canvas2.addEventListener('touchmove', function (e) {
        if (drawing2) {
            let currentX = e.changedTouches[0].pageX - this.offsetLeft;
            let currentY = e.changedTouches[0].pageY - this.offsetTop;
            draw(currentX, currentY, true, ctx2, lastX2, lastY2);
            lastX2 = currentX;
            lastY2 = currentY;
        }
    });

    canvas2.addEventListener('touchend', function () {
        drawing2 = false;
        ctx2.beginPath();
    });
});
