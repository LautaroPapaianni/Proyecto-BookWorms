const form = document.getElementById('login-form');
const emailInput = document.getElementById('email');

let data = JSON.parse(sessionStorage.getItem('formData')) || [];

if (form){ 
form.addEventListener("submit",function (event) {
const email = emailInput.value;   
if(email){
const newData = email;
data.push(newData);
saveDataToLocalStorage();
window.location ="login.php";
}else{
alert('Todos los datos son obligatorios')
}
})
}

function saveDataToLocalStorage() {
sessionStorage.setItem('formData',JSON.stringify(data));
}