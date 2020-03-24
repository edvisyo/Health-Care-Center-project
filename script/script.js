//Login Form 
function openLoginForm() {
   var form = document.getElementById("loginForm"); 
   form.style.display = "block";
}

function closeLoginForm() {
    var form = document.getElementById("loginForm"); 
    form.style.display = "none";
}

 function doctorRegistForm() {
    var docForm = document.getElementById("doctorRegistForm"); 
    docForm.style.display = "block";
}

//new SpecArea
document.getElementById("addNewSpec").addEventListener("click", function() {
    var newSpecForm = document.getElementById("newSpecArea");
    newSpecForm.style.display = "block";
});


function closeDoctorForm() {
    var docForm = document.getElementById("doctorRegistForm"); 
    docForm.style.display = "none";
}


function patientRegistForm() {
    var patientForm = document.getElementById("patientRegistForm"); 
    patientForm.style.display = "block";
}
 
 function closePatientForm() {
    var patientForm = document.getElementById("patientRegistForm"); 
    patientForm.style.display = "none";
}

function pharmacistRegistForm() {
    var patientForm = document.getElementById("pharmacistRegistForm"); 
    patientForm.style.display = "block";
}
 
 function closePharmacistForm() {
    var patientForm = document.getElementById("pharmacistRegistForm"); 
    patientForm.style.display = "none";
}

function assignForm() {
    var assignForm = document.getElementById("assignToForm"); 
    assignForm.style.display = "block";
}
 
 function closeAssignForm() {
    var assignForm = document.getElementById("assignToForm"); 
    assignForm.style.display = "none";
}

function userRegistForm() {
    var userForm = document.getElementById("userRegistForm"); 
    userForm.style.display = "block";
}
 
 function closeUserForm() {
    var userForm = document.getElementById("userRegistForm"); 
    userForm.style.display = "none";
}





// $("#addNewSpec").click(function() {
//     $("#newSpecArea").show();
// })
