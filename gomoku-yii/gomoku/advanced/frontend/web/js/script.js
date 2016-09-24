function insereImagem(id, src){
    var imagem = document.getElementById(id);
    imagem.onclick = function(){
        imagem.setAttribute('src', src);
    }

}
