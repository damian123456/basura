<?
/* VARIABLES  */

/* LABELS GENERALES */
$label1="Fila 1:";
$label2="Fila 2:";
$label3="Fila 3:";
$label4="Fila 4[OPCIONAL]:";
$label5="Fila 5[OPCIONAL]:";
$label6="Fila 6[OPCIONAL]:";
$label7="Fila 7[OPCIONAL]:";
$label8="Fila 8[OPCIONAL]:";

/* LABELS DE CADA FILA */
$lab1 = "1 (Azul)";
$lab2 = "2 (Azul)";
$lab3 = "3 (Verde)";
$lab4 = "4 (Verde)";
$lab5 = "5 (Verde, desplegable)";
$lab6 = "6 (Verde, desplegable)";

/*FILA 1*/

$f1_1="col1f1";
$f1_2="col2f1";
$f1_3="col3f1";
$f1_4="col3f2";
$f1_5="content";
$f1_6="excerpt";

/*FILA 2*/

$f2_1="col1f1f2";
$f2_2="col2f1f2";
$f2_3="col3f1f2";
$f2_4="col3f2f2";
$f2_5="contentf2";
$f2_6="excerptf2";

/*FILA 3*/

$f3_1="col1f1f3";
$f3_2="col2f1f3";
$f3_3="col3f1f3";
$f3_4="col3f2f3";
$f3_5="contentf3";
$f3_6="excerptf3";

/*FILA 4*/

$f4_1="col1f1f4";
$f4_2="col2f1f4";
$f4_3="col3f1f4";
$f4_4="col3f2f4";
$f4_5="contentf4";
$f4_6="excerptf4";

/*FILA 5*/

$f5_1="col1f1f5";
$f5_2="col2f1f5";
$f5_3="col3f1f5";
$f5_4="col3f2f5";
$f5_5="contentf5";
$f5_6="excerptf5";

/*FILA 6*/

$f6_1="col1f1f6";
$f6_2="col2f1f6";
$f6_3="col3f1f6";
$f6_4="col3f2f6";
$f6_5="contentf6";
$f6_6="excerptf6";

/*FILA 7*/

$f7_1="col1f1f7";
$f7_2="col2f1f7";
$f7_3="col3f1f7";
$f7_4="col3f2f7";
$f7_5="contentf7";
$f7_6="excerptf7";

/*FILA 8*/

$f8_1="col1f1f8";
$f8_2="col2f1f8";
$f8_3="col3f1f8";
$f8_4="col3f2f8";
$f8_5="contentf8";
$f8_6="excerptf8";

/* NOMBRE Y CATEGORIA */
	function imprimirSelectSubcategorias($children, $selected_id, $level=0){
		$level++;
		if($children) foreach($children as $sc){
?>				<option value="<?=$sc['id']?>" <?if($sc['id']==$selected_id){?>selected<?}?>><?=str_repeat('-',$level*2)?> <?=$sc['nombre']?></option><?
			if($sc['children']) imprimirSelectSubcategorias($sc['children'],$selected_id,$level);
		}
	}
?>





<form class="form-horizontal" role="form" method="post" action="">

	<div class="tab-content">

<?// INFO PANEL ?>
		<div class="tab-pane active" id="info">
			<div class="form-group">
				<label class="col-sm-2 control-label" for="category">Categor&iacute;a</label>
				<div class="col-sm-10">
					<select class="form-control" id="category" name="category">
