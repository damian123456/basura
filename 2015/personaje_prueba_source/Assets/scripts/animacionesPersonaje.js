#pragma strict

	var imagen : Texture;
	var imagen1 : Texture;
	
	if(Input.GetKeyDown("1"))
		renderer.material.SetTexture("_BumpMap", imagen);
	if(Input.GetKeyDown("2"))
		renderer.material.SetTexture("_BumpMap", imagen1);