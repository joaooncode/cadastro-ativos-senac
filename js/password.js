function validarSenha(senha) {
    const regex = /^(?=.*[a-zA-Z])(?=.*[\W_]).{8,}$/;
    return regex.test(senha);
  }
  
  // Quando o usuário digitar no campo de senha
  document.getElementById("floatingPassword").addEventListener("input", function () {
    const senha = this.value;
    const submitButton = document.getElementById("submit-btn");
  
    // Verificar se a senha é válida
    if (validarSenha(senha)) {
        // Adiciona a classe 'is-valid' para borda verde e habilita o botão
        this.classList.remove("is-invalid");
        this.classList.add("is-valid");
        document.getElementById("password-feedback").style.display = "none"; // Remove o feedback de erro
        submitButton.disabled = false; // Habilita o botão
    } else {
        // Adiciona a classe 'is-invalid' para borda vermelha e desabilita o botão
        this.classList.remove("is-valid");
        this.classList.add("is-invalid");
        document.getElementById("password-feedback").style.display = "block"; // Exibe o feedback de erro
        submitButton.disabled = true; // Desabilita o botão
    }
  });
  