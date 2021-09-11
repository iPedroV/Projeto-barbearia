//Modal da esqueceu a senha
function iniciaModal(modalID) {

    var modal = document.getElementById(modalID);
    if (modal) {
        modal.classList.add('mostrar');
        modal.addEventListener('click', (e) => {
            if (e.target.id == modalID || e.target.className == 'fechar') {
                modal.classList.remove('mostrar');
            }
        });
    }
}
var logo = document.querySelector('#lembrar-senha');
logo.addEventListener('click', () => iniciaModal('modal-esqueceu'));

document.addEventListener('scroll', () => {
    if (window.pageYOffset > 800) {
        iniciaModal('modal-esqueceu')
    }
})