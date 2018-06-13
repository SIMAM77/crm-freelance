// change happiness
var img = document.querySelectorAll(".happyIco");
var option = document.querySelectorAll(".user_details-humeur--emoji input[name=last_happiness]");

for(let i = 0; i < option.length; i++){
    option[i].addEventListener('click', function(){
        console.log('ok');
        for(var j = 0; j < img.length; j++){
            img[j].classList.remove('active');
        }

        img[i].classList.add('active');
    });
}

var money = document.querySelector('.money');
money.addEventListener('touchstart', mouseDown, false);
window.addEventListener('touchend', mouseUp, false);

function mouseUp(){   
    window.removeEventListener('touchmove', divMove, true);
}

function mouseDown(){
    window.addEventListener('touchmove', divMove, true);
}

function divMove(e){
    document.querySelector('.money').style.left = e.touches[0].clientX + 'px';
}