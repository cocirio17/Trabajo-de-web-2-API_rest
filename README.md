# ✈️ Proyecto: Comercialización de Viajes de Larga Distancia

---

### Integrantes  
- **Cocirio Francisco**  
- **Beheran Bazterrechea Felipe Tomás**

---

### Temática

Este proyecto tiene como objetivo la **comercialización de viajes en colectivos de larga distancia**. A través de esta plataforma web, los usuarios podrán:

- Consultar los **viajes disponibles**.
- Visualizar los **pasajeros** que tienen boletos reservados.

---

### URL de Ejemplo  
`./api/endpoint/:ID/:subrecurso`

---

## 🚏 Endpoints

### 🎫 Boletos

- **GET** `/api/boleto`  
  Devuelve todos los boletos disponibles.

  - **Query Params**:  
    - `orderBy`: Campo por el que se desea ordenar (e.g., `precio`).  
    - `orderDirection`: Dirección de orden (`ASC` o `DESC`).

  - **Ejemplo**:  
    `/api/boleto?orderBy=precio&orderDirection=DESC`
  
---

- **GET** `/api/boleto/:ID`  
  Devuelve el boleto correspondiente al `ID` solicitado.

---

- **POST** `/api/boleto`  
  Inserta un nuevo boleto con la información proporcionada en el cuerpo de la solicitud (en formato JSON).

  - **Campos requeridos**:  
    - `destino_inicio`: Origen del viaje.  
    - `destino_fin`: Destino del viaje.  
    - `fecha_salida`: Fecha y hora de salida.  
    - `precio`: Precio del boleto.

  > **Nota**: El campo `id` se genera automáticamente y no debe incluirse en el JSON.

---

- **PUT** `/api/boleto/:ID`  
  Modifica el boleto correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:  
    - `destino_inicio`  
    - `destino_fin`  
    - `fecha_salida`  
    - `precio`

---

- **DELETE** `/api/boleto/:ID`  
  Elimina el boleto correspondiente al `ID` solicitado.

---

### 🔐 Autenticación

Para acceder a recursos protegidos, los usuarios deben autenticarse utilizando un **token**. 

- **POST** `/usuarios/token`  
  Este endpoint permite a los usuarios obtener un token JWT. Para utilizarlo, se deben enviar las credenciales en el encabezado de la solicitud en formato Base64 (usuario:contraseña).

  - **Ejemplo de uso**: 
    - Encabezado de solicitud:  
      `Authorization: Basic <base64(usuario:contraseña)>`
  
  - **Respuesta**:  
    Si las credenciales son válidas, se devuelve un token JWT que puede ser utilizado para autenticar futuras solicitudes a la API.

---

### 🌐 Estructura del Proyecto

Este proyecto cuenta con una API REST que permite la consulta, modificación, eliminación e inserción de boletos para viajes en colectivos de larga distancia. El diseño está orientado a facilitar la **comercialización de boletos** y **gestión de pasajeros**.

---
