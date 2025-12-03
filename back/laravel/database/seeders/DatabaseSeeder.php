<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Movie, Screening, Seat, User, Reservation, Ticket, Room};
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpiar datos existentes
        $this->truncateTables();

        // Crear salas
        $rooms = [
            [
                'id' => 1,
                'name' => 'Sala Estàndar',
                'has_vip' => false,
                'total_seats' => 120,
                'vip_seats' => 0
            ],
            [
                'id' => 2,
                'name' => 'Sala Premium',
                'has_vip' => true,
                'total_seats' => 120,
                'vip_seats' => 20
            ],
            [
                'id' => 3,
                'name' => 'Sala Deluxe',
                'has_vip' => true,
                'total_seats' => 120,
                'vip_seats' => 15
            ],
            [
                'id' => 4,
                'name' => 'Sala Boutique',
                'has_vip' => true,
                'total_seats' => 120,
                'vip_seats' => 10
            ],
            [
                'id' => 5,
                'name' => 'Sala Èpica',
                'has_vip' => true,
                'total_seats' => 120,
                'vip_seats' => 8
            ]
        ];

        foreach ($rooms as $roomData) {
            $room = Room::create($roomData);
            $this->generateSeats($room);
        }

        // Crear películas
        $moviesData = [
            [
                'imdb_id' => 'tt0068646',
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.',
                'duration' => 175,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BM2MyNjYxNmUtYTAwNi00MTYxLWJmNWYtYzZlODY3ZTk3OTFlXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1972,
                'genre' => 'Crime, Drama',
                'director' => 'Francis Ford Coppola',
                'actors' => 'Marlon Brando, Al Pacino, James Caan',
                'awards' => 'Won 3 Oscars. 32 wins & 30 nominations total',
                'imdb_rating' => 9.2,
                'box_office' => '$136,381,073'
            ],
            [
                'imdb_id' => 'tt1375666',
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'duration' => 148,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_SX300.jpg',
                'year' => 2010,
                'genre' => 'Action, Adventure, Sci-Fi',
                'director' => 'Christopher Nolan',
                'actors' => 'Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page',
                'awards' => 'Won 4 Oscars. 159 wins & 220 nominations total',
                'imdb_rating' => 8.8,
                'box_office' => '$292,587,330'
            ],
            [
                'imdb_id' => 'tt0111161',
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMDFkYTc0MGEtZmNhMC00ZDIzLWFmNTEtODM1ZmRlYWMwMWFmXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg',
                'year' => 1994,
                'genre' => 'Drama',
                'director' => 'Frank Darabont',
                'actors' => 'Tim Robbins, Morgan Freeman, Bob Gunton',
                'awards' => 'Nominated for 7 Oscars. 21 wins & 43 nominations total',
                'imdb_rating' => 9.3,
                'box_office' => '$28,341,469'
            ],
            [
                'imdb_id' => 'tt0468569',
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'duration' => 152,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_SX300.jpg',
                'year' => 2008,
                'genre' => 'Action, Crime, Drama',
                'director' => 'Christopher Nolan',
                'actors' => 'Christian Bale, Heath Ledger, Aaron Eckhart',
                'awards' => 'Won 2 Oscars. 159 wins & 163 nominations total',
                'imdb_rating' => 9.0,
                'box_office' => '$534,858,444'
            ],
            [
                'imdb_id' => 'tt0137523',
                'title' => 'Fight Club',
                'description' => 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.',
                'duration' => 139,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMmEzNTkxYjQtZTc0MC00YTVjLTg5ZTEtZWMwOWVlYzY0NWIwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1999,
                'genre' => 'Drama',
                'director' => 'David Fincher',
                'actors' => 'Brad Pitt, Edward Norton, Meat Loaf',
                'awards' => 'Nominated for 1 Oscar. 11 wins & 38 nominations total',
                'imdb_rating' => 8.8,
                'box_office' => '$37,030,102'
            ],
            [
                'imdb_id' => 'tt0109830',
                'title' => 'Forrest Gump',
                'description' => 'The presidencies of Kennedy and Johnson, the Vietnam War, the Watergate scandal and other historical events unfold from the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.',
                'duration' => 142,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNWIwODRlZTUtY2U3ZS00Yzg1LWJhNzYtMmZiYmEyNmU1NjMzXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_SX300.jpg',
                'year' => 1994,
                'genre' => 'Drama, Romance',
                'director' => 'Robert Zemeckis',
                'actors' => 'Tom Hanks, Robin Wright, Gary Sinise',
                'awards' => 'Won 6 Oscars. 50 wins & 75 nominations total',
                'imdb_rating' => 8.8,
                'box_office' => '$330,252,182'
            ],
            [
                'imdb_id' => 'tt0167260',
                'title' => 'The Lord of the Rings: The Return of the King',
                'description' => 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',
                'duration' => 201,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNzA5ZDNlZWMtM2NhNS00NDJjLTk4NDItYTRmY2EwMWZlMTY3XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 2003,
                'genre' => 'Action, Adventure, Drama',
                'director' => 'Peter Jackson',
                'actors' => 'Elijah Wood, Viggo Mortensen, Ian McKellen',
                'awards' => 'Won 11 Oscars. 209 wins & 124 nominations total',
                'imdb_rating' => 9.0,
                'box_office' => '$377,845,905'
            ],
            [
                'imdb_id' => 'tt0133093',
                'title' => 'The Matrix',
                'description' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'duration' => 136,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 1999,
                'genre' => 'Action, Sci-Fi',
                'director' => 'Lana Wachowski, Lilly Wachowski',
                'actors' => 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss',
                'awards' => 'Won 4 Oscars. 42 wins & 51 nominations total',
                'imdb_rating' => 8.7,
                'box_office' => '$171,479,930'
            ],
            [
                'imdb_id' => 'tt0120737',
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'description' => 'A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.',
                'duration' => 178,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_SX300.jpg',
                'year' => 2001,
                'genre' => 'Action, Adventure, Drama',
                'director' => 'Peter Jackson',
                'actors' => 'Elijah Wood, Ian McKellen, Orlando Bloom',
                'awards' => 'Won 4 Oscars. 121 wins & 126 nominations total',
                'imdb_rating' => 8.8,
                'box_office' => '$315,544,750'
            ],
            [
                'imdb_id' => 'tt0110912',
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.',
                'duration' => 154,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1994,
                'genre' => 'Crime, Drama',
                'director' => 'Quentin Tarantino',
                'actors' => 'John Travolta, Uma Thurman, Samuel L. Jackson',
                'awards' => 'Won 1 Oscar. 70 wins & 75 nominations total',
                'imdb_rating' => 8.9,
                'box_office' => '$107,928,762'
            ],
            [
                'imdb_id' => 'tt0114369',
                'title' => 'Se7en',
                'description' => 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his motives.',
                'duration' => 127,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BOTUwODM5MTctZjczMi00OTk4LTg3NWUtNmVhMTAzNTNjYjcyXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 1995,
                'genre' => 'Crime, Drama, Mystery',
                'director' => 'David Fincher',
                'actors' => 'Morgan Freeman, Brad Pitt, Kevin Spacey',
                'awards' => 'Nominated for 1 Oscar. 29 wins & 42 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$100,125,643'
            ],
            [
                'imdb_id' => 'tt1853728',
                'title' => 'Django Unchained',
                'description' => 'With the help of a German bounty-hunter, a freed slave sets out to rescue his wife from a brutal plantation-owner in Mississippi.',
                'duration' => 165,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjIyNTQ5NjQ1OV5BMl5BanBnXkFtZTcwODg1MDU4OA@@._V1_SX300.jpg',
                'year' => 2012,
                'genre' => 'Drama, Western',
                'director' => 'Quentin Tarantino',
                'actors' => 'Jamie Foxx, Christoph Waltz, Leonardo DiCaprio',
                'awards' => 'Won 2 Oscars. 58 wins & 158 nominations total',
                'imdb_rating' => 8.4,
                'box_office' => '$162,805,434'
            ],
            [
                'imdb_id' => 'tt0816692',
                'title' => 'Interstellar',
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'duration' => 169,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SX300.jpg',
                'year' => 2014,
                'genre' => 'Adventure, Drama, Sci-Fi',
                'director' => 'Christopher Nolan',
                'actors' => 'Matthew McConaughey, Anne Hathaway, Jessica Chastain',
                'awards' => 'Won 1 Oscar. 44 wins & 148 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$188,020,017'
            ],
            [
                'imdb_id' => 'tt0172495',
                'title' => 'Gladiator',
                'description' => 'A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.',
                'duration' => 155,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMDliMmNhNDEtODUyOS00MjNlLTgxODEtN2U3NzIxMGVkZTA1L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 2000,
                'genre' => 'Action, Adventure, Drama',
                'director' => 'Ridley Scott',
                'actors' => 'Russell Crowe, Joaquin Phoenix, Connie Nielsen',
                'awards' => 'Won 5 Oscars. 59 wins & 106 nominations total',
                'imdb_rating' => 8.5,
                'box_office' => '$187,705,427'
            ],
            [
                'imdb_id' => 'tt0080684',
                'title' => 'Star Wars: Episode V - The Empire Strikes Back',
                'description' => 'After the Rebels are brutally overpowered by the Empire on the ice planet Hoth, Luke Skywalker begins Jedi training with Yoda, while his friends are pursued across the galaxy by Darth Vader and bounty hunter Boba Fett.',
                'duration' => 124,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BYmU1NDRjNDgtMzhiMi00NjZmLTg5NGItZDNiZjU5NTU4OTE0XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1980,
                'genre' => 'Action, Adventure, Fantasy',
                'director' => 'Irvin Kershner',
                'actors' => 'Mark Hamill, Harrison Ford, Carrie Fisher',
                'awards' => 'Won 2 Oscars. 25 wins & 20 nominations total',
                'imdb_rating' => 8.7,
                'box_office' => '$290,475,067'
            ],
            [
                'imdb_id' => 'tt0120815',
                'title' => 'Saving Private Ryan',
                'description' => 'Following the Normandy Landings, a group of U.S. soldiers go behind enemy lines to retrieve a paratrooper whose brothers have been killed in action.',
                'duration' => 169,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZjhkMDM4MWItZTVjOC00ZDRhLThmYTAtM2I5NzBmNmNlMzI1XkEyXkFqcGdeQXVyNDYyMDk5MTU@._V1_SX300.jpg',
                'year' => 1998,
                'genre' => 'Drama, War',
                'director' => 'Steven Spielberg',
                'actors' => 'Tom Hanks, Matt Damon, Tom Sizemore',
                'awards' => 'Won 5 Oscars. 79 wins & 75 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$216,540,909'
            ],
            [
                'imdb_id' => 'tt0099685',
                'title' => 'Goodfellas',
                'description' => 'The story of Henry Hill and his life in the mob, covering his relationship with his wife Karen Hill and his mob partners Jimmy Conway and Tommy DeVito in the Italian-American crime syndicate.',
                'duration' => 146,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BY2NkZjEzMDgtN2RjYy00YzM1LWI4ZmQtMjIwYjFjNmI3ZGEwXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1990,
                'genre' => 'Biography, Crime, Drama',
                'director' => 'Martin Scorsese',
                'actors' => 'Robert De Niro, Ray Liotta, Joe Pesci',
                'awards' => 'Won 1 Oscar. 44 wins & 38 nominations total',
                'imdb_rating' => 8.7,
                'box_office' => '$46,836,394'
            ],
            [
                'imdb_id' => 'tt0071562',
                'title' => 'The Godfather: Part II',
                'description' => 'The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.',
                'duration' => 202,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMWMwMGQzZTItY2JlNC00OWZiLWIyMDctNDk2ZDQ2YjRjMWQ0XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg',
                'year' => 1974,
                'genre' => 'Crime, Drama',
                'director' => 'Francis Ford Coppola',
                'actors' => 'Al Pacino, Robert De Niro, Robert Duvall',
                'awards' => 'Won 6 Oscars. 17 wins & 20 nominations total',
                'imdb_rating' => 9.0,
                'box_office' => '$57,300,000'
            ],
            [
                'imdb_id' => 'tt0108052',
                'title' => 'Schindler\'s List',
                'description' => 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.',
                'duration' => 195,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNDE4OTMxMTctNmRhYy00NWE2LTg3YzItYTk3M2UwOTU5Njg4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 1993,
                'genre' => 'Biography, Drama, History',
                'director' => 'Steven Spielberg',
                'actors' => 'Liam Neeson, Ralph Fiennes, Ben Kingsley',
                'awards' => 'Won 7 Oscars. 91 wins & 49 nominations total',
                'imdb_rating' => 9.0,
                'box_office' => '$96,898,818'
            ],
            [
                'imdb_id' => 'tt0167261',
                'title' => 'The Lord of the Rings: The Two Towers',
                'description' => 'While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron\'s new ally, Saruman, and his hordes of Isengard.',
                'duration' => 179,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZGMxZTdjZmYtMmE2Ni00ZTdkLWI5NTgtNjlmMjBiNzU2MmI5XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 2002,
                'genre' => 'Action, Adventure, Drama',
                'director' => 'Peter Jackson',
                'actors' => 'Elijah Wood, Ian McKellen, Viggo Mortensen',
                'awards' => 'Won 2 Oscars. 126 wins & 138 nominations total',
                'imdb_rating' => 8.8,
                'box_office' => '$342,952,511'
            ],
            [
                'imdb_id' => 'tt0060196',
                'title' => 'The Good, the Bad and the Ugly',
                'description' => 'A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.',
                'duration' => 178,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNjJlYmNkZGItM2NhYy00MjlmLTk5NmQtNjg1NmM2ODU4OTMwXkEyXkFqcGdeQXVyMjUzOTY1NTc@._V1_SX300.jpg',
                'year' => 1966,
                'genre' => 'Adventure, Western',
                'director' => 'Sergio Leone',
                'actors' => 'Clint Eastwood, Eli Wallach, Lee Van Cleef',
                'awards' => '4 wins & 6 nominations',
                'imdb_rating' => 8.8,
                'box_office' => '$6,100,000'
            ],
            [
                'imdb_id' => 'tt0120689',
                'title' => 'The Green Mile',
                'description' => 'The lives of guards on Death Row are affected by one of their charges: a black man accused of child murder and rape, yet who has a mysterious gift.',
                'duration' => 189,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTUxMzQyNjA5MF5BMl5BanBnXkFtZTYwOTU2NTY3._V1_SX300.jpg',
                'year' => 1999,
                'genre' => 'Crime, Drama, Fantasy',
                'director' => 'Frank Darabont',
                'actors' => 'Tom Hanks, Michael Clarke Duncan, David Morse',
                'awards' => 'Nominated for 4 Oscars. 15 wins & 36 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$136,801,374'
            ],
            [
                'imdb_id' => 'tt0076759',
                'title' => 'Star Wars: Episode IV - A New Hope',
                'description' => 'Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a Wookiee and two droids to save the galaxy from the Empire\'s world-destroying battle station, while also attempting to rescue Princess Leia from the mysterious Darth Vader.',
                'duration' => 121,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BOTA5NjhiOTAtZWM0ZC00MWNhLThiMzEtZDFkOTk2OTU1ZDJkXkEyXkFqcGdeQXVyMTA4NDI1NTQx._V1_SX300.jpg',
                'year' => 1977,
                'genre' => 'Action, Adventure, Fantasy',
                'director' => 'George Lucas',
                'actors' => 'Mark Hamill, Harrison Ford, Carrie Fisher',
                'awards' => 'Won 7 Oscars. 63 wins & 29 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$460,998,507'
            ],
            [
                'imdb_id' => 'tt0102926',
                'title' => 'The Silence of the Lambs',
                'description' => 'A young F.B.I. cadet must receive the help of an incarcerated and manipulative cannibal killer to help catch another serial killer, a madman who skins his victims.',
                'duration' => 118,
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BNjNhZTk0ZmEtNjJhMi00YzFlLWE1MmEtYzM1M2ZmMGMwMTU4XkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg',
                'year' => 1991,
                'genre' => 'Crime, Drama, Thriller',
                'director' => 'Jonathan Demme',
                'actors' => 'Jodie Foster, Anthony Hopkins, Lawrence A. Bonney',
                'awards' => 'Won 5 Oscars. 69 wins & 51 nominations total',
                'imdb_rating' => 8.6,
                'box_office' => '$130,742,922'
            ]
        ];

        $movies = [];
        foreach ($moviesData as $movieData) {
            $movies[] = Movie::create($movieData);
        }

        $screeningDates = [];
        for ($i = 0; $i < 90; $i++) {
            $screeningDates[] = Carbon::today()->subDays(90)->addDays($i);
        }

        // Crear usuarios de prueba
        $users = [
            [
                'name' => 'Juan',
                'email' => 'juan@example.com',
            ],
            [
                'name' => 'María',
                'email' => 'maria@example.com',
            ],
            [
                'name' => 'Lorenzo',
                'email' => 'lorenzo@gmail.com',
                'password' => bcrypt('pirineus')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@cine.cat',
                'password' => bcrypt('pirineus')
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        foreach ($movies as $movie) {
            foreach ($screeningDates as $date) {
                if (rand(0, 100) > 70)
                    continue; // 30% de probabilidad de crear proyección

                Screening::create([
                    'movie_id' => $movie->id,
                    'room_id' => $rooms[rand(1, 4)]['id'],
                    'date' => $date,
                    'time' => $this->randomTime(),
                    'is_special' => rand(0, 1)
                ]);
            }
        }

        // Crear 100 usuarios
        User::factory()->count(100)->create();

        // Crear reservas históricas
        $this->createHistoricalData();

    }


    private function createHistoricalData()
    {
        $screenings = Screening::all();

        foreach ($screenings as $screening) {
            // 70% de probabilidad de crear reservas para esta proyección
            if (rand(0, 100) > 40)
                continue;

            $reservationCount = rand(2, 3);

            for ($i = 0; $i < $reservationCount; $i++) {
                $this->createReservation($screening);
            }
        }
    }

    private function createReservation(Screening $screening)
    {
        $user = User::inRandomOrder()->first();
        $seatCount = rand(1, 3);

        $seats = $screening->room->seats()
            ->whereDoesntHave('tickets', fn($q) => $q->where('screening_id', $screening->id))
            ->inRandomOrder()
            ->take($seatCount)
            ->get();

        if ($seats->isEmpty())
            return;

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'screening_id' => $screening->id
        ]);

        foreach ($seats as $seat) {
            Ticket::create([
                'reservation_id' => $reservation->id,
                'screening_id' => $screening->id,
                'seat_id' => $seat->id,
                'price' => $this->calculatePrice($seat, $screening)
            ]);
        }
    }

    private function randomTime()
    {
        $hours = ['16:00', '18:00', '20:00', '22:00'];
        return $hours[array_rand($hours)];
    }

    private function generateSeats(Room $room)
    {
        $rows = range('A', 'L');
        $seats = [];
        $vipCount = 0;

        foreach ($rows as $row) {
            for ($number = 1; $number <= 10; $number++) {
                $type = 'normal';

                if ($room->has_vip) {
                    // Distribuciones VIP diferentes por sala
                    switch ($room->name) {
                        case 'Sala Premium':
                            // VIP en filas F y G (primeros 10 asientos)
                            if (in_array($row, ['F', 'G']) && $number <= 10 && $vipCount < $room->vip_seats) {
                                $type = 'vip';
                                $vipCount++;
                            }
                            break;

                        case 'Sala Deluxe':
                            // VIP en filas E (8 asientos) y H (7 asientos)
                            if ((($row == 'E' && $number <= 8) || ($row == 'H' && $number <= 7)) && $vipCount < $room->vip_seats) {
                                $type = 'vip';
                                $vipCount++;
                            }
                            break;

                        case 'Sala Boutique':
                            // VIP en fila D completa
                            if ($row == 'D' && $vipCount < $room->vip_seats) {
                                $type = 'vip';
                                $vipCount++;
                            }
                            break;

                        case 'Sala Èpica':
                            // VIP dispersos en filas I y J
                            if ((in_array($row, ['I', 'J']) && $number % 2 == 0) && $vipCount < $room->vip_seats) {
                                $type = 'vip';
                                $vipCount++;
                            }
                            break;
                    }
                }

                $seats[] = [
                    'room_id' => $room->id,
                    'row' => $row,
                    'number' => $number,
                    'type' => $type,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        Seat::insert($seats);
    }

    private function truncateTables()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Ticket::truncate();
        Reservation::truncate();
        Seat::truncate();
        Screening::truncate();
        Room::truncate();
        Movie::truncate();
        User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function calculatePrice($seat, $screening)
    {
        $basePrice = $screening->is_special ? 4.00 : 6.00;
        return $seat->type === 'vip' ? $basePrice + 2.00 : $basePrice;
    }
}