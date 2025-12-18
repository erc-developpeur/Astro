document.addEventListener('DOMContentLoaded', function() {
    const myListCards = document.querySelectorAll('.mylist-card');
    const mainFondImg = document.getElementById('main-fond-img');
    const mainTitle = document.getElementById('main-title');
    const mainGenre = document.getElementById('main-genre');
    const mainRating = document.getElementById('main-rating');
    const mainYear = document.getElementById('main-year');
    const mainDescription = document.getElementById('main-description');

    myListCards.forEach(card => {
        card.addEventListener('click', function() {
            const id = this.dataset.id;
            const type = this.dataset.type;

            // Mettre à jour la classe active
            myListCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            // Faire une requête AJAX pour obtenir les détails du film/série
            fetch(`api/get_media_details.php?id=${id}&type=${type}`)
                .then(response => response.json())
                .then(data => {
                    // Faire disparaître les éléments
                    [mainFondImg, mainTitle, mainGenre, mainRating, mainYear, mainDescription].forEach(el => {
                        el.classList.remove('show');
                    });

                    // Mettre à jour les données après un court délai
                    setTimeout(() => {
                        mainFondImg.src = data.imagefond;
                        mainTitle.textContent = data.title;
                        mainGenre.textContent = data.genre.join(', ');
                        mainRating.textContent = `${data.rating} ★`;
                        mainYear.textContent = new Date(data.date).getFullYear();
                        mainDescription.textContent = data.description;

                        // Faire réapparaître les éléments
                        [mainFondImg, mainTitle, mainGenre, mainRating, mainYear, mainDescription].forEach(el => {
                            el.classList.add('show');
                        });
                    }, 500);
                })
                .catch(error => console.error('Error:', error));
        });
    });
}); 