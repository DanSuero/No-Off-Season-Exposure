window.onload = function(){
  var importBtn = document.querySelector("button.uploadBtn"),
      done = document.querySelector(".col-results");

  importBtn.addEventListener("click",function(event){
    event.preventDefault();

    if(done.classList.contains("show")){
      done.classList.remove("show");
      done.classList.add("hide");
    }

    var file = document.querySelector("#uploadFile").files[0],
        ajax = new XMLHttpRequest(),
        formData = new FormData(),
        uploadType = document.querySelector("#uploadType").value;

    formData.append("uploadFile", file);
    formData.append("uploadType", uploadType);

    ajax.open("POST","/wp-content/plugins/nooffseason/assets/admin/upload.php", true);
    ajax.send(formData);

    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;

          console.log(this.responseText);

          if (response == "Done"){
            done.classList.remove("hide");
            done.classList.add("show");
          }
      }
    };
  });
};
