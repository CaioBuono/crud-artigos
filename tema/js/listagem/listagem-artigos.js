const parametrosPagina = new URLSearchParams(window.location.search);

/**
 * Responsavel por adicionar o evento de mudanca de pagina da listagem
 */
document.querySelectorAll('.numeroPagina').forEach(btnPagina => {
  btnPagina.addEventListener('click', function(){
    paginaSelecionada = this.textContent.trim();
    window.location = '?p=' + paginaSelecionada;
  });
});

document.querySelector('.btnPaginaAnterior').addEventListener('click', function(){
  let pagina = document.querySelector('input[name="prev"]').value;

  window.location = '?p=' + pagina;
});

document.querySelector('.btnPaginaPosterior').addEventListener('click', function(){
  let pagina = document.querySelector('input[name="next"]').value;

  window.location = '?p=' + pagina;
});