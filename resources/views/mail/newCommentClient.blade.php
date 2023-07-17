<!DOCTYPE html>
<html>
<head>
  <title>Formulario de contacto</title>
  <style>
    body {
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
    }
    
    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid white;
      background-color: black;
      color: white;
    }
    
    input[type="submit"] {
      background-color: white;
      color: black;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: gray;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Nuevo mensaje:</h1>
    <p>Nombre: {{$details['nombre']}}</p>
    <p>Apellido: {{$details['apellido']}}</p>
    <p>Correo electrónico: {{$details['correo']}}</p>
    <p>Celular: {{$details['celular']}}</p>
    <p>Mensaje: {{$details['mensaje']}}</p>
  </div>
</body>
</html>
