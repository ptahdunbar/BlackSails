# WP Skeleton project - WIP.

This is simply a skeleton repo for a WordPress site. Use it to jump-start your WordPress site repos, or fork it and customize it to your own liking!

## Assumptions

* WordPress as a Git submodule in `/public/wp/`
* Custom content directory in `/public/content/` (cleaner, and also because it can't be in `/public/wp/`)
* `wp-config.php` in the root (because it can't be in `/public/wp/`)
* All writable directories are symlinked to similarly named locations under `/shared/`.


## Installation

```
git clone --recursive git@github.com:ptahdunbar/wp-skeleton.git wp.dev
```