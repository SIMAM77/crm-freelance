// switch button 
var $switch = document.querySelectorAll('.input_switch');
var $onoff = document.querySelectorAll('.input_switch span');

for (let i = 0; i <$switch.length; i++) {
    $switch[i].addEventListener('click', function(e){
        e.preventDefault();
        if($onoff[i].className == 'slider'){
            document.querySelector('.descriptionEtatSuper').textContent = 'En négociation';
            document.querySelector('#status').value = '0';
        } else {
            document.querySelector('.descriptionEtatSuper').textContent = 'En cours';
            document.querySelector('#status').value = '1';
        }

        $onoff[i].classList.toggle('slider');
    });
}

// add project 
var $btnProject = document.querySelector('.btn-add-project');
var $list = document.querySelector('.list');
var numElem = 1; 

$btnProject.addEventListener('click', function(){
    numElem += 1;

    var newDiv = '<div class="create_project_free-item item--state">';
    newDiv += '<input type="text" name="project-etape[]" id="project-etape' + numElem + '" placeholder="Etape ' + numElem + ' du projet" value=""><div class="wrap-state"><input type="checkbox" name="project-state[]"><img src="../assets/img-content/cross.svg" alt=""></div></div>';

    $list.innerHTML += newDiv;
    deleteItem();
})


var deleteItem = function() {
    var $btnDelete = document.querySelectorAll('.wrap-state img');

    for (let i = 0; i < $btnDelete.length; i++){
        $btnDelete[i].addEventListener('click', function(){
            this.parentElement.parentElement.remove();
        });
    }
}
deleteItem();
