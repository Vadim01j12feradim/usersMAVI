var namePattern = /^[a-zA-Z]+$/;
   function validateName(name) {
      return name.match(namePattern);
   }
   var lastNamePattern = /^[a-zA-Z]+$/;

   function validateLastName(lastName) {
      return lastName.match(lastNamePattern);
   }
   var addressPattern = /^[a-zA-Z0-9\s\.,#-]+$/;

   function validateAddress(address) {
      return address.match(addressPattern);
   }

   var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function validateEmail(email) {
    return emailPattern.test(email);
}