<?				foreach($categories as $c){    ?>
						<option value="<?=$c['id']?>" <?if($c['id']==$item['id_category']){?>selected<?}?>><?=str_repeat('-',$level*2)?><?=$c['nombre']?></option>
						<?imprimirSelectSubcategorias($c['children'],$item['id_category'])?>
<?				} ?>
					</select>
					<?=(!$categories?'<p class="help-block"><strong>Importante:</strong> Primero debes <a href="categorias.php">agregar una categor&iacute;a</a></p>':'')?>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="title">Nombre</label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="Nombre" value="<?=getValue($item,'title')?>" required>
				</div>
			</div>
		</div>

		<?/* FILA 1 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label1?>"><?echo $label1?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn1">Ocultar</button>
			</div>					
		</div>

		<div id="f1">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_1?>"><?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f1_1?>" name="<?echo $f1_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f1_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f1_2?>" name="<?echo $f1_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f1_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f1_3?>" name="<?echo $f1_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f1_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f1_4?>" name="<?echo $f1_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f1_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f1_5?>" name="<?echo $f1_5?>" placeholder="Resumen"><?=getValue($item,$f1_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f1_6?>"><?echo $lab6?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f1_6?>" name="<?echo $f1_6?>" placeholder="Resumen"><?=getValue($item,$f1_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 1 */?>




		<?/* FILA 2 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label2?>"><?echo $label2?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn2">Ocultar</button>
			</div>					
		</div>

		<div id="f2">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_1?>"><?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f2_1?>" name="<?echo $f2_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f2_1)?>" >
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f2_2?>" name="<?echo $f2_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f2_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f2_3?>" name="<?echo $f2_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f2_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f2_4?>" name="<?echo $f2_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f2_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f2_5?>" name="<?echo $f2_5?>" placeholder="Resumen"><?=getValue($item,$f2_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f2_6?>"><?echo $lab6?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f2_6?>" name="<?echo $f2_6?>" placeholder="Resumen"><?=getValue($item,$f2_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 2 */?>

		<?/* FILA 3 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label3?>"><?echo $label3?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn3">Ocultar</button>
			</div>					
		</div>

		<div id="f3">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_1?>"><?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f3_1?>" name="<?echo $f3_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f3_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f3_2?>" name="<?echo $f3_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f3_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f3_3?>" name="<?echo $f3_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f3_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f3_4?>" name="<?echo $f3_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f3_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f3_5?>" name="<?echo $f3_5?>" placeholder="Resumen"><?=getValue($item,$f3_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f3_6?>"><?echo $lab6?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f3_6?>" name="<?echo $f3_6?>" placeholder="Resumen"><?=getValue($item,$f3_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 3 */?>

		<?/* FILA 4 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label4?>"><?echo $label4?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn4">Ocultar</button>
			</div>					
		</div>

		<div id="f4">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_1?>"><?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f4_1?>" name="<?echo $f4_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f4_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f4_2?>" name="<?echo $f4_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f4_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f4_3?>" name="<?echo $f4_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f4_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f4_4?>" name="<?echo $f4_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f4_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f4_5?>" name="<?echo $f4_5?>" placeholder="Resumen"><?=getValue($item,$f4_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f4_6?>"><?echo $lab6?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f4_6?>" name="<?echo $f4_6?>" placeholder="Resumen"><?=getValue($item,$f4_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 4 */?>

		<?/* FILA 5 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label5?>"><?echo $label5?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn5">Ocultar</button>
			</div>					
		</div>

		<div id="f5">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_1?>"><?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f5_1?>" name="<?echo $f5_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f5_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f5_2?>" name="<?echo $f5_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f5_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f5_3?>" name="<?echo $f5_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f5_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f5_4?>" name="<?echo $f5_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f5_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f5_5?>" name="<?echo $f5_5?>" placeholder="Resumen"><?=getValue($item,$f5_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f5_6?>"><?echo $lab6?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f5_6?>" name="<?echo $f5_6?>" placeholder="Resumen"><?=getValue($item,$f5_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 5 */?>

		<?/* FILA 6 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label6?>"><?echo $label6?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn6">Ocultar</button>
			</div>					
		</div>

		<div id="f6">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_1?>">1<?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f6_1?>" name="<?echo $f6_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f6_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f6_2?>" name="<?echo $f6_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f6_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f6_3?>" name="<?echo $f6_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f6_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f6_4?>" name="<?echo $f6_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f6_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f6_5?>" name="<?echo $f6_5?>" placeholder="Resumen"><?=getValue($item,$f6_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f6_6?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f6_6?>" name="<?echo $f6_6?>" placeholder="Resumen"><?=getValue($item,$f6_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 6 */?>

		<?/* FILA 7 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label7?>"><?echo $label7?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn7">Ocultar</button>
			</div>					
		</div>

		<div id="f7">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_1?>">1<?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f7_1?>" name="<?echo $f7_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f7_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f7_2?>" name="<?echo $f7_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f7_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f7_3?>" name="<?echo $f7_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f7_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f7_4?>" name="<?echo $f7_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f7_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f7_5?>" name="<?echo $f7_5?>" placeholder="Resumen"><?=getValue($item,$f7_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f7_6?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f7_6?>" name="<?echo $f7_6?>" placeholder="Resumen"><?=getValue($item,$f7_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 7 */?>

		<?/* FILA 8 */?>

		<div class="form-group">
			<label class="col-sm-2 control-label" for="<?echo $label8?>"><?echo $label8?></label>
			<div class="col-sm-10">
				<?/*MI QUERY */?>
				<button type="button" class="btn" id="btn8">Ocultar</button>
			</div>					
		</div>

		<div id="f8">
			<!--IMAGEN REFERENCIA-->
			<div class="form-group">
				<img src="./img/ref.jpg" alt="ref" style="margin-left:200px">
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_1?>">1<?echo $lab1?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f8_1?>" name="<?echo $f8_1?>" placeholder="Col1-F1" value="<?=getValue($item,$f8_1)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_2?>"><?echo $lab2?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f8_2?>" name="<?echo $f8_2?>" placeholder="Col2-F1" value="<?=getValue($item,$f8_2)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_3?>"><?echo $lab3?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f8_3?>" name="<?echo $f8_3?>" placeholder="Col3-F1" value="<?=getValue($item,$f8_3)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_4?>"><?echo $lab4?></label>				
				<div class="col-sm-10">
					<input type="text" class="form-control" id="<?echo $f8_4?>" name="<?echo $f8_4?>" placeholder="Col3-F2 (opcional)" value="<?=getValue($item,$f8_4)?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_5?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f8_5?>" name="<?echo $f8_5?>" placeholder="Resumen"><?=getValue($item,$f8_5)?></textarea>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label" for="<?echo $f8_6?>"><?echo $lab5?></label>
				<div class="col-sm-10">
					<textarea type="text" rows="4" class="form-control" id="<?echo $f8_6?>" name="<?echo $f8_6?>" placeholder="Resumen"><?=getValue($item,$f8_6)?></textarea>
				</div>
			</div>
		</div>
		<?/* FIN FILA 8 */?>



	</div>

