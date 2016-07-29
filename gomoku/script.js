function Init() {
    for (IsOver = !1, document.getElementById("jogador_2").style.opacity = .3,
    	 document.getElementById("jogador_1").style.opacity = 1,
    	 jogador_da_vez = 1, i = 0; i < 15; i++)
        for (j = 0; j < 15; j++)
        	document.images[size * i + j].src = ponto[0].src
}

function Clicked(c, o) { // um jogador de cada vez, e 
    0 == IsOver && document.images[size * c + o].src == ponto[0].src 
    && ( 1 == jogador_da_vez ? ( document.images[size * c + o].src = ponto[1].src,
    								document.getElementById("jogador_1").style.opacity = .3,
    								document.getElementById("jogador_2").style.opacity = 1) : 
    							(document.images[size * c + o].src = ponto[2].src,
    			 					document.getElementById("jogador_2").style.opacity = .3,
    		 						document.getElementById("jogador_1").style.opacity = 1),
    IsOver = verifica_ganhador(jogador_da_vez),
    		 	  	jogador_da_vez = 1 == jogador_da_vez ? 2 : 1);
}

function verifica_ganhador(c) {
    for (i = 0; i < 15; i++)
        for (j = 0; j < 15; j++)
            if (document.images[size * i + j].src == ponto[c].src) {
                if (j + 4 < 15 && document.images[size * i + j + 1].src == ponto[c].src 
                	&& document.images[size * i + j + 2].src == ponto[c].src 
                	&& document.images[size * i + j + 3].src == ponto[c].src 
                	&& document.images[size * i + j + 4].src == ponto[c].src){ //Verificando coluna
                		window.alert("Jogador " + c + " venceu!");
                		return console.log("Jogador " + c + " venceu!"), !0;
                	}
                if (i + 4 < 15 && document.images[size * (i + 1) + j].src == ponto[c].src 
                	&& document.images[size * (i + 2) + j].src == ponto[c].src 
                	&& document.images[size * (i + 3) + j].src == ponto[c].src 
                	&& document.images[size * (i + 4) + j].src == ponto[c].src){ //verificando linha 
                		window.alert("Jogador " + c + " venceu!");
                		return console.log("Jogador " + c + " venceu!"), !0;
                	}
                if (j + 4 < 15 && i + 4 < 15 && document.images[size * (i + 1) + j + 1].src == ponto[c].src 
                	&& document.images[size * (i + 2) + j + 2].src == ponto[c].src 
                	&& document.images[size * (i + 3) + j + 3].src == ponto[c].src 
                	&& document.images[size * (i + 4) + j + 4].src == ponto[c].src){ //varificando transversal "/" 
                		window.alert("Jogador " + c + " venceu!");
                		return console.log("Jogador " + c + " venceu!"), !0;
                }
                if (j - 4 >= 0 && i + 4 < 15 && document.images[size * (i + 1) + j - 1].src == ponto[c].src 
                	&& document.images[size * (i + 2) + j - 2].src == ponto[c].src 
                	&& document.images[size * (i + 3) + j - 3].src == ponto[c].src 
                	&& document.images[size * (i + 4) + j - 4].src == ponto[c].src){ //verificando transversal "\"
                		window.alert("Jogador " + c + " venceu!");
                		return console.log("Jogador " + c + " venceu!"), !0
                }
            }
    return !1
}

var IsOver, jogador_da_vez, size = 15;
ponto = new Array(3), 
ponto[0] = new Image,
ponto[0].src = "0.png",
ponto[1] = new Image,
ponto[1].src = "1.png",
ponto[2] = new Image,
ponto[2].src = "2.png",
window.onload = function() {
    Init() //Iniciar Jogo ao caregar pagina
},
document.getElementById("iniciar").onclick = function() {
    Init() //inicia jogo ao clicar em iniciar
};