# SimpleBlog

Prosty blog oparty o Symfony, Doctrine i Twig.

## Wymagania
- PHP 8.1+
- Composer
- Docker (zalecane)
- PostgreSQL (domyślnie przez Docker)

## Instalacja

1. Sklonuj repozytorium:
   ```bash
   git clone https://github.com/Foool1/SimpleBlog.git
   cd SimpleBlog
   ```
2. Skopiuj plik konfiguracyjny środowiska:
   ```bash
   cp .env.example .env
   # Uzupełnij APP_SECRET i ewentualnie inne dane
   ```
3. Uruchom projekt przez Docker Compose:
   ```bash
   docker compose up --build -d
   ```
4. Zainstaluj zależności PHP (jeśli nie przez Docker):
   ```bash
   composer install
   ```
5. Wygeneruj i uruchom migracje:
   ```bash
   docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction
   ```
6. Aplikacja powinna być dostępna pod adresem: http://localhost:8000/

## Struktura projektu
- `src/` – kod PHP (kontrolery, encje, formularze)
- `templates/` – szablony Twig
- `public/` – publicznie dostępne pliki (index.php, assets)
- `migrations/` – pliki migracji bazy danych
- `assets/` – pliki JS/CSS

## Najważniejsze komendy
- Uruchomienie serwera: `docker compose up -d`
- Zatrzymanie serwera: `docker compose down`
- Wyczyść cache: `docker compose exec php php bin/console cache:clear`
- Tworzenie migracji: `docker compose exec php php bin/console make:migration`
- Uruchom migracje: `docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction`