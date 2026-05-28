## Cursor Cloud specific instructions

- This repo contains a single browser-based Trip Manager app. There are no package manager or Composer manifests, so the dependency refresh step is intentionally a no-op.
- The template `biolink-style386.php` expects a parent PHP host to define `ASSETS_FULL_URL` and `TRIP_VERSION`, and it loads JavaScript from `/trip/*.js` even though the files live in the repo root. In Cursor Cloud, run it with a temporary PHP router that defines those constants and maps `/trip/` requests back to the root files.
- Example dev-server router:
  1. Create `/tmp/trip-router.php` with a router that serves `/trip/trip-*.js` from `$_SERVER['DOCUMENT_ROOT']`, defines `ASSETS_FULL_URL` as `/`, defines `TRIP_VERSION` as `dev_`, and includes `biolink-style386.php` for `/` and `/biolink-style386.php`.
  2. Start the app with `php -S 127.0.0.1:8000 -t /workspace /tmp/trip-router.php`.
- Useful checks are `php -l biolink-style386.php` for the PHP template and `node --check trip-*.js` for the browser JavaScript modules.
- There is no database, queue, or backend API service for local development; core app state is stored in browser `localStorage`.
- Current UI add/import flows can show success while leaving dashboard data unchanged because some handlers save a cloned `TripCore` data object or reload after writing storage. For smoke tests, seed through `TripCore.importData()` before verifying dashboard, destinations, and expenses.
