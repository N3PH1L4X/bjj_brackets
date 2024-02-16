function actualizarTextoCargo(itemHTMLvisible, itemHTMLinvisible, textoObjetivoVisible, textoObjetivoInvisible) {
    document.getElementById(itemHTMLvisible).innerText = textoObjetivoVisible;
    document.getElementById(itemHTMLinvisible).value = textoObjetivoInvisible;
}

function actualizarTextoTurno(itemHTMLvisible, itemHTMLinvisible, textoObjetivoVisible, textoObjetivoInvisible) {
    document.getElementById(itemHTMLvisible).innerText = textoObjetivoVisible;
    document.getElementById(itemHTMLinvisible).value = textoObjetivoInvisible;
}


// Exportar marcaciones
function exportToExcelMarcaciones() {
    var table = document.querySelector('.tabla');
    var cloneTable = table.cloneNode(true);

    var headers = cloneTable.querySelectorAll('th:last-child, td:last-child');
    if (headers.length > 0 && headers[0].cellIndex !== table.rows[0].cells.length - 1) {
        headers.forEach(function(header) {
            header.parentNode.removeChild(header);
        });
    }

    var excelData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
    excelData += '<head><meta charset="utf-8"></head><body>';
    excelData += cloneTable.outerHTML;
    excelData += '</body></html>';

    var blob = new Blob([excelData], { type: 'application/vnd.ms-excel' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'Reporte marcaciones.xls';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportToCSVMarcaciones() {
    var originalTable = document.querySelector('.tabla');
    var csvContent = "data:text/csv;charset=utf-8,";

    // Get the headers
    var headers = [];
    for (var i = 0; i < originalTable.rows[0].cells.length; i++) {
        headers.push(originalTable.rows[0].cells[i].textContent.trim());
    }
    csvContent += headers.join(',') + '\n';

    // Iterate over the rows and add visible rows to CSV
    for (var j = 1; j < originalTable.rows.length; j++) {
        var row = originalTable.rows[j];

        // Check if the row is visible
        if (row.style.display !== 'none') {
            var rowData = [];
            for (var k = 0; k < row.cells.length; k++) {
                rowData.push(row.cells[k].textContent.trim());
            }
            csvContent += rowData.join(',') + '\n';
        }
    }

    // Create and trigger the download
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement('a');
    link.href = encodedUri;
    link.download = 'Reporte marcaciones.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportToPDFMarcaciones() {
    // Get the HTML table element
    var table = document.querySelector('.tabla');

    var options = {
        margin: 3,
        filename: 'Reporte marcaciones.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 1 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { before: '.break-before', after: ['.break-after'] },
        // Add content before the table
        content: [
            table
        ],
    };

    // Generate PDF using html2pdf with options
    html2pdf().from(table).set(options).outputPdf().then(function(pdf) {
        // Save the PDF
        pdf.save();
    });

    html2pdf(table, options);
    setTimeout(function() {
        location.reload();
    }, 10000);
}


// Exportar inasistencias
function exportToExcelInasistencias() {
    var table = document.querySelector('.tabla');
    var cloneTable = table.cloneNode(true);

    var headers = cloneTable.querySelectorAll('th:last-child, td:last-child');
    if (headers.length > 0 && headers[0].cellIndex !== table.rows[0].cells.length - 1) {
        headers.forEach(function(header) {
            header.parentNode.removeChild(header);
        });
    }

    var excelData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
    excelData += '<head><meta charset="utf-8"></head><body>';
    excelData += cloneTable.outerHTML;
    excelData += '</body></html>';

    var blob = new Blob([excelData], { type: 'application/vnd.ms-excel' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'Reporte de inasistencias.xls';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportToCSVInasistencias() {
    var originalTable = document.querySelector('.tabla');
    var csvContent = "data:text/csv;charset=utf-8,";

    // Get the headers
    var headers = [];
    for (var i = 0; i < originalTable.rows[0].cells.length; i++) {
        headers.push(originalTable.rows[0].cells[i].textContent.trim());
    }
    csvContent += headers.join(',') + '\n';

    // Iterate over the rows and add visible rows to CSV
    for (var j = 1; j < originalTable.rows.length; j++) {
        var row = originalTable.rows[j];

        // Check if the row is visible
        if (row.style.display !== 'none') {
            var rowData = [];
            for (var k = 0; k < row.cells.length; k++) {
                rowData.push(row.cells[k].textContent.trim());
            }
            csvContent += rowData.join(',') + '\n';
        }
    }

    // Create and trigger the download
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement('a');
    link.href = encodedUri;
    link.download = 'Reporte inasistencias.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function exportToPDFInasistencias() {
    // Get the HTML table element
    var table = document.querySelector('.tabla');

    var options = {
        margin: 10,
        filename: 'Reporte de inasistencias.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { before: '.break-before', after: ['.break-after'] },
        // Add content before the table
        content: [
            { text: 'Additional Text at the Beginning', style: 'header' },
            table
        ],
        // Add custom styles
        styles: {
            header: {
                fontSize: 18,
                bold: true,
                margin: [0, 0, 0, 10]
            }
        }
    };

    // Generate PDF using html2pdf with options
    html2pdf().from(table).set(options).outputPdf().then(function(pdf) {
        // Save the PDF
        pdf.save();
    });

    html2pdf(table, options)
}

function hideElementsByID(id) {
    var elements = document.querySelectorAll("#" + id);
    elements.forEach(function(element) {
        element.style.display = "none";
    });
}

function mostrarGraficos(...elementIds) {
    elementIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.style.display = 'block';
        }
    });
}

function ocultarGraficos(...elementIds) {
    elementIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.style.display = 'none';
        }
    });
}