document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("cadaster-form"); 
    const nomeInput = document.getElementById('nome');
    const emailInput = document.getElementById('email');
    const senhaInput = document.getElementById('senha');
    const senhaConfirm = document.getElementById('confirm-senha');
    const btn = document.getElementById('btn');

    const nomeErr = document.getElementById('nomeErr');
    const emailErr = document.getElementById('emailErr');
    const senhaErr = document.getElementById('senhaErr');
    const senhaConfirmErr = document.getElementById('senhaConfirmErr');


    // validação Regex
    function validarEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    function atualizarBotao() {
        btn.disabled = !todosValidos();
    }

    function todosValidos() {
        return (
            nomeInput.value.trim().length >= 3 &&
            validarEmail(emailInput.value.trim()) &&
            senhaInput.value.trim().length >= 6 &&
            senhaInput.value === senhaConfirm.value &&
            senhaConfirm.value.trim() !== ''
        );
    }

    function mostrarErro(campo, elementoErro, mensagem) {
        if (mensagem) {
            elementoErro.textContent = mensagem;
            campo.style.border = "2px solid #dc3545";
        } else {
            elementoErro.textContent = "";
            campo.style.border = "1px solid #ced4da";
        }
    }

    form.addEventListener("submit", (e) => {
        if (senhaInput.value !== senhaConfirm.value) {
            e.preventDefault();
            alert("As senhas não coincidem!");
        }
    });


    // validação blur
    nomeInput.addEventListener('blur', () => {
        const nome = nomeInput.value.trim();
        if (nome === "") mostrarErro(nomeInput, nomeErr, "Nome é obrigatório.");
        else if (nome.length < 3) mostrarErro(nomeInput, nomeErr, "O nome deve conter 3 ou mais caracteres.");
        else mostrarErro(nomeInput, nomeErr, "");
        atualizarBotao();
    });

    emailInput.addEventListener('blur', () => {
        const email = emailInput.value.trim();
        if (email === "") mostrarErro(emailInput, emailErr, "Email é obrigatório.");
        else if (!validarEmail(email)) mostrarErro(emailInput, emailErr, "Formato inválido.");
        else mostrarErro(emailInput, emailErr, "");
        atualizarBotao();
    });

    senhaInput.addEventListener('blur', () => {
        const senha = senhaInput.value.trim();
        const confirm = senhaConfirm.value.trim();

        if (senha === "") mostrarErro(senhaInput, senhaErr, "Senha é obrigatória.");
        else if (senha.length < 6) mostrarErro(senhaInput, senhaErr, "Senha deve ter 6 ou mais caracteres.");
        else if (confirm !== "" && senha !== confirm) mostrarErro(senhaInput, senhaErr, "As senhas devem coincidir.");
        else mostrarErro(senhaInput, senhaErr, "");

        atualizarBotao();
    });

    senhaConfirm.addEventListener('blur', () => {
        const senha = senhaInput.value.trim();
        const confirm = senhaConfirm.value.trim();

        if (confirm === "") mostrarErro(senhaConfirm, senhaConfirmErr, "Confirmação é obrigatória.");
        else if (confirm.length < 6) mostrarErro(senhaConfirm, senhaConfirmErr, "Senha deve ter 6 ou mais caracteres.");
        else if (confirm !== senha) mostrarErro(senhaConfirm, senhaConfirmErr, "As senhas devem coincidir.");
        else mostrarErro(senhaConfirm, senhaConfirmErr, "");

        atualizarBotao();
    });

    [nomeInput, emailInput, senhaInput, senhaConfirm].forEach(input => {
        input.addEventListener('input', atualizarBotao);
    });

    // Eye password
    const eyeOpen = document.getElementById("desocultar");
    const eyeClosed = document.getElementById("ocultar");

    eyeOpen.addEventListener("click", () => {
        senhaInput.type = "text";
        eyeOpen.style.display = "none";
        eyeClosed.style.display = "block";
    });

    eyeClosed.addEventListener("click", () => {
        senhaInput.type = "password";
        eyeClosed.style.display = "none";
        eyeOpen.style.display = "block";
    });

    const eyeOpenConfirm = document.getElementById("confirm-desocultar");
    const eyeClosedConfirm = document.getElementById("confirm-ocultar");

    eyeOpenConfirm.addEventListener("click", () => {
        senhaConfirm.type = "text";
        eyeOpenConfirm.style.display = "none";
        eyeClosedConfirm.style.display = "block";
    });

    eyeClosedConfirm.addEventListener("click", () => {
        senhaConfirm.type = "password";
        eyeClosedConfirm.style.display = "none";
        eyeOpenConfirm.style.display = "block";
    });

});
