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

## Sistema de Validaciones

### Resumen de Validaciones Implementadas

El sistema cuenta con validaciones robustas tanto a nivel de base de datos como a nivel de aplicación, con mensajes de error en español.

#### 1. Validaciones a Nivel de Base de Datos (Migraciones)

**Tabla `productos`:**
- `nombre`: NOT NULL, VARCHAR(100)
- `precio`: NOT NULL, DECIMAL(10,2)
- `stock`: NOT NULL, INTEGER, DEFAULT(0)
- `descripcion`: NULLABLE, TEXT
- `imagen`: NULLABLE, VARCHAR(255)

**Tabla `clientes`:**
- `nombre`: NOT NULL, VARCHAR(100)
- `telefono`: NULLABLE, VARCHAR(20)
- `direccion`: NULLABLE, VARCHAR(255)

**Tabla `proveedores`:**
- `nombre`: NOT NULL, VARCHAR(100)
- `telefono`: NULLABLE, VARCHAR(20)
- `direccion`: NULLABLE, VARCHAR(255)
- `contacto`: NULLABLE, VARCHAR(100)

**Tabla `ventas`:**
- `cliente_id`: NULLABLE, FOREIGN KEY
- `fecha`: NOT NULL, DATETIME, DEFAULT CURRENT_TIMESTAMP
- `total`: NOT NULL, DECIMAL(10,2)

**Tabla `compras`:**
- `proveedor_id`: NOT NULL, FOREIGN KEY
- `fecha`: NOT NULL, DATETIME, DEFAULT CURRENT_TIMESTAMP
- `total`: NOT NULL, DECIMAL(10,2)

#### 2. Validaciones a Nivel de Modelos

**Modelo `Producto`:**
```php
public static $rules = [
    'nombre' => 'required|string|max:100|min:2',
    'descripcion' => 'nullable|string|max:1000',
    'precio' => 'required|numeric|min:0|max:999999.99',
    'stock' => 'required|integer|min:0|max:999999',
    'imagen' => 'nullable|string|max:255',
];
```

**Modelo `Cliente`:**
```php
public static $rules = [
    'nombre' => 'required|string|max:100|min:2',
    'telefono' => 'nullable|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
    'direccion' => 'nullable|string|max:255|min:5',
];
```

**Modelo `Proveedor`:**
```php
public static $rules = [
    'nombre' => 'required|string|max:100|min:2',
    'telefono' => 'nullable|string|max:20|regex:/^[0-9\-\+\(\)\s]+$/',
    'direccion' => 'nullable|string|max:255|min:5',
    'contacto' => 'nullable|string|max:100|min:2',
];
```

#### 3. Validaciones Personalizadas

**Validaciones implementadas en `AppServiceProvider`:**

- `not_empty_string`: Verifica que el campo no sea solo espacios en blanco
- `valid_phone`: Valida formato de teléfono (números, guiones, paréntesis, espacios)
- `positive_price`: Verifica que el precio sea mayor a 0
- `non_negative_stock`: Verifica que el stock no sea negativo
- `unique_name`: Verifica que el nombre sea único en la tabla especificada
- `valid_address`: Verifica que la dirección tenga al menos 5 caracteres

#### 4. Validaciones Específicas por Campo

**Nombres:**
- Mínimo 2 caracteres
- Máximo 100 caracteres
- No puede estar vacío
- Debe ser único en su tabla

**Teléfonos:**
- Formato: números, guiones, paréntesis, espacios
- Mínimo 7 dígitos
- Máximo 20 caracteres
- Opcional (nullable)

**Direcciones:**
- Mínimo 5 caracteres
- Máximo 255 caracteres
- Opcional (nullable)
- No puede estar vacía si se proporciona

**Precios:**
- Debe ser mayor a 0
- Máximo 999,999.99
- Se redondea a 2 decimales

**Stock:**
- No puede ser negativo
- Máximo 999,999
- Se actualiza automáticamente con ventas/compras

#### 5. Mensajes de Error Personalizados

Todos los mensajes de error están en español y son descriptivos:

- "El nombre del producto no puede estar vacío."
- "Ya existe un producto con este nombre."
- "El precio debe ser mayor a 0."
- "El teléfono debe tener al menos 7 dígitos."
- "La dirección no puede estar vacía si se proporciona."
- "Stock insuficiente para: [producto]"

#### 6. Validaciones en Controladores

**ProductoController:**
- **Crear**: Valida nombre único, precio positivo, stock no negativo
- **Actualizar**: Valida nombre único (excluyendo el registro actual)

**ClienteController:**
- **Crear**: Valida nombre único, teléfono válido, dirección válida
- **Actualizar**: Valida nombre único (excluyendo el registro actual)

**ProveedorController:**
- **Crear**: Valida nombre único, teléfono válido, dirección válida, contacto válido
- **Actualizar**: Valida nombre único (excluyendo el registro actual)

**VentaController:**
- Valida stock disponible antes de procesar venta
- Valida que los productos existan
- Valida cantidades positivas

**CompraController:**
- Valida que el proveedor exista
- Valida que los productos existan
- Valida cantidades y precios positivos

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
   php artisan migrate:fresh
   ```

7. **Limpia el cache para las validaciones personalizadas**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

8. **Ejecuta los seeders para poblar la base de datos con datos de ejemplo**
   ```bash
   php artisan db:seed --class=UserSeeder
   php artisan db:seed --class=ClienteSeeder
   php artisan db:seed --class=ProveedorSeeder
   php artisan db:seed --class=ProductoSeeder
   php artisan db:seed --class=InventarioSeeder
   php artisan db:seed --class=CompraSeeder
   php artisan db:seed --class=DetalleCompraSeeder
   php artisan db:seed --class=VentaSeeder
   php artisan db:seed --class=DetalleVentaSeeder
   ```

9. **Levanta el servidor de desarrollo**
   ```bash
   php artisan serve
   ```
   El proyecto estará disponible en [http://localhost:8000](http://localhost:8000)

---

## Comandos Útiles

### Regenerar migraciones
```bash
php artisan migrate:fresh
```

### Limpiar cache de validaciones
```bash
php artisan config:clear
php artisan cache:clear
```

### Ver errores de validación
```bash
php artisan route:list
```

---

## Próximas Mejoras Sugeridas

1. **Validación de imágenes**: Verificar formato y tamaño
2. **Validación de fechas**: Verificar que las fechas sean lógicas
3. **Validación de emails**: Para futuros campos de email
4. **Validación de códigos postales**: Para direcciones
5. **Validación de RFC/CURP**: Para información fiscal

---

> **Nota:**  
> Este proyecto incluye la estructura de base de datos (migraciones), modelos Eloquent, factories, seeders, controladores y vistas web para los módulos principales.  
> Al levantar el servidor (`php artisan serve`) podrás acceder a la interfaz web para gestionar la panadería desde el navegador.
> 
> **Sistema de validaciones robusto**: El proyecto cuenta con validaciones completas tanto del lado del cliente como del servidor, con mensajes de error claros en español que ayudan a los usuarios a corregir los datos ingresados correctamente.