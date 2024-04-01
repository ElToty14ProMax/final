// Función para exportar a PDF
function exportToPdf() {
    const doc = new jsPDF();
    doc.autoTable({
        html: '#dataTable', // ID de la tabla
    });
    doc.save('tabla.pdf');
}

// Agregar evento de clic al botón de exportar a PDF
document.getElementById('exportPdfButton').addEventListener('click', exportToPdf);

// Función para exportar a JSON
function exportToJson() {
    const rows = Array.from(document.querySelectorAll('#dataTable tbody tr'));
    const data = rows.map(row => {
        const cells = Array.from(row.querySelectorAll('td'));
        return cells.map(cell => cell.textContent.trim());
    });
    const jsonData = JSON.stringify(data);
    const blob = new Blob([jsonData], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'tabla.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

// Agregar evento de clic al botón de exportar a JSON
document.getElementById('exportJsonButton').addEventListener('click', exportToJson);