// document.getElementById("submit").addEventListener("click", function (event) {
//   event.preventDefault();
// });
// validate email nay <3
function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
//validate phonenumber ne <3
function validatePhone(phonenum) {
  var vnf_regex = /((09|01|02|03|06|04|03|07|08|05)+([0-9]{8})\b)/g;
  return vnf_regex.test(phonenum);
}
// function validatePassword(passWord) {
//   var pass_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
//   return pass_regex.test(passWord);
// }
// function Redirect() {
//   window.location = "homePage.html";
// }

function validateContact() {
  var name = document.getElementById("name").value; // lay value cua id name nha ae
  var phone = document.getElementById("phone").value; // lay value cua id phone nha ae
  var email = document.getElementById("email").value; // lay value cua id email nha ae
  var message = document.getElementById("message").value; // lay value cua id message nha ae
  var error_message = document.getElementById("error_message"); // lay value cua id error_message nha ae
  var text;
  if (name.length < 2 || name == "") {
    text =
      "Please Enter valid username - must be greater than 2 characters and not be Blank";
    error_message.innerHTML = text;
    return false;
  }

  if (!validatePhone(phone) || isNaN(phone)) {
    text = "Please Enter valid Phone Number";
    error_message.innerHTML = text;
    return false;
  }
  if (!validateEmail(email) || email.length < 10) {
    text = "Please Enter valid Email";
    error_message.innerHTML = text;
    return false;
  }
  if (message.length <= 3) {
    text = "Please Enter More Than 3 Characters";
    error_message.innerHTML = text;
    return false;
  }

  // alert("Register successfully <3");
    
    // alert("Register successfully <3");
    // event.preventDefault();
    // window.location.href="{{ route('contact.store') }}";
    return true;
  }

  function validateBooking() {
    var firstName = document.getElementById("first_name").value;
    var lastName = document.getElementById("last_name").value; // lay value cua id name nha ae
    var phone = document.getElementById("phone").value; // lay value cua id phone nha ae
    var email = document.getElementById("email").value; // lay value cua id email nha ae
    var address = document.getElementById("address").value; // lay value cua id message nha ae
    var provide = document.getElementById("provide").value; // lay value cua id message nha ae
    var country = document.getElementById("country").value; // lay value cua id message nha ae
    var code = document.getElementById("code").value; // lay value cua id message nha ae
    var note = document.getElementById("note").value; // lay value cua id message nha ae
    var error_message = document.getElementById("error_message"); // lay value cua id error_message nha ae
    var text;
   
    if (firstName.length < 2 || firstName.length > 50 || firstName == "") {
      text =
        "Please Enter valid first name - must be greater than 2 characters and not more than 50 character";
      error_message.innerHTML = text;
      document.getElementById("first_name").focus;
      return false;
      
    }
   
    if (lastName.length < 2 || lastName.length > 50 || lastName == "") {
      text =
        "Please Enter valid first name - must be greater than 2 characters and not more than 50 character";
      error_message.innerHTML = text;
      document.getElementById("last_name").focus;
      return false;
    }

    if (!validatePhone(phone) || isNaN(phone)) {
      text = "Please Enter valid Phone Number";
      error_message.innerHTML = text;
      document.getElementById("phone").focus;
      return false;
    }

    if (!validateEmail(email) || email.length < 10 || email.length > 100) {
      text = "Please Enter valid Email";
      error_message.innerHTML = text;
      document.getElementById("email").focus;
      return false;
    }

    if (address.length >=  200) {
      text = "Please Enter not more than 200 character";
      error_message.innerHTML = text;
      document.getElementById("address").focus;
      return false;
    }

    if (provide.length >=  50) {
      text = "Please Enter not more than 50 character";
      error_message.innerHTML = text;
      document.getElementById("provide").focus;
      return false;
    }

    if (country.length >=  100) {
      text = "Please Enter not more than 100 character";
      error_message.innerHTML = text;
      document.getElementById("country").focus;
      return false;
    }
  
    if (code.length >=  50) {
      text = "Please Enter not more than 50 character";
      error_message.innerHTML = text;
      document.getElementById("code").focus;
      return false;
    }

    if (note.length >=  500) {
      text = "Please Enter not more than 500 character";
      error_message.innerHTML = text;
      document.getElementById("note").focus;
      return false;
    }
      return true;
    }