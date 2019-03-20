<!DOCTYPE php>

<?php  //queries
//changes will be made in the functions ! (but later on)
//to found a way to pass arrays in update queries
//if you do not find a function that you need, contact me.
/*------------------------------------*/
//setup
include 'config.inc.php';
$conn = new mysqli($database_host, $database_user, $database_pass, $database_name);

/*------------------------------------*//*------------------------------------*/
//functions for the user
/*------------------------------------*//*------------------------------------*/
//for creating a new user.
function createUser($username, $email, $password)
{
    global $conn;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql_search = "INSERT INTO `User` (`Username`, `Name`, `Email`, `Password`)"
                ." VALUES ('".$username."','".$username."','".$email."','".$password."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//get data from user
function getUserData($username)
{
    global $conn;
    $sql_search = "SELECT `Name`, `Email` FROM `User` WHERE Username = '"
                .$username."'";
    $result = $conn->query($sql_search);
    //$row = $result->fetch_assoc();
    $data = $result->fetch_assoc();

    return $data;

    /*
    $name = $row["Name"];
    $email = $row["Email"];
    */
}

//get hashed password of user from database (added by Jason)
function getUserPassword($username)
{
    global $conn;
    $sql_search = "SELECT `Password` FROM `User` WHERE Username = '"
                .$username."'";
    $result = $conn->query($sql_search);
    //$row = $result->fetch_assoc();
    $data = $result->fetch_assoc();

    return $data;

    /*
    $password = $row["Password"];
    */
}

/*------------------------------------*/
//checking if the username is taken
function checkForExistingUsername($username)
{
    global $conn;
    $sql_search = "SELECT `Username` FROM `User` WHERE Username = '"
                .$username."'";
    $result = $conn->query($sql_search);
    //this if can be changed
    return $result->num_rows != 0;
}

/*------------------------------------*/
//updating an existing user's private details (email and password only)
function updateUser($username, $email, $password)
{
    global $conn;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql_search = "UPDATE `User` SET `Email`= '".$email."', `Password`='"
                .$password."' WHERE Username = '".$username."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//log in function
function logIn($username, $password)
{
    global $conn;
    $sql_search = "SELECT `Username`, `Password` FROM `User` WHERE Username = '".$username."'";
    $result = $conn->query($sql_search);
    $user = $result->fetch_assoc();
    $hash = $user['Password'];
    //this if can be changed
    return password_verify($password, $hash);
}

/*------------------------------------*//*------------------------------------*/
//functions for the event
/*------------------------------------*//*------------------------------------*/
//for creating a new event.
function createEventWithID($eventId, $master, $expirationDate, $visibility, $name,
                           $location, $description)
{
    global $conn;
    $sql_search = "INSERT INTO `Event`(`Event_ID`, `Master`, `Expiration_Date`,"
                ."`Visibility`, `Name`, `Location`, `Description`)"
                ."VALUES('".$eventId."','".$master."','".$expirationDate."','"
                .$visibility."','".$name."','".$location."','".$description."')";
    $conn->query($sql_search);
}

//generating an eventID for you
function createEvent($master, $expirationDate, $visibility, $name, $location,
                     $description)
{
    global $conn;
    $sql_nextEventID = "SELECT Event_ID FROM `Event` ORDER BY `Event`.`Event_ID` DESC";
    $result = $conn->querry($sql_nextEventID);
    $eventIdArray = $result->fetch_assoc();
    $eventId = $eventIdArray["Event_ID"] + 1;//test if this works

    $sql_search = "INSERT INTO `Event`(`Event_ID`, `Master`, `Expiration_Date`,"
                ."`Visibility`, `Name`, `Location`, `Description`)"
                ."VALUES('".$eventId."','".$master."','".$expirationDate."','"
                .$visibility."','".$name."','".$location."','".$description."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//get data from event
function getEventData($eventId)
{
    global $conn;
    $sql_search = "SELECT * FROM `Event` WHERE Event_ID = '"
                .$eventId."'";
    $result = $conn->query($sql_search);
    //$row = $result->fetch_assoc();
    $data = $result->fetch_assoc();

    return $data;

    /*
    $master = $row["Master"];
    $expirationDate = $row["Expiration_Date"];
    $visibility = $row["Visibility"];
    $name = $row["Name"];
    $location = $row["Location"];
    $description = $row["Description"];
    */
}

/*------------------------------------*/
//get all events id
function getAllEventID()
{
    global $conn;
    $sql_search = "SELECT Event_ID FROM `Event`";
    $result = $conn->query($sql_search);
    return $result;
}

/*------------------------------------*/
//updating an existing event's details (name, visibility, location, description only)
function updateEventWithID($eventId, $name, $visibility, $location, $description)
{
    global $conn;
    $sql_search = "UPDATE `Event` SET `Name`= '".$name."',
                `Visibility`='".$visibility."', `Location` = '".$location
                ."', `Description` = '".$description."' WHERE Event_ID = '".$eventId."'";
    $conn->query($sql_search);
}

//or update by master ! in this case, $eventid does not matter, use 0 or null
function updateEvent($eventId, $name, $visibility, $location, $description, $master)
{
    global $conn;
    $sql_search = "UPDATE `Event` SET `Name`= '".$name."',
                `Visibility`='".$visibility."', `Location` = '".$location
                ."', `Description` = '".$description."' WHERE Master = '".$master."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//deleting an event
function deleteEvent($eventId)  // Fixed spelling of function
{
    global $conn;
    //deleting the event from the Event table
    $sql_search = "DELETE FROM `Event` WHERE Event_ID ='"
                .$eventId."'";
    $conn->query($sql_search);

    //deleting any relations with the User table
    deleteAllEventEntriesInParticipating($eventId);

    //change all the other variables
}

/*------------------------------------*//*------------------------------------*/
//functions for relations
/*------------------------------------*//*------------------------------------*/
//this returns an array of Event_IDs for each event the user is participating
function getListOfEventsForUser($username)
{
    global $conn;
    $sql_search = "SELECT `Event_ID` FROM `Participating` WHERE Username = '"
                .$username."'";
    $listOfEvent_IDs = $conn->query($sql_search);
    return $listOfEvent_IDs;
}

/*------------------------------------*/
//this returns an array of Usernames for each user that is participating
function getListOfUsersForEvent($eventId)
{
    global $conn;
    $sql_search = "SELECT `Username` FROM `Participating` WHERE Event_ID = '"
                .$eventId."'";
    $listOfUsernames = $conn->query($sql_search);
    return $listOfUsernames;
}

/*------------------------------------*/
//this deletes every entry of an event in the participating table
function deleteAllEventEntriesInParticipating($eventId) // Fixed typo 
{
    global $conn;
    $sql_search = "DELETE FROM `Participating` WHERE Event_ID ='"
                .$eventId."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//adds a new instance in the participating table
function addANewParticipation($username, $eventID)
{
    global $conn;
    $sql_search = "INSERT INTO `Participating` (`Username`, `Event_ID`) "
                ."VALUES ('".$username."','".$eventID."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//removes an instance in the participating table (Added by Jason)
function removeAParticipation($username, $eventID)
{
    global $conn;
    $sql_search = "DELETE FROM `Participating` WHERE Event_ID ='"
                .$eventID."' AND Username ='"
                .$username."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//this deletes an instance in the likes table
function deleteObjectFromLikes($username, $object) // Fixed typo
{
    global $conn;
    $sql_search = "DELETE FROM `Likes` WHERE Username ='"
                .$username."' AND Object = '".$object."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//adds a new instance in the likes table
function addANewLikeableObject($username, $object)
{
    global $conn;
    $sql_search = "INSERT INTO `Likes` (`Object`, `Username`) "
                ."VALUES ('".$object."','".$username."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//get objects from the likes table
function getListOfLikeableObjectsForUser($username)
{
    global $conn;
    $sql_search = "SELECT * FROM `Likes` WHERE Username = '"
                .$username."'";
    $listOfLikableObjects = $conn->query($sql_search);
    return $listOfLikableObjects;
}
/*------------------------------------*//*------------------------------------*/
//functions for cache
/*------------------------------------*//*/*------------------------------------*/
//get value from the cache 
//return -1 if there was no match
function getCacheValue($like1, $like2)
{
    global $conn;
    if(strcasecmp($like1, $like2) < 0)
    {
        $switch = $like1;
        $like1 = $like2;
        $like2 = $switch;
    }
    $sql_search = "SELECT * FROM `Cache` WHERE Object1 = '"
                .$like1."' AND Object2 = '"
                .$like2."'";
    $result = $conn->query($sql_search);
    if($result == null)
        return -1;
    $data = $result->fetch_assoc();
    if($data == null)
        return -1;
    return $data["Value"];
}
/*------------------------------------*/
//new instance of (like1, like2, value) int the cache table
function addToCache($like1, $like2, $value)
{
    global $conn;
    if(strcasecmp($like1, $like2) < 0)
    {
        $switch = $like1;
        $like1 = $like2;
        $like2 = $switch;
    }
    $sql_search = "INSERT INTO `Cache` (`Object1`, `Object2`,`Value` ) "
                ."VALUES ('".$like1."','".$like2."','".$value."')";
    $conn->query($sql_search);
}

?>
