<?php
// Conexión a la base de datos
include "../db.php";

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para obtener la cantidad de citas por estado
$sql = "SELECT id_estado, COUNT(*) AS cantidad_citas
        FROM citas
        WHERE fecha = CURDATE()
        GROUP BY id_estado";

$result = $conexion->query($sql);

$estados = [];
$cantidades = [];

// Almacenar los resultados en arrays
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $estado = $row['id_estado'];
        switch ($estado) {
            case 1:
                $estados[] = 'Agendada';
                break;
            case 2:
                $estados[] = 'Cancelada';
                break;
            case 3:
                $estados[] = 'Atendida';
                break;
        }
        $cantidades[] = $row['cantidad_citas'];
    }
} else {
    $estados = ['Agendada', 'Cancelada', 'Atendida'];
    $cantidades = [0, 0, 0];
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard de Citas</title>
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            background-color: #ffffff; /* Fondo blanco */
            color: #87CEEB; /* Color de texto azul cielo */
        }

        h1 {
            color: #87CEEB; /* Color de encabezado en azul cielo */
        }

        .chart-container {
            width: 80%;
            max-width: 600px;
            margin-top: 20px;
        }

        .back-button {
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #007BFF; /* Color del enlace en azul cielo */
            font-weight: bold;
            padding: 10px 20px;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-button a:hover {
            background-color: #007BFF;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="back-button">
        <h1>Sistema de Salud General</h1>
    </div>
    <div class="chart-container">
        <canvas id="estadoCitasChart"></canvas>
        <!-- Botón de regreso a vista_empleado.php -->
        <div class="back-button">
            <a href="../vista_empleado.php">Regresar</a>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('estadoCitasChart').getContext('2d');
        const estadoCitasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($estados); ?>,
                datasets: [{
                    label: 'Número de citas',
                    data: <?php echo json_encode($cantidades); ?>,
                    backgroundColor: '#007BFF',
                    borderColor: '#007BFF',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de citas',
                            color: '#007BFF' /* Título en azul cielo */
                        }
                    },
                    y: {
                        ticks: {
                            color: '#007BFF' /* Etiquetas en azul cielo */
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
