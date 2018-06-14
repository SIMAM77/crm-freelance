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
var moneyValue = document.querySelector('.money-humeur input'); 
moneyValue.value = 0;
money.addEventListener('touchstart', mouseDown, false);
window.addEventListener('touchend', mouseUp, false);

function mouseUp(){   
    window.removeEventListener('touchmove', divMove, true);
}

function mouseDown(){
    window.addEventListener('touchmove', divMove, true);
}

function divMove(e){
    if (e.touches[0].clientX > 245){
        money.style.left = '245px';
        money.style.transform = "scale(1.4)";
        moneyValue.value = 245;
    } else if (e.touches[0].clientX < 20){
        money.style.left = '20px';
        money.style.transform = "scale(0.9)";
        moneyValue.value = 20;
    } else if (e.touches[0].clientX < 123) {
        money.style.transform = "scale(1.1)";
        moneyValue.value = 123;
    } else {
        money.style.left = e.touches[0].clientX + 'px';
        moneyValue.value = e.touches[0].clientX;
    }
}