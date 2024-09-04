document.getElementById('uploadIcon').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.rectangle-34625156').style.backgroundImage = `url(${e.target.result})`;
        };
        reader.readAsDataURL(file);
    }
});

function previewImages() {
    const previewContainer = document.getElementById('preview');
    const files = document.getElementById('images').files;
    
    // Clear the previous images
    previewContainer.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(event) {
                const imgElement = document.createElement('img');
                imgElement.src = event.target.result;
                imgElement.style.width = '100px';
                imgElement.style.height = '100px';
                imgElement.style.objectFit = 'cover';
                imgElement.style.borderRadius = '8px';
                imgElement.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(file);
        }
    }
}
