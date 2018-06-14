function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            document.querySelector('.client_create-img--file img').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

document.querySelector("#file").addEventListener('change', function(){
    readURL(this);
});