<? /*if(!$item){ ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 well" style="text-align:right">
			<small>Guarde los cambios para continuar con la carga de la tabla</small>
		</div>
	</div>
<? } */?>

	<div class="form-group">
		<label class="col-sm-2 control-label">&nbsp;</label>
		<div class="col-sm-10 form-controls">
			<button type="button" onclick="location.href='tbl_cursos.php'" class="btn btn-default"><i class="fa fa-chevron-left"></i> Volver</button>
			<button  type="submit" class="btn btn-primary" >Guardar</button>

			<input type="hidden" name="save" value="1" >
			<input type="hidden" name="id" id="courseId" value="<?=$item['id']?>" >
		</div>
	</div>
</form>


<script type="text/javascript" src="js/bootstrap-wysiwyg.js"></script>
<script type="text/javascript">
$(function(){
	$('#editor').summernote({
		height:400,

		lang: 'es-ES',   // language 'en-US', 'ko-KR', ...

		toolbar: [
			['style', ['style']],
			['font', ['clear']],
			//['font', ['bold', 'italic', 'underline', 'clear']],
			//['fontsize', ['fontsize']],
			//['color', ['color']],
			//['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table', ['table']],
			['insert', ['link', 'picture', 'video']],
			//['view', ['fullscreen', 'codeview']],
			//['help', ['help']]
		]
	});
	$('form').submit(function(ev){
		$('#editor').html($('#editor').code());
//		$('#editor-input').val($('#editor').code());
//		ev.preventDefault();
	});
	$('a[href="'+location.hash+'"]').tab('show')
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		window.history.pushState(false,false,this.href);
	})
});

/*MI JQUERY*/


/* FILA 1 */

   	var estado1;

	$("#btn1").click(function(){
    	$("#f1").toggle();
    	estado1++;
 		if(estado1==1){
			$("#btn1").text('Ocultar');
		}else{
			$("#btn1").text('Mostrar');
			estado1=0;
		}
	});
/*  FILA 2  */
   	var estado2;

	$("#btn2").click(function(){
    	$("#f2").toggle();
    	estado2++;
 		if(estado2==1){
			$("#btn2").text('Ocultar');
		}else{
			$("#btn2").text('Mostrar');
			estado2=0;
		}
	});


   	var estado3;

	$("#btn3").click(function(){
    	$("#f3").toggle();
    	estado3++;
 		if(estado3==1){
			$("#btn3").text('Ocultar');
		}else{
			$("#btn3").text('Mostrar');
			estado3=0;
		}
	});
	
   	var estado4;

	$("#btn4").click(function(){
    	$("#f4").toggle();
    	estado4++;
 		if(estado4==1){
			$("#btn4").text('Ocultar');
		}else{
			$("#btn4").text('Mostrar');
			estado4=0;
		}
	});
   
   	var estado5;

	$("#btn5").click(function(){
    	$("#f5").toggle();
    	estado5++;
 		if(estado5==1){
			$("#btn5").text('Ocultar');
		}else{
			$("#btn5").text('Mostrar');
			estado5=0;
		}
	});
   	
   	var estado6;

	$("#btn6").click(function(){
    	$("#f6").toggle();
    	estado6++;
 		if(estado6==1){
			$("#btn6").text('Ocultar');
		}else{
			$("#btn6").text('Mostrar');
			estado6=0;
		}
	});

	var estado7;

	$("#btn7").click(function(){
    	$("#f7").toggle();
    	estado7++;
 		if(estado7==1){
			$("#btn7").text('Ocultar');
		}else{
			$("#btn7").text('Mostrar');
			estado7=0;
		}
	});

	var estado8;

	$("#btn8").click(function(){
    	$("#f8").toggle();
    	estado8++;
 		if(estado8==1){
			$("#btn8").text('Ocultar');
		}else{
			$("#btn8").text('Mostrar');
			estado8=0;
		}
	});
</script>
