# 🛠️ FerroCenter – Sistema ERP para Ferreterías

FerroCenter es un sistema web de gestión empresarial desarrollado como proyecto académico en la Universidad Técnica del Norte para una ferretería ubicada en Cayambe. El objetivo fue reemplazar procesos manuales por soluciones digitales seguras y escalables. La aplicación gestiona ventas, inventario, usuarios, reportes, auditoría y más.

---

## 🚀 Funcionalidades principales

- Gestión de usuarios y roles (Administrador y Empleado)
- Módulo de productos, proveedores y clientes
- Registro de ventas con actualización automática de stock
- Reportes de ventas, inventario y auditoría
- Panel de control con estadísticas gráficas
- Sistema modular con autenticación y validaciones

---

## ⚙️ Tecnologías utilizadas

- **Framework:** Laravel 10
- **Lenguaje:** PHP 8.x
- **Frontend:** Blade, Bootstrap 5
- **Base de datos:** MySQL
- **ORM:** Eloquent
- **Control de versiones:** Git
- **Documentación:** Basada en IEEE 830

---

## 📦 Instalación del proyecto

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/DiegoCuaycal/sistema-gestion-ferreteria.git
cd sistema-gestion-ferreteria
```

### 2️⃣ Instalar dependencias del backend
```bash
composer install
```
### 3️⃣ Instalar dependencias del frontend
```bash
npm install
npm run dev
```
### 4️⃣ Configurar entorno
Copia el archivo .env.example y renómbralo a .env:
```bash
cp .env.example .env
```
### 5️⃣ Configurar variables de entorno
Edita el archivo .env y coloca tus datos de base de datos:
```bash
DB_DATABASE=ferrocenter
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```
### 6️⃣ Generar clave de aplicación
```bash
php artisan key:generate
```
