<?php
    interface IModel{
        
        public function guardar();
        public function obtenerTodos();
        public function obtener($id);
        public function eliminar($id);
        public function actualizar();
    }
?>