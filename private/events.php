<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Event Planning</title>
    <link rel="stylesheet" href="/EventManagement/public/stylesheet/Style_2.css">
    <script src="../public/scripts/Script.js" defer></script>
</head>
<body>
    <?php
        require "config/events_process.php";
        session_start();
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
        }
        if(isset($_SESSION['events'])){
            $events = $_SESSION['events'];
            unset($_SESSION['events']);
        }else{
            $events = listAllEvents();
        }    
        

    ?>
    <div class="div_container">
        <div class="">
            <h2 class="event_header">Events</h2>
     
            <div class="event_header">
                <button class="filter-btn" data-filter="all" onclick="loadContent('/EventManagement/private/events.php')">All Events</button>
                <button class="filter-btn" type="submit" onclick="loadContent('/EventManagement/private/search_event.php')">Search Event</button>
            </div>
         
            <!-- Timeline Container -->
            <div class="event_container">
                <?php
                    foreach ($events as $event) {
                        echo "<div class='event-content'>
                                <p class=\"timeline-date\">" . date('l', strtotime($event['date'])) . ", {$event['date']}, ". substr($event['time'], 0,5)."</p>
                                <h3 class=\"timeline-title\">{$event['event_name']}</h3>
                                <p class=\"timeline-location\">📍 {$event['location']}</p>
                                <p class=\"timeline-description\">{$event['description']}</p>
                                <p class=\"timeline-participants\">👥". getAttendees($event['id'])."/{$event['max_attendees']} Participants ";                
                        if(isset($userid)){
                            if($userid == $event['user_id']){  
                                echo "<div class='div-button'>";
                                echo "<form method='post' action='/EventManagement/public/index.php?active=edit&eventid={$event['id']}'>                                                 
                                        <button type='submit'>Edit</button>
                                    </form>";    
                                echo "<form method='post' action='../private/config/delete_event.php'>
                                        <input type='hidden' name='userid' value='{$userid}'>
                                        <input type='hidden' name='eventid' value='{$event['id']}'>
                                        <button type='submit'>Delete</button>
                                     </form>";
                                echo "</div>";
                            }else if (hasUserBookEvent($userid, $event['id']) <=0) {
                                echo "<form method='post' action='/EventManagement/private/register_event.php'>
                                    <input type='hidden' name='userid' value='{$userid}'>
                                    <input type='hidden' name='eventid' value='{$event['id']}'>
                                    <button type='submit'>Register</button>
                                    </form>";
                            }else{
                                echo "<form method='post' action='/EventManagement/private/cancel_event.php'>
                                    <input type='hidden' name='userid' value='{$userid}'>
                                    <input type='hidden' name='eventid' value='{$event['id']}'>
                                    <button type='submit'>Cancel Registration</button>
                                    </form>";
                            }
                        }                      
                            
                        echo "</p></div>";               
                    }
                ?>
            </div>
        </div>
    </div>


</body>
</html>