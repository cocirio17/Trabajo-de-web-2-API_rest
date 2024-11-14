<p align="center">
  <img src="https://cdn.pixabay.com/animation/2023/06/13/15/12/15-12-44-718_512.gif" alt="Descripción del GIF" width="300">
</p>

### ✈️ Proyecto: Comercialización de Viajes de Larga Distancia

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
  Devuelve todos los boletos disponibles en la base de datos, permitiendo opcionalmente aplicar filtrado y ordenamiento a los resultados.

  - **Descripción**:  
    Esta endpoint permite a los usuarios recuperar una lista de boletos disponibles, con opciones para filtrar y ordenar los resultados por diferentes campos.

  - **Query Params**:  
    - **Ordenamiento**:  
      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:
        - `precio`: Ordena los boletos por precio.
        - `destino_inicio`: Ordena los boletos por el destino de inicio.
        - `destino_fin`: Ordena los boletos por el destino final.
        - `fecha`: Ordena los boletos por la fecha de salida.
        - `id_boleto`: Ordena los boletos por su id (por defecto).
      
      - `orderDirection`: Dirección de orden para el campo especificado en `orderBy`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.
  
      **Ejemplo de Ordenamiento**:  
      Para obtener todos los boletos ordenados por precio en orden descendente:
      ```http
      GET /api/boleto?orderBy=precio&orderDirection=DESC
      ```

    - **Filtro**:  
      - `filtrado`: Campo por el que se desea filtrar los resultados. Los campos válidos pueden incluir:
        - `destino_inicio`: Filtra los boletos por el destino de inicio.
        - `destino_fin`: Filtra los boletos por el destino final.
        - `precio`: Filtra los boletos por precio.
        - `fecha_salida`: Filtra las boletos por las fechas.

      - `valor`: Valor que se utilizará para el filtrado. Debe ser el valor específico que se comparará con el campo filtrado.

      **Ejemplo de Filtrado**:  
      Para obtener todos los boletos cuyo precio sea igual a 7000:
      ```http
      GET /api/boleto?filtro=precio&valor=7000
      ```
    - **Paginación**:  
      La **paginación** permite dividir los resultados en páginas más pequeñas, mejorando la experiencia del usuario y optimizando el rendimiento de la aplicación.

      - `pagina`: Número de la página solicitada. Si no se especifica, se muestran todos los Boletos.
      - `limite`: Número de Boletos por página. Si este no tiene un valor, se aplica un límite por defecto que va a ser 5.

      **Ejemplo de solicitud**:  
      Para obtener los boletos de la página 2 con 10 resultados por página:
      ```http
      GET /api/boleto?pagina=2&limite=10
      ```
      

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

  - **iniciar sesión**:  
    - **Nombre de usuario**: `webadmin`  
    - **Contraseña**: `admin`

  - **Respuesta**:  
    Si las credenciales son válidas, se devuelve un token JWT que puede ser utilizado para autenticar futuras solicitudes a la API.


---

### 🌐 Estructura del Proyecto

Este proyecto cuenta con una API REST que permite la consulta, modificación, eliminación e inserción de boletos para viajes en colectivos de larga distancia. El diseño está orientado a facilitar la **comercialización de boletos** y **gestión de pasajeros**.

---
