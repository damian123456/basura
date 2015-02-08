class Circulo {
  float velx, vely;
  float posX, posY, objectWidth, objectHeight;

  float GRAVITY = 0.6;

  float DAMPING = 0.8;

  float FRICTION = .10;

  Circulo() {
    posX=width/2;
    posY=0;
    objectWidth=20;
    objectHeight=objectWidth;

    velx=5;
    vely=5;
  }

  void graficar() {
    fill(255, 0, 0);
    ellipse(posX, posY, objectWidth, objectHeight);
  }

  void updateObjectLocation() {
    posX = posX + velx;
    posY = posY + vely;
  }

  void adjustForGravity() {
    vely = vely + GRAVITY;
  }



  void checkForCollision() {

    if (posX > 540 - objectWidth) {
      posX = 540 - objectWidth;
      velx = -1 * velx;
    }
    else if (posX < 85) {
      posX = 85;
      velx = -1 * velx;
    }

    // Check for floor collision:
    if (posY > 440 - objectHeight) {
      posY = 440 - objectHeight;
      vely = -1 * vely;
      vely = DAMPING * vely;
      velx = FRICTION * velx;
    }

    else if (posY < 100) {
      posY = 100 ;
      vely = -1 * vely;
      vely = DAMPING * vely;
      velx = FRICTION * velx;
    }
    ///Primer obstaculo
    if (posX >150  - objectWidth && posX<470 && posY>140 && posY<235) {
      posX = 150 - objectWidth;
      velx = -1 * velx;
    }else if (posY < 390 && posX>150 && posX<470) {
      posY = 600 ;
      vely = -1 * vely;
      vely = DAMPING * vely;
      //velx = FRICTION * velx;
    }
  }

  void mover() {

    if (keyCode == 39) {
      derecha();
    }
    else if (keyCode == 37) {
      izquierda();
    }
    else if (keyCode == 38 ) {
      arriba();
    }
    else if (keyCode == 40) {
      abajo();
    }
  }

  void derecha() {
    posX+=5;
  }

  void izquierda() {
    posX-=5;
  }

  void arriba() {
    posY-=5;
  }

  void abajo() {
    posY+=5;
  }
}

