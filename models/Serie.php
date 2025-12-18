<?php
class Serie {
    private $series = [
        [
            'id' => 101,
            'type' => 'serie',
            'title' => 'Breaking Bad',
            'description' => 'Un professeur de chimie atteint d\'un cancer se lance dans la fabrication de méthamphétamine pour assurer l\'avenir financier de sa famille.',
            'genre' => ['drame', 'thriller', 'crime'],
            'image' => 'https://fr.web.img5.acsta.net/pictures/19/06/18/12/11/3956503.jpg',
            'imagefond' => 'https://occ-0-8407-2218.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABUZRetY0NwWkIBQ-9QF0PLIDcuUCPKgno_8riE_In9tHRgqqTTSG-vGiP5ctXrVMY4PESkV5-x1LE_MGn32QtUZfnoNR4Hx9GoRI.jpg?r=9fa',
            'affiche' => 'https://fr.web.img5.acsta.net/pictures/19/06/18/12/11/3956503.jpg',
            'date' => '2008-01-20',
            'date_ajout' => '2024-04-01',
            'actors' => 'Bryan Cranston, Aaron Paul, Anna Gunn, Dean Norris, Betsy Brandt',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Bryan_Cranston',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Aaron_Paul',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Anna_Gunn',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Dean_Norris',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Betsy_Brandt',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'HhesaQXLuRY',
            'seasons' => 5,
            'episodes' => 62,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 102,
            'type' => 'serie',
            'title' => 'Game of Thrones',
            'description' => 'Neuf familles nobles se battent pour le contrôle des terres de Westeros, tandis qu\'un ancien ennemi revient après avoir été endormi pendant des millénaires.',
            'genre' => ['fantastique', 'drame', 'aventure'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMTNhMDJmNmYtNDQ5OS00ODdlLWE0ZDAtZTgyYTIwNDY3OTU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'imagefond' => 'https://media.newyorker.com/photos/5cae6ad5671c64058676f05c/master/pass/Larson-GameofThronesPreview.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMTNhMDJmNmYtNDQ5OS00ODdlLWE0ZDAtZTgyYTIwNDY3OTU3XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'date' => '2011-04-17',
            'date_ajout' => '2024-04-01',
            'actors' => 'Emilia Clarke, Kit Harington, Lena Headey, Peter Dinklage, Nikolaj Coster-Waldau',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Emilia_Clarke',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Kit_Harington',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Lena_Headey',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Peter_Dinklage',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Nikolaj_Coster-Waldau',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'gcTkNV5Vg1E',
            'seasons' => 8,
            'episodes' => 73,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1399/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221058Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=91fe7dee54e7a8c75d1de797370df25c324c2b179be4b47ba9de9e9856f5599b'
        ],
        [
            'id' => 103,
            'type' => 'serie',
            'title' => 'Stranger Things',
            'description' => 'Quand un jeune garçon disparaît, une petite ville découvre une affaire d\'expériences secrètes, de forces surnaturelles terrifiantes... et d\'une fillette.',
            'genre' => ['sci-fi', 'horreur', 'drame'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BMjg2NmM0MTEtYWY2Yy00NmFlLTllNTMtMjVkZjEwMGVlNzdjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'imagefond' => 'https://dnm.nflximg.net/api/v6/BvVbc2Wxr2w6QuoANoSpJKEIWjQ/AAAAQVJOiOuzyPyu1flQwWnrT1_EUpUpigi8_iSS8_7TyimYCg1QyRyU_BADZxE46ggSbIZsYAbsQjkYdjwX4euMoUnKxOghtcd1arZBKVZLszQVQWFFmAeJ3PZ1y0mws_ORbaADCmtFE-cfl8X-Fa5WcXnnsIU.jpg?r=e2c',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BMjg2NmM0MTEtYWY2Yy00NmFlLTllNTMtMjVkZjEwMGVlNzdjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'date' => '2016-07-15',
            'date_ajout' => '2024-04-01',
            'actors' => 'Millie Bobby Brown, Finn Wolfhard, Noah Schnapp, Caleb McLaughlin, Gaten Matarazzo',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Millie_Bobby_Brown',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Finn_Wolfhard',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Noah_Schnapp',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Caleb_McLaughlin',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Gaten_Matarazzo',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => 'b9EkMc79ZSU',
            'seasons' => 4,
            'episodes' => 34,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/66732/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221130Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=1f4d3f283c1fb73786f43d883e5cb56352e759257eb56cc8d76448252ab296d9'
        ],
        [
            'id' => 104,
            'type' => 'serie',
            'title' => 'The Witcher',
            'description' => 'Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.',
            'genre' => ['fantastique', 'action', 'aventure'],
            'image' => 'https://fr.web.img6.acsta.net/pictures/19/12/12/12/13/2421997.jpg',
            'imagefond' => 'https://occ-0-8407-90.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABU7gpMAYfvyueawBTChK__g2nos9dYiy4OW7GztXMmRA5gyDCLovfugu5n_mSxXJPNaiHgNPIg3hLLuOqtIBFvfX9htxXvCpYDaT.jpg?r=3ec',
            'affiche' => 'https://fr.web.img6.acsta.net/pictures/19/12/12/12/13/2421997.jpg',
            'date' => '2019-12-20',
            'date_ajout' => '2024-04-01',
            'actors' => 'Henry Cavill, Anya Chalotra, Freya Allan, Joey Batey, Eamon Farren',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Henry_Cavill',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Anya_Chalotra',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Freya_Allan',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Joey_Batey',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Eamon_Farren',
            'rating' => 4.6,
            'is_featured' => true,
            'trailer_id' => 'ndl1W4teCMw',
            'seasons' => 3,
            'episodes' => 24,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/71912/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221222Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=0f124d0a836ed575fa51547f303649ac30f8ab365fc1aee38ce0bf79c157194d'
        ],
        [
            'id' => 105,
            'type' => 'serie',
            'title' => 'The Mandalorian',
            'description' => 'Les aventures de Mandalorien, un chasseur de primes solitaire dans les contrées sauvages de la galaxie, au-delà de la juridiction de la Nouvelle République.',
            'genre' => ['sci-fi', 'action', 'aventure'],
            'image' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/The_Mandalorian_season_2_poster.jpg',
            'imagefond' => 'https://wallpapercat.com/w/full/9/1/6/11714-3840x2160-desktop-4k-the-mandalorian-wallpaper-image.jpg',
            'affiche' => 'https://upload.wikimedia.org/wikipedia/en/e/e7/The_Mandalorian_season_2_poster.jpg',
            'date' => '2019-11-12',
            'date_ajout' => '2024-04-01',
            'actors' => 'Pedro Pascal, Gina Carano, Carl Weathers, Giancarlo Esposito, Werner Herzog',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Pedro_Pascal',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Gina_Carano',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Carl_Weathers',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Giancarlo_Esposito',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Werner_Herzog',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'aOC8E8z_ifw',
            'seasons' => 3,
            'episodes' => 24,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/82856/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221247Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c3062f6343b52f2adc5f93df905e2378944e24aafa193817aadfecc455163761'
        ],
        [
            'id' => 106,
            'type' => 'serie',
            'title' => 'True Detective: Night Country',
            'description' => 'Dans la ville d\'Ennis en Alaska, huit hommes qui exploitent la station de recherche arctique Tsalal disparaissent sans laisser de trace. Pour résoudre l\'affaire, les détectives Liz Danvers et Evangeline Navarro devront affronter leurs démons et plonger dans les ténèbres pour découvrir la vérité.',
            'genre' => ['drame', 'thriller', 'mystère'],
            'image' => 'https://m.media-amazon.com/images/I/819iGLqVfJL.jpg',
            'imagefond' => 'https://img-4.linternaute.com/MRun4VhGxxEYOMa-6szhk1_ZUUU=/1500x/smart/67df20d46f2d4249beeb2ff41ca8cb7e/ccmcms-linternaute/53677422.jpg',
            'affiche' => 'https://m.media-amazon.com/images/I/819iGLqVfJL.jpg',
            'date' => '2024-01-14',
            'date_ajout' => '2024-04-01',
            'actors' => 'Jodie Foster, Kali Reis, Finn Bennett, Isabella Star LaBlanc, John Hawkes',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Jodie_Foster',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Kali_Reis',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Finn_Bennett',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Isabella_Star_LaBlanc',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/John_Hawkes_(actor)',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'IbcjTskigag',
            'seasons' => 1,
            'episodes' => 6,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 107,
            'type' => 'serie',
            'title' => 'Mr. & Mrs. Smith',
            'description' => 'Deux espions solitaires, John et Jane Smith, travaillent pour une mystérieuse agence qui leur fait croire qu\'ils sont mariés. Alors qu\'ils effectuent des missions à haut risque, ils commencent à développer de véritables sentiments l\'un pour l\'autre.',
            'genre' => ['action', 'comédie', 'espionnage'],
            'image' => 'https://m.media-amazon.com/images/M/MV5BZmQ0NmMyMDItZDNiNC00ZTBiLWI0ZDgtMTk5NDBmNmZhMDZmXkEyXkFqcGc@._V1_.jpg',
            'imagefond' => 'https://www.premiere.fr/sites/default/files/styles/scale_crop_1280x720/public/2023-11/MAMS_S1_UT_101_220614_LEEDAV_00678R_CropC2.jpg',
            'affiche' => 'https://m.media-amazon.com/images/M/MV5BZmQ0NmMyMDItZDNiNC00ZTBiLWI0ZDgtMTk5NDBmNmZhMDZmXkEyXkFqcGc@._V1_.jpg',
            'date' => '2024-02-02',
            'date_ajout' => '2024-04-01',
            'actors' => 'Donald Glover, Maya Erskine, Paul Dano, Michaela Coel, John Turturro',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Donald_Glover',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Maya_Erskine',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Paul_Dano',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Michaela_Coel',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/John_Turturro',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => 'ViKIMsxDfgI',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 109,
            'type' => 'serie',
            'title' => 'Shogun',
            'description' => 'En 1600, un navire européen s\'échoue au Japon, transportant des secrets qui pourraient déstabiliser le pays. Son pilote anglais, John Blackthorne, se retrouve plongé dans une lutte de pouvoir qui changera l\'histoire.',
            'genre' => ['drame', 'historique', 'action'],
            'image' => 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/C73612F3F38211D5F358E5435856D9583EB852891975112BC8C69B5AD61512B3/scale?width=506&aspectRatio=2.00&format=webp',
            'imagefond' => 'https://img.20mn.fr/SSStoH--S4WObPY-RVu7Gyk/1444x920_shogun-anjin-episode-1-airs-february-27-pictured-l-r-hiroyuki-sanada-as-yoshii-toranaga-yuki-kura-as-yoshii-nagakado-cr-katie-yu-fx',
            'affiche' => 'https://prod-ripcut-delivery.disney-plus.net/v1/variant/disney/C73612F3F38211D5F358E5435856D9583EB852891975112BC8C69B5AD61512B3/scale?width=506&aspectRatio=2.00&format=webp',
            'date' => '2024-02-27',
            'date_ajout' => '2024-04-01',
            'actors' => 'Hiroyuki Sanada, Cosmo Jarvis, Anna Sawai, Tadanobu Asano, Fumi Nikaido',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Hiroyuki_Sanada',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Cosmo_Jarvis',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Anna_Sawai',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Tadanobu_Asano',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Fumi_Nikaido',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'P0nW4h4HwE4',
            'seasons' => 1,
            'episodes' => 10,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 110,
            'type' => 'serie',
            'title' => '3 Body Problem',
            'description' => 'À travers le passé et le présent, une menace existentielle pour l\'humanité émerge, forçant un groupe de brillants scientifiques à unir leurs forces avec une détective peu orthodoxe pour affronter la plus grande menace de l\'histoire de la civilisation.',
            'genre' => ['sci-fi', 'drame', 'mystère'],
            'image' => 'https://fr.web.img5.acsta.net/pictures/24/03/07/16/16/3918310.jpg',
            'imagefond' => 'https://serieall.fr/images/1920_330/3-body-problem-108545-banner.jpg',
            'affiche' => 'https://fr.web.img5.acsta.net/pictures/24/03/07/16/16/3918310.jpg',
            'date' => '2024-03-21',
            'date_ajout' => '2024-04-01',
            'actors' => 'Rosalind Chao, Benedict Wong, Eiza González, Liam Cunningham, Jovan Adepo',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Rosalind_Chao',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Benedict_Wong',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Eiza_González',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Liam_Cunningham',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Jovan_Adepo',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'SdvzhCL7vIA',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 111,
            'type' => 'serie',
            'title' => 'Avatar: The Last Airbender',
            'description' => 'Adaptation en live-action de la série animée culte, suivant Aang, le dernier maître de l\'air, dans sa quête pour maîtriser les quatre éléments et rétablir l\'équilibre dans un monde déchiré par la guerre.',
            'genre' => ['fantastique', 'aventure', 'action'],
            'image' => 'https://fr.web.img3.acsta.net/pictures/24/01/22/16/15/0835298.jpg',
            'imagefond' => 'https://www.programme-tv.net/imgre/fit/~1~tel~2024~01~17~f4cc1992-0e00-46d0-83b1-480dacfc1500.jpeg/1200x600/crop-from/top/quality/80/avatar-le-dernier-maitre-de-l-air-pourquoi-la-serie-netflix-fait-polemique-avant-meme-sa-sortie.jpg',
            'affiche' => 'https://fr.web.img3.acsta.net/pictures/24/01/22/16/15/0835298.jpg',
            'date' => '2024-02-22',
            'date_ajout' => '2024-04-01',
            'actors' => 'Gordon Cormier, Kiawentiio Tarbell, Ian Ousley, Dallas Liu, Daniel Dae Kim',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Gordon_Cormier',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Kiawentiio_Tarbell',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Ian_Ousley',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Dallas_Liu',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Daniel_Dae_Kim',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => 'ByAn8DF8Ykk',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 112,
            'type' => 'serie',
            'title' => 'Fallout',
            'description' => 'Adaptation du célèbre jeu vidéo, l\'histoire suit une survivante d\'un abri anti-atomique qui doit explorer un monde post-apocalyptique ravagé par une guerre nucléaire, 200 ans après la catastrophe.',
            'genre' => ['sci-fi', 'action', 'aventure'],
            'image' => 'https://fr.web.img6.acsta.net/pictures/24/03/07/15/16/4242537.jpg',
            'imagefond' => 'https://static.lpnt.fr//images/2024/04/10/26354812lpw-26357028-article-jpg_10238439.jpg',
            'affiche' => 'https://fr.web.img6.acsta.net/pictures/24/03/07/15/16/4242537.jpg',
            'date' => '2024-04-11',
            'date_ajout' => '2024-04-01',
            'actors' => 'Ella Purnell, Walton Goggins, Kyle MacLachlan, Aaron Moten, Moisés Arias',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Ella_Purnell',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Walton_Goggins',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Kyle_MacLachlan',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Aaron_Moten',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Moisés_Arias',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => 'OLcnN3SsDno',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/106379/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221418Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=9f099d2284b547c040bae54bb3f334f95da770e74c7561dbfad31fc2271ca668'
        ],
        [
            'id' => 113,
            'type' => 'serie',
            'title' => 'The Penguin',
            'description' => 'Spin-off du film The Batman, cette série suit l\'ascension du Pingouin dans les bas-fonds criminels de Gotham City après la chute de Carmine Falcone.',
            'genre' => ['action', 'crime', 'drame'],
            'image' => 'https://fr.web.img3.acsta.net/img/63/52/6352ab41b772ed075e3a2484ad05af18.jpg',
            'imagefond' => 'https://img-4.linternaute.com/77JzSXTnSER6yhtUHsqPqVtXAT0=/1500x/smart/6c82e0e0ee5b40d2981fa23a1fd1ceeb/ccmcms-linternaute/65417745.jpg',
            'affiche' => 'https://fr.web.img3.acsta.net/img/63/52/6352ab41b772ed075e3a2484ad05af18.jpg',
            'date' => '2024-04-25',
            'date_ajout' => '2024-04-01',
            'actors' => 'Colin Farrell, Cristin Milioti, Rhenzy Feliz, Michael Kelly, Shohreh Aghdashloo',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Colin_Farrell',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Cristin_Milioti',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Rhenzy_Feliz',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Michael_Kelly_(actor)',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Shohreh_Aghdashloo',
            'rating' => 4.7,
            'is_featured' => true,
            'trailer_id' => 'sfJG6IiA_s8',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/194764/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221528Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=5a4c2b08eccad4beec5d3dec6868a6e6e411691c8b07e1a474047b2bb1a80776'
        ],
        [
            'id' => 114,
            'type' => 'serie',
            'title' => 'The Acolyte',
            'description' => 'Une série Star Wars se déroulant à la fin de l\'ère de la Haute République, suivant une ancienne Padawan qui retrouve son maître Jedi pour enquêter sur une série de crimes.',
            'genre' => ['sci-fi', 'action', 'mystère'],
            'image' => 'https://fr.web.img6.acsta.net/img/9c/b7/9cb7f211d16112ed9b5bdab65d67663d.jpg',
            'imagefond' => 'https://lumiere-a.akamaihd.net/v1/images/g_ondisneyplus_theacolyte_3201_108_4_b2f5e552.jpeg?region=1%2C0%2C1298%2C730',
            'affiche' => 'https://fr.web.img6.acsta.net/img/9c/b7/9cb7f211d16112ed9b5bdab65d67663d.jpg',
            'date' => '2024-06-04',
            'date_ajout' => '2024-04-01',
            'actors' => 'Amandla Stenberg, Lee Jung-jae, Manny Jacinto, Dafne Keen, Carrie-Anne Moss',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Amandla_Stenberg',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Lee_Jung-jae',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Manny_Jacinto',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Dafne_Keen',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Carrie-Anne_Moss',
            'rating' => 4.8,
            'is_featured' => true,
            'trailer_id' => '6hEZHyf9iKU',
            'seasons' => 1,
            'episodes' => 8,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/1396/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221029Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=c16dffdf21f0a03668ea5f3b5840786eeed87e5cf1cbc635659387da4fde9a91'
        ],
        [
            'id' => 115,
            'type' => 'serie',
            'title' => 'Daredevil: Born Again',
            'description' => 'Le retour de Matt Murdock alias Daredevil dans une nouvelle série qui promet d\'être plus sombre et plus mature, explorant à nouveau les rues de Hell\'s Kitchen.',
            'genre' => ['action', 'crime', 'drame'],
            'image' => 'https://fr.web.img6.acsta.net/img/8c/6c/8c6c4659ab0bc0764f06e2bf7c487d05.jpg',
            'imagefond' => 'https://c0.lestechnophiles.com/www.numerama.com/wp-content/uploads/2025/01/otk-106-45455-r2.jpg?resize=1200,675&key=cf3318f1&watermark',
            'affiche' => 'https://fr.web.img6.acsta.net/img/8c/6c/8c6c4659ab0bc0764f06e2bf7c487d05.jpg',
            'date' => '2025-01-01',
            'date_ajout' => '2024-04-01',
            'actors' => 'Charlie Cox, Vincent D\'Onofrio, Jon Bernthal, Wilson Bethel, Margarita Levieva',
            'actor_link_1' => 'https://en.wikipedia.org/wiki/Charlie_Cox',
            'actor_link_2' => 'https://en.wikipedia.org/wiki/Vincent_D\'Onofrio',
            'actor_link_3' => 'https://en.wikipedia.org/wiki/Jon_Bernthal',
            'actor_link_4' => 'https://en.wikipedia.org/wiki/Wilson_Bethel',
            'actor_link_5' => 'https://en.wikipedia.org/wiki/Margarita_Levieva',
            'rating' => 4.9,
            'is_featured' => true,
            'trailer_id' => 'DF4h9waAccc',
            'seasons' => 1,
            'episodes' => 18,
            'video' => 'https://349d4612ae38e32df1bda0ade6569e18.r2.cloudflarestorage.com/journey/SERIES/202555/VF/S01/01.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=310ae5e8630e8c3b82e08eb1c6c92bd7%2F20250427%2Fauto%2Fs3%2Faws4_request&X-Amz-Date=20250427T221610Z&X-Amz-SignedHeaders=host&X-Amz-Expires=43200&X-Amz-Signature=7dc8109a7690ed70bb9ba5269657b48de8c5960eecd72a5fac73c033269d57f2'
        ]
    ];

    public function getFeaturedSeries($limit = 5) {
        return array_slice($this->series, 0, $limit);
    }

    public function getTrendingSeries($limit = 5) {
        return array_slice($this->series, 0, $limit);
    }

    public function getSerieById($id) {
        foreach ($this->series as $serie) {
            if ($serie['id'] == $id) {
                return $serie;
            }
        }
        return null;
    }

    public function getVideoUrl($id) {
        $serie = $this->getSerieById($id);
        return $serie ? $serie['video'] : null;
    }

    public function searchSeries($query) {
        $results = [];
        foreach ($this->series as $serie) {
            if (stripos($serie['title'], $query) !== false || 
                stripos($serie['description'], $query) !== false) {
                $results[] = $serie;
            }
        }
        return $results;
    }

    public function getAllSeries() {
        return $this->series;
    }

    public function getSeriesByGenre($genre) {
        $results = [];
        foreach ($this->series as $serie) {
            if (in_array($genre, $serie['genre'])) {
                $results[] = $serie;
            }
        }
        return $results;
    }

    public function getSeriesByCategory($categoryId, $limit = 5) {
        $results = [];
        foreach ($this->series as $serie) {
            if (stripos($serie['category'], $categoryId) !== false) {
                $results[] = $serie;
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

    public function getLatestSeries($limit = 7) {
        $series = $this->series;
        usort($series, function($a, $b) {
            return strtotime($b['date_ajout']) - strtotime($a['date_ajout']);
        });
        return array_slice($series, 0, $limit);
    }

    public function getLikedSeries($userId) {
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

            // Requête pour récupérer les séries aimées par l'utilisateur
            $sql = "SELECT s.* FROM series s 
                    INNER JOIN user_likes ul ON s.id = ul.serie_id 
                    WHERE ul.user_id = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $likedSeries = [];
            while ($row = $result->fetch_assoc()) {
                $likedSeries[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'image' => $row['image'],
                    'rating' => $row['rating'],
                    'seasons' => $row['seasons'],
                    'episodes' => $row['episodes']
                ];
            }
            
            $stmt->close();
            $conn->close();
            
            return $likedSeries;
            
        } catch (Exception $e) {
            // En cas d'erreur, retourner un tableau vide
            error_log("Erreur dans getLikedSeries: " . $e->getMessage());
            return [];
        }
    }
} 