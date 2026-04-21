// Register
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



// const passwordInput = document.getElementById('password');
// const passwordError = document.getElementById('password-error');
// const  togglePasswordButton = document.getElementById('toggle-password');
// let passwordVisible = false;

// passwordInput.addEventListener('input', function () {
//     let password = passwordInput.value;
//     let valid = cekPassword(password);

//     if( valid )  {
//     	   passwordError.style.display = 'none';
//     } else {
//     	  passwordError.style.display = 'block';
//     	  passwordError.innerText = 'Password tidak memenuhi password';
//           passwordError.style.color = 'red';
//           passwordError.style.marginBottom = '20px';
//     }
// });

// togglePasswordButton.addEventListener('click', function() {
// 	 if( passwordVisible ) { 
//     passwordInput.type = 'password';
//     togglePasswordButton.innerText = 'Lihat Password';
//     passwordVisible = false;
//     passwordVisible.style.fontSize = '1em';
//    } else {
//    	  passwordInput.type = 'text';
//    	  togglePasswordButton.innerText = 'Sembunyikan password'; 
//    	  passwordVisible = true;
//        passwordVisible.style.fontSize = '1em';

//    }
// });


// Memastikan script berjalan SETELAH DOM siap
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('password-error');
    const togglePasswordButton = document.getElementById('toggle-password');
    let passwordVisible = false;

    // Tambahkan pengecekan agar tidak error jika elemen tidak ditemukan
    if (passwordInput && passwordError) {
        passwordInput.addEventListener('input', function () {
            let password = passwordInput.value;
            // Pastikan fungsi cekPassword sudah didefinisikan sebelumnya
            let valid = typeof cekPassword === 'function' ? cekPassword(password) : password.length >= 8;

            if (valid) {
                passwordError.style.display = 'none';
            } else {
                passwordError.style.display = 'block';
                passwordError.innerText = 'Password tidak memenuhi kriteria';
                passwordError.style.color = 'red';
                passwordError.style.marginBottom = '20px';
            }
        });
    }

    if (togglePasswordButton && passwordInput) {
        togglePasswordButton.addEventListener('click', function() {
            if (passwordVisible) { 
                passwordInput.type = 'password';
                togglePasswordButton.innerText = 'Lihat Password';
                passwordVisible = false;
            } else {
                passwordInput.type = 'text';
                togglePasswordButton.innerText = 'Sembunyikan password'; 
                passwordVisible = true;
            }
            // Perbaikan: Anda mencoba memberi style .fontSize pada variable boolean di kode lama
            // Jika ingin mengubah style button, gunakan:
            togglePasswordButton.style.fontSize = '1em';
        });
    }
});



// Modal
 function showModal(message) {
    return new Promise((resolve) => {
        // Buat elemen modal
        const modal = document.createElement('div');
        modal.id = 'custom-modal';
        modal.style.cssText = `
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        `;
        modal.innerHTML = `
            <div style="background: #fff; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); max-width: 400px; width: 90%;">
                <h2 style="margin-bottom: 20px; font-family: sans-serif; color: #333;">${message}</h2>
                <button id="tutup-modal" style="padding: 10px 25px; background: #333; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">OK</button>
            </div>
        `;

        document.body.appendChild(modal);

        // Tambahkan event click pada tombol
        document.getElementById('tutup-modal').addEventListener('click', function () {
            modal.remove(); // Hapus modal dari DOM
            resolve();      // Selesaikan promise
        });
    });
}

// Dropdown button
function toggleDropdown() {
    const dropdown = document.getElementById("managementDropdown");
    const arrow = document.querySelector(".arrow");
    
    // Toggle class 'show'
    dropdown.classList.toggle("show");
    
    // Animasi rotasi panah (opsional)
    if (dropdown.classList.contains("show")) {
        arrow.style.transform = "rotate(90deg)";
    } else {
        arrow.style.transform = "rotate(0deg)";
    }
}

// Menutup dropdown jika user klik di luar area menu
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-container");
        for (let i = 0; i < dropdowns.length; i++) {
            if (dropdowns[i].classList.contains('show')) {
                dropdowns[i].classList.remove('show');
            }
        }
    }
}   