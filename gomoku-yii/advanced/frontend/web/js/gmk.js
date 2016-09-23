var IsOver, jogador_da_vez, size = 15;

Pic = new Array(3);

Pic[0] = new Image(); Pic[0].src = "'img/0.png' width=32";
Pic[1] = new Image(); Pic[1].src = "'img/1.png' width=32";
Pic[2] = new Image(); Pic[2].src = "'img/2.png' width=32";

function Init () {
  IsOver=false;
  
  document.getElementById("jogador_2").style.opacity = 0.3;
  document.getElementById("jogador_1").style.opacity = 1;   
  vencedor = document.getElementById("vencedor").getAttribute('data-value');

  if (!vencedor) {
    jogador_da_vez = 1;
    for (row=0; row<15; row++) {
      for (col=0; col<15; col++) {
        document.images[2+size*row+col].src = Pic[0].src;
      }
    }  
  }
}

function Clicked(row,col,jogador_id) {

  jogadores = [];

  jogadores[document.getElementById("jog_1").getAttribute('data-user')] = 1;
  jogadores[document.getElementById("jog_2").getAttribute('data-user')] = 2;  

  jogador_da_vez = jogadores[jogador_id];

  if (document.images[2+size*row+col].src == Pic[0].src) {

    if (jogador_da_vez == 1) {
      document.images[2+size*row+col].src = Pic[1].src;
      document.getElementById("jogador_1").style.opacity = 0.3;
      document.getElementById("jogador_2").style.opacity = 1;
    } else {
      document.images[2+size*row+col].src = Pic[2].src;
      document.getElementById("jogador_2").style.opacity = 0.3;
      document.getElementById("jogador_1").style.opacity = 1;

    }
    
    document.getElementById("c_" + row + "_" + col).innerHTML = "<img src="+ Pic[jogador_da_vez].src +"/>";

    var vencedor = document.getElementById("vencedor").getAttribute("data-value");

    /*if (vencedor!=0) {
      //document.getElementById('win').innerHTML = '<img src="'+ Pic[jogadores[vencedor]].src +'" />&nbsp;venceu!';
      //document.getElementById('id01').style.display='block';
      //IsOver = true;
    //}*/

    jogador_da_vez = jogador_da_vez == 1? 2:1;

  }
}

window.onload = function () {
  Init();
};