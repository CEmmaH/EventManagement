
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const activePage = urlParams.get('active');
    $eventid = urlParams.get('eventid');

    if (activePage) {
        if(activePage == "login"){
            loadContent('/EventManagement/private/Login.php');
        }else if(activePage == "create"){
            loadContent('/EventManagement/private/Submission.php');
        }else if(activePage == "events"){
            loadContent('/EventManagement/private/events.php');
        }else if(activePage == "myevent"){
            loadContent('/EventManagement/private/myevents.php');
        }else if(activePage == "signup"){
            loadContent('/EventManagement/private/sign-up.php');
        }else if(activePage == "edit"){
            loadContent('/EventManagement/private/edit_event.php',$eventid);
        }else if(activePage == "search"){
            loadContent('/EventManagement/private/search_event.php');
        }else{
            loadContent('/EventManagement/private/aboutus.html');
        }
    }else{
        loadContent('/EventManagement/private/aboutus.html');
    }

};

function loadContent(page, eventid=undefined) {
    let requestBody = {};
    if (eventid !== undefined) {
        requestBody.eventid = eventid; // Add eventid to the body if it is provided
    }
    fetch(page, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Adjust as necessary for your needs
        },
        body: JSON.stringify(requestBody)   
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('content').innerHTML = data;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            document.getElementById('content').innerHTML = '<p>Error loading content</p>';
        });
}

function logout(){
    window.location.href = '/EventManagement/public/index.php?active=login';
}
// create event validation
function validate(){
    const isNameValid = validateName();
    const isDateValid = validateDate();
    const isTimeValid = validateTime();
    const isDescriptionValid = validateDescription();    
    const isLocationValid = validateLocation();
    if( isNameValid && isDateValid && isTimeValid && isDescriptionValid && isLocationValid){
        document.getElementById("createEventForm").submit();
    }   
}

function validateName(){
    var name = document.getElementById("name");    
    if(isEmpty(name.value)){
        document.getElementById("nameSpan").textContent = "X Event name can not be empty.";
        document.getElementById("nameSpan").style.display = "inline";
        name.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("nameSpan").style.display = "none";
        name.style.borderColor = "";
        return true;
    }
}

function validateDate(){
    var date = document.getElementById("date");    
    if(isEmpty(date.value)){
        document.getElementById("dateSpan").textContent = "X Event date can not be empty.";
        document.getElementById("dateSpan").style.display = "inline";
        date.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("dateSpan").style.display = "none";
        date.style.borderColor = "";
        return true;
    }
}

function validateTime(){
    var time = document.getElementById("time");    
    if(isEmpty(time.value)){
        document.getElementById("timeSpan").textContent = "X Event time can not be empty.";
        document.getElementById("timeSpan").style.display = "inline";
        time.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("timeSpan").style.display = "none";
        time.style.borderColor = "";
        return true;
    }
}

function validateDescription(){
    var description = document.getElementById("description");    
    if(isEmpty(description.value)){
        document.getElementById("descriptionSpan").textContent = "X Event description can not be empty.";
        document.getElementById("descriptionSpan").style.display = "inline";
        description.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("descriptionSpan").style.display = "none";
        description.style.borderColor = "";
        return true;
    }
}

function validateLocation(){
    var location = document.getElementById("location");    
    if(isEmpty(location.value)){
        document.getElementById("locationSpan").textContent = "X Event location can not be empty.";
        document.getElementById("locationSpan").style.display = "inline";
        location.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("locationSpan").style.display = "none";
        location.style.borderColor = "";
        return true;
    }
}
function isEmpty(str){
    if(str != null && str.length > 0){
        return false;
    }
    return true;
}

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "name") {
        validateName();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "date") {
        validateDate();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "time") {
        validateTime();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "description") {
        validateDescription();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "location") {
        validateLocation();
    }
}, true); 

// sign up validation
function signupValidate(){
    const isUsernameValid = validateUsername();
    const isEmailValid = validateEmail();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid = validateConfirmPassword();    
    if( isUsernameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid){
        document.getElementById("signupForm").submit();
    }   
}

function validateUsername(){
    var username = document.getElementById("username");    
    if(isEmpty(username.value)){
        document.getElementById("usernameSpan").textContent = "X Username can not be empty.";
        document.getElementById("usernameSpan").style.display = "inline";
        username.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("usernameSpan").style.display = "none";
        username.style.borderColor = "";
        return true;
    }
}
function validateEmail(){
    var email = document.getElementById("email");    
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(isEmpty(email.value) || !regex.test(email.value)){
        document.getElementById("emailSpan").textContent = "X Email address should be non-empty with the format xyz@xyz.xyz.";
        document.getElementById("emailSpan").style.display = "inline";
        email.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("emailSpan").style.display = "none";
        email.style.borderColor = "";
        return true;
    }
}
function validatePassword(){
    var password = document.getElementById("password");
    const regex = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if(!regex.test(password.value)){
        document.getElementById("passwordSpan").textContent = "X Password should be at least 8 characters: 1 uppercase, 1 lowercase.";
        document.getElementById("passwordSpan").style.display = "inline";
        password.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("passwordSpan").style.display = "none";
        password.style.borderColor = "";
        return true;
    }
}
function validateConfirmPassword(){
    var rePassword = document.getElementById("confirmPassword");
    if(isEmpty(rePassword.value) || !(password.value == rePassword.value)){
        document.getElementById("confirmPasswordSpan").textContent = "X Please retype password, both passwords must be have same values.";
        document.getElementById("confirmPasswordSpan").style.display = "inline";
        rePassword.style.borderColor = "red";
        return false;
    }else{
        document.getElementById("confirmPasswordSpan").style.display = "none";
        rePassword.style.borderColor = "";
        return true;
    }
}

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "username") {
        validateUsername();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "email") {
        validateEmail();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "password") {
        validatePassword();
    }
}, true); 

document.getElementById("content").addEventListener("blur", function (event) {
    if (event.target.id === "confirmPassword") {
        validateConfirmPassword();
    }
}, true); 