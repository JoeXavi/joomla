// JavaScript Document
console.log("Cargando...")

function renderCategories(list){
	let o = new Option("Seleccionar", "0");
	$(o).html("Seleccionar");
	$('#category').append(o);

	list.map(item=>{
		let o = new Option(item.title, item.id);
		$(o).html(item.title);
		$('#category').append(o);
	})
		
}

function loadCategories(value){
	$.ajax({
		url: '/categories.php?token=Token123*&conexion='+value,
		success: function(respuesta) {
			console.log(typeof respuesta);
			let list = JSON.parse(respuesta)
			renderCategories(list)
		},
		error: function() {
			console.log("No se ha podido obtener la información");
		}
	});				
}

	$(document).ready(function() {
		loadCategories('n2')
			
		$('#tiporegistro').change((e)=>{
			let value = e.target.value
			loadCategories(value)
		})
	});
              
          