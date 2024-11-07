const form = document.querySelector("form");

const eField = form.querySelector(".email"),
      eInput = eField.querySelector("input"),
      pField = form.querySelector(".password"),
      pInput = pField.querySelector("input");

form.onsubmit = (e) => {
    e.preventDefault();

    checkEmail();
    checkPass();

    if (eField.classList.contains("error")) eField.classList.add("shake");
    if (pField.classList.contains("error")) pField.classList.add("shake");

    setTimeout(() => {
        eField.classList.remove("shake");
        pField.classList.remove("shake");
    }, 500);

    eInput.onkeyup = () => { checkEmail(); }
    pInput.onkeyup = () => { checkPass(); }

    function checkEmail() {
        let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        let errorTxt = eField.querySelector(".error-txt");

        if (!eInput.value.match(pattern)) {
            eField.classList.add("error");
            eField.classList.remove("valid");
            errorTxt.innerText = eInput.value ? "Please enter a valid email." : "Email cannot be empty.";
        } else {
            eField.classList.remove("error");
            eField.classList.add("valid");
        }
    }

    function checkPass() {
        let errorTxt = pField.querySelector(".error-txt");

        if (pInput.value === "") {
            pField.classList.add("error");
            pField.classList.remove("valid");
            errorTxt.innerText = "Password cannot be empty.";
        } else {
            pField.classList.remove("error");
            pField.classList.add("valid");
        }
    }

    if (!eField.classList.contains("error") && !pField.classList.contains("error")) {
        window.location.href = form.getAttribute("action");
    }
};

document.querySelectorAll('.sign-txt a').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const wrapper = document.querySelector('.wrapper');
        wrapper.classList.add('page-transition');

        setTimeout(() => {
            window.location.href = e.target.href;
        }, 500);
    });
});
