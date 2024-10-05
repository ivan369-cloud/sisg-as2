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
                if (response.request().method() === 'OPTIONS') return;

                if (response.url().includes('DeletePac.php')) {
                    const responseText = await response.text();
                    escribirLog(`Respuesta del servidor: ${responseText}`);
                }
            } catch (error) {
                escribirLog(`Error al obtener la respuesta: ${error}`);
            }
        });

        page.on('response', async response => {
            try {
                if (response.url().includes('DeletePac.php')) {
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

        const dpiToDelete = '123456789';

        const deleteButtonSelector = `table tbody tr td:nth-child(2):contains("${dpiToDelete}") + td a:nth-child(2)`;

        const deleteButton = await page.evaluateHandle((dpi) => {
            const rows = Array.from(document.querySelectorAll('table tbody tr'));
            for (const row of rows) {
                const dpiCell = row.querySelector('td:nth-child(2)');
                if (dpiCell && dpiCell.innerText.trim() === dpi) {
                    return row.querySelector('td a:nth-child(2)'); 
                }
            }
            return null; 
        }, dpiToDelete);

        if (deleteButton) {
            await deleteButton.click();
            escribirLog(`Se hizo clic en el botón de eliminar para el paciente con DPI: ${dpiToDelete}`);

            page.on('dialog', async dialog => {
                await dialog.accept();
                escribirLog('Se aceptó la alerta de confirmación para eliminar el paciente.');
            });

            await page.waitForNavigation();

            const textoDPIEliminado = await page.evaluate(() => document.body.innerText);
            if (!textoDPIEliminado.includes(dpiToDelete)) {
                escribirLog(`El paciente con DPI ${dpiToDelete} fue eliminado exitosamente.`);
            } else {
                escribirLog(`Error: El paciente con DPI ${dpiToDelete} aún aparece en la tabla.`);
            }
        } else {
            escribirLog(`Error: No se encontró el botón de eliminar para el paciente con DPI: ${dpiToDelete}`);
        }

        await browser.close();
        escribirLog('Navegador cerrado.');

    } catch (error) {
        escribirLog(`Error durante la ejecución del test: ${error}`);
    }
})();