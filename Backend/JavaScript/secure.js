document.oncontextmenu = function(){
    return false;
}

document.onkeydown = function(e) {
    if (e.ctrlKey && (e.keyCode === 85)) { // 85 es el código de tecla para la 'U'
        return false;
    }
};
