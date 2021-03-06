// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  // The response object is returned with a status field that lets the
  // app know the current login status of the person.
  // Full docs on the response object can be found in the documentation
  // for FB.getLoginStatus().
  
  // This is called with the results from from FB.getLoginStatus().<br>function statusChangeCallback(response) {

  if (response.status === 'connected') {
    // Logged into your app and Facebook.
    testAPI();
  } 
  else if (response.status === 'not_authorized') {
    // The person is logged into Facebook, but not your app.
    document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
  }
  else {
    // The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
    document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
 }
}

// This is the callback, it calls FB.getLoginStatus() to get the state
// statusChangeCallback() is a function that's part of the example that processes the response.

function checkLoginState()
{
  FB.getLoginStatus(
    function(response) { statusChangeCallback(response); } );
}


window.fbAsyncInit = function()
{
    FB.init(
      {
        appId      : '401356637298458', // enable cookies to allow the server to access the session
        cookie     : true,
        xfbml      : true,  // parse social plugins on this page
        version    : 'v3.2' // The Graph API version to use for the call
      });

    FB.AppEvents.logPageView();
};

 // Now that we've initialized the JavaScript SDK, we call
 // FB.getLoginStatus().  This function gets the state of the
 // person visiting this page and can return one of three states to
 // the callback you provide.  They can be:
 //
 // 1. Logged into your app ('connected')
 // 2. Logged into Facebook, but not your app ('not_authorized')
 // 3. Not logged into Facebook and can't tell if they are logged into
 //    your app or not.
 //
 // These three cases are handled in the callback function.

 // That function will trigger a call to Facebook to get the login status and
 // call your callback function with the results.
 FB.getLoginStatus(function(response)
   { statusChangeCallback(response); });

 // Load the SDK asynchronously
 (function(d, s, id)
   {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   } (document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI()
  {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', { locale: 'en_US', fields: 'name, email' }, function(response)
    {
      console.log('Successful login for: ' + response.name);
      console.log('Email is: ' + response.email);
    });
  }

//<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
//</fb:login-button>

//<div id="status"></div>

