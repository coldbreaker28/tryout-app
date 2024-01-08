function escapeHtml(html) {
    var text = document.createTextNode(html);
    var div = document.createElement('div');
    div.appendChild(text);
    return div.innerHTML;
}

// let soalUjians = [];
const itemsPerPage = 5;
let currentPage = 1;
// fetch('/api/get-soal')
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('HTTP error! Status: ${response.status}');
//         } return response.json();
//     })
//     .then(data => {
//         soalUjians = data.soalUjians || [];
//         console.log(soalUjians)
//         displaySoal(0, itemsPerPage);
//         updatePagination();
//     })
//     .catch(error => {
//         console.error('Fetch error:', error);
//     });

function displaySoal(startIndex, endIndex) {
    const container = document.getElementById('soal-container');
    container.innerHTML = '';

    for (let i = startIndex; i < endIndex && soalUjians && i < soalUjians.length; i++) {
        const soal = soalUjians[i];

        if (soal && soal.pertanyaan && soal.mataPelajaran && soal.mataPelajaran.nama) {
            const cardElement = document.createElement('div');
            cardElement.className = 'page';
            cardElement.innerHTML = `
                <div class="page-content">${escapeHtml(soal.pertanyaan)}</div>
                <div class="page-content">${escapeHtml(soal.mataPelajaran.nama)}</div>
            `;
            container.appendChild(cardElement);
        }
    }
}
    
function updatePagination() {
    const totalPages = soalUjians ? Math.ceil(soalUjians.length / itemsPerPage) : 0;
    const currentPageElement = document.getElementById('current-page');

    if (currentPageElement) {
        currentPageElement.innerText = currentPage;
    }

    // enable/disable tombol previous dan next sesuai dengan halaman saat ini
    const previousBtn = document.getElementById('previous-btn');
    const nextBtn = document.getElementById('next-btn');

    if (previousBtn && nextBtn) {
        previousBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
    }
}

function previousPage() {
    if (currentPage > 1) {
        currentPage--;
        updatePagination();
        displaySoal((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);
    }
}
function nextPage(){
    const totalPages = Math.ceil(soalUjians.length / itemsPerPage);
    if (currentPage < totalPages) {
        currentPage++;
        updatePagination();
        displaySoal((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);
    }
}
updatePagination();