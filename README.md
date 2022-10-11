

## Weather Forecast

This project will be used to monitor and access weather updates within the specific locations. It was built with Livewire and design with Tailwind CSS. Click here to know more about <a href="https://laravel-livewire.com/">Livewire</a> and <a href="https://tailwindcss.com/">Tailwind CSS</a>.

## Get Started

### Clone Repo

```shell
git clone https://github.com/ormelflores/weather-forecast.git
cd weather-forecast
```

### Install composer

```shell
comoposer install
```

### Install npm

```shell
npm install
npm run build
```

### Local env
copy your .env.example to .env

Add this to your env file
```shell
WEATHER_APP_KEY=
```
If you don't have an existing account, create an account from here and register your app to generate api key https://openweathermap.org/

### Development Server
You can use any development server locally that is compatible with laravel.

```shell
php artisan key:generate
```

### Git Convention

### Branch

- `feature/*` - for new feature and breaking changes
- `hotfixes/*` - for bug fixes

### Additional Note

Always rebase the current branch to the main branch before pusing to the origin.
