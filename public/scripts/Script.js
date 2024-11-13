
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


