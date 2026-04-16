const inputs = document.querySelectorAll('input');
  inputs.forEach(input => {
   input.addEventListener('blur', function() {
   // Jika input ada isinya, tambah class 'used', jika kosong hapus
   if (this.value) {
         this.classList.add('used');
      } else {
        this.classList.remove('used');
      }
    });
  });



