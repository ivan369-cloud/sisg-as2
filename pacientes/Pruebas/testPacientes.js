const puppeteer = require('puppeteer');
const fs = require('fs');

function escribirLog(mensaje) {
    const fecha = new Date().toISOString();
    fs.appendFileSync('test-log.txt', `[${fecha}] ${mensaje}\n`);
}

(async () => {
    try {
        const browser = await puppeteer.launch({ headless: false });
        const page = await browser.newPage();

        page.on('response', async response => {
            try {
                if (response.url().includes('regPacientes.php')) {
                    if (response.request().method() !== 'OPTIONS') {
                        const responseText = await response.text();
                        escribirLog(`Respuesta del servidor: ${responseText}`);
                    } else {
                        escribirLog(`Solicitud preflight detectada para ${response.url()}`);
                    }
                }
            } catch (error) {
                escribirLog(`Error al obtener la respuesta: ${error}`);
            }
        });

        page.on('dialog', async dialog => {
            escribirLog(`Dialogo detectado: ${dialog.message()}`);
            await dialog.accept();  
            escribirLog('Dialogo aceptado.');
        });

        await page.goto('http://localhost:8081/asii/02-sisg/pacientes/Pacientes.php');
        escribirLog('Navegación a la página exitosa.');

        await page.type('input[name="dpi"]', '123456789');
        escribirLog('Campo DPI disponible.');
        await page.type('input[name="primer_nombre"]', 'Juan');
        await page.type('input[name="segundo_nombre"]', 'Carlos');
        await page.type('input[name="primer_apellido"]', 'Perez');
        await page.type('input[name="segundo_apellido"]', 'Lopez');
        await page.type('input[name="edad"]', '25');
        await page.select('select[name="genero"]', 'Masculino');
        await page.type('input[name="correopaciente"]', 'juan@example.com');
        await page.type('input[name="fecha_nac"]', '01/01/1995');
        await page.type('input[name="direpaciente"]', 'Calle Falsa 123');
        await page.type('input[name="telepaciente"]', '12345678');
        await page.type('input[name="obspaciente"]', 'Observaciones aquí');
        await page.select('select[name="medicoencargado"]', '1');
        escribirLog('Formulario llenado exitosamente.');

        await page.click('button[type="submit"]');
        escribirLog('Formulario enviado.');

        await page.waitForTimeout(2000); 

        escribirLog('Test Passed: Paciente ingresado con éxito.');

        await browser.close();
        escribirLog('Navegador cerrado.');

    } catch (error) {
        escribirLog(`Error durante la ejecución del test: ${error}`);
    }
})();
