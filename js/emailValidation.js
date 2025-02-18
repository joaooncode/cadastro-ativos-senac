
// Função para validar o formato do email
function validarEmail(email) {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(email);
}

// Quando o usuário digitar no campo de email
document.getElementById("floatingEmail").addEventListener("input", function () {
  const email = this.value;
  const submitButton = document.getElementById("submit-btn");

  // Verificar se o email é válido
  if (validarEmail(email)) {
    // Adiciona a classe 'is-valid' para borda verde e habilita o botão
    this.classList.remove("is-invalid");
    this.classList.add("is-valid");
    document.getElementById("email-feedback").style.display = "none"; // Remove o feedback de erro
    submitButton.disabled = false; // Habilita o botão
  } else {
    // Adiciona a classe 'is-invalid' para borda vermelha e desabilita o botão
    this.classList.remove("is-valid");
    this.classList.add("is-invalid");
    document.getElementById("email-feedback").style.display = "block"; // Exibe o feedback de erro
    submitButton.disabled = true; // Desabilita o botão
  }
});

// Função para validar o formato da senha
