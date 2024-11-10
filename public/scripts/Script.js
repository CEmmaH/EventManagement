
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const activePage = urlParams.get('active');
    if (activePage) {
        if(activePage == "login"){
            loadContent('/private/Login.php');
        }else if(activePage == "plan"){
            loadContent('/private/Plan.php');
        }else if(activePage == "events"){
            loadContent('/private/events.php');
        }else if(activePage == "timeline"){
            loadContent('/private/Timeline.html');
        }else if(activePage == "signup"){
            loadContent('/private/sign-up.php');
        }else{
            loadContent('/private/aboutus.html');
        }
    }else{
        loadContent('/private/aboutus.html');
    }
};

function loadContent(page) {
    fetch(page)
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
    alert("login");
    window.location.href = '/public/index.php?active=login';
}

