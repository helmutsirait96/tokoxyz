function cekPassword (password) { 
	 // Rules :
	 // - Minimal 8 karakter 
	 // - Minimal 1 Huruf besar
	 // - Minimal 1 huruf kecil 
	 // - Minimal 1 angka
    // - Minimal 1 karakter spesial 

    let rules = [
           { id: 'rule-8-char', regex: /.{8,}/ },
           {  id: 'rule-upper', regex: /[A-Z]/},
           {  id: 'rule-lower', regex: /[a-z]/},
           {  id: 'rule-number', regex: /[0-9]/},
           { id: 'rule-special', regex: /[!@#$%^&*()]/}
    ]; 

   let valid = true;

   rules.forEach( function(rule) {
   	  let ruleELement = document.getElementById(rule.id);
   	  if( rule.regex.test(password) ) {
   	  	  ruleELement.style.textDecoration = 'line-through';
   	  	  ruleELement.style.color = 'green';
   	  } else {
   	  	   ruleELement.style.textDecoration = 'none';
   	  	  ruleELement.style.color = 'gray';
   	  	  valid = false;
   	  }
   });

  return valid;
}

const passwordInput = document.getElementById('password');
const passwordError = document.getElementById('password-error');
const  togglePasswordButton = document.getElementById('toggle-password');
let passwordVisible = false;

passwordInput.addEventListener('input', function () {
    let password = passwordInput.value;
    let valid = cekPassword(password);

    if( valid )  {
    	   passwordError.style.display = 'none';
    } else {
    	  passwordError.style.display = 'block';
    	  passwordError.innerText = 'Password tidak memenuhi password';
    }
})

togglePasswordButton.addEventListener('click', function() {
	 if( passwordVisible ) { 
    passwordInput.type = 'password';
    togglePasswordButton.innerText = 'Lihat Password';
    passwordVisible = false;
   } else {
   	  passwordInput.type = 'text';
   	  togglePasswordButton.innerText = 'Sembunyikan password'; 
   	  passwordVisible = true;
   }
});

 




