<!DOCTYPE php>

<?php  //queries
//changes will be made in the functions ! (but later on)
//to found a way to pass arrays in update queries
//if you do not find a function that you need, contact me.
/*------------------------------------*/
//setup
include 'config.inc.php';
$conn = new mysqli($database_host, $database_user, $database_pass,
                   $database_name);

/*------------------------------------*//*------------------------------------*/
//functions for the user
/*------------------------------------*//*------------------------------------*/
//for creating a new user.
function createUser($username, $name, $email, $password)
{
    $sql_search = "INSERT INTO `User` (`Username`, `Name`, `Email`, `Password`)"
                ." VALUES ('".$username."','".$name."','".$email."','".$password."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//get data from user
function getUserData($username)
{
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

/*------------------------------------*/
//checking if the username is taken
function checkForExistingUsername($username)
{
    $sql_search = "SELECT `Username` FROM `User` WHERE Username = '"
                .$username."'";
    $result = $conn->query($sql_search);
    //this if can be changed
    if($result->num_rows != 0)
        return true;
    else
        return false;
}

/*------------------------------------*/
//updating an existing user's private details (email and password only)
function updateUser($username, $email, $password)
{
    $sql_search = "UPDATE `User` SET `Email`= '".$email."', `Password`='"
                .$password."' WHERE Username = '".$username."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//log in function
function logIn($username, $password)
{
    $sql_search = "SELECT `Username`, `Password` FROM `User` WHERE Username = '"
                .$username."' AND Password = '".$password."'";
    $result = $conn->query($sql_search);
    //this if can be changed
    if($result->num_rows != 0)
        return true;
    else
        return false;
}

/*------------------------------------*//*------------------------------------*/
//functions for the event
/*------------------------------------*//*------------------------------------*/
//for creating a new event.
function createEvent($eventId, $master, $expirationDate, $visibility, $name,
                     $location, $description)
{
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
//updating an existing event's details (name, visibility, location, description only)
function updateEvent($eventId, $name, $visibility, $location, $description)
{
    $sql_search = "UPDATE `Event` SET `Name`= '".$name."',
                `Visibility`='".$visibility."', `Location` = '".$location
                ."', `Description` = '".$description."' WHERE Event_ID = '".$eventId."'";
    $conn->query($sql_search);
}

//or update by master ! in this case, $eventid does not matter, use 0 or null
function updateEvent($eventId, $name, $visibility, $location, $description, $master)
{
    $sql_search = "UPDATE `Event` SET `Name`= '".$name."',
                `Visibility`='".$visibility."', `Location` = '".$location
                ."', `Description` = '".$description."' WHERE Master = '".$master."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//deleting an event
function deteleEvent($eventId)
{
    //deleting the event from the Event table
    $sql_search = "DELETE FROM `Event` WHERE Event_ID ='"
                .$eventId."'";
    $conn->query($sql_search);

    //deleting any relations with the User table
    deteleAllEventEntriesInParticipating($eventId);

    //change all the other variables
}

/*------------------------------------*//*------------------------------------*/
//functions for relations
/*------------------------------------*//*------------------------------------*/
//this returns an array of Event_IDs for each event the user is participating
function getListOfEventsForUser($username)
{
    $sql_search = "SELECT `Event_ID` FROM `Participating` WHERE Username = '"
                .$username."'";
    $listOfEvent_IDs = $conn->query($sql_search);
    return $listOfEvent_IDs;
}

/*------------------------------------*/
//this returns an array of Usernames for each user that is participating
function getListOfUsersForEvent($eventId)
{
    $sql_search = "SELECT `Username` FROM `Participating` WHERE Event_ID = '"
                .$eventId."'";
    $listOfUsernames = $conn->query($sql_search);
    return $listOfUsernames;
}

/*------------------------------------*/
//this deletes every entry of an event in the participating table
function deteleAllEventEntriesInParticipating($eventId)
{
    $sql_search = "DELETE FROM `Participating` WHERE Event_ID ='"
                .$eventId."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//adds a new instance in the participating table
function addANewParticipation($username, $eventID)
{
    $sql_search = "INSERT INTO `Participating` (`Username`, `Event_ID`) "
                ."VALUES ('".$username."','".$eventId."')";
    $conn->query($sql_search);
}


/*------------------------------------*/
//this deletes an instance in the likes table
function deteleObjectFromLikes($username, $object)
{
    $sql_search = "DELETE FROM `Likes` WHERE Username ='"
                .$username."' AND Object = '".$object."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//adds a new instance in the likes table
function addANewLikableObject($username, $object)
{
    $sql_search = "INSERT INTO `Likes` (`Object`, `Username`) "
                ."VALUES ('".$object."','".$username."')";
    $conn->query($sql_search);
}

/*------------------------------------*/
//this deletes an instance in the dislikes table
function deteleObjectFromDislikes($username, $object)
{
    $sql_search = "DELETE FROM `Dislikes` WHERE Username ='"
                .$username."' AND Object = '".$object."'";
    $conn->query($sql_search);
}

/*------------------------------------*/
//adds a new instance in the likes table
function addANewDislikableObject($username, $object)
{
    $sql_search = "INSERT INTO `Dislikes` (`Object`, `Username`) "
                ."VALUES ('".$object."','".$username."')";
    $conn->query($sql_search);
}
/*------------------------------------*/
//get objects from the likes table
function getListOfLikableObjectsForUser($username)
{
    $sql_search = "SELECT * FROM `Likes` WHERE Username = '"
                .$username."'";
    $listOfLikableObjects = $conn->query($sql_search);
    return $listOfLikableObjects;
}
/*------------------------------------*/
//get objects from the dislikes table
function getListOfDislikableObjectsForUser($username)
{
    $sql_search = "SELECT * FROM `Dislikes` WHERE Username = '"
                .$username."'";
    $listOfDislikableObjects = $conn->query($sql_search);
    return $listOfDislikableObjects;
}
?>