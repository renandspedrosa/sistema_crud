function validarSenha(){ 
    var senha = document.getElementById('senha').value
    var senha1 = document.getElementById('senha1').value
    if (senha !== senha1) {
      swal ( " Senhas não batem!"," Verifique o valor digitado. ")  ;
      document.getElementById('senha1').value = ""
      return false
      } else {
        return true
    }
  }
