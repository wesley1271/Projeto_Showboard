const botao = document.getElementById("botaoTrocarAvatar");
const grid = document.getElementById("seletorAvatar"); 
const avatarAtual = document.getElementById("avatarAtual");


botao.addEventListener('click', () => {
    if (grid.style.display === 'flex') {
        grid.style.display = 'none';
    } else {
        grid.style.display = 'flex'; 
    }
});


document.querySelectorAll(".opcao-avatar").forEach(img => {
    img.addEventListener("click", () => {
        avatarAtual.src = img.src;


        document.querySelectorAll(".opcao-avatar")
            .forEach(a => a.classList.remove("selecionado"));

        img.classList.add("selecionado");

      
        grid.style.display = 'none';
    });
});


document.addEventListener('click', (e) => {
    if (!grid.contains(e.target) && e.target !== botao) {
        grid.style.display = 'none';
    }
});

botao.addEventListener('click', () => {
    grid.classList.toggle('show');
});

document.querySelectorAll(".opcao-avatar").forEach(img => {
    img.addEventListener("click", () => {e
        avatarAtual.src = img.src;
        grid.classList.remove('show');

        // Envia para o PHP
        fetch('perfil.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'avatar=' + encodeURIComponent(img.src.split('/').pop()) + '&id=' + encodeURIComponent(userId)
        })
            .then(res => res.text())
            .then(res => console.log(res))
            .catch(err => console.error(err));
    });
});

console.log(userId)