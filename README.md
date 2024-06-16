# Michele Capichioni Code Challenge

## Guide to run the project

Start by cloning the repository to your local machine.

```bash
git clone https://github.com/capimichi/base-code-challenge.git
```

Install the dependencies.

```bash
composer install
```

Copy the `.env.example` file to `.env` and configure the database.

```bash
cp .env.example .env
```

Install sail

```bash
php artisan sail:install
```

Start sail

```bash
./vendor/bin/sail up
```

Generate the application key.

```bash
./vendor/bin/sail artisan key:generate
```

Install npm dependencies.

```bash
./vendor/bin/sail npm install
```

If it throws an error, try removing package-lock.json and node_modules and run the command again.

Start frontend development server.

```bash
./vendor/bin/sail npm run dev
```

Migrate the database

```bash
./vendor/bin/sail artisan migrate
```

Create required roles

```bash
./vendor/bin/sail artisan app:role-create --name=admin
./vendor/bin/sail artisan app:role-create --name=user
```

Generate the sample data

```bash
./vendor/bin/sail artisan app:fake-data-generate
```
