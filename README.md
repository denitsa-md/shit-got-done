# Shit got done

Tells you what you did on Clubhouse today/yesterday/this week. Because sometimes we forget what we did yesterday

## Installation

```bash
composer require --dev denitsa/shit-got-done
```

## Usage

Set you Clubhouse API token and user in your `.env` file as: 

```bash
CLUBHOUSE_API_TOKEN=
CLUBHOUSE_USER=
```

Run the following command to see what you did this week.

```bash
php artisan shit-got-done --this-week
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
