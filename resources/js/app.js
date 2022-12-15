import Dropzone from "dropzone";
import { drop } from "lodash";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Imagen",
    maxfiles: 1,
    uploadMultiple: false,

});

dropzone.on('sending', function(file, xhr, formData){
    console.log(file);
});


dropzone.on('success', function(file, response){
    console.log(response);
});

dropzone.on('error', function(file, message){
    console.log(message);
});

dropzone.on('removedfile', function(){
    console.log('Archivo eliminado');
});