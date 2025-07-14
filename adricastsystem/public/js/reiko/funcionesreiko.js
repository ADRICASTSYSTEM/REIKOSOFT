function redirigir(ruta){
    window.location.href = ruta ;
  
  }

function createPagination() {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");
  var rowsPerPageSelect = document.getElementById("rowsPerPageSelect");
  var rowsPerPage = parseInt(rowsPerPageSelect.value);
  var pageCount = Math.ceil((rows.length - 1) / rowsPerPage); // -1 para excluir la fila del encabezado
  var pagination = document.getElementById("pagination");
  pagination.innerHTML = ""; 
  for (var i = 1; i <= pageCount; i++) {
    var pageButton = document.createElement("button");
    pageButton.textContent = i;
 
    pageButton.classList.add("button-pagination");
    if (i === currentPage) {
      pageButton.classList.add("active");
    }
    pageButton.addEventListener("click", function () {
      currentPage = parseInt(this.textContent); // Actualizar el valor de currentPage
      showRows(currentPage);
     
      createPagination();
    });
    
    pagination.appendChild(pageButton);
  }
}
