require('./bootstrap');


document.getElementById('number').addEventListener('keyup', function(e) {
    if (this.value.length > 4) {
        this.value = this.value.substring(0,4);
    }
});
