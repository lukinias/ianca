var uploadImgValidator = function () {
    var maxFileSize = 1000000;
    var fileTypes =
    [
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/gif'
    ];

    this.validateTypes = function ( file ) {
        for ( var i=0 ; i < fileTypes.length ; i++ ) {
            if ( file.type === fileTypes[i] ) {
                return true;
            }
        }
        return false;
    }

    this.validateSize = function ( file ) {
        if ( file.size <= maxFileSize ) {
            return true;
        }
        return false;
    }

    this.deleteImgs = function () {
        $('#publicacion_imagen').val('');
        $('#imagenPublicacion').attr('src', '');
        $('#thumbPublicacion').attr('src', '');
    }

    this.imgValidate = function ( event ) {
        var file = event.target.files[0];

        if ( !this.validateTypes( file ) ) {
            $('#alertSound')[0].play();
            this.deleteImgs();
            alert('Tipo de archivo no válido. Tipos permitidos: jpg, jpeg, png o gif');
        }

        if ( !this.validateSize( file ) ) {
            $('#alertSound')[0].play();
            this.deleteImgs();
            alert('El tamaño del archivo debe ser menor a 1Mb');
        }

        if ( this.validateSize( file ) ) {
            $('#imagenPublicacion').attr('src', '');
            $('#thumbPublicacion').attr('src', window.URL.createObjectURL(file));
        }
    }
}

function validaImagen (event) {
    var validator = new uploadImgValidator();
    validator.imgValidate(event);
}
