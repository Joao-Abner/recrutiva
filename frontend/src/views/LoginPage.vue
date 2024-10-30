<template>
    <div class="container">
      <div class="container_top_page">
        <h1>Olá, Recrutador!</h1>
        <p>Encontre o seu candidato ideal em empresas comprometidas com o seu futuro.</p>
      </div>
  
      <div class="tabs">
        <RouterLink to="/loginre" class="tab ">JÁ SOU CADASTRADO</RouterLink>
        <RouterLink to="/cadastrore" class="tab active">QUERO ME CADASTRAR</RouterLink>
      </div>
  
      <div class="box-info">
        <form>
  
          <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" id="email" placeholder="Digite seu Email" required>
          </div>
  
          <div class="form-group">
            <label for="senha">Senha *</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
          </div>
  
          <button type="submit" class="submit-button">EFETUAR LOGIN</button>
        </form>
      </div>
  
      <div class="footer">
        <p>Problemas com seu cadastro? <a href="#">Clique para contatar o suporte</a></p>
      </div>
    </div>
  </template>