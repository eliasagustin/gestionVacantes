<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdfFile = $_FILES['pdfFile'];
    // echo $_POST['usuario_id'];

    if ($pdfFile['error'] === UPLOAD_ERR_OK) {
        $pdfFileName = $pdfFile['name'];
        $pdfTempPath = $pdfFile['tmp_name'];

        // Mueve el archivo a una ubicación deseada en el servidor
        $targetPath = '../uploads/' . $_POST['usuario_id'] . '_CV.pdf'; //$pdfFileName;
        move_uploaded_file($pdfTempPath, $targetPath);

        echo "<div class='notification is-info is-light'><strong>¡CV cargado correctamente!</strong><br>El archivo PDF se ha cargado con éxito</div>";
    } else {
        echo "<div class='notification is-danger is-light'><strong>¡Ocurrio un error inesperado!</strong><br>Error al cargar el archivo PDF.</div>";
        
    }
}
?>