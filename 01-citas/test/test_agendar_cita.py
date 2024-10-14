import requests
import unittest

class TestAgendarCita(unittest.TestCase):
    BASE_URL = "http://localhost:8081/asii/01-citas/"  # Asegúrate de que esta URL sea correcta

    def test_insertar_cita(self):
        # Prueba para insertar una cita
        data = {
            'id_paciente': 2,  # Usa un ID válido
            'id_medico': 5,    # Usa un ID válido
            'id_horario': 2,   # Usa un ID válido
            'fecha': '2024-10-06', # Cambia a una fecha válida
            'id_motivo': 2     # Usa un ID válido
        }
        response = requests.post(f"{self.BASE_URL}create.php", data=data)
        print(f"Status Code: {response.status_code}")
        print(response.text)  # Esto ayudará a ver qué se está devolviendo

    def test_obtener_citas(self):
        # Prueba para obtener las citas
        response = requests.get(f"{self.BASE_URL}index.php")  # Cambia esta URL según tu implementación
        print(f"Status Code: {response.status_code}")
        print(response.text)  # Esto ayudará a ver qué se está devolviendo
        self.assertEqual(response.status_code, 200)  # Asegúrate de que se obtuvo con éxito
        # Puedes agregar más aserciones aquí para verificar el contenido de la respuesta si es necesario
        # Por ejemplo, verificar que se devuelven citas específicas en la respuesta
        self.assertIn("cita", response.text)  # Cambia "cita" por lo que esperas encontrar en la respuesta

    def test_eliminar_cita(self):
        # Prueba para eliminar una cita
        cita_id = 34  # Reemplaza con el ID real de la cita que deseas eliminar.

        # Realiza la solicitud para eliminar la cita
        delete_response = requests.post(f"{self.BASE_URL}delete.php", data={'id': cita_id})
        print(f"Delete Status Code: {delete_response.status_code}")
        print(delete_response.text)  # Esto ayudará a ver qué se está devolviendo
        self.assertEqual(delete_response.status_code, 200)  # Asegúrate de que la eliminación fue exitosa
        #self.assertIn("Cita eliminada con éxito", delete_response.text)  # Cambia según el mensaje esperado

if __name__ == '__main__':
    unittest.main()
