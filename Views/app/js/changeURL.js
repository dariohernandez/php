function changeURL(url){	// Función para cambiar la URL de una página sin recargarla

	history.pushState(null, null, url);
}