document.addEventListener("DOMContentLoaded", function() {
    // Find the container where the links will be placed
    const inhaltContainer = document.getElementById('inhalt');
    if (!inhaltContainer) {
        console.error('Inhalt container not found');
        return;
    }

    // Clear existing content in inhaltContainer
    inhaltContainer.innerHTML = '<strong>Auf dieser Seite:</strong>';

    // Find all articles on the page
    const articles = document.querySelectorAll('article');

    // Loop through each article and create links
    articles.forEach(article => {
        if (article.id && article.id !== 'inhalt') {
            const titleElement = article.querySelector('h2');
            if (titleElement) {
                const title = titleElement.textContent;
                const link = document.createElement('a');
                link.href = `#${article.id}`;
                link.textContent = title;
                inhaltContainer.appendChild(document.createTextNode(' *** '));
                inhaltContainer.appendChild(link);
            }
        }
    });
});
