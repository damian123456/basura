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

