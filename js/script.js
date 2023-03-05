function validate() {
    let checkname = /^[a-z A-Z]{2,15}$/;
    let checkmail =
        /^[a-z 0-9.!#$%&'*+/=?^_`{|}~-]+@[a-z 0-9-]+(?:\.[a-z 0-9-]+)*$/;
    let name = document.getElementById("bt_name").value;
    let email = document.getElementById("bt_email").value;
    let msg = document.getElementById("bt_msg").value;
    if (name == "" || name == null) {
        alert("Please enter name");
        return false;
    } else if (!checkname.test(name)) {
        alert("Please enter  name");
        return false;
    } else if (email == "" || email == null) {
        alert("Please enter email name");
        return false;
    } else if (!checkmail.test(email)) {
        // alert("enter valid mail id in the format abc123@gmail.com");
        alert("Please enter valid email name");
        return false;
    } else if (msg == "" || msg == null) {
        alert("Please enter your message");
        return false;
    } else {
        return true;
    }
}
