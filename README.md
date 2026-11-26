1. Cloner et demarrer l API Laravel (api-momotrail)
Assure-toi que Docker Desktop est ouvert, puis ouvre PowerShell :

PowerShell
git clone <URL_DE_TON_DEPOT_API_MOMOTRAIL>
cd api-momotrail
copy .env.example .env
New-Item -Path database/database.sqlite -ItemType File -Force
docker run --rm -v "${PWD}:/app" -w /app composer install
docker compose up -d
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
Ajoute ensuite les 2 sentiers de test dans la base de donnees :



PowerShell
docker compose exec app php artisan tinker

Colle ces 4 lignes puis appuie sur Entree :

$u = App\Models\User::first() ?? App\Models\User::factory()->create(['name' => 'Kevin']);
App\Models\Article::create(['user_id' => $u->id, 'title' => 'Sentier des Loups', 'subtitle' => 'Parc national de la Jacques-Cartier', 'content' => 'Sentier panoramique avec vue sur la vallee.', 'published_at' => now()]);
App\Models\Article::create(['user_id' => $u->id, 'title' => 'Mont du Lac des Cygnes', 'subtitle' => 'Charlevoix', 'content' => 'Sommet avec vue 360 degres sur Charlevoix.', 'published_at' => now()]);
exit

Ouvre http://localhost:8080/api/articles dans ton navigateur pour verifier que le JSON s affiche.
