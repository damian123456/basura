import ddf.minim.spi.*;
import ddf.minim.signals.*;
import ddf.minim.*;
import ddf.minim.analysis.*;
import ddf.minim.ugens.*;
import ddf.minim.effects.*;




String pantalla, pInicial = "Nivel1";
PImage fondoPrueba, imagenes[];
Circulo c;
int con=1,secuencia=1,t=1,ss=1,cont=1,n=1,seTermina=1;
Minim minim;
AudioPlayer fondo;
AudioSample finalen;
AudioSample loopen;




void setup() {
  size(624, 550);
  noStroke();
  ellipseMode(CORNER);
  pantalla = pInicial;
  c = new Circulo();
  fondoPrueba = loadImage("fondoNormal.jpg");
  imagenes = new PImage [17];
  for(int i=0;i<17;i++){
    imagenes[i]=loadImage("img"+i+".jpg");
    
  }
  
  minim = new Minim(this);
  fondo = minim.loadFile("audio.wav");
  finalen= minim.loadSample("finale.mp3");
  loopen = minim.loadSample("loope.mp3");
  
}

void draw() {





  /* LÓGICA DE PANTALLAS */

  if (pantalla=="Inicio") {                 //// INICIO ////
  }
  else if (pantalla=="Nivel1") {            ////NIEVL 1 ////
  fondo.play();
    cont=1;
    image(fondoPrueba, 0, 0);
    c.graficar();
    c.adjustForGravity();
    c.updateObjectLocation();
    c.checkForCollision();

    if (keyPressed) {
      c.mover();
    }
    if(c.posY<390 && c.posX>285 && c.posX<335){
      int f= 1;
      
      con++;
      
      image(imagenes[f],0,0);
      f++;
      loopen.trigger();
      if(f==7){
        f=1;
      }
      if(con==3){
        pantalla="Nivel3";
      }
      
    }
  }
  else if (pantalla=="Nivel2") {          //// NIVEL 2////
  
    seTermina++;
    finalen.trigger();
   
    if(seTermina==120){
      exit();
    }
    image(imagenes[secuencia],0,0);
    secuencia++;
      if(secuencia==17){
        secuencia=1;
      }
  }
  else if (pantalla=="Nivel3") {          //// NIVEL 3 ////
  n++;
  if(n==60){
    pantalla="Nivel2";
  }
  image(imagenes[ss],0,0);
      ss++;
      cont++;
      if(ss==7){
        ss=1;
      }
      if(cont==21){
        pantalla="Nivel1";
        con=0;
      }
  }

  //Consola();
}

void Consola() {
  //println("X = "+mouseX);
  //println("Y = "+mouseY);
  println("Pos X = "+c.posX);
  println("Pos Y = "+c.posY);
  println("KeyCode: "+keyCode);
}

