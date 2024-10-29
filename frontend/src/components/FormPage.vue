<template>
  <div class="container">
    <div class="container_top_page">
      <h1>Olá, candidato!</h1>
      <p>Encontre a sua vaga ideal em empresas comprometidas com o seu futuro profissional.</p>
    </div>

    <div class="tabs">
      <RouterLink to="/" class="tab ">JÁ SOU CADASTRADO</RouterLink>
      <RouterLink to="/cadastro" class="tab active">QUERO ME CADASTRAR</RouterLink>
    </div>

    <div class="box-info">
      <form>
        <div class="form-group">
          <label for="nome">Nome *</label>
          <input type="text" name="nome" id="nome" placeholder="Nome" required>
        </div>

        <div class="form-group">
          <label for="sobrenome">Sobrenome *</label>
          <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" required>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" id="email" placeholder="Digite seu Email" required>
        </div>

        <div class="form-group">
          <label for="sexo">Sexo *</label>
          <select name="sexo" id="sexo" required>
            <option value="">Selecione</option>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
            <option value="feminino">Outro</option>
          </select>
        </div>

        <div class="form-group">
          <label for="senha">Senha *</label>
          <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
        </div>

        <div class="form-group">
          <label for="repetir_senha">Repetir senha *</label>
          <input type="password" name="repetir_senha" id="repetir_senha" placeholder="Repita sua senha" required>
        </div>

        <div class="form-group">
          <label for="email">CPF *</label>
          <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" required>
        </div>

        <div class="form-group">
          <label for="telefone">Telefone *</label>
          <input type="tel" name="telefone" id="telefone" placeholder="Digite seu telefone" required>
        </div>

        <div class="form-group">
          <label for="nascimento">Data de nascimento *</label>
          <input type="date" name="nascimento" id="nascimento" required>
        </div>

        <div class="form-group">
          <label for="pais">País *</label>
          <input type="text" name="pais" id="pais" value="Brazil" disabled>
        </div>

        <button type="submit" class="submit-button">EFETUAR CADASTRO</button>
      </form>
    </div>

    <div class="footer">
      <p>Problemas com seu cadastro? <a href="#">Clique para acessar como recrutador</a></p>
    </div>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router'


</script>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap');



.container {
  max-width: 600px;
  margin: auto;
  font-family: 'poppins', sans-serif;
  color: #333;
}

.container_top_page {
  text-align: center;
  background-color: #f02424;
  padding: 20px;
  color: white;
}

.tabs {
  display: flex;
  justify-content: center;
  margin: 20px 0;
  font-family: 'Rovoto mono', sans-serif;
}

.tab {
  background: none;
  border: none;
  font-weight: bold;
  color: #333;
  padding: 10px 20px;
  cursor: pointer;
}

.tab.active {
  border-bottom: 2px solid #d81b60;
}

.box-info {
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
  border-radius: 10px;
}

label {
  margin-bottom: 5px;
  font-weight: bold;
}

input, select {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.submit-button {
  width: 100%;
  padding: 15px;
  background-color: #f02424;
  color: white;
  font-size: 16px;
  font-weight: bold;
  border: none;
  border-radius: 20px;
  cursor: pointer;
}

.submit-button:hover {
  background-color: #333;
}

.footer {
  text-align: center;
  margin-top: 20px;
}

.footer a {
  color: #f02424;
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}


.terms input {
  margin-right: 10px;
}
</style>
