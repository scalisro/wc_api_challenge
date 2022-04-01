(function () {

  eventListeners();

  function eventListeners(){
    window.addEventListener('load', function(){
          const flashMsg = document.querySelector('.message');
          // Quitar el mensajes flash despues de 3 segundos
          setTimeout(() => {
            flashMsg.remove();
          }, 3000);
      });
  }

})();
