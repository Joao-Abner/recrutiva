<template>
    <div class="homepage">
        <header class="header">
            <img src="@/assets/logo-recrutiva.png" alt="Logo-recrutiva" class="logo" />
            <img src="@/assets/recrutiva-slogan.png" alt="slogan-recrutiva" class="logo-slogan" />
            <button class="login-button">ACESSAR/CADASTRAR</button>
        </header>

        <main class="content">
            <h1 class="title">Crie uma jornada de R&S</h1>
            <h2 class="subtitle">mais moderna e otimizada.</h2>
            <p class="description">
                Melhore a sua aquisição e qualificação de talentos <br>com o sistema de recrutamento da Nexti.
            </p>
            <button class="cta-button">CONHEÇA AGORA!</button>
        </main>

        <!-- Ícones decorativos ao redor -->
        <div class="icons">
            <!-- Pode usar tags de imagem ou ícones SVG -->
            <span class="icon pencil-icon"></span>
            <span class="icon web-icon"></span>
            <span class="icon lightbulb-icon"></span>
        </div>
    </div>
</template>

<script>
export default {
    name: "HomePage",
};
</script>

<style scoped>
.homepage {
    font-family: Arial, sans-serif;
    text-align: center;
    color: #333;
}

.header {
    display: flex;
    justify-content: space-between;
    padding: 1.25rem;
}

.logo-slogan {
    width: 18.75rem;
}

.logo {
    width: 5.875rem;
}

.login-button {
    font-size: .875rem;
    color: #333;
    background: none;
    border: none;
    cursor: pointer;
}

.content {
    padding: 3.125rem 1.25rem;
}

.title {
    font-size: 4.5rem;
    color: white;
    background-color: #f02424;
    padding: .625rem 1.25rem;
    display: inline-block;
    border-radius: 8px;
}

.subtitle {
    font-size: 4rem;
    color: #333;
    margin-top: .625rem;
}

.description {
    font-size: 2rem;
    color: #666;
    margin-top: .625rem;
    text-align: center;
}

.cta-button {
    background-color: #f02424;
    color: white;
    border: none;
    border-radius: 8px;
    padding: .9375rem 1.875rem;
    font-size: 1.5rem;
    cursor: pointer;
    margin-top: 1.25rem;
}

.icons {
    display: flex;
    justify-content: center;
    gap: 1.25rem;
    margin-top: 1.875rem;
}

.icon {
    width: 1.875rem;
    height: 1.875rem;
}
</style>