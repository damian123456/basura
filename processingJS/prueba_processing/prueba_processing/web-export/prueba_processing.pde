Sprite secuencia;

void setup()
{
  size(575, 625);
  frameRate(25);
  
  secuencia = new Sprite();
  secuencia.cargarSec("0","jpg");
}

void draw()
{  
  if (keyPressed && key == ' ')
  {
    println("SALTO");
    secuencia.sheet(1);
  } else
  {
    println("-  ");
    secuencia.arrancar();  
    
  }
}

class Sprite {
  PImage[] imgArray;
  int inicio, cantidad;
  int imgW, imgH, imgX, imgY;
  int img;

  Sprite() {
    
    cantidad = 4;
    inicio = 1;
    
    
    imgW = 575;
    imgH = 625;

    imgX = 0;
    imgY = 0;
  }
  
  void cargarSec(String nombre, String formato){
  
  imgArray = new PImage[cantidad];
    
    for (int i = 1; i < cantidad; i++)
    {
      imgArray[i] = loadImage(nombre+i+"."+formato);
    }
}

  /* ARRANCAR MULTIPLES SPRITES */
  void arrancar() {
    image(imgArray[inicio], imgX, imgY, imgW, imgH);
    inicio++;
    if (inicio==cantidad)
    {
      inicio = 1;
    }
  }
  /* FIN ARRANCAR MULTIPLES SPRITES */
  
  void sheet(int num_sprite){
    indice=num_sprite;
  }
}

class Player
{
  Player()
  {
  }
}

