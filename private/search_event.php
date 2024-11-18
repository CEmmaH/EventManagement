<!-- Login.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Event - Event Planning</title>
    <link rel="stylesheet" href="../public/stylesheet/Style.css">
</head>
<body>
    <?php
        session_start();   
        $searchName = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '';
        echo $searchName;
    ?>
    <!-- Main content -->
     <form action="/EventManagement/private/config/search_event_process.php" method="POST">
        <div class="container" role="main">
            <div class="card">
                <h2>Search Event</h2>
                    
                    <div class="event_header">  
                        <input type="text" name="searchName" id="searchName" placeholder="Search By Event Name" class="search-input">
                        <input type="text" name="location" id="location" placeholder="" class="location-input">                
                    </div>                    
                    <?php                        
                        if(isset($_SESSION['error'])){
                            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']);  // clean error message
                        }
                    ?>
                    <div class="event_header">
                     <button class="filter-btn" type="submit">Search Event</button>
                    </div>
            </div>
        </div>
     </form>
    
</body>
</html>
