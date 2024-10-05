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
                if (response.url().includes('EditarPac.php')) {
                    if (response.request().method() !== 'OPTIONS') {
                        const responseText = await response.text();
                        escribirLog(`Respuesta del servidor: ${responseText}`);
                    }
                }
            } catch (error) {
                escribirLog(`Error al obtener la respuesta: ${error}`);
            }
        });

        await page.goto('http://localhost/sisg-as2/pacientes/URDpacientes.php');
        escribirLog('Navegación a la página de pacientes exitosa.');

        await page.waitForSelector('table tbody');

        const dpiToEdit = '123456789';
        const filas = await page.$$('table tbody tr');

        let editButtonFound = false;

        for (const fila of filas) {
            const dpi = await fila.$eval('td:nth-child(2)', td => td.innerText.trim());

            if (dpi === dpiToEdit) {
                const editButton = await fila.$('td a img[alt="Editar"]'); 
                if (editButton) {
                    await editButton.click();
                    escribirLog("Se hizo clic en el botón de editar para el paciente con DPI: " + dpiToEdit);
                    editButtonFound = true;
                    break;
                }
            }
        }

        if (!editButtonFound) {
            escribirLog(`No se encontró el botón de editar para el paciente con DPI: ${dpiToEdit}`);
            await browser.close();
            return;
        }

        await page.waitForNavigation();
        escribirLog('Navegación a la página de edición de paciente.');

        await page.waitForSelector('form#form-medicos');

        const nuevoNombre = 'NuevoNombre'; 
        await page.evaluate((nuevoNombre) => {
            const firstNameField = document.querySelector('input[name="primer_nombre"]');
            firstNameField.value = ""; 
            firstNameField.value = nuevoNombre;
        }, nuevoNombre);

        const nuevoSegundoNombre = 'NuevoSegundonNombre';
        await page.evaluate((nuevoSegundoNombre) => {
            const secondNameField = document.querySelector('input[name="segundo_nombre"]');
            secondNameField.value = "";
            secondNameField.value = nuevoSegundoNombre;
        }, nuevoSegundoNombre);

        await Promise.all([
            page.waitForNavigation(),
            page.click('button[name="btnactualizar"]')
        ]);
        
        escribirLog('Formulario de edición enviado.');

        await page.waitForSelector('table tbody');
        const textoNombreModificado = await page.evaluate(() => document.body.innerText);
        if (textoNombreModificado.includes(nuevoNombre)) {
            escribirLog('El paciente fue editado exitosamente.');
        } else {
            escribirLog('Error: El paciente no fue editado.');
        }

        console.log('Formulario enviado.');

        // Cerrar el navegador
        await browser.close();
        escribirLog('Navegador cerrado.');

    } catch (error) {
        escribirLog(`Error durante la ejecución del test: ${error}`);
    }
})();