const input = document.querySelector("#newTask");

input.focus();

function deleteTask(id) {
  if (confirm("Tem certeza de que deseja excluir esta tarefa?")) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "deleteTask.php?id=" + id, true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        location.reload();
      }
    };
    xhr.send();
  }
}
