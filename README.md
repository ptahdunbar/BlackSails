# WP Skeleton App

> This is a work in progress. Subject to sweeping changes at random intervals until the 1.0.0 :)

### Getting Started
> The following steps will prepare the environment

1. Clone the repo

```
git clone https://github.com/ptahdunbar/wp.git .
```

2. Download dependencies and prepare `.env` file (password prompt: `WordPress`) 

```
make
```


3. Edit `.env` based on your environment settings
* Provide local `DB_*` settings
* Make sure WP_HOME has no ending slashes
* Remove prefix underscores to active constants: e.g. `_WP_ALLOW_MULTISITE` to `WP_ALLOW_MULTISITE`

### Install
* Visit the url.
