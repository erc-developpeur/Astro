<?php
class Movie {
    private $movies = [
        [
            'id' => 1,
            'type' => 'movie',
            'title' => 'Avatar',
            'description' => 'Avatar est un film de science-fiction réalisé par James Cameron. L\'histoire suit un ancien marine qui vit sur la planète Pandora et qui se retrouve impliqué dans une guerre entre humains et Na\'vi.',
            'genre' => ['sci-fi', 'action', 'aventure'],
            'image' => 'https://images.affiches-et-posters.com//albums/3/47832/medium/poster-film-avatar.jpg',
            'imagefond' => 'https://m.media-amazon.com/images/S/pv-target-images/16627900db04b76fae3b64266ca161511422059cd24062fb5d900971003a0b70.jpg',
            'affiche' => 'https://images.affiches-et-posters.com//albums/3/47832/medium/poster-film-avatar.jpg',
            'date' => '2009-07-16',
            'actors' => 'Sam Worthington, Zoe Saldana, Stephen Lang, Michelle Rodriguez, Sigourney Weaver',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Sam_Worthington',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Zoe_Salda%C3%B1a',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Stephen_Lang',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Michelle_Rodriguez',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Sigourney_Weaver',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => '5PSNL1qE6VY',
            'duration' => '162',
            'video' => 'https://ab48032c4e411136ead9a62f559db62e.r2.cloudflarestorage.com/volvic/MOVIES/AVATAR_2009/VF/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ca9500f8d550faa1a05b9948ec5245f7%2F20250430%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250430T101401Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=02466ab42e381ccff0fb15971210b25c4d3d9b37fb98ce3a30522360474b393b'
        ],
        [
            'id' => 2,
            'type' => 'movie',
            'title' => 'Interstellar',
            'description' => 'Dans un futur où la Terre est menacée, un groupe d\'explorateurs dirigé par Cooper entreprend un voyage interstellaire pour sauver l\'humanité. Un film de Christopher Nolan mêlant science-fiction et drame familial, porté par une bande sonore épique de Hans Zimmer.',
            'genre' => ['sci-fi', 'drame', 'aventure'],
            'image' => 'https://fr.web.img6.acsta.net/pictures/14/09/24/12/08/158828.jpg',
            'imagefond' => 'https://www.lebleudumiroir.fr/wp-content/uploads/2014/10/interstellar_movie-wide.jpg',
            'affiche' => 'https://fr.web.img6.acsta.net/pictures/14/09/24/12/08/158828.jpg',
            'date' => '2014-11-07',
            'actors' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain, Michael Caine, Matt Damon',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Matthew_McConaughey',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Anne_Hathaway',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Jessica_Chastain',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Michael_Caine',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Matt_Damon',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'zSWdZVtXT7E',
            'duration' => '169',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/Interstellar/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T213928Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=6c10ec8adaba9e4dc3f73fece9aad78f603dccc49f285778bb4592e941895361'
        ],
        [
            'id' => 3,
            'type' => 'movie',
            'title' => 'The Dark Knight',
            'description' => 'The Dark Knight est un film de super-héros réalisé par Christopher Nolan, mettant en vedette Batman dans sa lutte contre le Joker pour sauver Gotham City.',
            'genre' => ['action', 'drame', 'thriller'],
            'image' => 'https://fr.web.img2.acsta.net/medias/nmedia/18/63/97/89/18949761.jpg',
            'imagefond' => 'https://www.legendary.com/wp-content/uploads/2015/04/film_thedarkknight_featureimage_desktop_1600x9001.jpg',
            'affiche' => 'https://fr.web.img2.acsta.net/medias/nmedia/18/63/97/89/18949761.jpg',
            'date' => '2008-07-18',
            'actors' => 'Christian Bale, Heath Ledger, Aaron Eckhart, Maggie Gyllenhaal, Gary Oldman',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Christian_Bale',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Heath_Ledger',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Aaron_Eckhart',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Maggie_Gyllenhaal',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Gary_Oldman',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'EXeTwQWrcwY',
            'duration' => '152',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/MOVIES/THEDARKKNIGHT_2008/VF/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214021Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=e75f446c320b1398776aad524419a04860c3eae088cbedc229fd7dae210b3465'
        ],
        [
            'id' => 4,
            'type' => 'movie',
            'title' => 'The Matrix',
            'description' => 'The Matrix est un film de science-fiction réalisé par les Wachowskis. Il raconte l\'histoire de Neo, un hacker qui découvre que la réalité telle qu\'il la connaît est en fait une simulation informatique contrôlée par des machines.',
            'genre' => ['sci-fi', 'action'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BN2NmN2VhMTQtMDNiOS00NDlhLTliMjgtODE2ZTY0ODQyNDRhXkEyXkFqcGc@._V1_.jpg',
            'imagefond' => 'https://m.media-amazon.com/images/M/MV5BNzM4OTkzMjcxOF5BMl5BanBnXkFtZTgwMTkxMjI1MTI@._V1_QL75_UX494_.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BN2NmN2VhMTQtMDNiOS00NDlhLTliMjgtODE2ZTY0ODQyNDRhXkEyXkFqcGc@._V1_.jpg',
            'date' => '1999-03-31',
            'actors' => 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss, Hugo Weaving, Joe Pantoliano',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Keanu_Reeves',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Laurence_Fishburne',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Carrie-Anne_Moss',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Hugo_Weaving',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Joe_Pantoliano',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'vKQi3bBA1y8',
            'duration' => '136',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/Matrix/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214052Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=2123e418bca4b562dd0ef41e2b563a0c55d683b4e843c212ba39d48ca2bb65f4'
        ],
        [
            'id' => 5,
            'type' => 'movie',
            'title' => 'The Godfather',
            'description' => 'The Godfather est un film dramatique réalisé par Francis Ford Coppola, centré sur la famille mafieuse Corleone, dirigée par Don Vito Corleone, et le passage de pouvoir à son fils Michael.',
            'genre' => ['drame', 'thriller'],
            'image' => 'https://i.ebayimg.com/00/s/MTYwMFgxMDY2/z/s1kAAOSw9KFiaB2t/$_57.JPG?set_id=880000500F',
            'imagefond' => 'https://m.media-amazon.com/images/M/MV5BOTFhMzgwNzQtNTYzMS00NDdlLWJkMjYtMGY3ZGY5NjZjYjliXkEyXkFqcGc@._V1_QL75_UX310_.jpg',
            'affiche' => 'https://i.ebayimg.com/00/s/MTYwMFgxMDY2/z/s1kAAOSw9KFiaB2t/$_57.JPG?set_id=880000500F',
            'date' => '1972-03-14',
            'actors' => 'Marlon Brando, Al Pacino, James Caan, Diane Keaton, Richard S. Castellano',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Marlon_Brando',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Al_Pacino',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/James_Caan',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Diane_Keaton',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Richard_S._Castellano',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'bmtuIhesQWA',
            'duration' => '175',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/LeParrain/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214117Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=9ac77cfc50e2883997950849b45bd82ab55decf14dd4c611cb9a1ce36eba2e79'
        ],
        [
            'id' => 6,
            'type' => 'movie',
            'title' => 'Titanic',
            'description' => 'Titanic est un film romantique et dramatique réalisé par James Cameron, qui raconte l\'histoire d\'un amour naissant entre deux jeunes passagers à bord du Titanic lors de son tragique voyage inaugural.',
            'genre' => ['drame', 'romance'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/1/18/Titanic_%281997_film%29_poster.png',
            'imagefond' => 'https://i.cbc.ca/1.6690550.1671412533!/fileImage/httpImage/image.jpg_gen/derivatives/original_1180/titanic.jpg?im=',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/1/18/Titanic_%281997_film%29_poster.png',
            'date' => '1997-12-19',
            'actors' => 'Leonardo DiCaprio, Kate Winslet, Billy Zane, Danny Nucci, Bill Paxton',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Leonardo_DiCaprio',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Kate_Winslet',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Billy_Zane',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Danny_Nucci',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Bill_Paxton',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => 'aLRl4mnvfWQ',
            'duration' => '194',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/Titanic/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214142Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=18222a9a2b7a33ad74ecc80e1ae3a43097e057443313d3a01ef49c0940ffcd7c'
        ],
        [
            'id' => 7,
            'type' => 'movie',
            'title' => 'Pulp Fiction',
            'description' => 'Pulp Fiction est un film culte réalisé par Quentin Tarantino, qui tisse plusieurs histoires entrelacées dans un univers de crime, de violence et de rédemption.',
            'genre' => ['drame', 'thriller'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg',
            'imagefond' => 'https://m.media-amazon.com/images/M/MV5BNTY1MzgzOTYxNV5BMl5BanBnXkFtZTgwMDI4OTEwMjE@._V1_.jpg',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/3/3b/Pulp_Fiction_%281994%29_poster.jpg',
            'date' => '1994-05-21',
            'actors' => 'John Travolta, Uma Thurman, Samuel L. Jackson, Bruce Willis, Harvey Keitel',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/John_Travolta',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Uma_Thurman',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Samuel_L._Jackson',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Bruce_Willis',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Harvey_Keitel',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'gjAJnzTPltc',
            'duration' => '154',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/PulpFiction/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214142Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=18222a9a2b7a33ad74ecc80e1ae3a43097e057443313d3a01ef49c0940ffcd7c'
        ],
        [
            'id' => 8,
            'type' => 'movie',
            'title' => 'Inception',
            'description' => 'Inception est un film de science-fiction réalisé par Christopher Nolan, qui explore le concept de vol d\'idées à travers le partage de rêves. Un voleur expérimenté est chargé d\'implanter une idée dans l\'esprit d\'un PDG.',
            'genre' => ['sci-fi', 'action', 'thriller'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
            'imagefond' => 'https://farm5.static.flickr.com/4087/4834024368_24e4493bf1_o_d.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_.jpg',
            'date' => '2010-07-16',
            'actors' => 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page, Tom Hardy, Ken Watanabe',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Leonardo_DiCaprio',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Joseph_Gordon-Levitt',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Ellen_Page',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Tom_Hardy',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Ken_Watanabe',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'YoHD9XEInc0',
            'duration' => '148',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/Inception/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214117Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=9ac77cfc50e2883997950849b45bd82ab55decf14dd4c611cb9a1ce36eba2e79'
        ],
        [
            'id' => 9,
            'type' => 'movie',
            'title' => 'Forrest Gump',
            'description' => 'Forrest Gump est un film dramatique réalisé par Robert Zemeckis, qui raconte la vie exceptionnelle de Forrest Gump, un homme simple mais doté d\'une grande sagesse, qui traverse les événements majeurs de l\'histoire américaine.',
            'genre' => ['drame', 'comedie'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BNDYwNzVjMTItZmU5YS00YjQ5LTljYjgtMjY2NDVmYWMyNWFmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'imagefond' => 'https://media.cnn.com/api/v1/images/stellar/prod/140702154952-02-forrest-gump-restricted.jpg?q=w_2434,h_1631,x_0,y_0,c_fill',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BNDYwNzVjMTItZmU5YS00YjQ5LTljYjgtMjY2NDVmYWMyNWFmXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'date' => '1994-07-06',
            'actors' => 'Tom Hanks, Robin Wright, Gary Sinise, Mykelti Williamson, Sally Field',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Tom_Hanks',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Robin_Wright',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Gary_Sinise',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Mykelti_Williamson',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Sally_Field',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'Mj9IA9tTfio',
            'duration' => '142',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/MOVIES/13/VF/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214243Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=d5ec7d0c7ba5cc5a539381681c5a9d7b8284e26818d982458d8af2600c2818f6'
        ],
        [
            'id' => 10,
            'type' => 'movie',
            'title' => 'Gladiator',
            'description' => 'Gladiator est un film historique réalisé par Ridley Scott, qui raconte l\'histoire de Maximus, un général romain trahi qui cherche à venger sa famille et restaurer l\'honneur de Rome.',
            'genre' => ['action', 'drame', 'aventure'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/f/fb/Gladiator_%282000_film_poster%29.png',
            'imagefond' => 'https://static.esquire.de/0x0:1080x608/1080x608/images/2024-11/gladiator.jpg',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/f/fb/Gladiator_%282000_film_poster%29.png',
            'date' => '2000-05-05',
            'actors' => 'Russell Crowe, Joaquin Phoenix, Connie Nielsen, Oliver Reed, Richard Harris',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Russell_Crowe',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Joaquin_Phoenix',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Connie_Nielsen',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Oliver_Reed',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Richard_Harris',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'P5ieIbInFpg',
            'duration' => '155',
            'video' => 's'
        ],
        [
            'id' => 11,
            'type' => 'movie',
            'title' => 'Star Wars: A New Hope',
            'description' => 'Star Wars: A New Hope est le premier film de la saga Star Wars, réalisé par George Lucas, qui raconte les aventures de Luke Skywalker pour sauver la galaxie de l\'Empire Galactique.',
            'genre' => ['sci-fi', 'aventure', 'fantastique'],
            'image' => 'https://fr.web.img6.acsta.net/medias/nmedia/18/35/41/59/18422600.jpg',
            'imagefond' => 'https://lumiere-a.akamaihd.net/v1/images/image_c3178b6b.jpeg',
            'affiche' => 'https://fr.web.img6.acsta.net/medias/nmedia/18/35/41/59/18422600.jpg',
            'date' => '1977-05-25',
            'actors' => 'Mark Hamill, Harrison Ford, Carrie Fisher, Alec Guinness, Peter Cushing',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Mark_Hamill',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Harrison_Ford',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Carrie_Fisher',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Alec_Guinness',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Peter_Cushing',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'vZ734NWnAHA',
            'duration' => '121',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/MOVIES/GLADIATOR_2000/VF/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214305Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=a30eff86c778a78f65763e7d7d2f2e180e2801a898ed5fe823073aade6dcc700'
        ],
        [
            'id' => 12,
            'type' => 'movie',
            'title' => 'Jurassic Park',
            'description' => 'Jurassic Park est un film de science-fiction réalisé par Steven Spielberg, où un parc à thème peuplé de dinosaures génétiquement recréés devient hors de contrôle.',
            'genre' => ['sci-fi', 'aventure', 'thriller'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMjM2MDgxMDg0Nl5BMl5BanBnXkFtZTgwNTM2OTM5NDE@._V1_FMjpg_UX1000_.jpg',
            'imagefond' => 'https://m.media-amazon.com/images/M/MV5BMzNiMTE5ZTItZmZmMC00M2E5LWExZGYtYjAzMDZlMTM5NTkyXkEyXkFqcGdeQW1yb2Njbw@@._V1_.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMjM2MDgxMDg0Nl5BMl5BanBnXkFtZTgwNTM2OTM5NDE@._V1_FMjpg_UX1000_.jpg',
            'date' => '1993-06-11',
            'actors' => 'Sam Neill, Laura Dern, Jeff Goldblum, Richard Attenborough, Joseph Mazzello',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Sam_Neill',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Laura_Dern',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Jeff_Goldblum',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Richard_Attenborough',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Joseph_Mazzello',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'ZEY7iMX_oZs',
            'duration' => '127',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/Jurassic/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214335Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=b074445dbe92aa0d8d791c20a175388ff295c06ae1b4925711b449b91795bf56'
        ],
        [
            'id' => 13,
            'type' => 'movie',
            'title' => 'The Shawshank Redemption',
            'description' => 'The Shawshank Redemption est un film dramatique réalisé par Frank Darabont, qui raconte l\'histoire de la friendship entre deux détenus dans une prison, Andy Dufresne et Ellis Boyd Redding.',
            'genre' => ['drame'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg',
            'imagefond' => 'https://images.savoysystems.co.uk/ODY/16879129.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMDAyY2FhYjctNDc5OS00MDNlLThiMGUtY2UxYWVkNGY2ZjljXkEyXkFqcGc@._V1_.jpg',
            'date' => '1994-09-23',
            'actors' => 'Tim Robbins, Morgan Freeman, Bob Gunton, William Sadler, Clancy Brown',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Tim_Robbins',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Morgan_Freeman',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Bob_Gunton',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/William_Sadler',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Clancy_Brown',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'PLl99DlL6b4',
            'duration' => '142',
            'video' => 's'
        ],
        [
            'id' => 14,
            'type' => 'movie',
            'title' => 'The Lion King',
            'description' => 'The Lion King est un film d\'animation de Disney, qui raconte l\'histoire de Simba, un lionceau qui doit surmonter des épreuves pour devenir le roi de la Terre des Lions.',
            'genre' => ['animation', 'aventure'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/3/3d/The_Lion_King_poster.jpg',
            'imagefond' => 'https://images.bauerhosting.com/legacy/empire-tmdb/films/8587/images/klI0K4oQMsLhHdjA9Uw8WLugk9v.jpg?ar=16%3A9&fit=crop&crop=top&auto=format&w=undefined&q=80',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/3/3d/The_Lion_King_poster.jpg',
            'date' => '1994-06-15',
            'actors' => 'Matthew Broderick, James Earl Jones, Jeremy Irons, Whoopi Goldberg, Nathan Lane',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Matthew_Broderick',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/James_Earl_Jones',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Jeremy_Irons',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Whoopi_Goldberg',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Nathan_Lane',
            'rating' => 4.8,
            'is_featured' => true,
            'duration' => '88',
            'trailer_id' => 'KfIYw-D4Iw&',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/LeRoiLion/02.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214458Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=dad50e99691968aaca2874152215985ec9db90fa9ef2287dcf33cfc2beb45de0'
        ],
        [
            'id' => 15,
            'type' => 'movie',
            'title' => 'The Godfather Part II',
            'description' => 'Suite de \'The Godfather\', explorant à la fois l\'ascension de Vito Corleone et la consolidation du pouvoir de Michael Corleone.',
            'genre' => ['drame', 'thriller'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMDIxMzBlZDktZjMxNy00ZGI4LTgxNDEtYWRlNzRjMjJmOGQ1XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'imagefond' => 'https://variety.com/wp-content/uploads/2017/01/godfather-part-ii.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMDIxMzBlZDktZjMxNy00ZGI4LTgxNDEtYWRlNzRjMjJmOGQ1XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'date' => '1974-12-12',
            'actors' => 'Al Pacino, Robert De Niro, Robert Duvall, Diane Keaton, John Cazale',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Al_Pacino',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Robert_De_Niro',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Robert_Duvall',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Diane_Keaton',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/John_Cazale',
            'rating' => 4.9,
            'is_featured' => true,
            'duration' => '202',
            'trailer_id' => 'bmtuIhesQWA',
            'video' => 's'
        ],
        [
            'id' => 16,
            'type' => 'movie',
            'title' => 'The Lord of the Rings: The Fellowship of the Ring',
            'description' => 'Un jeune hobbit se lance dans une quête périlleuse pour détruire un anneau maléfique et sauver la Terre du Milieu.',
            'genre' => ['fantastique', 'aventure', 'action'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/f/fb/Lord_Rings_Fellowship_Ring.jpg',
            'imagefond' => 'https://images.bauerhosting.com/legacy/media/61b3/96ab/d603/e8f4/962f/75e5/fellowship.jpg?ar=16%3A9&fit=crop&crop=top&auto=format&w=1440&q=80',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/f/fb/Lord_Rings_Fellowship_Ring.jpg',
            'date' => '2001-12-19',
            'actors' => 'Elijah Wood, Ian McKellen, Viggo Mortensen, Sean Astin, Orlando Bloom',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Elijah_Wood',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Ian_McKellen',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Viggo_Mortensen',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Sean_Astin',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Orlando_Bloom',
            'rating' => 4.9,
            'is_featured' => true,
            'duration' => '178',
            'trailer_id' => 'vvx7m22GGtA',
            'video' => 'https://81c828508914d7e34e1fe68599576030.r2.cloudflarestorage.com/ablanco/Films/SeigneurDesAnneaux/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=f20a31fae81194a19dc3c5b063b39f10%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T214600Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=2f4d4fc3a7d0ca7da1d1cd613b947e580c1cb2905519d6b794a03ed9ae0d76c7'
        ],
        [
            'id' => 17,
            'type' => 'movie',
            'title' => 'Saving Private Ryan',
            'description' => 'Une unité de soldats américains est envoyée en mission pour retrouver un soldat dont les frères sont tous morts au combat.',
            'genre' => ['drame', 'action', 'guerre'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/a/ac/Saving_Private_Ryan_poster.jpg',
            'imagefond' => 'https://ychef.files.bbci.co.uk/1280x720/p0j2dzgq.jpg',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/a/ac/Saving_Private_Ryan_poster.jpg',
            'date' => '1998-07-24',
            'actors' => 'Tom Hanks, Matt Damon, Tom Sizemore, Edward Burns, Barry Pepper',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Tom_Hanks',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Matt_Damon',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Tom_Sizemore',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Edward_Burns',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Barry_Pepper',
            'rating' => 4.8,
            'is_featured' => true,
            'duration' => '169',
            'trailer_id' => 'tMfsrRZxAHg',
            'video' => 's'
        ]
    ];

    public function getFeaturedMovies($limit = 21) {
        return array_slice($this->movies, 0, $limit);
    }

    public function getTrendingMovies($limit = 21) {
        return array_slice($this->movies, 0, $limit);
    }

    public function getMovieById($id) {
        foreach ($this->movies as $movie) {
            if ($movie['id'] == $id) {
                return $movie;
            }
        }
        return null;
    }

    public function getVideoUrl($movieId) {
        $movie = $this->getMovieById($movieId);
        if ($movie && isset($movie['video'])) {
            return $movie['video'];
        }
        return null;
    }

    public function searchMovies($query) {
        $results = [];
        foreach ($this->movies as $movie) {
            if (stripos($movie['title'], $query) !== false || 
                stripos($movie['description'], $query) !== false) {
                $results[] = $movie;
            }
        }
        return $results;
    }

    public function getAllMovies() {
        return $this->movies;
    }

    public function getMoviesByGenre($genre) {
        $results = [];
        foreach ($this->movies as $movie) {
            if (in_array($genre, $movie['genre'])) {
                $results[] = $movie;
            }
        }
        return $results;
    }

    public function getMoviesByCategory($categoryId, $limit = 12) {
        $results = [];
        foreach ($this->movies as $movie) {
            if (stripos($movie['category'], $categoryId) !== false) {
                $results[] = $movie;
            }
        }
        return array_slice($results, 0, $limit);
    }

    public function incrementViews($id) {
        // Implementation needed
        return false;
    }

    public function updateRating($id, $rating) {
        // Implementation needed
        return false;
    }

    public function getLatestMovies($limit = 7) {
        $movies = $this->movies;
        usort($movies, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        return array_slice($movies, 0, $limit);
    }

    public function getSimilarMovies($currentMovieId, $genres, $limit = 4) {
        $similarMovies = [];
        $currentMovie = $this->getMovieById($currentMovieId);
        
        if (!$currentMovie) {
            return [];
        }

        foreach ($this->movies as $movie) {
            // Ne pas inclure le film actuel dans les suggestions
            if ($movie['id'] === $currentMovieId) {
                continue;
            }

            // Calculer le score de similarité basé sur les genres communs
            $commonGenres = array_intersect($movie['genre'], $genres);
            $similarityScore = count($commonGenres);

            if ($similarityScore > 0) {
                $movie['similarity_score'] = $similarityScore;
                $similarMovies[] = $movie;
            }
        }

        // Trier les films par score de similarité (décroissant)
        usort($similarMovies, function($a, $b) {
            return $b['similarity_score'] - $a['similarity_score'];
        });

        // Retourner les films les plus similaires
        return array_slice($similarMovies, 0, $limit);
    }

    public function getRandomMovies($limit = 4) {
        $movies = $this->movies;
        shuffle($movies);
        return array_slice($movies, 0, $limit);
    }

    public function getWatchlist($userId) {
        // Pour un visiteur, retourner un tableau vide
        if (strpos($userId, 'visitor_') === 0) {
            return [];
        }

        try {
            // Récupération de la configuration de la base de données
            $dbConfig = require_once __DIR__ . '/../config/dbconfig.php';
            
            // Connexion à la base de données
            $conn = new mysqli(
                $dbConfig['host'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['database']
            );
            
            if ($conn->connect_error) {
                throw new Exception("Connexion échouée: " . $conn->connect_error);
            }

            // Requête pour récupérer les films de la liste de surveillance
            $sql = "SELECT m.* FROM movies m 
                    INNER JOIN user_watchlist uw ON m.id = uw.movie_id 
                    WHERE uw.user_id = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $watchlist = [];
            while ($row = $result->fetch_assoc()) {
                $watchlist[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'rating' => $row['rating']
                ];
            }
            
            $stmt->close();
            $conn->close();
            
            return $watchlist;
            
        } catch (Exception $e) {
            // En cas d'erreur, retourner un tableau vide
            error_log("Erreur dans getWatchlist: " . $e->getMessage());
            return [];
        }
    }

    public function getLikedMovies($userId) {
        // Pour un visiteur, retourner un tableau vide
        if (strpos($userId, 'visitor_') === 0) {
            return [];
        }

        try {
            // Récupération de la configuration de la base de données
            $dbConfig = require_once __DIR__ . '/../config/dbconfig.php';
            
            // Connexion à la base de données
            $conn = new mysqli(
                $dbConfig['host'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['database']
            );
            
            if ($conn->connect_error) {
                throw new Exception("Connexion échouée: " . $conn->connect_error);
            }

            // Requête pour récupérer les films aimés par l'utilisateur
            $sql = "SELECT m.* FROM movies m 
                    INNER JOIN user_likes ul ON m.id = ul.movie_id 
                    WHERE ul.user_id = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $likedMovies = [];
            while ($row = $result->fetch_assoc()) {
                $likedMovies[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'rating' => $row['rating']
                ];
            }
            
            $stmt->close();
            $conn->close();
            
            return $likedMovies;
            
        } catch (Exception $e) {
            // En cas d'erreur, retourner un tableau vide
            error_log("Erreur dans getLikedMovies: " . $e->getMessage());
            return [];
        }
    }

    public function getWatchHistory($userId) {
        // Pour un visiteur, retourner un tableau vide
        if (strpos($userId, 'visitor_') === 0) {
            return [];
        }

        try {
            // Récupération de la configuration de la base de données
            $dbConfig = require_once __DIR__ . '/../config/dbconfig.php';
            
            // Connexion à la base de données
            $conn = new mysqli(
                $dbConfig['host'],
                $dbConfig['username'],
                $dbConfig['password'],
                $dbConfig['database']
            );
            
            if ($conn->connect_error) {
                throw new Exception("Connexion échouée: " . $conn->connect_error);
            }

            // Requête pour récupérer l'historique de visionnage
            $sql = "SELECT m.*, uh.watched_at FROM movies m 
                    INNER JOIN user_history uh ON m.id = uh.movie_id 
                    WHERE uh.user_id = ? 
                    ORDER BY uh.watched_at DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $watchHistory = [];
            while ($row = $result->fetch_assoc()) {
                $watchHistory[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'rating' => $row['rating'],
                    'watched_at' => $row['watched_at']
                ];
            }
            
            $stmt->close();
            $conn->close();
            
            return $watchHistory;
            
        } catch (Exception $e) {
            // En cas d'erreur, retourner un tableau vide
            error_log("Erreur dans getWatchHistory: " . $e->getMessage());
            return [];
        }
    }
} 