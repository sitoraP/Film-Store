class User {
  constructor(firstName, lastName, email, password) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.email = email;
    this.password = password;
  }
}

function Register() {
  const fname = document.getElementById("fname").value;
  const lname = document.getElementById("lname").value;
  const email = document.getElementById("email").value;
  const pass = document.getElementById("password").value;

  const user = new User(fname, lname, email, pass);

  const json = JSON.stringify(user);
  try {
    window.open(`./PHP/addUser.php?user=${json}`, "_self");
  } catch (error) {
    alert(error.message);
  }
}
