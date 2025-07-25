# Panadería - Sistema de Gestión

## Descripción breve

Este proyecto es un sistema de gestión para una panadería, desarrollado en Laravel. Permite administrar clientes, proveedores, productos, ventas, compras, inventario y los detalles asociados a cada operación. El objetivo es facilitar el control de stock, las ventas y las compras, así como mantener un registro ordenado de toda la información relevante para el negocio.

---

## Funcionalidades principales

- Gestión de **Clientes**: Alta, edición, listado y eliminación de clientes.
- Gestión de **Proveedores**: Alta, edición, listado y eliminación de proveedores.
- Gestión de **Productos**: CRUD de productos, incluyendo imagen, stock y descripción.
- Gestión de **Ventas**: Registro de ventas, selección de cliente y productos, historial de ventas.
- Gestión de **Compras**: Registro de compras a proveedores, historial de compras.
- Gestión de **Inventario**: Control de entradas y salidas de productos, historial de movimientos.
- Vistas web para cada módulo, con formularios y listados paginados.

---

## ¿Cómo ejecutar el proyecto?

1. **Clona el repositorio**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd panaderia
   ```

2. **Instala las dependencias de PHP con Composer**
   ```bash
   composer install
   ```

3. **Copia el archivo de entorno y configura tus variables**
   ```bash
   cp .env.example .env
   ```
   Luego edita el archivo `.env` y configura los datos de tu base de datos y otros parámetros necesarios.

4. **Genera la clave de la aplicación**
   ```bash
   php artisan key:generate
   ```

5. **Crea la base de datos en tu gestor (MySQL, MariaDB, etc.)**  
   Asegúrate de que el nombre coincida con el que pusiste en el `.env`.

6. **Ejecuta las migraciones para crear las tablas**
   ```bash
   php artisan migrate
   ```

7. **Ejecuta los seeders para poblar la base de datos con datos de ejemplo**
   ```bash
   php artisan db:seed
   ```
   O ejecuta los seeders individualmente si lo prefieres.

8. **Levanta el servidor de desarrollo**
   ```bash
   php artisan serve
   ```
   El proyecto estará disponible en [http://localhost:8000](http://localhost:8000)

---

> **Nota:**  
> Este proyecto incluye la estructura de base de datos (migraciones), modelos Eloquent, factories, seeders, controladores y vistas web para los módulos principales.  
> Al levantar el servidor (`php artisan serve`) podrás acceder a la interfaz web para gestionar la panadería desde el navegador.