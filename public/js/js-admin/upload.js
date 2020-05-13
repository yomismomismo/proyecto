
    var dropzone = document.getElementById('dropzone');

    var displayUploads = function(data){
        var uploads = document.getElementById('uploads'),
            anchor,
            x;

            for (x = 0; x < data.length; x = x + 1) {
                anchor = document.createElement('a');
                anchor.href = data[x].file;
                anchor.innerText = data[x].name;

                uploads.appendChild(anchor);
            }
    }

    var upload = function(files){
        var formData = new FormData(),
            xhr = new XMLHttpRequest(),
            x;

        for(x = 0; x < files.length; x = x + 1){
            formData.append('file[]', files[x]);
        }
        
        xhr.onload = function(){
            var data = JSON.parse(this.responseText);

            displayUploads(data);
            
        }
        // /Ricardo/Documents/trabajo/templates/adminPage/upload.php
        xhr.open('post', 'adminPage/upload.php');
        xhr.send(formData);
    }

    dropzone.ondrop = function(e){
        e.preventDefault();
        this.className = 'dropzone';
        upload(e.dataTransfer.files);
    }

    dropzone.ondragover = function () {
        this.className = 'dropzone dragover';
        return false;                
    }

    dropzone.ondragleave = function(){
        this.className = 'dropzone';
        return false;      
    }
